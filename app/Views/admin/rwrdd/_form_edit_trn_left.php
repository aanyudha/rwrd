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
            <label class="control-label"><?= trans('trn-hotel-filename'); ?></label>
            <input type="text" class="form-control" name="filename" placeholder="<?= trans('trn-hotel-filename'); ?>" value="<?= esc($trnhtl->filename); ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('trn-hotel-hotel-code'); ?></label>
            </label>
            <input type="text" class="form-control" name="hotel_code" placeholder="<?= trans('trn-hotel-hotel-code'); ?>" value="<?= esc($trnhtl->hotel_code); ?>">
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('trn-hotel-id-member'); ?></label>
            <textarea class="form-control text-area" name="id_member" placeholder="<?= trans('trn-hotel-id-member'); ?> & <?= trans("description"); ?> (<?= trans('meta_tag'); ?>)"><?= esc($trnhtl->id_member); ?></textarea>
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('trn-hotel-room-no'); ?> </label>
            <input type="text" class="form-control" name="room_no" placeholder="<?= trans('trn-hotel-room-no'); ?>" value="<?= esc($trnhtl->room_no); ?>">
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('trn-hotel-room-type'); ?> </label>
            <input type="text" class="form-control" name="room_type" placeholder="<?= trans('trn-hotel-room-type'); ?>" value="<?= esc($trnhtl->room_type); ?>">
        </div>
    </div>
</div>
