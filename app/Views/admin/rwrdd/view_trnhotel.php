<div class="row">
    <div class="col-sm-12">
			<?= csrf_field(); ?>
            <input type="hidden" name="post_type" value="article">
            <div class="row">
                <div class="col-sm-12 form-header">
                    <h1 class="form-title"><?= trans('trn-hotel-view'); ?></h1>
                   <a href="<?= adminUrl('reward-system/trn-hotel'); ?>" class="btn btn-success btn-add-new pull-right">
                        <i class="fa fa-bars"></i>
                        <?= trans('trn-hotel'); ?>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-post">
                        <div class="form-post-left">
                            <?= view("admin/rwrdd/_form_view_post_left"); ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>