<?php

namespace App\Controllers;

use App\Models\RewardModel;
use App\Models\PostAdminModel;

class RewardController extends BaseAdminController
{
    protected $rewardModel;
	protected $postAdminModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        if (!isAdmin()) {
            redirectToUrl(adminUrl());
            exit();
        }
        $this->rewardModel = new RewardModel();
		$this->postAdminModel = new PostAdminModel();
    }

    /**
     * Reward System
     */
    public function rewardSystem()
    {
        $data['title'] = trans("reward_system");
        $data['userSession'] = getUserSession();

        echo view('admin/includes/_header', $data);
        echo view('admin/reward/reward_system', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Update Settings Post
     */
    public function updateSettingsPost()
    {
        if ($this->rewardModel->updateSettings()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->to(adminUrl('reward-system'));
    }

    /**
     * Update Payout Post
     */
    public function updatePayoutPost()
    {
        if ($this->rewardModel->updatePayoutMethods()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->to(adminUrl('reward-system'));
    }

    /**
     * Update Currency Post
     */
    public function updateCurrencyPost()
    {
        if ($this->rewardModel->updateCurrency()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->to(adminUrl('reward-system'));
    }

    /**
     * Earnings
     */
    public function earnings()
    {
        $data['title'] = trans("earnings");
        $numRows = $this->rewardModel->getEarningsCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['earnings'] = $this->rewardModel->getEarningsPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/reward/earnings', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Payouts
     */
    public function payouts()
    {
        $data['title'] = trans("payouts");
        $numRows = $this->rewardModel->getPayoutsCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['payouts'] = $this->rewardModel->getPayoutsPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/reward/payouts', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Add Payout
     */
    public function addPayout()
    {
        $data['title'] = trans("add_payout");
        $data['users'] = $this->rewardModel->getEarnings();

        echo view('admin/includes/_header', $data);
        echo view('admin/reward/add_payout', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Add Payout Post
     */
    public function addPayoutPost()
    {
        $userId = inputPost('user_id');
        $amount = inputPost('amount');
        $user = getUserById($userId);
        if (!empty($user)) {
            if ($user->balance < $amount) {
                $this->session->setFlashdata('error', trans("insufficient_balance"));
            } else {
                if ($this->rewardModel->addPayout($user, $amount)) {
                    $this->session->setFlashdata('success', trans("msg_payout_added"));
                } else {
                    $this->session->setFlashdata('error', trans("msg_error"));
                }
            }
        }
        return redirect()->to(adminUrl('reward-system/add-payout'));
    }

    /**
     * Delete Payout Post
     */
    public function deletePayoutPost()
    {
        $id = inputPost('id');
        if ($this->rewardModel->deletePayout($id)) {
            $this->session->setFlashdata('success', trans("msg_deleted"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }

    /**
     * Pageviews
     */
    public function pageviews()
    {
        $data['title'] = trans("pageviews");
        $numRows = $this->rewardModel->getPageviewsCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['pageviews'] = $this->rewardModel->getPageviewsPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/reward/pageviews', $data);
        echo view('admin/includes/_footer');
    }
	/**
     * View MemberTypes
     */
	public function refMemberTypes()
    {
        $data['title'] = trans("ref-tipe-member");
		$data['rwrdType'] = 'refMemberType';
        $numRows = $this->rewardModel->getMemberTypesCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['tipemember'] = $this->rewardModel->getMemberTypesPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/member_types', $data);
        echo view('admin/includes/_footer');
    }
	/**
     * Edit MemberTypes
     */
    public function editMemberTypes($id)
    {
        checkAdmin();
        $data['panelSettings'] = panelSettings();
        $data['title'] = trans("edit-ref-tipe-member");
        $data['tipemember'] = getMemberTypesById($id);
        if (empty($data['tipemember'])) {
            return redirect()->to(adminUrl('reward-system/ref-tipe-member'));
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/edit_membertypes', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Edit MemberTypes Post
     */
    public function editMemberTypesPost()
    {
        checkAdmin();
        $id_tipe_member = inputPost('id_tipe_member');
        if ($this->rewardModel->editMemberTypePost($id_tipe_member)) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->to(adminUrl('reward-system/ref-tipe-member'));
    }
	/**
     * Add MemberTypes
     */
    public function addMemberTypes()
    {
        checkAdmin();
        $data['title'] = trans("add-ref-tipe-member");

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/add_membertypes');
        echo view('admin/includes/_footer');
    }
	
	/**
     * Add Post Member Types
     */
    public function addMemberTypesPost()
    {
        //checkPermission('add_post');
		checkAdmin();
        $val = \Config\Services::validation();
        $val->setRule('id_tipe_member', trans("id-ref-tipe-member"), 'required');
        $val->setRule('nama', trans("nama-ref-tipe-member"), 'required|max_length[500]');
        $val->setRule('index', trans("index-ref-tipe-member"), 'required');
        $val->setRule('min_stays', trans("min_stays-ref-tipe-member"), 'required');
        $val->setRule('max_stays', trans("max_stays-ref-tipe-member"), 'required');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->to(adminUrl('reward-system/add-tipe-member'))->withInput();
        } else {
            $id_tipe_member = inputPost('id_tipe_member');
            $nama = inputPost('nama');
			if (!$this->rewardModel->isUniqueMemberTypesName($nama, $id_tipe_member)) {
                $this->session->setFlashdata('error', trans("msg_member_type_kode_unique_error"));
                return redirect()->to(adminUrl('reward-system/add-tipe-member'))->withInput();
            }
            if ($this->rewardModel->addMemberTypes()) {
                $this->session->setFlashdata('success', trans("msg_updated"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
                return redirect()->to(adminUrl('reward-system/add-tipe-member'))->withInput();
            }
        }
        return redirect()->to(adminUrl('reward-system/add-tipe-member'))->withInput();
    }
	/**
     * View RefReward
     */
	public function refReward()
    {
        $data['title'] = trans("rewards-list");
		$data['rwrdType'] = 'refRewardType';
        $numRows = $this->rewardModel->getRefRewardCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['refrewarddd'] = $this->rewardModel->getRefRewardPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/ref_reward', $data);
        echo view('admin/includes/_footer');
    }
	/**
     * Add RefReward
     */
    public function addRefReward()
    {
        checkAdmin();
        $data['title'] = trans("trn-hotel-add");
        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/add_refreward');
		echo view('admin/includes/_footer');
    }
	/**
     * Add Post RefReward
     */
    public function addRefRewardPost()
    {
        //checkPermission('add_post');
		checkAdmin();
        $val = \Config\Services::validation();
        $val->setRule('nama', trans("nama-ref-tipe-member"), 'required|max_length[500]');
        $val->setRule('tipe', trans("index-ref-tipe-member"), 'required');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->to(adminUrl('reward-system/add-ref-reward'))->withInput();
        } else {
            $id_reward = inputPost('id_reward');
            $nama = inputPost('nama');
			if (!$this->rewardModel->isUniqueRefRewardName($nama, $id_reward)) {
                $this->session->setFlashdata('error', trans("msg_member_type_kode_unique_error"));
                return redirect()->to(adminUrl('reward-system/add-ref-reward'))->withInput();
            }
            if ($this->rewardModel->addRefReward()) {
                $this->session->setFlashdata('success', trans("msg_updated"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
                return redirect()->to(adminUrl('reward-system/add-ref-reward'))->withInput();
            }
        }
        return redirect()->to(adminUrl('reward-system/add-ref-reward'))->withInput();
    }
	/**
     * Edit RefReward
     */
    public function editRefReward($id)
    {
        //checkAdmin();
        $data['panelSettings'] = panelSettings();
        $data['title'] = trans("edit-ref-rewards");
        $data['refrewards'] = getRefRewardById($id);
        if (empty($data['refrewards'])) {
            return redirect()->to(adminUrl('reward-system/ref-reward'));
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/edit_refrewards', $data);
        echo view('admin/includes/_footer');
    }
	/**
     * Edit RefReward Post
     */
    public function editRefRewardPost()
    {
        //checkAdmin();
        $id_reward = inputPost('id_reward');
        if ($this->rewardModel->editRefRewardPost($id_reward)) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->to(adminUrl('reward-system/ref-reward'));
    }
	/**
     * Delete RefReward
     */
    public function deleteRefRewardPost()
    {
        //checkPermission('add_post');
        $id = inputPost('id');
		// $platNomor=$_GET[$id];
        if ($this->rewardModel->delRefRewardPost($id)) {
            $this->session->setFlashdata('success', trans("msg_deleted"));
            resetCacheDataOnChange();
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }
	
	/**
     * View trnHotel
     */
	public function trnHotel()
    {
		checkAdmin();
        $data['title'] = trans("trn-hotel");
        $numRows = $this->rewardModel->getTrnHotelCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
		$data['panelSettings'] = panelSettings();
		$data['rwrdType'] = 'trnType';
        $data['trnhtl'] = $this->rewardModel->getTrnHotelPaginated($this->perPage, $pager->offset);
		$data['ptaip'] = $this->rewardModel->enum_select_pointType();

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/trn_hotel', $data);
        echo view('admin/includes/_footer');
    }
	/**
     * Add trnHotel
     */
    public function addTrnHotel()
    {
        checkAdmin();
        $data['title'] = trans("trn-hotel-add");

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/add_trnhotel');
    }
	/**
     * Add Post trnHotel
     */
    public function addTrnHotelPost()
    {
        //checkPermission('add_post');
		checkAdmin();
        $val = \Config\Services::validation();
        $val->setRule('id_tipe_member', trans("id-ref-tipe-member"), 'required');
        $val->setRule('nama', trans("nama-ref-tipe-member"), 'required|max_length[500]');
        $val->setRule('index', trans("index-ref-tipe-member"), 'required');
        $val->setRule('min_stays', trans("min_stays-ref-tipe-member"), 'required');
        $val->setRule('max_stays', trans("max_stays-ref-tipe-member"), 'required');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->to(adminUrl('reward-system/add-trn-hotel'))->withInput();
        } else {
            $id_tipe_member = inputPost('id_tipe_member');
            $nama = inputPost('nama');
			if (!$this->rewardModel->isUniqueMemberTypesName($nama, $id_tipe_member)) {
                $this->session->setFlashdata('error', trans("msg_member_type_kode_unique_error"));
                return redirect()->to(adminUrl('reward-system/add-tipe-member'))->withInput();
            }
            if ($this->rewardModel->addMemberTypes()) {
                $this->session->setFlashdata('success', trans("msg_updated"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
                return redirect()->to(adminUrl('reward-system/add-tipe-member'))->withInput();
            }
        }
        return redirect()->to(adminUrl('reward-system/add-tipe-member'))->withInput();
    }
	/**
     * View trnHotel
     */
    public function viewTrnHotel($id)
    {
        checkAdmin();
        $data['panelSettings'] = panelSettings();
        $data['title'] = trans("trn-hotel-view");
        $data['trnhtl'] = getTrnHotelById($id);
        if (empty($data['trnhtl'])) {
            return redirect()->to(adminUrl('reward-system/trn-hotel'));
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/view_trnhotel', $data);
        echo view('admin/includes/_footer');
    }
	/**
     * Edit trnHotel
     */
    public function editTrnHotel($id)
    {
        checkAdmin();
        $data['panelSettings'] = panelSettings();
        $data['title'] = trans("trn-hotel-edit");
        $data['trnhtl'] = getTrnHotelById($id);
        if (empty($data['trnhtl'])) {
            return redirect()->to(adminUrl('reward-system/trn-hotel'));
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/edit_trnhotel', $data);
        echo view('admin/includes/_footer');
    }
	    /**
     * Delete trnHotel
     */
    public function deleteTrnHotel()
    {
        //checkPermission('add_post');
		checkAdmin();
        $id = inputPost('id');
        if ($this->rewardModel->deleteTrnHotelPost($id)) {
            $this->session->setFlashdata('success', trans("msg_deleted"));
            resetCacheDataOnChange();
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }
	/**
     * trnHotelUpl
     */
    public function trnHotelUpl()
    {
        checkAdmin();
        $data['title'] = trans("add-ref-tipe-member");

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/trn_htl_upd');
        echo view('admin/includes/_footer');
    }
	
	public function trnHotelUpPost()
    {
        //checkPermission('add_post');
		checkAdmin();
		//add post files
		if (!$this->postAdminModel->addPostFiles($postId)) {
			$this->session->setFlashdata('error', trans("msg_member_type_kode_unique_error"));
            return redirect()->to(adminUrl('reward-system/trn_htl_upd'))->withInput();
		}
        $this->session->setFlashdata('success', trans("msg_added"));
        resetCacheDataOnChange();
        return redirect()->to(adminUrl('add-post?type=' . cleanStr($postType)));
    }
	public function simpan_upload_trn_hotel($filemanual=null)	
	{
		checkAdmin();
		$filename=$_FILES["file_csv"]["name"];
		if (!$this->postAdminModel->isUniqueFilename($filename)) {
                $this->session->setFlashdata('error', trans("msg_member_filename_unique_error"));
                return redirect()->to(adminUrl('reward-system/trn-hotel-upl'))->withInput();
            }
		if (!$this->postAdminModel->simpan_upload_mod($filemanual=null)) {
			$this->session->setFlashdata('error', trans("msg_member_type_kode_unique_error"));
            return redirect()->to(adminUrl('reward-system/trn-hotel-upl'))->withInput();
		}
		
        $this->session->setFlashdata('success', trans("msg_added"));
        resetCacheDataOnChange();
        return redirect()->to(adminUrl('reward-system/trn-hotel'));				
	}
	
	/**
     * View trnPointOut
     */
	public function trnPointOut()
    {
        $data['title'] = trans("trn-point-out");
		$data['rwrdType'] = 'trnPointType';
        $numRows = $this->rewardModel->getTrnPointOutCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['pointout'] = $this->rewardModel->getTrnPointOutPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/trn_point_o', $data);
        echo view('admin/includes/_footer');
    }
	
	/**
     * Edit trnPointOut
     */
    public function editTrnPointOut($id)
    {
        checkAdmin();
        $data['panelSettings'] = panelSettings();
        $data['title'] = trans("trn-point-out-edit");
        $data['trnpout'] = getTrnPointOutById($id);
        $data['stat'] = getTrnPointOutStatusById($id);
        if (empty($data['trnpout'])) {
            return redirect()->to(adminUrl('reward-system/trn-point-out'));
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/edit_trnpointout', $data);
        echo view('admin/includes/_footer');
    }
	
	/**
     * Edit Post editTrnPointOutPost
     */
    public function editTrnPointOutPost()
    {
        //checkAdmin();
        $id_point_out = inputPost('id_point_out');
        if ($this->rewardModel->editPointOutPost($id_point_out)) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->to(adminUrl('reward-system/trn-point-out'));
    }
	
	/**
     * View member type mtr
     */
	public function mmbrTypeMtr()
    {
        $data['title'] = trans("mmbr-type-mtr");
		$data['rwrdType'] = 'mmbrTypeType';
        $numRows = $this->rewardModel->getMmbrTypeMtrCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['mmbrtypmtr'] = $this->rewardModel->getMmbrTypeMtrPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/mmbr_typemtr', $data);
        echo view('admin/includes/_footer');
    }
	
	/**
     * View rpt point member
     */
	public function rptPointMmbr()
    {
        $data['title'] = trans("rpt-point-mmbr");
		$data['rwrdType'] = 'rptPointType';
        $numRows = $this->rewardModel->getRptPointMmbrCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['rptpntmmbr'] = $this->rewardModel->getRptPointMmbrPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/rpt_pointmmbr', $data);
        echo view('admin/includes/_footer');
    }
}
