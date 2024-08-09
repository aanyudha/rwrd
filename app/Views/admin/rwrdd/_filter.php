<div class="row table-filter-container">
    <div class="col-sm-12">
        <form action="<?= $url; ?>" method="get">
		<?= csrf_field(); ?>
            <div class="item-table-filter" style="width: 80px; min-width: 80px;">
                <label><?= trans("show"); ?></label>
                <select name="show" class="form-control">
                    <option value="15" <?= inputGet('show', true) == '15' ? 'selected' : ''; ?>>15</option>
                    <option value="30" <?= inputGet('show', true) == '30' ? 'selected' : ''; ?>>30</option>
                    <option value="60" <?= inputGet('show', true) == '60' ? 'selected' : ''; ?>>60</option>
                    <option value="100" <?= inputGet('show', true) == '100' ? 'selected' : ''; ?>>100</option>
                </select>
            </div>
            <div class="item-table-filter item-table-filter-long">
                <label><?= trans("search"); ?></label>
                <input name="q" class="form-control" placeholder="<?= trans("search") ?>" type="search" value="<?= esc(inputGet('q', true)); ?>">
            </div>
			<?php if ($rwrdType == 'trnType'): ?>
			<div class="item-table-filter">
                <label><?= trans("select_post_type"); ?></label>
                <select id="pointtpe" class="form-control form-input input-account" name="pointtpe">
					<option value=""><?= trans("select_post_type"); ?></option>
					<?php if (!empty($ptaip)):
						foreach ($ptaip as $item=>$value): ?>
					<option value="<?= $value; ?>"><?= $value; ?></option>
					<?php endforeach;
					endif; ?>
                </select>
            </div>
			<div class="item-table-filter">
                <label><?= trans("search_start_date"); ?></label>
                <input name="qdatestart" class="form-control" placeholder="<?= trans("search_start_date") ?>" type="date" value="<?= esc(inputGet('qdatestart', true)); ?>">
            </div>
			<div class="item-table-filter">
                <label><?= trans("search_end_date"); ?></label>
                <input name="qdateend" class="form-control" placeholder="<?= trans("search_end_date") ?>" type="date" value="<?= esc(inputGet('qdateend', true)); ?>">
            </div>
			<?php endif; ?>
            <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
                <label style="display: block">&nbsp;</label>
                <button type="submit" class="btn bg-purple"><?= trans("filter"); ?></button>
            </div>
        </form>
    </div>
</div>