<section class="section section-page">
    <div class="container-xl">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                    <li class="breadcrumb-item active"><?= trans("point_hist"); ?></li>
                </ol>
            </nav>
            <h1 class="page-title"><?= trans("point_hist"); ?></h1>
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <?= loadView('earnings/_tabs'); ?>
                    </div>
                    <div class="col-sm-12 col-md-9">
						<div class="left">
							<h3 class="box-title"><?= trans('point_hist'); ?></h3>
						</div>
                        <div class="table-responsive table-payouts">
                            <table class="table table-striped" style="border-collapse: collapse; width: 100%; text-align: left;">
                                <thead>
                                <tr role="row" style="background-color: #f2f2f2;">
                                    <th style="width: 5%; min-width: 40px; padding: 12px; border: 1px solid #ddd;">#</th>
                                    <th style="padding: 12px; border: 1px solid #ddd;"><?= trans('room_phist'); ?></th>
                                    <th style="padding: 12px; border: 1px solid #ddd;"><?= trans('arvdate_phist'); ?></th>
                                    <th style="padding: 12px; border: 1px solid #ddd;"><?= trans('depdate_phist'); ?></th>
                                    <th style="padding: 12px; border: 1px solid #ddd;"><?= trans('pointhist_point'); ?></th>
                                    <th style="padding: 12px; border: 1px solid #ddd;"><?= trans('stat_phist'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
								$total_all=0;
								$total_in=0;
								$total_exp=0;
								$i=0;
                                    foreach ($history as $item): 
									
											$i++;									
											if($item->status=="Draft") {
												$status="<span class='badge bg-danger'>".$item->status."</span>";
											}
											if($item->status=="Converted") {
												$status="<span class='badge bg-success'>".$item->status."</span>";
											}
											if($item->status=="Expired") {
												$status="<span class='badge bg-danger'>".$item->status."</span>";
											}
											if($item->status=="Void") {
												$status="<span class='badge bg-secondary'>".$item->status."</span>";
											}
											$total_all+=$item->total_revenue_converted;
											if($item->status!='Expired')
											{
												$total_in+=$item->total_revenue_converted;
											}
											else
											{
												$total_exp+=$item->total_revenue_converted;
											}		
											$arrival_date=$item->arrival_date==null?"":date("d-M-Y", strtotime($item->arrival_date));
											$departure_date=$item->arrival_date==null?"":date("d-M-Y", strtotime($item->departure_date)); 
									?>
                                        <tr style="border-bottom: 1px solid #ddd;">
                                            <td style="width: 5%; min-width: 40px; padding: 12px; border: 1px solid #ddd;"><?= $i ?></td>
                                            <td style="padding: 12px; border: 1px solid #ddd;"><?= $item->room_no; ?></td>
                                            <td style="padding: 12px; border: 1px solid #ddd;"><?= formatDateFront($item->arrival_date); ?></td>
                                            <td style="padding: 12px; border: 1px solid #ddd;"><?= formatDateFront($item->departure_date); ?></td>
                                            <td style="padding: 12px; border: 1px solid #ddd;"><?= $item->total_revenue_converted; ?></td>
                                            <td style="padding: 12px; border: 1px solid #ddd;"><?= $status ?></td>
                                        </tr>
                                    <?php endforeach;?>
									<tr style="background-color: #f9f9f9;">
										<td colspan='2' style="padding: 12px; border: 1px solid #ddd;">Sub Total Point</td>
										<td colspan='4' style="padding: 12px; text-align: right; border: 1px solid #ddd;"><h4><b class='text text-default'><?=  number_format($total_all);  ?></b></h4></td>
									</tr>
									<tr style="background-color: #f9f9f9;">
										<td colspan='2' style="padding: 12px; border: 1px solid #ddd;">Expired Point</td>
										<td colspan='4' style="padding: 12px; text-align: right; border: 1px solid #ddd;"><h4><b class='text text-danger'><?= number_format($total_exp); ?></b></h4></td>
									</tr>
									<tr style="background-color: #f9f9f9;">
										<td colspan='4' style="padding: 12px; border: 1px solid #ddd;"><b>Total Point<b></td>
										<td colspan='4' style="padding: 12px; text-align: right; border: 1px solid #ddd;"><h4><b class='text text-success'><?= number_format($total_in); ?></b></h4></td>
									</tr>		
                                </tbody>
                            </table>
                            <?php if (empty($history)): ?>
                                <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                           <!--?= view('common/_pagination'); ?>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
