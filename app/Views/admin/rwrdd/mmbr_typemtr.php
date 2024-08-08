<?php $rewardModel = new \App\Models\RewardModel(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('mmbr-type-mtr'); ?></h3>
        </div>

    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
			<div class="scrollme"> 
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <?= view('admin/rwrdd/_filter', ['url' => adminUrl('reward-system/mmbr-type-mtr')]); ?>
                        <thead>
                        <tr role="row">
                            <th><?= trans('mmbr_id'); ?></th>
                            <th><?= trans('mmbr_nameoc'); ?></th>
                            <th><?= trans('mmbr_isprintcard'); ?></th>
                            <th><?= trans('mmbr_nos'); ?></th>
                            <th><?= trans('mmbr_typeactual'); ?></th>
                            <th><?= trans('mmbr_typesuggest'); ?></th>
                            <!--<th>?= trans('options'); ?></th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($mmbrtypmtr)):
                            foreach ($mmbrtypmtr as $item): ?>
                                <tr>
                                    <td><?= esc($item->id_member); ?></td>
                                    <td><?= esc($item->name_on_card); ?></td>
                                    <td><?= esc($item->is_print_card); ?></td>
                                    <td><?= esc($item->number_of_stays); ?></td>
                                    <td><?= esc($item->member_type_actual); ?></td>
                                    <td><?= esc($item->member_type_suggested); ?></td>
                                    <!--<td class="td-select-option">
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown">?= trans('select_an_option'); ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <li>
                                                    <a href="?= adminUrl('reward-system/view-trn-hotel/' . $item->id_member); ?>"><i class="fa fa-play option-icon"></i>?= trans('trn-hotel-view'); ?></a>
                                                </li>
												<li>
                                                    <a href="?= adminUrl('reward-system/edit-trn-hotel/' . $item->id_member); ?>"><i class="fa fa-edit option-icon"></i>?= trans('trn-hotel-edit'); ?></a>
                                                </li>
												<li>
                                                        <a href="javascript:void(0)" onclick="deleteItem('RewardController/deleteTrnHotel','?= $item->id_member; ?>','?= clrQuotes(trans("confirm_post_delete_trn_hotel")); ?>');"><i class="fa fa-trash option-icon"></i><?= trans('delete'); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>-->
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
					<?php if (empty($mmbrtypmtr)): ?>
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