<section class="section section-page">
    <div class="container-xl">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                    <li class="breadcrumb-item active"><?= trans("gift_4_you"); ?></li>
                </ol>
            </nav>
            <h1 class="page-title"><?= trans("gift_4_you"); ?></h1>
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <?= loadView('earnings/_tabs'); ?>
						<!--<li class="list-group-item <?= $activeTab == 'payouts' ? 'active' : ''; ?>">
							<a class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Cart</a>
						</li>
						<li class="list-group-item">
							<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCart">Cart</a>
						</li>-->
                    </div>
                    <div class="col-sm-12 col-md-9">
						<div class="left">
							<h3 class="box-title"><?= trans('gift_4_you'); ?></h3>
							<?php if($last_point > 0) : ?>
							<h4>Your current points: <span class="badge rounded-pill bg-primary"><h4><?php echo number_format($last_point,0,".",",")?></h4></span> pts</h4>
							<?php else : ?>
								<h4>You don't have any reward points yet.</h4>
							<?php endif; ?>
						</div>
						<div class="right">
							  <div class="row">
								<div class="col-9">
									<div class="container">
									  <div class="row g-4">
									  <?php 
										foreach($promo as $row)
										{
										?>
										<div class="col-sm-6">
											 <div id="reward-<?php echo $row->id_reward; ?>" class="card sc-product-item thumbnail text-center " style="width: 18rem;">
											  <a class="card-title center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><img data-name="product_image" src="<?= getPostImage3($row->foto); ?>" class="card-img-top" alt="..."></a>
											  <div class="card-body">
												<a id="reward-<?php echo $row->id_reward; ?>" class="card-title center" type="button" data-name="product_name" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions2" aria-controls="offcanvasWithBothOptions2"><?php echo $row->nama; ?></a>
												<form  action="" enctype="multipart/form-data">
												<!--<a href="javascript:void(0)" class="btn btn-primary btn-lg" onclick="detailGift();">?= trans('check'); ?></a>
												 <p class="card-text" data-name="product_desc">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
												</form>
											  </div>
											  <ul class="list-group list-group-flush">
												<?php 
													if($row->promo==null)
													{
													?>
														<li class="list-group-item price pull-left"><span class="badge bg-primary"><?php echo number_format($row->index_point,0,".",","); ?> points</span></li>
														<li class="list-group-item">Valid thru: <?php echo $row->tanggal_selesai; ?></li>
													<?php 
													}
													else
													{
													?>
														<li class="list-group-item price pull-left"><del><?php echo number_format($row->index_point,0,".",","); ?></del> points</li>
														<li class="list-group-item price pull-left"><?php echo number_format($row->promo,0,".",","); ?> points</li>
														<li class="list-group-item">Valid thru: <?php echo $row->tanggal_tutup; ?></li>
													<?php 
													}
												?>
											  </ul>
											  <div class="card-body">
											  
										<input type="hidden" value="<?php echo $row->id_trn_reward; ?>" name="product_id">
											   <?php 
												if($row->promo==null)
												{
												?>
													<input type="hidden" value="<?php echo $row->index_point; ?>" name="product_price">
												<?php 
												}
												else
												{
												?>
													<input type="hidden" value="<?php echo $row->promo; ?>" name="product_price">
												<?php 
												}
												?>
												<?php //if($last_point<$row->index_point){ ?>
												<!--<button class="card-link sc-add-to-cart btn btn-success btn-sm pull-right" disabled>Add to cart</button>-->
												<?php //}else{ ?>
												<button class="card-link sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
												<?php //} ?>
											  </div>
											</div>
										</div>
									  <?php } ?>
									  </div>
									</div>
								</div>
								<div class="col-3">
									
								</div>
								
							  </div>
								
						</div><!-- right -->
					</div><!-- col-sm-12 col-md-9 -->
				</div> <!-- row -->
            </div> <!-- page-content -->
        </div>
    </div>
</section>
<?= loadView('earnings/_canvas'); ?>

