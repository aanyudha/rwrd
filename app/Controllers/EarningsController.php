<?php

namespace App\Controllers;

use App\Models\RewardModel;

class EarningsController extends BaseController
{
    protected $rewardModel;
    protected $perPage;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        if (!authCheck()) {
            redirectToUrl(langBaseUrl());
            exit();
        }
        if (user()->reward_system_enabled != 1) {
            redirectToUrl(langBaseUrl());
            exit();
        }
        $this->rewardModel = new RewardModel();
        $this->perPage = 15;
    }

    /**
     * Earnings Page
     
    public function earnings()
    {
        $data['title'] = trans("earnings");
        $data['description'] = trans("earnings") . ' - ' . $this->settings->site_title;
        $data['keywords'] = trans("earnings") . ', ' . $this->settings->application_name;
        $data['activeTab'] = 'earnings';
        $data['userSession'] = getUserSession();
        //$data['userPostsCount'] = $this->postModel->getUserPostsCount(user()->id);
        $data['pageViewsCounts'] = $this->rewardModel->getPageViewsCountByDate(user()->id);
        $data['numberOfDays'] = date('t');
        if (empty($data['numberOfDays'])) {
            $data['numberOfDays'] = 30;
        }
        $data['today'] = date('d');

        echo loadView('partials/_header', $data);
        echo loadView('earnings/earnings', $data);
        echo loadView('partials/_footer');
    }

    /**
     * Payouts Page
     
    public function payouts()
    {
        $data['title'] = trans("payouts");
        $data['description'] = trans("payouts") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("payouts") . ', ' . $this->settings->application_name;
        $data['activeTab'] = 'payouts';
        $data['userSession'] = getUserSession();
        //$data['userPostsCount'] = $this->postModel->getUserPostsCount(user()->id);
        $data['numRows'] = $this->rewardModel->geUserPayoutsCount(user()->id);
        $pager = paginate($this->perPage, $data['numRows']);
        $data['payouts'] = $this->rewardModel->getUserPayoutsPaginated(user()->id, $this->perPage, $pager->offset);

        echo loadView('partials/_header', $data);
        echo loadView('earnings/payouts', $data);
        echo loadView('partials/_footer');
    }

    /**
     * Set Payout Account
     
    public function setPayoutAccount()
    {
        $data['title'] = trans("set_payout_account");
        $data['description'] = trans("set_payout_account") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("set_payout_account") . "," . $this->settings->application_name;
        $data['activeTab'] = 'setPayoutAccount';
        $data['userSession'] = getUserSession();
        //$data['userPostsCount'] = $this->postModel->getUserPostsCount(user()->id);
        $data['userPayout'] = $this->rewardModel->getUserPayoutAccount(user()->id);
        $data['selectedPayout'] = inputGet('payout');
        if ($data['selectedPayout'] != 'paypal' && $data['selectedPayout'] != 'iban' && $data['selectedPayout'] != 'swift') {
            $data['selectedPayout'] = 'paypal';
        }

        echo loadView('partials/_header', $data);
        echo loadView('earnings/set_payout_account', $data);
        echo loadView('partials/_footer');
    }

    /**
     * Set Paypal Payout Account Post
     
    public function setPaypalPayoutAccountPost()
    {
        if ($this->rewardModel->setPaypalPayoutAccount()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        redirectToBackURL();
    }

    /**
     * Set IBAN Payout Account Post
     
    public function setIbanPayoutAccountPost()
    {
        if ($this->rewardModel->setIbanPayoutAccount()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        redirectToBackURL();
    }

    /**
     * Set SWIFT Payout Account Post
     
    public function setSwiftPayoutAccountPost()
    {
        if ($this->rewardModel->setSwiftPayoutAccount()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        redirectToBackURL();
    }
	//TNTR
	/**
     * PointHist Page
     */
    public function pointHist()
    {
        $data['title'] = trans("point_hist");
        $data['description'] = trans("point_hist") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("point_hist") . ', ' . $this->settings->application_name;
        $data['activeTab'] = 'point_hist';
        $data['userSession'] = getUserSession();
        //$data['userPostsCount'] = $this->postModel->getUserPostsCount(user()->id);
        $data['history'] = $this->rewardModel->getPointHistoryByMemberId(user()->id_member);
        $data['promo'] = $this->rewardModel->getPointHistPromo();

        echo loadView('partials/_header', $data);
        echo loadView('earnings/pointhist', $data);
        echo loadView('partials/_footer');
    }
	
	/**
     * Redemption Page
     */
    public function redemptSta()
    {
        $data['title'] = trans("red_stat");
        $data['description'] = trans("red_stat") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("red_stat") . ', ' . $this->settings->application_name;
        $data['activeTab'] = 'red_stat';
        $data['userSession'] = getUserSession();
        //$data['userPostsCount'] = $this->postModel->getUserPostsCount(user()->id);
        $data['history'] = $this->rewardModel->getHistRedemp();
        $data['promo'] = $this->rewardModel->getHistRedempPromo();

        echo loadView('partials/_header', $data);
		echo loadView('earnings/redempsta', $data);
        echo loadView('partials/_footer');
    }
	/**
     * Gift for you Page
     */
    public function gfY()
    {
        $data['title'] = trans("gift_4_you");
        $data['description'] = trans("gift_4_you") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("gift_4_you") . ', ' . $this->settings->application_name;
        $data['activeTab'] = 'gift_4_you';
        $data['userSession'] = getUserSession();
        $data['promo'] = $this->rewardModel->getGift4You();
        $data['last_point'] = $this->rewardModel->last_point();

        echo loadView('partials/_header', $data);
		echo loadView('earnings/gfy', $data);
        echo loadView('partials/_footer');
    }
	
	public function cobaPost()
    {
			$request = service('request'); // Mengambil instance request
        
        // Mengambil data POST menggunakan request
        $cartDataJson = $request->getPost('cart');
        
        // Decode JSON data
        $cartData = json_decode($cartDataJson, true); // true untuk array, false untuk objek

        if (json_last_error() === JSON_ERROR_NONE) {
            // Data JSON berhasil di-decode
            foreach ($cartData as $item) {
                // Proses setiap item sesuai kebutuhan
                $data = [
                    'product_image' => $item['product_image'],
                    'product_name' => $item['product_name'],
                    'product_price' => $item['product_price'],
                    'product_quantity' => $item['product_quantity'],
                    'unique_key' => $item['unique_key']
                ];

                // Simpan data ke database jika diperlukan
                // $this->db->insert('your_table', $data);

                // Debug data
                var_dump($data);
            }
        } else {
            // Tangani error jika JSON tidak valid
            echo 'Invalid JSON';
        }
    }
	

	
	public function getDtlGift()
    {
		$idParkir = inputPost('id_reward');
        
			if (!empty($getRefReward)) {
				$data = [
					'ref_reward' => $this->rewardModel->getRefReward($getRefReward)
				];
				echo json_encode($data);
			}
	}
}
