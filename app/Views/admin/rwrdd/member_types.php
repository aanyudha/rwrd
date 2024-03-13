<?php $rewardModel = new \App\Models\RewardModel(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('ref-tipe-member'); ?></h3>
        </div>
        <div class="right">
            <a href="<?= adminUrl('reward-system/add-tipe-member'); ?>" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?= trans('add-ref-tipe-member'); ?>
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <?= view('admin/rwrdd/_filter', ['url' => adminUrl('reward-system/ref-tipe-member')]); ?>
                        <thead>
                        <tr role="row">
                            <th><?= trans('id-ref-tipe-member'); ?></th>
                            <th><?= trans('name-ref-tipe-member'); ?></th>
                            <th><?= trans('index-ref-tipe-member'); ?></th>
                            <th><?= trans('minstay-ref-tipe-member'); ?></th>
                            <th><?= trans('maxstay-ref-tipe-member'); ?></th>
                            <th><?= trans('benefit-ref-tipe-member'); ?></th>
                            <th><?= trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($tipemember)):
                            foreach ($tipemember as $item): ?>
                                <tr>
                                    <td><?= $item->id_tipe_member; ?></td>
                                    <td><?= esc($item->nama); ?></td>
                                    <td><?= esc($item->index); ?></td>
                                    <td><?= esc($item->min_stays); ?></td>
                                    <td><?= esc($item->max_stays); ?></td>
                                    <td><?= esc($item->benefit); ?></td>
                                    <td>
                                        <p class="m-0">
                                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#accountDetailsModel_<?= $item->id_tipe_member; ?>"><?= trans("payout_method"); ?></button>
                                        </p>
                                    </td>
                                    <td class="td-select-option">
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= trans('select_an_option'); ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <li>
                                                    <a href="<?= adminUrl('reward-system/edit-tipe-member/' . $item->id_tipe_member); ?>"><i class="fa fa-edit option-icon"></i><?= trans('edit'); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
					<?php if (empty($item)): ?>
                        <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <?= view('common/_pagination'); ?>
            </div>
        </div>
    </div>
</div>
