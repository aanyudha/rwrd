<?php namespace App\Models;

use CodeIgniter\Model;

class RewardModel extends BaseModel
{
    protected $builderUsers;
    protected $builderPayouts;
    protected $builderPayoutAccounts;
    protected $builderGeneral;
    protected $builderPageviews;
    protected $builderRefTipeMember;
    protected $builderRefReward;
    protected $builderTrnHotel;
    protected $builderTrnOut;
    protected $builderMemberType;
    protected $builderRptPointMmbr;
    protected $builderPointHist;

    public function __construct()
    {
        parent::__construct();
        $this->builderUsers = $this->db->table('users');
        $this->builderPayouts = $this->db->table('payouts');
        $this->builderPayoutAccounts = $this->db->table('user_payout_accounts');
        $this->builderGeneral = $this->db->table('general_settings');
        $this->builderPageviews = $this->db->table('post_pageviews_month');
        $this->builderRefTipeMember = $this->db->table('ref_tipe_member');
        $this->builderRefReward = $this->db->table('ref_reward');
        $this->builderTrnHotel = $this->db->table('trn_hotel');
        $this->builderTrnOut = $this->db->table('trn_point_out');
        $this->builderMemberType = $this->db->table('v_member_type');
        $this->builderRptPointMmbr = $this->db->table('v_member_point');
        $this->builderPointHist = $this->db->table('lpe');
    }
	
	//input values hotel
    public function inputValuesMemberType()
    {
        return [
            'id_tipe_member' => inputPost('id_tipe_member'),
            'nama' => inputPost('nama'),
            'index' => inputPost('index'),
            'min_stays' => inputPost('min_stays'),
            'max_stays' => inputPost('max_stays'),
            'benefit' => inputPost('benefit')
        ];
    }

    //get page views counts by date
    public function getPageViewsCountByDate($userId)
    {
        return $this->builderPageviews->select('COUNT(id) AS count, SUM(reward_amount) as total_amount, DATE(created_at) AS date')
            ->where('post_user_id', cleanNumber($userId))->where('reward_amount > 0')->where('MONTH(created_at)', date('m'))->groupBy('date')->get()->getResult();
    }

