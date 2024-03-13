<div class="box">
    <div class="box-body">
        <div class="form-group">
            <label class="control-label"><?= trans('id-ref-tipe-member'); ?></label>
            <input type="text" id="wr_input_post_title" class="form-control" name="id_tipe_member" placeholder="<?= trans('id-ref-tipe-member'); ?>" value="<?= old('id-ref-tipe-member'); ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('name-ref-tipe-member'); ?></label>
            <input type="text" class="form-control" name="nama" placeholder="<?= trans('name-ref-tipe-member'); ?>" value="<?= old('name-ref-tipe-member'); ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('index-ref-tipe-member'); ?> </label>
            <input class="form-control text-area" name="index" placeholder="<?= trans('index-ref-tipe-member'); ?>" value="<?= old('index-ref-tipe-member'); ?>" required>
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('minstay-ref-tipe-member'); ?> </label>
            <input class="form-control text-area" name="min_stays" placeholder="<?= trans('minstay-ref-tipe-member'); ?>" value="<?= old('minstay-ref-tipe-member'); ?>" required>
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('maxstay-ref-tipe-member'); ?> </label>
            <input class="form-control text-area" name="max_stays" placeholder="<?= trans('maxstay-ref-tipe-member'); ?>" value="<?= old('maxstay-ref-tipe-member'); ?>" required>
        </div>
    </div>
</div>

