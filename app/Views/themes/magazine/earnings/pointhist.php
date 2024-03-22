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
                            <table class="table table-striped">
                                <thead>
                                <tr role="row">
                                    <th><?= trans('room_phist'); ?></th>
                                    <th><?= trans('arvdate_phist'); ?></th>
                                    <th><?= trans('depdate_phist'); ?></th>
                                    <th><?= trans('point_phist'); ?></th>
                                    <th><?= trans('stat_phist'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($point_hist)):
                                    foreach ($point_hist as $item): ?>
                                        <tr>
                                            <td><?= priceFormatted($item->amount); ?></td>
                                            <td><?= formatDateFront($item->payout_method); ?></td>
                                            <td><?= formatDateFront($item->created_at); ?></td>
                                            <td><?= trans($item->created_at); ?></td>
                                            <td><?= trans($item->created_at); ?></td>
                                        </tr>
                                    <?php endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                            <?php if (empty($point_hist)): ?>
                                <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <?= view('common/_pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>