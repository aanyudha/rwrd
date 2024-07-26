<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans("add_member"); ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('member'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?= trans("member"); ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('AdminController/addMemberPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("username"); ?></label>
                        <input type="text" name="username" class="form-control auth-form-input" placeholder="<?= trans("username"); ?>" value="<?= old("username"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("email"); ?></label>
                        <input type="email" name="email" class="form-control auth-form-input" placeholder="<?= trans("email"); ?>" value="<?= old("email"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("password"); ?></label>
                        <input type="password" name="password" class="form-control auth-form-input" placeholder="<?= trans("password"); ?>" value="<?= old("password"); ?>" required>
                    </div>
					<input type="hidden" name="role" value="4" required>
                  <!--  <div class="form-group">
                        <label>?= trans("role"); ?></label>
                        <select name="role" class="form-control">
                            ?php if (!empty($roles)):
                                foreach ($roles as $role):
                                    $roleName = parseSerializedNameArray($role->role_name, $activeLang->id); ?>
                                    <option value="?= $role->role; ?>">?= esc($roleName); ?></option>
                               ?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                </div>-->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('add_member'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>