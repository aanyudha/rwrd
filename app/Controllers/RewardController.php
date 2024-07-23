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
        $id = inputPost('id_reward');
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
        $data['title'] = trans("trn-hotel");
        $numRows = $this->rewardModel->getTrnHotelCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['trnhtl'] = $this->rewardModel->getTrnHotelPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/trn_hotel', $data);
        echo view('admin/includes/_footer');
    }
	/**
     * Add MemberTypes
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
    public function trnHotelUp()
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
			$query = $this->db->query("select * from ref_konversi")->result();
			$fitgrp=array();
			foreach($query as $row)		
			{
				$fitgrp[$row->kode]=$row->tipe;
			}
			$query = $this->db->query("select nilai from tbl_setting where nama='Guest FIT'")->result();
			$point_conversion_guest_fit=$query[0]->nilai;
			$query = $this->db->query("select nilai from tbl_setting where nama='Guest GRP'")->result();
			$point_conversion_guest_grp=$query[0]->nilai;
			$query = $this->db->query("select nilai from tbl_setting where nama='Booker FIT'")->result();
			$point_conversion_booker_fit=$query[0]->nilai;
			$query = $this->db->query("select nilai from tbl_setting where nama='Booker GRP'")->result();
			$point_conversion_booker_grp=$query[0]->nilai;
			$path_upload=FCPATH."assets/uploads/osr";
			if($filemanual!==NULL)
			{
				$filename=$filemanual;
			}
			else
			{
				$filename=$_FILES["file_csv"]["name"];
				$filename_tmp=$_FILES["file_csv"]["tmp_name"];
				move_uploaded_file($filename_tmp, $path_upload."/".$filename);			
			}
			try
			{
				if (($handle = fopen($path_upload."/".$filename, "r")) !== FALSE) 
				{
					$this->db->trans_start();			
					$this->db->query("delete from trn_hotel where filename='$filename'");					
					$tipenya="Member";
					while (($data = fgetcsv($handle, 0, ";")) !== FALSE) 
					{
						if(count($data)>2 && strlen($data[0])>3) 
						{
							//HTJOG	TNT		100	Bambang	Dwi	326	DLXK	14BARBP	BEN	WEB	06-OCT-17	06-OCT-17	0	1.115.702.479.338.840.000	0	1.115.702.479.338.840.000						
							//HTJOG;;;;Anton;Siregar;9011;PM;NR;BEN;PHN;18-MAR-20;18-MAR-20;0;0;0;0;							
							$hotel_code=$data[0];
							$id_member=$data[3];
							$room_no=$data[6];						
							$room_type=$data[7];
							$room_code=$data[6];
							$market_code=$data[9];
							$market_code_converted=$fitgrp[$market_code];
							$source_code=$data[10];
							$arrival_date_asli = date_create_from_format('j-M-y', $data[11]);						
							$arrival_date=date_format($arrival_date_asli, 'Y-m-d');
							$departure_date_asli = date_create_from_format('j-M-y', $data[12]);						
							$departure_date=date_format($departure_date_asli, 'Y-m-d');
							$number_of_nights=$data[13];
							$room_revenue=$data[14];
							$fnb_revenue=$data[15];
							$total_revenue=$data[16];
							$booker=$data[17];
							//$date = new DateTime($departure_date);
							//$date->add(new DateInterval('P1Y'));
							//$exp_date= $date->format('Y-m-d');
							/*
							$other_revenue=$data[0];
							$total_revenue=$room_revenue+$fnb_revenue+$other_revenue;
							if($tipenya=="Member")
							{
								$room_revenue_converted=floor($room_revenue/100000)*$point_conversion_member*100000;
								$fnb_revenue_converted=floor($fnb_revenue/100000)*$point_conversion_member*100000;
								$other_revenue_converted=floor($other_revenue/100000)*$point_conversion_member*100000;
								$total_revenue_converted=$room_revenue_converted+$fnb_revenue_converted+$other_revenue_converted;
								$point_type="Member";
							}
							else
							{
								$room_revenue_converted=floor($room_revenue/100000)*$point_conversion_booker*100000;
								$fnb_revenue_converted=floor($fnb_revenue/100000)*$point_conversion_booker*100000;
								$other_revenue_converted=floor($other_revenue/100000)*$point_conversion_booker*100000;
								$total_revenue_converted=$room_revenue_converted+$fnb_revenue_converted+$other_revenue_converted;
								$point_type="Booker";							
							}
							*/
							$status="Converted";
							//if(!empty($market_code_converted))
							if($market_code_converted!=="" && ($id_member!=="" || $booker !=="") && $source_code!="OTA" && $source_code!="WHO" && $source_code!="RDM" && $market_code!=="WHO") //TAMBAHAN PAK YO DISINI
							{
								if($market_code_converted=="FIT")
								{
									$point_conversion_member=$point_conversion_guest_fit;
									$point_conversion_booker=$point_conversion_booker_fit;
								}
								if($market_code_converted=="GRP")
								{
									$point_conversion_member=$point_conversion_guest_grp;
									$point_conversion_booker=$point_conversion_booker_grp;
								}
								try
								{									
									$query = $this->db->query("select r.index as nilai from ref_tipe_member r, mst_member m where m.id_tipe_member=r.id_tipe_member and m.id_member='$id_member'")->result();
									if(count($query)==0)
									{
										$index_tipe_member=1;
									}
									else
									{
										$index_tipe_member=$query[0]->nilai;
									}
									//$room_revenue_converted=($room_revenue*$point_conversion_member)*$index_tipe_member;
									$room_revenue_converted=floor(($room_revenue/100000)*$point_conversion_member*$index_tipe_member*100000);
									$fnb_revenue_converted=floor(($fnb_revenue/100000)*$point_conversion_member*$index_tipe_member*100000);
									$other_revenue=0;
									$other_revenue_converted=0;
									//$total_revenue_converted=$total_revenue*$point_conversion_member;
									$total_revenue_converted=$room_revenue_converted+$fnb_revenue_converted;
									$point_type="Member";
									if($id_member!==""){
									$query=$this->db->query("insert into trn_hotel(filename, hotel_code, id_member, room_no, room_type, room_code, market_code, market_code_converted, source_code, arrival_date, departure_date, number_of_nights, room_revenue, fnb_revenue, other_revenue, total_revenue, room_revenue_converted, fnb_revenue_converted, other_revenue_converted, total_revenue_converted, point_type, status, exp_date) values('$filename', '$hotel_code', '$id_member', '$room_no', '$room_type', '$room_code', '$market_code', '$market_code_converted', '$source_code', '$arrival_date', '$departure_date', $number_of_nights, $room_revenue, $fnb_revenue, $other_revenue, $total_revenue, $room_revenue_converted, $fnb_revenue_converted, $other_revenue_converted, $total_revenue_converted, '$point_type', '$status', '$exp_date')");
									//UPDATE yang lama sesuai ID INTERVAL 1 TAHUN
										if (!empty($query)) {
											$cek_gap = $this->cron_model->algorithma_baru_model($id_member);
												foreach ($cek_gap as $cek) {
													if ($cek->gapnya=='0'){
														$this->cron_model->update_exp_date($cek->id_member,$cek->departure_date);
													}elseif($cek->gapnya=='1'){
														$this->cron_model->update_status_exp($cek->id_member, $cek->departure_date );
													}
												}
										}
									}
									//echo "insert into trn_hotel(filename, id_member, room_no, room_type, room_code, market_code, market_code_converted, source_code, arrival_date, departure_date, number_of_nights, room_revenue, fnb_revenue, other_revenue, total_revenue, room_revenue_converted, fnb_revenue_converted, other_revenue_converted, total_revenue_converted, point_type, status) values('$filename', '$id_member', '$room_no', '$room_type', '$room_code', '$market_code', '$market_code_converted', '$source_code', '$arrival_date', '$departure_date', $number_of_nights, $room_revenue, $fnb_revenue, $other_revenue, $total_revenue, $room_revenue_converted, $fnb_revenue_converted, $other_revenue_converted, $total_revenue_converted, '$point_type', '$status')";
									//if(!empty($booker))
									if($booker!=="")
									{
										$id_member=$booker;
										$room_revenue_converted=floor(($room_revenue/100000)*$point_conversion_booker*$index_tipe_member*100000);
										$fnb_revenue_converted=floor(($fnb_revenue/100000)*$point_conversion_booker*$index_tipe_member*100000);
										$other_revenue=0;
										$other_revenue_converted=0;
										//$total_revenue_converted=$total_revenue*$point_conversion_booker;
										$total_revenue_converted=$room_revenue_converted+$fnb_revenue_converted;
										$point_type="Booker";
										$query=$this->db->query("insert into trn_hotel(filename, hotel_code, id_member, room_no, room_type, room_code, market_code, market_code_converted, source_code, arrival_date, departure_date, number_of_nights, room_revenue, fnb_revenue, other_revenue, total_revenue, room_revenue_converted, fnb_revenue_converted, other_revenue_converted, total_revenue_converted, point_type, status, exp_date) values('$filename', '$hotel_code', '$id_member', '$room_no', '$room_type', '$room_code', '$market_code', '$market_code_converted', '$source_code', '$arrival_date', '$departure_date', $number_of_nights, $room_revenue, $fnb_revenue, $other_revenue, $total_revenue, $room_revenue_converted, $fnb_revenue_converted, $other_revenue_converted, $total_revenue_converted, '$point_type', '$status', '$exp_date')");										
										
										//UPDATE yang lama sesuai ID INTERVAL 1 TAHUN
										if (!empty($query)) {
											$cek_gap = $this->cron_model->algorithma_baru_model($id_member);
												foreach ($cek_gap as $cek) {
													if ($cek->gapnya=='0'){
														$this->cron_model->update_exp_date($cek->id_member,$cek->departure_date);
													}elseif($cek->gapnya=='1'){
														$this->cron_model->update_status_exp($cek->id_member, $cek->departure_date );
													}
												}
										}
									}
								}
								catch(Exception $e)
								{
							}			
								
							}
						}
					}
					$this->db->trans_complete();
					fclose($handle);	
					//exec("rm -rf $path_upload/$filename");
					exec("mv $path_upload/$filename $path_upload/processed");
					//redirect("kelola/trn_hotel","refresh");
					$this->session->setFlashdata('success', trans("msg_updated"));
				}
			}
			catch(Exception $e)
			{
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}						
	}
	
	/**
     * View trnPointOut
     */
	public function trnPointOut()
    {
        $data['title'] = trans("trn-point-out");
        $numRows = $this->rewardModel->getTrnPointOutCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['pointout'] = $this->rewardModel->getTrnPointOutPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/trn_point_o', $data);
        echo view('admin/includes/_footer');
    }
	
	/**
     * View member type mtr
     */
	public function mmbrTypeMtr()
    {
        $data['title'] = trans("mmbr-type-mtr");
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
        $numRows = $this->rewardModel->getRptPointMmbrCount();
        $pager = paginate($this->perPage, $numRows);
        $data['userSession'] = getUserSession();
        $data['rptpntmmbr'] = $this->rewardModel->getRptPointMmbrPaginated($this->perPage, $pager->offset);

        echo view('admin/includes/_header', $data);
        echo view('admin/rwrdd/rpt_pointmmbr', $data);
        echo view('admin/includes/_footer');
    }
}
