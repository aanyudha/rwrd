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
                    <h3 class="box-title"><?= trans('edit_hotel'); ?></h3>
                </div>
            </div>
            <form action="<?= base_url('AdminController/editHotelPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_hotel" value="<?= $hotel->id_hotel; ?>">

                <div class="box-body">

                    <div class="form-group">
                        <label><?= trans('kode_hotel'); ?></label>
                        <input type="text" class="form-control form-input" name="kode_hotel" placeholder="<?= trans('kode_hotel'); ?>" value="<?= esc($hotel->kode_hotel); ?>">
                    </div>

                    <div class="form-group">
                        <label><?= trans('nama'); ?></label>
                        <input type="text" class="form-control form-input" name="nama" placeholder="<?= trans('nama'); ?>" value="<?= esc($hotel->nama); ?>">
                    </div>

                    <div class="form-group">
                        <label><?= trans('alamat'); ?></label>
                        <input type="text" class="form-control form-input" name="alamat" placeholder="<?= trans('alamat'); ?>" value="<?= esc($hotel->alamat); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?= trans('email_admin'); ?></label>
                        <textarea class="form-control text-area" name="email_admin" placeholder="<?= trans('email_admin'); ?>"><?= esc($hotel->email_admin); ?></textarea>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>