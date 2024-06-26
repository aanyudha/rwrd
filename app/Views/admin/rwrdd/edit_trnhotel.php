<div class="row">
    <div class="col-sm-12">
        <form action="<?= base_url('RewardController/editTrnHotelPost'); ?>" method="post" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
            <?= csrf_field(); ?>
            <input type="hidden" name="post_type" value="article">
            <div class="row">
                <div class="col-sm-12 form-header">
                    <h1 class="form-title"><?= trans('update_article'); ?></h1>
                   <a href="<?= adminUrl('reward-system/trn-hotel'); ?>" class="btn btn-success btn-add-new pull-right">
                        <i class="fa fa-bars"></i>
                        <?= trans('trn-hotel'); ?>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= view('admin/includes/_messages'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-post">
                        <div class="form-post-left">
                            <?= view("admin/rwrdd/_form_edit_trn_left"); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= view("admin/rwrdd/_text_editor"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-post-right">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= view('admin/rwrdd/_submit_box', ['url' => adminUrl('reward-system/edit-trn-hotel')]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>