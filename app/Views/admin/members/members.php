<?php $authModel = new \App\Models\AuthModel(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans("members"); ?></h3>
        </div>
        <?php if (user()->role == 'admin'): ?>
            <div class="right">
                <a href="<?= adminUrl('add-member'); ?>" class="btn btn-success btn-add-new">
                    <i class="fa fa-plus"></i>
                    <?= trans("add_member"); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <?= view('admin/members/_filter'); ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr role="row">
                            <th width="20"><?= trans('id'); ?></th>
                            <th><?= trans('member'); ?></th>
                            <th><?= trans('email'); ?></th>
                            <th><?= trans('role'); ?></th>
                            <th><?= trans('status'); ?></th>
                            <th><?= trans('date'); ?></th>
                            <th><?= trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($members)):
                            foreach ($members as $member): ?>
                                <tr>
                                    <td><?= $member->id_member; ?></td>
                                    <td class="td-member">
										<img src="<?= getMemberAvatar($member->avatar); ?>" alt="" class="img-responsive">
                                        <strong><?= esc($member->fullname); ?></strong>
                                        <!--<a href="?= generateProfileURL($member->slug); ?>" target="_blank" class="table-link">
                                            <img src="?= getmemberAvatar($member->avatar); ?>" alt="" class="img-responsive">
                                            <strong>?= esc($member->membername); ?></strong>
                                        </a>-->
                                        <?php if ($member->reward_system_enabled == 1): ?>
                                            <p><label class="label bg-primary"><?= trans('reward_system'); ?></label></p>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= esc($member->email);
                                        if ($member->email_status == 1): ?>
                                            <small class="text-success">(<?= trans("confirmed"); ?>)</small>
                                        <?php else: ?>
                                            <small class="text-danger">(<?= trans("unconfirmed"); ?>)</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php $role = $authModel->getRoleByKey($member->role);
                                        if (!empty($role)):
                                            $roleName = parseSerializedNameArray($role->role_name, $activeLang->id);
                                            if ($member->role == 'user'):?>
                                                <label class="label bg-olive"><?= esc($roleName); ?></label>
                                            <?php endif;
                                        endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($member->status == 'Aktif'): ?>
                                            <label class="label label-success"><?= trans('aktif'); ?></label>
                                        <?php else: ?>
                                            <label class="label label-danger"><?= trans('non_aktif'); ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= formatDate($member->created_at); ?></td>
                                    <td class="td-select-option">
                                        <form action="<?= base_url('AdminController/memberOptionsPost'); ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $member->id_member; ?>">
                                            <div class="dropdown">
                                                <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= trans('select_an_option'); ?>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu options-dropdown">
                                                    <?php if ($member->reward_system_enabled == 1): ?>
                                                        <li>
                                                            <button type="submit" name="submit" value="reward_system" class="btn-list-button"><i class="fa fa-money option-icon"></i><?= trans('disable_reward_system'); ?></button>
                                                        </li>
                                                    <?php else: ?>
                                                        <li>
                                                            <button type="submit" name="submit" value="reward_system" class="btn-list-button"><i class="fa fa-money option-icon"></i><?= trans('enable_reward_system'); ?></button>
                                                        </li>
                                                    <?php endif;
                                                    if ($member->email_status != 1): ?>
                                                        <li>
                                                            <button type="submit" name="submit" value="confirm_email" class="btn-list-button"><i class="fa fa-check option-icon"></i><?= trans('confirm_member_email'); ?></button>
                                                        </li>
                                                    <?php endif;
                                                    if ($member->status == "Aktif"): ?>
                                                        <li>
                                                            <button type="submit" name="submit" value="ban_member" class="btn-list-button"><i class="fa fa-stop-circle option-icon"></i><?= trans('non_aktif'); ?></button>
                                                        </li>
                                                    <?php else: ?>
                                                        <li>
                                                            <button type="submit" name="submit" value="ban_member" class="btn-list-button"><i class="fa fa-stop-circle option-icon"></i><?= trans('aktif'); ?></button>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a href="<?= adminUrl('edit-member/' . $member->id_member); ?>"><i class="fa fa-edit option-icon"></i><?= trans('edit'); ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="deleteItem('AdminController/deletememberPost','<?= $member->id_member; ?>','<?= clrQuotes(trans("confirm_member")); ?>');"><i class="fa fa-trash option-icon"></i><?= trans('delete'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($members)): ?>
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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= trans('change_member_role'); ?></h4>
            </div>
            <form action="<?= base_url('AdminController/changememberRolePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" name="member_id" id="modal_member_id" value="">
                            <?php $roles = $authModel->getRolesPermissions();
                            if (!empty($roles)):
                                foreach ($roles as $role):
                                    $roleName = parseSerializedNameArray($role->role_name, $activeLang->id); ?>
                                    <div class="col-sm-3">
                                        <input type="radio" name="role" value="<?= esc($role->role); ?>" id="role_<?= esc($role->role); ?>" class="square-purple" required>&nbsp;&nbsp;
                                        <label for="role_<?= esc($role->role); ?>" class="option-label cursor-pointer"><?= esc($roleName); ?></label>
                                    </div>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><?= trans('save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= trans('close'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>