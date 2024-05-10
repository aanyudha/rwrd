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
                    </div>
                    <div class="col-sm-12 col-md-9">
						<div class="left">
							<h3 class="box-title"><?= trans('gift_4_you'); ?></h3>
						</div>
						<div class="right">
							  <div class="row">
								<div class="col-9">
									<div class="container">
									  <div class="row g-4">
										<div class="col-sm-6">
											 <div class="card sc-product-item thumbnail" style="width: 18rem;">
											  <img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+6" class="card-img-top" alt="...">
											  <div class="card-body">
												<h5 class="card-title" data-name="product_name">Card title</h5>
												<p class="card-text" data-name="product_desc">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
												
											  </div>
											  <ul class="list-group list-group-flush">
												<li class="list-group-item price pull-left">$3,410.00</li>
												<li class="list-group-item">A second item</li>
											  </ul>
											  <div class="card-body">
											   <input name="product_price" value="5435.50" type="hidden" />
                                               <input name="product_id" value="145" type="hidden" />
												<button class="card-link sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
											  </div>
											</div>
										</div>
										<div class="col-sm-6">
											 <div class="card sc-product-item thumbnail" style="width: 18rem;">
											  <img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+6" class="card-img-top" alt="...">
											  <div class="card-body">
												<h5 class="card-title" data-name="product_name">Card title</h5>
												<p class="card-text" data-name="product_desc">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
											  </div>
											  <ul class="list-group list-group-flush">
												<li class="list-group-item">An item</li>
												<li class="list-group-item">A second item</li>
											  </ul>
											  <div class="card-body">
											  <input name="product_price" value="3410.00" type="hidden" />
                                            <input name="product_id" value="155" type="hidden" />
												<button class="card-link sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
											  </div>
											</div>
										</div>
										<div class="col-sm-6">
											 <div class="card sc-product-item thumbnail" style="width: 18rem;">
											  <img src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+6" class="card-img-top" alt="...">
											  <div class="card-body">
												<h5 class="card-title">Card title</h5>
												<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
											  </div>
											  <ul class="list-group list-group-flush">
												<li class="list-group-item">An item</li>
												<li class="list-group-item">A second item</li>
											  </ul>
											  <div class="card-body">
											  <input name="product_price" value="435.50" type="hidden" />
                                            <input name="product_id" value="154" type="hidden" />
												<button class="card-link sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
											  </div>
											</div>
										</div>
										<div class="col-sm-6">
											 <div class="card sc-product-item thumbnail" style="width: 18rem;">
											  <img src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+6" class="card-img-top" alt="...">
											  <div class="card-body">
												<h5 class="card-title">Card title</h5>
												<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
											  </div>
											  <ul class="list-group list-group-flush">
												<li class="list-group-item">An item</li>
												<li class="list-group-item">A second item</li>
											  </ul>
											  <div class="card-body">
											  <input name="product_price" value="5435.50" type="hidden" />
                                            <input name="product_id" value="145" type="hidden" />
												<button class="card-link sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
											  </div>
											</div>
										</div>
									  </div>
									</div>
								</div>
								<div class="col-3">
									<!-- Cart submit form -->
									<form action="results.php" method="POST"> 
										<!-- SmartCart element -->
										<div id="smartcart"></div>
									</form>
								</div>
							  </div>
								
						</div><!-- right -->
					</div><!-- col-sm-12 col-md-9 -->
				</div> <!-- row -->
            </div> <!-- page-content -->
        </div>
    </div>
</section>