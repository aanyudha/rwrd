<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans("add_hotel"); ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('ref-hotel'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?= trans("hotels_setting"); ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('AdminController/addHotelPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("kode_hotel"); ?></label>
                        <input type="text" name="kode_hotel" class="form-control auth-form-input" placeholder="<?= trans("kode_hotel"); ?>" value="<?= old("kode_hotel"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("nama"); ?></label>
                        <input type="text" name="nama" class="form-control auth-form-input" placeholder="<?= trans("nama"); ?>" value="<?= old("nama"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("alamat"); ?></label>
                        <input type="text" name="alamat" class="form-control auth-form-input" placeholder="<?= trans("alamat"); ?>" value="<?= old("alamat"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("email_admin"); ?></label>
                        <input type="text" name="email_admin" class="form-control auth-form-input" placeholder="<?= trans("email_admin"); ?>" value="<?= old("email_admin"); ?>" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('add_hotel'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>