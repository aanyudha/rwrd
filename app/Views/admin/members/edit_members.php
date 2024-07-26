<?php $authModel = new \App\Models\AuthModel(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans('update_profile'); ?></h3>
                </div>
            </div>
            <form action="<?= base_url('AdminController/editMemberPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $member->id_member; ?>">

                <div class="box-body">
                    <div class="form-group">
                        <?php $role = $authModel->getRoleByKey($member->role);
                        if (!empty($role)):
                            $roleName = parseSerializedNameArray($role->role_name, $activeLang->id);
                            if ($member->role == 'moderator'):?>
                                <label class="label bg-olive"><?= esc($roleName); ?></label>
                            <?php elseif ($member->role == 'author'): ?>
                                <label class="label label-warning"><?= esc($roleName); ?></label>
                            <?php elseif ($member->role == 'user'): ?>
                                <label class="label label-default"><?= esc($roleName); ?></label>
                            <?php endif;
                        endif; ?>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-profile">
                                <img src="<?= getUserAvatar($member->avatar); ?>" alt="" class="thumbnail img-responsive img-update" style="max-width: 300px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-profile">
                                <p>
                                    <a class="btn btn-success btn-sm btn-file-upload">
                                        <?= trans('change_avatar'); ?>
                                        <input name="file" size="40" accept=".png, .jpg, .jpeg" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));" type="file">
                                    </a>
                                </p>
                                <p class='label label-info' id="upload-file-info"></p>
                            </div>
                        </div>
                    </div>
					<div class="form-group">
                        <label><?= trans('email'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($member->email); ?>">
                    </div>
					<div class="form-group">
                        <label><?= trans('fullname'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($member->fullname); ?>">
                    </div>
					<div class="form-group">
                        <label><?= trans('email'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($member->name_on_card); ?>">
                    </div>
					<div class="form-group">
                        <label><?= trans('email'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($member->alamat); ?>">
                    </div>
					<div class="form-group">
                        <label><?= trans('email'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($member->tempat_lahir); ?>">
                    </div>
					<div class="form-group">
                        <label><?= trans('email'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($member->tanggal_lahir); ?>">
                    </div>
					<div class="form-group">
                        <label><?= trans('email'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($member->telepon); ?>">
                    </div>
					<div class="form-group">
                        <label><?= trans('email'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($member->handphone); ?>">
                    </div>
					<div class="form-group">
                        <label><?= trans('email'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($member->perusahaan); ?>">
                    </div>

                    <hr>
                    <div class="form-group">
                        <label><?= trans('balance'); ?></label>
                        <input type="text" class="form-control form-input price-input" name="balance" placeholder="<?= trans('balance'); ?>" value="<?= $member->balance; ?>">
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>