    //update settings
    public function updateSettings()
    {
        $amount = inputPost('reward_amount');
        if ($amount < 0.01) {
            $amount = 0.01;
        }
        $data = [
            'reward_system_status' => inputPost('reward_system_status'),
            'reward_amount' => $amount
        ];
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //update payout methods
    public function updatePayoutMethods()
    {
        $data = [
            'payout_paypal_status' => inputPost('payout_paypal_status'),
            'payout_iban_status' => inputPost('payout_iban_status'),
            'payout_swift_status' => inputPost('payout_swift_status')
        ];
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //update currency
    public function updateCurrency()
    {
        $data = [
            'currency_name' => inputPost('currency_name'),
            'currency_symbol' => inputPost('currency_symbol'),
            'currency_format' => inputPost('currency_format'),
            'currency_symbol_format' => inputPost('currency_symbol_format')
        ];
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //get earnings
    public function getEarnings()
    {
        return $this->builderUsers->where('reward_system_enabled', 1)->orWhere('balance >', 0)->orderBy('balance DESC')->get()->getResult();
    }

    //get earnings count
    public function getEarningsCount()
    {
        $this->filterEarnings();
        return $this->builderUsers->countAllResults();
    }

    //get earnings paginated
    public function getEarningsPaginated($perPage, $offset)
    {
        $this->filterEarnings();
        return $this->builderUsers->orderBy('balance DESC')->limit($perPage, $offset)->get()->getResult();
    }

    //earnings filter
    public function filterEarnings()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderUsers->groupStart()->like('users.username', $q)->orLike('users.email', $q)->groupEnd();
        }
        $this->builderUsers->groupStart()->where('reward_system_enabled', 1)->orWhere('balance >', 0)->groupEnd();
    }

    //get payout
    public function getPayout($id)
    {
        return $this->builderPayouts->where('id', cleanNumber($id))->get()->getRow();
    }

    //get payouts count
    public function getPayoutsCount()
    {
        $this->filterPayouts();
        return $this->builderPayouts->countAllResults();
    }

    //get payouts paginated
    public function getPayoutsPaginated($perPage, $offset)
    {
        $this->filterPayouts();
        return $this->builderPayouts->orderBy('created_at DESC')->limit($perPage, $offset)->get()->getResult();
    }

    //payouts filter
    public function filterPayouts()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderPayouts->groupStart()->like('username', $q)->orLike('email', $q)->orLike('payout_method', $q)->groupEnd();
        }
    }

    //add payout
    public function addPayout($user, $amount)
    {
        if (!empty($user)) {
            $data = [
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'payout_method' => inputPost('payout_method'),
                'amount' => $amount,
                'created_at' => date('Y-m-d H:i:s')
            ];
            if ($this->builderPayouts->insert($data)) {
                $balance = $user->balance - $amount;
                if ($balance < 0) {
                    $balance = 0;
                }
                $this->builderUsers->where('id', $user->id)->update(['balance' => $balance]);
                return true;
            }
        }
        return false;
    }

    //delete payout
    public function deletePayout($id)
    {
        $payout = $this->getPayout($id);
        if (!empty($payout)) {
            return $this->builderPayouts->where('id', $payout->id)->delete();
        }
        return false;
    }

    //get user payouts count
    public function geUserPayoutsCount($userId)
    {
        return $this->builderPayouts->where('user_id', cleanNumber($userId))->countAllResults();
    }

    //get paginated user payouts
    public function getUserPayoutsPaginated($userId, $perPage, $offset)
    {
        return $this->builderPayouts->where('user_id', cleanNumber($userId))->orderBy('created_at DESC')->limit($perPage, $offset)->get()->getResult();
    }

    //get user payout account
    public function getUserPayoutAccount($userId)
    {
        $row = $this->db->table('user_payout_accounts')->where('user_id', cleanNumber($userId))->get()->getRow();
        if (!empty($row)) {
            return $row;
        }
        $user = getUserById($userId);
        if (!empty($user)) {
            $data = [
                'user_id' => $user->id,
                'payout_paypal_email' => '',
                'iban_full_name' => '',
                'iban_country' => '',
                'iban_bank_name' => '',
                'iban_number' => '',
                'swift_full_name' => '',
                'swift_address' => '',
                'swift_state' => '',
                'swift_city' => '',
                'swift_postcode' => '',
                'swift_country' => '',
                'swift_bank_account_holder_name' => '',
                'swift_iban' => '',
                'swift_code' => '',
                'swift_bank_name' => '',
                'swift_bank_branch_city' => '',
                'swift_bank_branch_country' => '',
                'default_payout_account' => ''
            ];
            $this->db->table('user_payout_accounts')->insert($data);
            return $this->db->table('user_payout_accounts')->where('user_id', $user->id)->get()->getRow();
        }
        return false;
    }

    //set paypal payout account
    public function setPaypalPayoutAccount()
    {
        $data = [
            'payout_paypal_email' => inputPost('payout_paypal_email')
        ];
        if (inputPost('default_payout_account') == 'paypal') {
            $data['default_payout_account'] = 'paypal';
        }
        return $this->builderPayoutAccounts->where('user_id', cleanNumber(user()->id))->update($data);
    }

    //set iban payout account
    public function setIbanPayoutAccount()
    {
        $data = [
            'iban_full_name' => inputPost('iban_full_name'),
            'iban_country' => inputPost('iban_country'),
            'iban_bank_name' => inputPost('iban_bank_name'),
            'iban_number' => inputPost('iban_number')
        ];
        if (inputPost('default_payout_account') == 'iban') {
            $data['default_payout_account'] = 'iban';
        }
        return $this->builderPayoutAccounts->where('user_id', cleanNumber(user()->id))->update($data);
    }

    //set swift payout account
    public function setSwiftPayoutAccount()
    {
        $data = [
            'swift_full_name' => inputPost('swift_full_name'),
            'swift_address' => inputPost('swift_address'),
            'swift_state' => inputPost('swift_state'),
            'swift_city' => inputPost('swift_city'),
            'swift_postcode' => inputPost('swift_postcode'),
            'swift_country' => inputPost('swift_country'),
            'swift_bank_account_holder_name' => inputPost('swift_bank_account_holder_name'),
            'swift_iban' => inputPost('swift_iban'),
            'swift_code' => inputPost('swift_code'),
            'swift_bank_name' => inputPost('swift_bank_name'),
            'swift_bank_branch_city' => inputPost('swift_bank_branch_city'),
            'swift_bank_branch_country' => inputPost('swift_bank_branch_country')
        ];
        if (inputPost('default_payout_account') == 'swift') {
            $data['default_payout_account'] = 'swift';
        }
        return $this->builderPayoutAccounts->where('user_id', cleanNumber(user()->id))->update($data);
    }

    //get paginated pageviews count
    public function getPageviewsCount()
    {
        $this->filterPageviews();
        return $this->builderPageviews->join('users', 'users.id = post_pageviews_month.post_user_id')
            ->select('post_pageviews_month.*, users.username AS author_username, users.slug AS author_slug')->countAllResults();
    }

    //get paginated pageviews
    public function getPageviewsPaginated($perPage, $offset)
    {
        $this->filterPageviews();
        return $this->builderPageviews->join('users', 'users.id = post_pageviews_month.post_user_id')
            ->select('post_pageviews_month.*, users.username AS author_username, users.slug AS author_slug')->orderBy('created_at DESC')->limit($perPage, $offset)->get()->getResult();
    }

    //pageviews filter
    public function filterPageviews()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderPageviews->groupStart()->like('users.username', $q)->orLike('ip_address', $q)->orLike('user_agent', $q)->groupEnd();
        }
    }

    //enable disable reward system
    public function enableDisableRewardSystem($user)
    {
        if (!empty($user)) {
            if ($user->reward_system_enabled == 1) {
                $data['reward_system_enabled'] = 0;
            } else {
                $data['reward_system_enabled'] = 1;
            }
            return $this->db->table('users')->where('id', $user->id)->update($data);
        }
        return false;
    }
	//TNTREM RWRDD
	//get member types
    public function getMemberTypes($id)
    {
		return $this->builderRefTipeMember->where('id_tipe_member', cleanNumber($id))->get()->getRow();
	}

    //get member types count
    public function getMemberTypesCount()
    {
        $this->filterMemberTypes();
        return $this->builderRefTipeMember->countAllResults();
    }

    //get member types paginated
    public function getMemberTypesPaginated($perPage, $offset)
    {
        $this->filterMemberTypes();
        return $this->builderRefTipeMember->orderBy('id_tipe_member ASC')->limit($perPage, $offset)->get()->getResult();
    }

    //member types filter
    public function filterMemberTypes()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderRefTipeMember->groupStart()->like('nama', cleanStr($q))->orLike('id_tipe_member', cleanStr($q))->orLike('min_stays', cleanStr($q))->orLike('max_stays', cleanStr($q))->orLike('benefit', cleanStr($q))->groupEnd();
        }
    }
	 //get hotel by MemberTypes nama
    public function getMemberTypesByNama($nama)
    {
        return $this->builderRefTipeMember->where('nama', removeForbiddenCharacters($nama))->get()->getRow();
    }
	//add MemberTypes
    public function addMemberTypes()
    {
		$data = $this->inputValuesMemberType();
        return $this->builderRefTipeMember->insert($data);
    }
	//check if MemberTypes name is unique
    public function isUniqueMemberTypesName($nama, $memberTypeId = 0)
    {
        $memberType = $this->getMemberTypesByNama($nama);
        if ($memberTypeId == 0) {
            if (!empty($memberType)) {
                return false;
            }
            return true;
        } else {
            if (!empty($memberType) && $memberType->id_tipe_member != $memberTypeId) {
                return false;
            }
            return true;
        }
    }
	//edit MemberTypes
    public function editMemberTypePost($id)
    {
        $membertyp = $this->getMemberTypes($id);
        if (!empty($membertyp)) {
            $data = [
			'id_tipe_member' => inputPost('id_tipe_member'),
            'nama' => inputPost('nama'),
            'index' => inputPost('index'),
            'min_stays' => inputPost('min_stays'),
            'max_stays' => inputPost('max_stays'),
            'benefit' => inputPost('benefit')
            ];
            return $this->builderRefTipeMember->where('id_tipe_member', $membertyp->id_tipe_member)->update($data);
        }
        return false;
    }
	//REF_REWARD
	//get ref reward
    public function getRefReward($id)
    {
		return $this->builderRefReward->where('id_reward', cleanNumber($id))->get()->getRow();
	}

    //getref reward count
    public function getRefRewardCount()
    {
        $this->filterRefReward();
        return $this->builderRefReward->countAllResults();
    }

    //get ref reward paginated
    public function getRefRewardPaginated($perPage, $offset)
    {
        $this->filterRefReward();
        return $this->builderRefReward->orderBy('id_reward ASC')->limit($perPage, $offset)->get()->getResult();
    }

    //ref reward filter
    public function filterRefReward()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderRefReward->groupStart()->like('nama', cleanStr($q))->orLike('id_reward', cleanStr($q))->groupEnd();
        }
    }
	//TRN-hotel
	//get trnHotel
    public function getTrnHotel($id)
    {
		return $this->builderTrnHotel->where('id_trn', cleanNumber($id))->get()->getRow();
	}

    //getref trnHotel count
    public function getTrnHotelCount()
    {
        $this->filterTrnHotel();
        return $this->builderTrnHotel->countAllResults();
    }

    //get ref trnHotel paginated
    public function getTrnHotelPaginated($perPage, $offset)
    {
        $this->filterTrnHotel();
        return $this->builderTrnHotel->orderBy('id_trn ASC')->limit($perPage, $offset)->get()->getResult();
    }

    //ref trnHotel filter
    public function filterTrnHotel()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderTrnHotel->groupStart()->like('id_member', cleanStr($q))->orLike('id_trn', cleanStr($q))->groupEnd();
        }
    }
	//get trnHotel by id
    public function getTrnHotelById($id)
    {
		return $this->builderTrnHotel->where('id_trn', cleanNumber($id))->get()->getRow();
	}
	//delete trnHotel
    public function deleteTrnHotelPost($id)
    {
        $trnHotel = $this->getTrnHotel($id);
        if (!empty($trnHotel)) {
            //if (!checkPostOwnership($trnHotel->user_id)) {
            //    return false;
            //}
            //delete trnHotel
            return $this->builderTrnHotel->where('id_trn', $trnHotel->id_trn)->delete();
        }
        return false;
    }
	//TRN_POINT_OUT
	//get trn point out
    public function getTrnPointOut($id)
    {
		return $this->builderTrnOut->where('id_point_out', cleanNumber($id))->get()->getRow();
	}

    //get TrnPointOut count
    public function getTrnPointOutCount()
    {
        $this->filterTrnPointOut();
        return $this->builderTrnOut->countAllResults();
    }

    //get TrnPointOut paginated
    public function getTrnPointOutPaginated($perPage, $offset)
    {
        $this->filterTrnPointOut();
        return $this->builderTrnOut->orderBy('id_point_out ASC')->limit($perPage, $offset)->get()->getResult();
    }

    //ref TrnPointOut filter
    public function filterTrnPointOut()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderTrnOut->groupStart()->like('id_member', cleanStr($q))->orLike('id_point_out', cleanStr($q))->groupEnd();
        }
    }
	//Mmbr_type_mtr
	//get Mmbr_type_monitor
    public function getMmbrTypeMtr($id)
    {
		return $this->builderMemberType->where('id_member', cleanNumber($id))->get()->getRow();
	}

    //get Mmbr_type_mtr count
    public function getMmbrTypeMtrCount()
    {
        $this->filterMmbrTypeMtr();
        return $this->builderMemberType->countAllResults();
    }

    //get Mmbr_type_mtr paginated
    public function getMmbrTypeMtrPaginated($perPage, $offset)
    {
        $this->filterMmbrTypeMtr();
        return $this->builderMemberType->orderBy('id_member ASC')->limit($perPage, $offset)->get()->getResult();
    }

    //ref Mmbr_type_mtr filter
    public function filterMmbrTypeMtr()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderMemberType->groupStart()->like('id_member', cleanStr($q))->orLike('name_on_card', cleanStr($q))->groupEnd();
        }
    }
	//Report Point by member
	//get rptPointMmbr
    public function getRptPointMmbr($id)
    {
		return $this->builderRptPointMmbr->where('id_member', cleanNumber($id))->get()->getRow();
	}

    //get RptPointMmbr count
    public function getRptPointMmbrCount()
    {
        $this->filterRptPointMmbr();
        return $this->builderRptPointMmbr->countAllResults();
    }

    //get RptPointMmbr paginated
    public function getRptPointMmbrPaginated($perPage, $offset)
    {
        $this->filterRptPointMmbr();
        return $this->builderRptPointMmbr->orderBy('id_member ASC')->limit($perPage, $offset)->get()->getResult();
    }

    //ref RptPointMmbr filter
    public function filterRptPointMmbr()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderRptPointMmbr->groupStart()->like('id_member', cleanStr($q))->orLike('name_on_card', cleanStr($q))->groupEnd();
        }
    }
	//get user point hist count
    public function geUserPointHistCount($userId)
    {
        return $this->builderPayouts->where('user_id', cleanNumber($userId))->countAllResults();
    }

    //get paginated user point hist
    public function getUserPointHistPaginated($userId, $perPage, $offset)
    {
        return $this->builderPayouts->where('user_id', cleanNumber($userId))->orderBy('created_at DESC')->limit($perPage, $offset)->get()->getResult();
    }
}