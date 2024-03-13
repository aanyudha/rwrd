<?php

namespace App\Controllers;

use App\Models\RewardModel;

class RewardController extends BaseAdminController
{
    protected $rewardModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        if (!isAdmin()) {
            redirectToUrl(adminUrl());
            exit();
        }
        $this->rewardModel = new RewardModel();
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
        $numRows = $this->rewardModel->getRefRewardCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['refrewarddd'] = $this->rewardModel->getRefRewardPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/ref_reward', $data);
        echo view('admin/includes/_footer');
    }
}
