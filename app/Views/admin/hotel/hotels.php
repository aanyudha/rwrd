<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans("hotels_setting"); ?></h3>
        </div>
        <?php if (user()->role == 'admin'): ?>
            <div class="right">
                <a href="<?= adminUrl('add-hotel'); ?>" class="btn btn-success btn-add-new">
                    <i class="fa fa-plus"></i>
                    <?= trans("hotels_setting_add"); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <?= view('admin/hotel/_filter'); ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr role="row">
                            <th width="20"><?= trans('id_hotels'); ?></th>
                            <th><?= trans('kode_hotel'); ?></th>
                            <th><?= trans('nama'); ?></th>
                            <th><?= trans('alamat'); ?></th>
                            <th><?= trans('email_admin'); ?></th>
                            <th><?= trans('hotel_created_at'); ?></th>
                            <th><?= trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($hotels)):
                            foreach ($hotels as $hotel): ?>
                                <tr>
                                    <td><?= $hotel->id_hotel; ?></td>
                                    <td><?= $hotel->kode_hotel; ?></td>
                                    <td><?= $hotel->nama; ?></td>
                                    <td><?= $hotel->alamat; ?></td>
                                    <td><?= $hotel->email_admin; ?></td>
                                    <td><?= formatDate($hotel->created_at); ?></td>
                                    <td>
                                        <a href="<?= adminUrl('edit-hotel/' . $hotel->id_hotel); ?>" class="btn btn-success"><i class="fa fa-edit"></i>&nbsp;&nbsp;<?= trans("edit"); ?></a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($hotels)): ?>
                        <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <?= view('common/_pagination'); ?>
            </div>
        </div>
    </div>
</div>