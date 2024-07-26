<section class="section section-page">
    <div class="container-xl">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                    <li class="breadcrumb-item active"><?= trans("red_stat"); ?></li>
                </ol>
            </nav>
            <h1 class="page-title"><?= trans("red_stat"); ?></h1>
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <?= loadView('earnings/_tabs'); ?>
                    </div>
                    <div class="col-sm-12 col-md-9">
						 <div class="left">
							<h3 class="box-title"><?= trans('red_stat'); ?></h3>
						</div>
                        <div class="table-responsive table-payouts">
                            <table class="table table-striped">
                                <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th><?= trans('red-stat'); ?></th>
                                    <th><?= trans('qty-stat'); ?></th>
                                    <th><?= trans('pointunt-stat'); ?></th>
                                    <th><?= trans('point-stat'); ?></th>
                                    <th><?= trans('reqdate-stat'); ?></th>
                                    <th><?= trans('procdate-stat'); ?></th>
                                    <th><?= trans('claimed-stat'); ?></th>
                                    <th><?= trans('stat-stat'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
								$i=0;
								foreach($history as $row) 
									{
										$color="primary";
										if($row->status=="Canceled")
										{
											$color="danger";					
										}
										if($row->status=="Approved")
										{
											$color="info";										
										}
										if($row->status=="Claimed")
										{
											$color="success";										
										}
										$i++;
										$tanggal_pengajuan=$row->tanggal_pengajuan==null?"":date("d-M-Y", strtotime($row->tanggal_pengajuan));
										$tanggal_proses=$row->tanggal_proses==null?"":date("d-M-Y", strtotime($row->tanggal_proses));
										$tanggal_claim=$row->tanggal_claim==null?"":date("d-M-Y", strtotime($row->tanggal_claim));
										echo "<tr><td>$i</td><td>".$row->nama."</td><td>".$row->qty."</td><td align='right'>".$row->point."</td><td align='right'>".($row->qty*$row->point)."</td><td align='right'>".$tanggal_pengajuan."</td><td align='right'>".$tanggal_proses."</td><td align='right'>".$tanggal_claim."</td><td align='right'><span class='badge badge-".$color."'>".$row->status."</span></td></tr>";
									} 
									?>
                                        
                                </tbody>
                            </table>
                          <!--  ?php if (empty($point_hist)): ?>
                                <p class="text-center text-muted">?= trans("no_records_found"); ?></p>
                            <\?php endif; ?>
                        </div>-->
                        <div class="col-sm-12 col-xs-12">
                           <!-- ?= view('common/_pagination'); ?> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>