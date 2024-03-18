<?php $rewardModel = new \App\Models\RewardModel(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('trn-hotel'); ?></h3>
        </div>
        <div class="right">
            <a href="<?= adminUrl('reward-system/add-trn-hotel'); ?>" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?= trans('trn-hotel-add'); ?>
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
			<div class="scrollme"> 
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <?= view('admin/rwrdd/_filter', ['url' => adminUrl('reward-system/trn-hotel')]); ?>
                        <thead>
                        <tr role="row">
                            <th><?= trans('trn-hotel-filename'); ?></th>
                            <th><?= trans('trn-hotel-hotel-code'); ?></th>
                            <th><?= trans('trn-hotel-id-member'); ?></th>
                            <th><?= trans('trn-hotel-room-no'); ?></th>
                            <th><?= trans('trn-hotel-room-type'); ?></th>
                            <th><?= trans('trn-hotel-room-code'); ?></th>
                            <th><?= trans('trn-hotel-market-code'); ?></th>
                            <th><?= trans('trn-hotel-market-code-converted'); ?></th>
                            <th><?= trans('trn-hotel-source-code'); ?></th>
                            <th><?= trans('trn-hotel-arrival-date'); ?></th>
                            <th><?= trans('trn-hotel-departure-date'); ?></th>
                            <th><?= trans('trn-hotel-number-nights'); ?></th>
                            <th><?= trans('trn-hotel-room-revenue'); ?></th>
                            <th><?= trans('trn-hotel-fnb-revenue'); ?></th>
                            <th><?= trans('trn-hotel-other-revenue'); ?></th>
                            <th><?= trans('trn-hotel-total-revenue'); ?></th>
                            <th><?= trans('trn-hotel-room-revenue-converted'); ?></th>
                            <th><?= trans('trn-hotel-fnb-revenue-converted'); ?></th>
                            <th><?= trans('trn-hotel-other-revenue-converted'); ?></th>
                            <th><?= trans('trn-hotel-total-revenue-converted'); ?></th>
                            <th><?= trans('trn-hotel-point-type'); ?></th>
                            <th><?= trans('trn-hotel-status'); ?></th>
                            <th><?= trans('trn-hotel-waktu-upload'); ?></th>
                            <th><?= trans('trn-hotel-exp-date'); ?></th>
                            <th><?= trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($trnhtl)):
                            foreach ($trnhtl as $item): ?>
                                <tr>
                                    <td><?= esc($item->filename); ?></td>
                                    <td><?= esc($item->hotel_code); ?></td>
                                    <td><?= esc($item->id_member); ?></td>
                                    <td><?= esc($item->room_no); ?></td>
                                    <td><?= esc($item->room_type); ?></td>
                                    <td><?= esc($item->room_code); ?></td>
                                    <td><?= esc($item->market_code); ?></td>
                                    <td><?= esc($item->market_code_converted); ?></td>
                                    <td><?= esc($item->source_code); ?></td>
                                    <td><?= esc($item->arrival_date); ?></td>
                                    <td><?= esc($item->departure_date); ?></td>
                                    <td><?= esc($item->number_of_nights); ?></td>
                                    <td><?= esc($item->room_revenue); ?></td>
                                    <td><?= esc($item->fnb_revenue); ?></td>
                                    <td><?= esc($item->other_revenue); ?></td>
                                    <td><?= esc($item->total_revenue); ?></td>
                                    <td><?= esc($item->room_revenue_converted); ?></td>
                                    <td><?= esc($item->fnb_revenue_converted); ?></td>
                                    <td><?= esc($item->other_revenue_converted); ?></td>
                                    <td><?= esc($item->total_revenue_converted); ?></td>
                                    <td><?= esc($item->point_type); ?></td>
                                    <td><?= esc($item->status); ?></td>
                                    <td><?= esc($item->waktu_upload); ?></td>
                                    <td><?= esc($item->exp_date); ?></td>
                                    <td class="td-select-option">
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= trans('select_an_option'); ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <li>
                                                    <a href="<?= adminUrl('reward-system/view-trn-hotel/' . $item->id_trn); ?>"><i class="fa fa-play option-icon"></i><?= trans('trn-hotel-view'); ?></a>
                                                </li>
												<li>
                                                    <a href="<?= adminUrl('reward-system/edit-trn-hotel/' . $item->id_trn); ?>"><i class="fa fa-edit option-icon"></i><?= trans('trn-hotel-edit'); ?></a>
                                                </li>
												<li>
                                                        <a href="javascript:void(0)" onclick="deleteItem('RewardController/deleteTrnHotel','<?= $item->id_trn; ?>','<?= clrQuotes(trans("confirm_post_delete_trn_hotel")); ?>');"><i class="fa fa-trash option-icon"></i><?= trans('delete'); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
					<?php if (empty($trnhtl)): ?>
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