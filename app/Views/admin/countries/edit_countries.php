<?php $settingModel = new \App\Models\SettingsModel(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans('edit_countries'); ?></h3>
                </div>
            </div>
            <form action="<?= base_url('AdminController/editCountriesPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_hotel" value="<?= $country->id_negara; ?>">

                <div class="box-body">

                    <div class="form-group">
                        <label><?= trans('nama_countries'); ?></label>
                        <input type="text" class="form-control form-input" name="nama" placeholder="<?= trans('nama'); ?>" value="<?= esc($country->nama); ?>">
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>