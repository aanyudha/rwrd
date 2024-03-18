<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('post_details'); ?></h3>
        </div>
    </div>
    <div class="box-body">
        <input type="hidden" name="id_trn" value="<?= esc($trnhtl->id_trn); ?>">
        <input type="hidden" name="back_url" class="form-control" value="<?= esc(inputGet('back_url')); ?>">

        <div class="form-group">
            <label class="control-label"><?= trans('id-ref-tipe-member'); ?></label>
            <input type="text" class="form-control" name="filename" placeholder="<?= trans('title'); ?>" value="<?= esc($trnhtl->filename); ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('name-ref-tipe-member'); ?></label>
            </label>
            <input type="text" class="form-control" name="hotel_code" placeholder="<?= trans('name-ref-tipe-member'); ?>" value="<?= esc($trnhtl->hotel_code); ?>">
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('index-ref-tipe-member'); ?></label>
            <textarea class="form-control text-area" name="id_member" placeholder="<?= trans('index-ref-tipe-member'); ?> & <?= trans("description"); ?> (<?= trans('meta_tag'); ?>)"><?= esc($trnhtl->id_member); ?></textarea>
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('minstay-ref-tipe-member'); ?> </label>
            <input type="text" class="form-control" name="room_no" placeholder="<?= trans('minstay-ref-tipe-member'); ?>" value="<?= esc($trnhtl->room_no); ?>">
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('maxstay-ref-tipe-member'); ?> </label>
            <input type="text" class="form-control" name="room_type" placeholder="<?= trans('maxstay-ref-tipe-member'); ?>" value="<?= esc($trnhtl->room_type); ?>">
        </div>
    </div>
</div>
