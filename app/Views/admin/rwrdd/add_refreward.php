<div class="row">
    <div class="col-sm-12">
        <form action="<?= base_url('RewardController/addRefRewardPost'); ?>" method="post" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
            <?= csrf_field(); ?>
            <input type="hidden" name="post_type" value="article">
            <div class="row">
                <div class="col-sm-12 form-header">
                    <h1 class="form-title"><?= trans('ref-reward'); ?></h1>
                    <a href="<?= adminUrl('reward-system/ref-reward'); ?>" class="btn btn-success btn-add-new pull-right">
                        <i class="fa fa-bars"></i>
                        <?= trans('ref-reward'); ?>
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
                            <?= view("admin/rwrdd/_form_add_post_left_ref_reward"); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= view("admin/rwrdd/_text_editor_ref_reward"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-post-right">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= view('admin/rwrdd/_upload_image_box_ref_reward'); ?>
                                </div>
                                <div class="col-sm-12">
                                   <?= view('admin/rwrdd/_submit_box_refreward', ['url' => adminUrl('reward-system/add-ref-reward')]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= view('admin/file-manager/_load_file_manager', ['loadImages' => true, 'loadFiles' => false, 'loadVideos' => false, 'loadAudios' => false]); ?>