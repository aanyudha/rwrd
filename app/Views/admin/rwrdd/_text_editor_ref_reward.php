<label class="control-label control-label-content"><?= trans('deskripsi-ref-reward'); ?></label>
<div id="main_editor">
    <?php if (!empty($refrewards)): ?> <!-- jika edit -->
        <textarea class="tinyMCE form-control" name="deskripsi"><?= $refrewards->deskripsi; ?></textarea>
    <?php else: ?> <!-- jika add -->
        <textarea class="tinyMCE form-control" name="deskripsi"><?= old('deskripsi'); ?></textarea>
    <?php endif; ?>
</div>