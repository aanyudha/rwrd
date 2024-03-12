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
                    <h3 class="box-title"><?= trans("add_countries"); ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('ref-countries'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?= trans("negara_setting"); ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('AdminController/addCountriesPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("nama"); ?></label>
                        <input type="text" name="nama" class="form-control auth-form-input" placeholder="<?= trans("nama"); ?>" value="<?= old("nama"); ?>" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('add_countries'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>