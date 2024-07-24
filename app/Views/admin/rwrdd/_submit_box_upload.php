<div class="box">
	<form action="<?= $url; ?>" method="get">
	<?= csrf_field(); ?>
		<div class="box-header with-border">
			<div class="left">
				<h3 class="box-title"><?= trans('submit-box'); ?></h3>
			</div>
		</div>
		<div class="box-body">
				<div class="form-group">
				<button type="submit" class="btn btn-primary pull-right" onclick="allowSubmitForm = true;"><?= trans('btn_submit'); ?></button>
				</div>
		</div>
	</form>
</div>