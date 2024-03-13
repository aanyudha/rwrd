<label class="control-label control-label-content"><?= trans('benefit'); ?></label>
<div id="main_editor">
    <?php if (!empty($tipemember)): ?> <!-- jika edit -->
        <textarea class="tinyMCE form-control" name="benefit"><?= $tipemember->benefit; ?></textarea>
    <?php else: ?> <!-- jika add -->
        <textarea class="tinyMCE form-control" name="benefit"><?= old('content'); ?></textarea>
    <?php endif; ?>
</div>