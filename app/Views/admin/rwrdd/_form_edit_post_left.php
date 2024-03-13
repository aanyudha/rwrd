<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('post_details'); ?></h3>
        </div>
    </div>
    <div class="box-body">
        <input type="hidden" name="id_tipe_member" value="<?= esc($tipemember->id_tipe_member); ?>">
        <input type="hidden" name="back_url" class="form-control" value="<?= esc(inputGet('back_url')); ?>">

        <div class="form-group">
            <label class="control-label"><?= trans('id-ref-tipe-member'); ?></label>
            <input type="text" class="form-control" name="id_tipe_member" placeholder="<?= trans('title'); ?>" value="<?= esc($tipemember->id_tipe_member); ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('name-ref-tipe-member'); ?></label>
            </label>
            <input type="text" class="form-control" name="nama" placeholder="<?= trans('name-ref-tipe-member'); ?>" value="<?= esc($tipemember->nama); ?>">
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('index-ref-tipe-member'); ?></label>
            <textarea class="form-control text-area" name="index" placeholder="<?= trans('index-ref-tipe-member'); ?> & <?= trans("description"); ?> (<?= trans('meta_tag'); ?>)"><?= esc($tipemember->index); ?></textarea>
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('minstay-ref-tipe-member'); ?> </label>
            <input type="text" class="form-control" name="min_stays" placeholder="<?= trans('minstay-ref-tipe-member'); ?>" value="<?= esc($tipemember->min_stays); ?>">
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('maxstay-ref-tipe-member'); ?> </label>
            <input type="text" class="form-control" name="max_stays" placeholder="<?= trans('maxstay-ref-tipe-member'); ?>" value="<?= esc($tipemember->max_stays); ?>">
        </div>
    </div>
</div>
