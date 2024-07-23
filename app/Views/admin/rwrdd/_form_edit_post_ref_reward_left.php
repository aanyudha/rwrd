<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('post_details'); ?></h3>
        </div>
    </div>
    <div class="box-body">
        <input type="hidden" name="id_reward" value="<?= esc($refrewards->id_reward); ?>">
        <input type="hidden" name="back_url" class="form-control" value="<?= esc(inputGet('back_url')); ?>">

       <!-- <div class="form-group">
            <label class="control-label"><= trans('id-ref-tipe-member'); ?></label>
            <input type="text" class="form-control" name="id_reward" placeholder="<= trans('title'); ?>" value="<= esc($refrewards->id_reward); ?>" required>
        </div>-->

        <div class="form-group">
            <label class="control-label"><?= trans('name-ref-tipe-member'); ?></label>
            </label>
            <input type="text" class="form-control" name="nama" placeholder="<?= trans('name-ref-tipe-member'); ?>" value="<?= esc($refrewards->nama); ?>">
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('tipe-ref-rewards'); ?></label>
            </label>
            <input type="text" class="form-control" name="tipe" placeholder="<?= trans('tipe-ref-rewards'); ?>" value="<?= esc($refrewards->tipe); ?>">
        </div>
    </div>
</div>
