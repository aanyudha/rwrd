<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('submit-box'); ?></h3>
        </div>
    </div>
    <div class="box-body">
        <?php if (!empty($tipemember)): ?>
            <div class="form-group"> <!-- jika edit -->
                    <button type="submit" class="btn btn-primary pull-right" onclick="allowSubmitForm = true;"><?= trans('btn_submit'); ?></button>
                </div>
        <?php else: ?> <!-- jika add -->
            <div class="form-group">
			<button type="submit" class="btn btn-primary pull-right" onclick="allowSubmitForm = true;"><?= trans('btn_submit'); ?></button>
            </div>
        <?php endif; ?>
    </div>
</div>