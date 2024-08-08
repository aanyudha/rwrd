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
    protected $builderTrnPointOut;
    protected $builderTrnReward;
    protected $builderTrnStatus;
    protected $builderMstMember;

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
        $this->builderPointHist = $this->db->table('ref_reward');
        $this->builderTrnPointOut = $this->db->table('trn_point_out');
        $this->builderTrnReward = $this->db->table('trn_reward');
        $this->builderTrnStatus = $this->db->table('trn_status');
        $this->builderMstMember = $this->db->table('mst_member');
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
	//input values hotel
    public function inputValuesRefReward()
    {
        return [
            'nama' => inputPost('nama'),
            'tipe' => inputPost('tipe'),
            'deskripsi' => inputPost('deskripsi')
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
	//get MemberTypes all
    public function getMemberTypesAll()
    {
        return $this->builderRefTipeMember->get()->getResult();
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
	//get hotel by MemberTypes nama
    public function getRefRewardByNama($nama)
    {
        return $this->builderRefReward->where('nama', removeForbiddenCharacters($nama))->get()->getRow();
    }
	//add ref reward
    public function addRefReward()
    {
		$data = $this->inputValuesRefReward();
		//add post image
        $postImageId = inputPost('post_image_id');
        if (!empty($postImageId)) {
            $fileModel = new FileModel();
            $image = $fileModel->getImage($postImageId);
            if (!empty($image)) {
                $data['foto'] = $image->image_big;
                // $data['image_default'] = $image->image_default;
                // $data['image_slider'] = $image->image_slider;
                // $data['image_mid'] = $image->image_mid;
                // $data['image_small'] = $image->image_small;
                // $data['image_mime'] = $image->image_mime;
                // if ($image->storage == 'aws_s3') {
                    // $data['image_storage'] = 'aws_s3';
                // }
            }
        }
        return $this->builderRefReward->insert($data);
    }
	//check if ref reward name is unique
    public function isUniqueRefRewardName($nama, $refRewardId = 0)
    {
        $refreward = $this->getRefRewardByNama($nama);
        if ($refRewardId == 0) {
            if (!empty($refreward)) {
                return false;
            }
            return true;
        } else {
            if (!empty($refreward) && $memberType->id_tipe_member != $refRewardId) {
                return false;
            }
            return true;
        }
    }
	//edit ref reward
    public function editRefRewardPost($id)
    {
        $memberref = $this->getRefReward($id);
        if (!empty($memberref)) {
            $data = [
			'id_reward' => inputPost('id_reward'),
            'nama' => inputPost('nama'),
            'tipe' => inputPost('tipe'),
            'deskripsi' => inputPost('deskripsi')
            ];
            return $this->builderRefReward->where('id_reward', $memberref->id_reward)->update($data);
        }
        return false;
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
	//delete ref reward
    public function delRefRewardPost($id)
    {
        $refRewrd = $this->getRefReward($id);
        if (!empty($refRewrd)) {
            // if (!checkPostOwnership($refRewrd->user_id)) {
                // return false;
            // }
            // delete additional images
            // $this->deleteAdditionalImages($post->id);
            // delete audios
            // $this->deletePostAudios($post->id);
            // delete list items
            // $postItemModel = new PostItemModel();
            // $postItemModel->deletePostListItems($post->id, 'gallery');
            // $postItemModel->deletePostListItems($post->id, 'sorted_list');
            // delete quiz questions
            // $quizModel = new QuizModel();
            // $quizModel->deleteQuizQuestions($post->id);
            // $quizModel->deleteQuizResults($post->id);
            // delete post tags
            // $tagModel = new TagModel();
            // $tagModel->deletePostTags($post->id);
            // delete comments
            // $this->db->table('comments')->where('post_id', $post->id)->delete();
            //delete post
            return $this->builderRefReward->where('id_reward', $refRewrd->id_reward)->delete();
        }
        return false;
    }

    //delete multi ref reward
    public function deleteRefRewardMultiPosts($postIds)
    {
        if (!empty($postIds)) {
            foreach ($postIds as $id) {
                $this->deletePost($id);
            }
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
        return $this->builderTrnHotel->orderBy('waktu_upload DESC')->limit($perPage, $offset)->get()->getResult();
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
        return $this->builderTrnOut->orderBy('tanggal_pengajuan DESC')->limit($perPage, $offset)->get()->getResult();
    }

    //ref TrnPointOut filter
    public function filterTrnPointOut()
    {
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $this->builderTrnOut->groupStart()->like('id_member', cleanStr($q))->orLike('id_point_out', cleanStr($q))->groupEnd();
        }
    }
	
	public function getStatusForPointOut()
    {
		return $this->builderTrnStatus->get()->getResult();
	}
	
	//edit ref reward
    public function editPointOutPost($id)
    {
        $pointout = $this->getTrnPointOut($id);
        if (!empty($pointout)) {
            $data = [
            'status' => inputPost('status'),
            'tanggal_pengajuan' => formatDateOnly(inputPost('tanggal_pengajuan')),
            'tanggal_proses' => formatDateOnly(inputPost('tanggal_proses')),
            'tanggal_claim' => formatDateOnly(inputPost('tanggal_claim'))
            ];
            return $this->builderTrnPointOut->where('id_point_out', $pointout->id_point_out)->update($data);
        }
        return false;
	}
	//Mmbr_type_mtr
	//get Mmbr_type_monitor
    public function getMmbrTypeMtr($id)
    {
		return $this->builderMstMember->where('id_member', cleanNumber($id))->get()->getRow()->id_tipe_member;
	}
	
	public function getMmbrTypeNameMtr($id)
    {
		return $this->builderRefTipeMember->where('id_tipe_member', cleanNumber($id))->get()->getRow()->nama;
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
	public function getMmbrTypeMtrCmn($id)
    {
		return $this->builderMemberType->where('id_member', cleanNumber($id))->get()->getRow();
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
	
	//enable disable reward system
    public function enableDisableRewardSystemMember($member)
    {
        if (!empty($member)) {
            if ($member->reward_system_enabled == 1) {
                $data['reward_system_enabled'] = 0;
            } else {
                $data['reward_system_enabled'] = 1;
            }
            return $this->db->table('mst_member')->where('id_member', $member->id_member)->update($data);
        }
        return false;
    }
	//get Member point hist 
    public function getPointHistoryByMemberId($memberId)
    {
        return $this->builderTrnHotel->where('id_member', cleanNumber($memberId))->get()->getResult();
    }

    //get paginated Member point hist
    public function getPointHistPromo()
    {
        return $this->builderPointHist->join('trn_point_konversi', 'trn_point_konversi.id_reward=ref_reward.id_reward')->select('trn_point_konversi.*,ref_reward.nama,ref_reward.foto,ref_reward.deskripsi')->get()->getResult();
	}
	//get paginated Member point hist
    public function getHistRedemp()
    {
        $sql = "select rr.nama,tpo.* from trn_point_out tpo,trn_reward tr,ref_reward rr where tpo.id_reward=tr.id_reward and tr.id_reward=rr.id_reward and tpo.id_member= '" . user()->id_member . "'";
        $result = $this->db->query($sql)->getResult();
		return $result;
	}
	//get paginated Member point hist
    public function getHistRedempPromo()
    {
        return $this->builderPointHist->join('trn_point_konversi', 'trn_point_konversi.id_reward=ref_reward.id_reward')->select('trn_point_konversi.*,ref_reward.nama,ref_reward.foto')->get()->getResult();
	}
	//get paginated Member point hist
    public function getGift4You()
    {
        $sql = "select t.*,t.id_reward,r.tipe,r.nama,r.foto,(select point from trn_point_konversi where trn_point_konversi.id_reward=t.id_reward and now() between tanggal_buka and tanggal_tutup) as promo,(select tanggal_tutup from trn_point_konversi where trn_point_konversi.id_reward=t.id_reward and now() between tanggal_buka and tanggal_tutup) as tanggal_tutup from trn_reward t, ref_reward r where t.id_reward=r.id_reward and now() between tanggal_mulai_berlaku and tanggal_selesai";
        $result = $this->db->query($sql)->getResult();
		return $result;
	}
	public function last_point()
	{
		$query = $this->db->query("select ifnull(sum(point),0)-ifnull((select sum(point*qty) from trn_point_out where id_member='".member()->id_member."' and status<>'Canceled' and id_reward<>0),0)-ifnull((select sum(point*qty) from trn_point_out where id_member='".user()->id_member."' and id_reward=0),0) as hasil from trn_point_in where id_member='" . user()->id_member . "'")->getResult();		
		return $query[0]->hasil;
	}
	//
    public function getGift4YouPostCart($idTrnReward)
    {
        $sql = "select id_reward from trn_reward where id_trn_reward=$idTrnReward";
        $result = $this->db->query($sql)->getResult();
		return $result;
	}
	public function getGift4YouPointPostCart($idTrnReward)
    {
        $sql = "select ifnull((select point from trn_point_konversi where id_reward=t.id_reward and now() between tanggal_buka and tanggal_tutup),t.index_point) as point from trn_reward t where t.id_trn_reward=$idTrnReward and now() between t.tanggal_mulai_berlaku and t.tanggal_selesai";
        $result = $this->db->query($sql)->getResult();
		return $result;
	}
	
	public function addTrnPointOut()
    {
		$request = service('request'); // Mengambil instance request
        
        // Mengambil data POST menggunakan request
        $cartDataJson = $request->getPost('cart');
        
        // Decode JSON data
        $cartData = json_decode($cartDataJson, true); // true untuk array, false untuk objek

        if (json_last_error() === JSON_ERROR_NONE) {
            // Data JSON berhasil di-decode
            foreach ($cartData as $key1=>$value1 ) {
                // Proses setiap item sesuai kebutuhan
                // $data = [
                    // 'product_image' => $item['product_id'],
                    // 'product_image' => $item['product_image'],
                    // 'product_name' => $item['product_name'],
                    // 'product_price' => $item['product_price'],
                    // 'product_quantity' => $item['product_quantity'],
                    // 'unique_key' => $item['unique_key']
                // ];
                $qty=$value1['product_quantity'];
                $membere=member()->id_member;
				$query1=$this->getGift4YouPostCart($value1['product_id']);
				$point=$this->getGift4YouPointPostCart($value1['product_id']);			
				$data = array(
					'id_member'=>$membere,
					'id_reward'=>$query1[0]->id_reward,
					'qty'=>$qty,
					'point'=>$point[0]->point,
					'tanggal_pengajuan'=>date("Y-m-d"),
				);
				
				$result = $this->builderTrnPointOut->insert($data);
				if($result){
					$lastIDPost = $this->db->insertID();
					return ['lastIDPost' => $lastIDPost, 'id_member' => $data['id_member'],'id_reward' => $data['id_reward'],'qty' => $data['qty'],'point' => $data['point'],'tanggal_pengajuan' => $data['tanggal_pengajuan']];
				}else {
					return false;
				}
            }
        } else {
            // Tangani error jika JSON tidak valid
            echo 'Invalid JSON';
        }
    }
}