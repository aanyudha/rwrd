<?php if (authCheck()): ?>
<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Gift Cart</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <!-- Cart submit form -->
		<form action="results.php" method="POST"> 
			<!-- SmartCart element -->
			<div id="smartcart"></div>
		</form>
  </div>
</div>
<div class="offcanvas offcanvas-end w-15 h-15" data-bs-scroll="true"  tabindex="-1" id="offcanvasWithBothOptions2" aria-labelledby="offcanvasWithBothOptionsLabel2">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel2">Gift Details</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
	<?php echo $id = inputPost('id'); ?>
  </div>
</div>
<?php endif; ?>