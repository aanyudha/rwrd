<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('post_details'); ?></h3>
        </div>
    </div>
    <div class="box-body">
        <input type="hidden" name="id_point_out" value="<?= esc($trnpout->id_point_out); ?>">
        <input type="hidden" name="back_url" class="form-control" value="<?= esc(inputGet('back_url')); ?>">

        <div class="form-group">
            <label class="control-label"><?= trans('trnpointo_idnumber'); ?></label>
            <input type="text" class="form-control" name="id_member" placeholder="<?= trans('trnpointo_idnumber'); ?>" value="<?= esc($trnpout->id_member); ?>" disabled>
            <input type="hidden" class="form-control" name="id_member" value="<?= esc($trnpout->id_member); ?>" disabled>
        </div>

        <div class="form-group">
            <label class="control-label"><?= trans('trnpointo_id_reward'); ?></label>
            </label>
            <input type="text" class="form-control" name="id_reward" placeholder="<?= trans('trnpointo_id_reward'); ?>" value="<?= esc($trnpout->id_reward); ?>" disabled>
            <input type="hidden" class="form-control" name="id_reward" value="<?= esc($trnpout->id_reward); ?>" >
        </div>
		
        <div class="form-group">
            <label class="control-label"><?= trans('trnpointo_qty'); ?> </label>
            <input type="text" class="form-control" name="qty" placeholder="<?= trans('trnpointo_qty'); ?>" value="<?= esc($trnpout->qty); ?>" disabled>
            <input type="hidden" class="form-control" name="qty" value="<?= esc($trnpout->qty); ?>">
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('trnpointo_point'); ?> </label>
            <input type="text" class="form-control" name="point" placeholder="<?= trans('trnpointo_point'); ?>" value="<?= esc($trnpout->point); ?>" disabled>
            <input type="hidden" class="form-control" name="point"  value="<?= esc($trnpout->point); ?>" >
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('trnpointo_tanggalPengajuan'); ?> </label>
            <input type="date" class="form-control" name="tanggal_pengajuan" placeholder="<?= trans('trnpointo_tanggalPengajuan'); ?>" value="<?= esc($trnpout->tanggal_pengajuan); ?>">
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('trnpointo_status'); ?></label>
                <select id="status" name="status" class="form-control" autocomplete="off" required>
                    <option value=""><?= trans('select_status'); ?></option>
                    <?php if (!empty($stat)):
                        foreach ($stat as $item): ?>
                            <option value="<?= $item->id; ?>"><?= esc($item->nama); ?></option>
                        <?php endforeach;
                    endif; ?>
                </select>
		</div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('trnpointo_tglproses'); ?> </label>
            <input type="date" class="form-control" name="tanggal_proses" placeholder="<?= trans('trnpointo_tglproses'); ?>" value="<?= esc($trnpout->tanggal_proses); ?>">
        </div>
		
		<div class="form-group">
            <label class="control-label"><?= trans('trnpointo_tglclaim'); ?> </label>
            <input type="date" class="form-control" name="tanggal_claim" placeholder="<?= trans('trnpointo_tglclaim'); ?>" value="<?= esc($trnpout->tanggal_claim); ?>">
        </div>
		
    </div>
</div>
