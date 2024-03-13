<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= $title; ?></h3>
        </div>
        <div class="right">
            <a href="<?= adminUrl('add-reward'); ?>" class="btn btn-success btn-add-new pull-right">
                <i class="fa fa-plus"></i>
                <?= trans('ref-rewards-add'); ?>
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <?= view('admin/rwrdd/_filter', ['url' => adminUrl('reward-system/ref-reward')]); ?>
                        <thead>
                        <tr role="row">
                            <?php if (checkUserPermission('manage_all_posts')): ?>
                                <th width="20"><input type="checkbox" class="checkbox-table" id="checkAll"></th>
                            <?php endif; ?>
                            <th><?= trans('ref-rewards-name'); ?></th>
                            <th><?= trans('ref-rewards-desc'); ?></th>
                            <th><?= trans('ref-rewards-foto'); ?></th>
                            <th><?= trans('ref-rewards-type'); ?></th>
							<th><?= trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($refrewarddd)):
                            foreach ($refrewarddd as $item):
                                //$language = getLanguage($item->lang_id); ?>
                                <tr>
                                    <?php if (checkUserPermission('manage_all_posts')): ?>
                                        <td><input type="checkbox" name="checkbox-table" class="checkbox-table" value="<?= $item->id_reward; ?>"></td>
                                    <?php endif; ?>
                                    <td><?= esc($item->nama); ?></td>
                                    <td><?= esc($item->deskripsi); ?></td>
                                    <td>
                                        <div class="td-post-item">
                                            <div class="post-image">
                                                <!--<a href="?= generatePostURL($item, generateBaseURLByLang($language)); ?>" target="_blank">-->
                                                    <div class="image">
                                                    <!--    <img src="?= IMG_BASE64_1x1; ?>" data-src="?= getPostImage($item, "small"); ?>" alt="" class="lazyload img-responsive"/>
                                                    </div>
                                                <!--</a>-->
                                            </div>
                                    </td>  
									<td><?= esc($item->tipe); ?></td>
                                    <td style="width: 180px;">
                                        <form action="<?= base_url('PostController/postOptionsPost'); ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $item->id_reward; ?>">
                                            <input type="hidden" name="back_url" value="<?= currentFullURL(); ?>">
                                            <div class="dropdown">
                                                <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= trans('select_an_option'); ?>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu options-dropdown">
                                                    <li>
                                                        <a href="<?= adminUrl('edit-post/' . $item->id_reward); ?>"><i class="fa fa-edit option-icon"></i><?= trans('edit'); ?></a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="deleteItem('PostController/deletePost','<?= $item->id_reward; ?>','<?= clrQuotes(trans("confirm_post")); ?>');"><i class="fa fa-trash option-icon"></i><?= trans('delete'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($refrewarddd)): ?>
                        <p class="text-center"><?= trans("no_records_found"); ?></p>
                    <?php endif; ?>
                    <div class="col-sm-12 table-ft">
                        <div class="row">
                            <div class="pull-right">
                                <?= view('common/_pagination'); ?>
                            </div>
                            <?php if (!empty($posts) && countItems($posts) > 0): ?>
                                <div class="pull-left bulk-options">
                                    <button class="btn btn-sm btn-danger btn-table-delete" onclick="deleteSelectePosts('<?= clrQuotes(trans("confirm_posts")); ?>');"><i class="fa fa-trash option-icon"></i><?= trans('delete'); ?></button>
                                    <?php if ($listType != 'slider_posts'): ?>
                                        <button class="btn btn-sm btn-default btn-table-delete" onclick="postBulkOptions('add_slider');"><i class="fa fa-plus option-icon"></i><?= trans('add_slider'); ?></button>
                                    <?php endif;
                                    if ($listType != 'featured_posts'): ?>
                                        <button class="btn btn-sm btn-default btn-table-delete" onclick="postBulkOptions('add_featured');"><i class="fa fa-plus option-icon"></i><?= trans('add_featured'); ?></button>
                                    <?php endif;
                                    if ($listType != 'breaking_news'): ?>
                                        <button class="btn btn-sm btn-default btn-table-delete" onclick="postBulkOptions('add_breaking');"><i class="fa fa-plus option-icon"></i><?= trans('add_breaking'); ?></button>
                                    <?php endif;
                                    if ($listType != 'recommended_posts'): ?>
                                        <button class="btn btn-sm btn-default btn-table-delete" onclick="postBulkOptions('add_recommended');"><i class="fa fa-plus option-icon"></i><?= trans('add_recommended'); ?></button>
                                    <?php endif; ?>
                                    <button class="btn btn-sm btn-default btn-table-delete" onclick="postBulkOptions('remove_slider');"><i class="fa fa-minus option-icon"></i><?= trans('remove_slider'); ?></button>
                                    <button class="btn btn-sm btn-default btn-table-delete" onclick="postBulkOptions('remove_featured');"><i class="fa fa-minus option-icon"></i><?= trans('remove_featured'); ?></button>
                                    <button class="btn btn-sm btn-default btn-table-delete" onclick="postBulkOptions('remove_breaking');"><i class="fa fa-minus option-icon"></i><?= trans('remove_breaking'); ?></button>
                                    <button class="btn btn-sm btn-default btn-table-delete" onclick="postBulkOptions('remove_recommended');"><i class="fa fa-minus option-icon"></i><?= trans('remove_recommended'); ?></button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>