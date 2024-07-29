<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('member_photo'); ?>
                <small class="small-title"><?= trans('main_post_image'); ?></small>
            </h3>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group m-0">
            <?php if (!empty($refrewards)):
                    $postImgURL = $refrewards->foto;
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (!empty($postImgURL)): ?>
                            <div id="post_select_image_container" class="post-select-image-container">
                                <img src="<?= $postImgURL; ?>" id="selected_image_file" alt="">
                                <a id="btn_delete_post_main_image_database" class="btn btn-danger btn-sm btn-delete-selected-file-image" data-post-id="<?= $refrewards->id_reward; ?>">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <div id="post_select_image_container" class="post-select-image-container">
                                <a class="btn-select-image" data-toggle="modal" data-target="#file_manager_image" data-image-type="main">
                                    <div class="btn-select-image-inner">
                                        <i class="fa fa-image"></i>
                                        <button class="btn"><?= trans("select_image"); ?></button>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" name="post_image_id" id="post_image_id">
                    </div>
                </div>

            <?php else: ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="post_select_image_container" class="post-select-image-container">
                            <a class="btn-select-image" data-toggle="modal" data-target="#file_manager_image" data-image-type="main">
                                <div class="btn-select-image-inner">
                                    <i class="fa fa-image"></i>
                                    <button class="btn"><?= trans("select_image"); ?></button>
                                </div>
                            </a>
                        </div>
                        <input type="hidden" name="post_image_id" id="post_image_id">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>