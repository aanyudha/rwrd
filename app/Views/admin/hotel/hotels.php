<?php $authModel = new \App\Models\AuthModel(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans("hotels_setting"); ?></h3>
        </div>
        <?php if (user()->role == 'admin'): ?>
            <div class="right">
                <a href="<?= adminUrl('hotels_setting_add'); ?>" class="btn btn-success btn-add-new">
                    <i class="fa fa-plus"></i>
                    <?= trans("hotels_setting_add"); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <?= view('admin/hotel/_filter'); ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr role="row">
                            <th width="20"><?= trans('id_hotels'); ?></th>
                            <th><?= trans('kode_hotel'); ?></th>
                            <th><?= trans('nama'); ?></th>
                            <th><?= trans('alamat'); ?></th>
                            <th><?= trans('email_admin'); ?></th>
                            <th><?= trans('hotel_created_at'); ?></th>
                            <th><?= trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($hotels)):
                            foreach ($hotels as $hotel): ?>
                                <tr>
                                    <td><?= $hotel->id_hotel; ?></td>
                                    <td><?= $hotel->kode_hotel; ?></td>
                                    <td><?= $hotel->nama; ?></td>
                                    <td><?= $hotel->alamat; ?></td>
                                    <td><?= $hotel->email_admin; ?></td>
                                    <td><?= formatDate($hotel->created_at); ?></td>
                                    <td>
                                        <a href="<?= adminUrl('edit-role/' . $role->id); ?>" class="btn btn-success"><i class="fa fa-edit"></i>&nbsp;&nbsp;<?= trans("edit"); ?></a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($hotels)): ?>
                        <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <!--<div class="col-sm-12 text-right">
                ?= view('common/_pagination'); ?>
            </div>-->
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= trans('change_user_role'); ?></h4>
            </div>
            <form action="<?= base_url('AdminController/changeUserRolePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" name="user_id" id="modal_user_id" value="">
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