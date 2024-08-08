<?php

namespace App\Controllers;

use App\Models\PostAdminModel;
// use App\Models\RssModel;
// use App\Models\SitemapModel;

class CronController extends BaseController
{
	protected $postAdminModel;
	
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->postAdminModel = new PostAdminModel();
    }

    /**
     * Check Feed Posts
     
    public function checkFeedPosts()
    {
        $rssModel = new RssModel();
        $feedNotUpdated = $rssModel->getFeedsNotUpdated();
        if (empty($feedNotUpdated)) {
            $rssModel->resetFeedsCronChecked();
        }
        $feeds = $rssModel->getFeedsCron();
        if (!empty($feeds)) {
            foreach ($feeds as $feed) {
                if (!empty($feed->feed_url)) {
                    $rssModel->addFeedPosts($feed->id);
                    $rssModel->setFeedCronChecked($feed->id);
                }
            }
            resetCacheDataOnChange();
        }
        echo "Feeds have been checked!";
    }

    /**
     * Update Sitemap
    
    public function updateSitemap()
    {
        $sitemapModel = new SitemapModel();
        $sitemapModel->generateSitemap();
        echo "Sitemap has been generated!";
    }

    /**
     * Check Scheduled Posts*/
    
    public function checkScheduledPosts()
    {
        $postAdminModel = new PostAdminModel();
        $postAdminModel->checkScheduledPosts();
    }
	
	public function algorithma_baru()
    {
		if ($this->postAdminModel->update_all_converted_null()) {
			$ini = $this->postAdminModel->select_id_member_v2();       
			if (!empty($ini)) {
				foreach ($ini as $post) {
					//echo "$post->id_member<br>";
					$cek_gap = $this->postAdminModel->algorithma_baru_model($post->id_member);
					foreach ($cek_gap as $cek) {
						//echo "cek gap = $cek->gapnya<br>";
						// echo "$post->id_member<br>";
						if ($cek->gapnya=='0'){
							// echo "------------------------------------------<br>";
							// echo "NOL<br>";
							// echo "id trn = $cek->id_trn<br>";
							// echo "id_member = $cek->id_member<br>";
							// echo "departure_date = $cek->departure_date<br>";
							// echo "------------------------------------------<br>";
							$this->postAdminModel->update_exp_date($cek->id_member,$cek->departure_date);
						}else{
							// echo "++++++++++++++++++++++++++++++++++++++++++<br>";
							// echo "LEBIH DARI 0<br>";
							// echo "id trn = $cek->id_trn<br>";
							// echo "id_member = $cek->id_member<br>";
							// echo "departure_date = $cek->departure_date<br>";
							// echo "++++++++++++++++++++++++++++++++++++++++++<br>";
							$this->postAdminModel->update_status_exp($cek->id_member, $cek->departure_date );
						}
					}
				}
					$log_time = date('Y-m-d h:i:s');
					// $log_time_end = date('Y-m-d h:i:s');
					// $log_msg = "Masuk di semua data";
					echo 'Masuk di semua data';
					echo "************** Akhir Log Pada : '" . $log_time . "'**********";
					//LOG
					// $this->lognya("************** Mulai Log Pada : '" . $log_time . "'**********");
					// $this->lognya($log_msg);
					// $this->lognya("************** Akhir Log Pada : '" . $log_time_end . "'**********");
			}else {
					$log_time = date('Y-m-d h:i:s');
					// $log_time_end = date('Y-m-d h:i:s');
					// $log_msg = "TIDAK MASOK di semua data, CEK Lagi";
					echo 'TIDAK MASOK di semua data, CEK Lagi';
					echo "************** Akhir Log Pada : '" . $log_time . "'**********";
					//LOG
					// $this->lognya("************** Mulai Log Pada : '" . $log_time . "'**********");
					// $this->lognya($log_msg);
					// $this->lognya("************** Akhir Log Pada : '" . $log_time_end . "'**********");
			}
		} 
    }
	
	public function cek_controller()
    {
		
		// var_dump('SUSU');
		if ($this->postAdminModel->check_cron_db() == true) {
			
			$log_time = date('Y-m-d h:i:s');
			$log_msg = "TRUE";
			echo 'TRUE';
			echo "************** Akhir Log Pada : '" . $log_time . "'**********";
			// LOG
			// $this->lognya("************** Mulai Log Pada : '" . $log_time . "'**********");
			// $this->lognya($log_msg);
			// $this->lognya("************** Akhir Log Pada : '" . $log_time . "'**********");
		}else{
			
			$log_time = date('Y-m-d h:i:s');
			$log_msg = "FALSE";
			echo 'FALSE';
			echo "************** Akhir Log Pada : '" . $log_time . "'**********";
			// LOG
			// $this->lognya("************** Mulai Log Pada : '" . $log_time . "'**********");
			// $this->lognya($log_msg);
			// $this->lognya("************** Akhir Log Pada : '" . $log_time . "'**********");
		}
		
	}
	
	function lognya($log_msg){
		/*$log_filename = "lognya";
		$log_tanggal_waktu = date('Y-m-d');
			if (!file_exists($log_filename)) {
				// buat direktori/folder uploads.
				mkdir($log_filename, 0755, true);
			}*/
			$root = $_SERVER["DOCUMENT_ROOT"];
			$dir = $root . '/rwrd/logcron';
			$log_tanggal_waktu = date('Y-m-d');
				if( !file_exists($dir) ) {
					mkdir($dir, 0755, true);
				}
		//$log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.txt';
		$log_file_data = $dir.'/log_' . $log_tanggal_waktu . '.txt';
		// `FILE_APPEND`, supaya tidak kehapus saat ada log baru, jadi update file itu di hari yg sama
		file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
	}
	
	function coba_algo_baru(){
		$ini = $this->postAdminModel->select_id_member_v2();       
			if (!empty($ini)) {
				foreach ($ini as $post) {
					//echo "$post->id_member<br>";
					$cek_gap = $this->postAdminModel->indexing_per_member($post->id_member);
					foreach ($cek_gap as $cek) {
						//echo "cek gap = $cek->gapnya<br>";
						//echo "$cek->indexNya<br>";
						//echo "$cek->id_member<br>";
						if ($cek->indexNya=='3'){
							//echo "dept_date3 $cek->id_member = $cek->departure_date<br>";
							//echo "UPDATE MEMBER JADI 2(GOLD)<br>";
							$count1year = $this->postAdminModel->count_1_year($cek->adaylater,$cek->ayearlater,$cek->id_member);
							foreach ($count1year as $cek2) {
								//echo "jumlahnya = $cek2->jml<br>";
								if($cek2->jml>=0 && $cek2->jml<=2){
									echo "$cek->id_member = BLUE<br>";
									$this->postAdminModel->update_BLUE($cek->id_member);
								}elseif($cek2->jml>=3 && $cek2->jml<=9){
									echo "$cek->id_member = GOLD<br>";
									$this->postAdminModel->update_GOLD($cek->id_member);
								}elseif($cek2->jml>=10 && $cek2->jml<=24){
									echo "$cek->id_member = PLATINUM<br>";
									$this->postAdminModel->update_PLATINUM($cek->id_member);
								}elseif($cek2->jml>=25 && $cek2->jml<=9999){
									echo "$cek->id_member = BLACK<br>";
									$this->postAdminModel->update_BLACK($cek->id_member);
								}
							}
						}
					}
				}
					echo 'mlebu';
			}
	}
	
	public function simpan_upload_trn_hotel_cron($fileauto)	
	{
		// if (!$this->postAdminModel->isUniqueFilename($fileauto)) {
			if (!$this->postAdminModel->simpan_upload_mod_auto($fileauto)) {
			}
		// }
	}
	public function message($to = 'World')
    {
        return "Hello {$to}!" . PHP_EOL;
    }
	public function cek_controller_cli($coba)
    {
		echo $coba;
	}
}
