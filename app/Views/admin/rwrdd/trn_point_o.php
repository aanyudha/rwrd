<?php $rewardModel = new \App\Models\RewardModel(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('trn-point-out'); ?></h3>
        </div>
        <div class="right">
            <a href="<?= adminUrl('reward-system/add-trn-point-out'); ?>" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?= trans('add-trn-point-out'); ?>
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
			<div class="scrollme"> 
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <?= view('admin/rwrdd/_filter', ['url' => adminUrl('reward-system/trn-point-out')]); ?>
                        <thead>
                        <tr role="row">
                            <th><?= trans('trnpointo_idnumber'); ?></th>
                            <th><?= trans('trnpointo_id_reward'); ?></th>
                            <th><?= trans('trnpointo_qty'); ?></th>
                            <th><?= trans('trnpointo_point'); ?></th>
                            <th><?= trans('trnpointo_tanggalPengajuan'); ?></th>
                            <th><?= trans('trnpointo_status'); ?></th>
                            <th><?= trans('trnpointo_tglproses'); ?></th>
                            <th><?= trans('trnpointo_tglclaim'); ?></th>
                            <th><?= trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($pointout)):
                            foreach ($pointout as $item): ?>
                                <tr>
                                    <td><?= esc($item->id_member); ?></td>
                                    <td><?= esc($item->id_reward); ?></td>
                                    <td><?= esc($item->qty); ?></td>
                                    <td><?= esc($item->point); ?></td>
                                    <td><?= esc($item->tanggal_pengajuan); ?></td>
                                    <td><?= esc($item->status); ?></td>
                                    <td><?= esc($item->tanggal_proses); ?></td>
                                    <td><?= esc($item->tanggal_claim); ?></td>
                                    <td class="td-select-option">
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= trans('select_an_option'); ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <!--<li>
                                                    <a href="?= adminUrl('reward-system/view-trn-point-out/' . $item->id_point_out); ?>"><i class="fa fa-play option-icon"></i>?= trans('trn-hotel-view'); ?></a>
                                                </li>-->
												<li>
                                                    <a href="<?= adminUrl('reward-system/edit-trn-point-out/' . $item->id_point_out); ?>"><i class="fa fa-edit option-icon"></i><?= trans('trn-hotel-edit'); ?></a>
                                                </li>
												<!--<li>
                                                        <a href="javascript:void(0)" onclick="deleteItem('RewardController/deleteTrnHotel','?= $item->id_point_out; ?>','?= clrQuotes(trans("confirm_post_delete_trn_hotel")); ?>');"><i class="fa fa-trash option-icon"></i>?= trans('delete'); ?></a>
                                                </li>-->
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
					<?php if (empty($pointout)): ?>
                        <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                    <?php endif; ?>
                </div>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <?= view('common/_pagination'); ?>
            </div>
        </div>
    </div>
</div>
<style>
.scrollme {
    overflow-x: auto;
}
</style>