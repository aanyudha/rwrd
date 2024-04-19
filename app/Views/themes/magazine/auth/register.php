<section class="section section-page">
    <div class="container-xl">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                    <li class="breadcrumb-item active"><?= trans("register"); ?></li>
                </ol>
            </nav>
            <div class="col-12">
                <div class="display-flex align-items-center justify-content-center">
                    <div class="section-account">
                        <div class="title">
                            <h1 class="page-title"><?= trans("register"); ?></h1>
                        </div>
                        <div class="social-login">
                            <?= view("common/_social_login", ['orText' => trans("or_register_with_email")]); ?>
                        </div>
                        <?= loadView('partials/_messages'); ?>
                        <form action="<?= base_url('register-post-spc'); ?>" method="post" class="needs-validation">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="sys_lang_id" value="<?= $activeLang->id; ?>">
							<div class="mb-2">
								<select id="title" class="form-control form-input input-account" name="title" required autocomplete="off"> <!--onchange="hideParentCategoryInputs(this.value);">-->
									<option value=""><?= trans("select_ttle"); ?></option>
									<?php if (!empty($ttle)):
										foreach ($ttle as $item=>$value):?>
											<option value="<?= $value; ?>"><?= $value; ?></option>
										<?php endforeach;
									endif; ?>
								</select>
							</div>
							<div class="mb-2">
								<select id="jenis_identitas" class="form-control form-input input-account" name="jenis_identitas" required autocomplete="off"> <!--onchange="hideParentCategoryInputs(this.value);">-->
									<option value=""><?= trans("select_identype"); ?></option>
									<?php if (!empty($jnsident)):
										foreach ($jnsident as $item=>$value):?>
											<option value="<?= $value; ?>"><?= $value; ?></option>
										<?php endforeach;
									endif; ?>
								</select>
							</div>
							<div class="mb-2">
                                <input type="text" name="fullname" class="form-control form-input input-account" placeholder="<?= trans("fullnamedesc"); ?>" value="<?= old("fullname"); ?>" required autocomplete="off">
                            </div>
							<div class="mb-2">
                                <input type="text" name="namecard" class="form-control form-input input-account" placeholder="<?= trans("namecarddesc"); ?>" value="<?= old("namecard"); ?>" required autocomplete="off">
                            </div>
							<div class="mb-2">
								<div class='input-group date' id='datetimepicker'>
								<input type='date' class="form-control form-input input-account" name="dob" placeholder="<?= trans("dob"); ?>" value="<?= old("dob"); ?>" required autocomplete="off">
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
								</span>
								</div>
							</div>
							<div class="mb-2">
								<select id="nationalities" class="form-control form-input input-account" name="nationality" required autocomplete="off"> <!--onchange="hideParentCategoryInputs(this.value);">-->
									<option value=""><?= trans("select_country"); ?></option>
									<?php if (!empty($nationl)):
										foreach ($nationl as $item): ?>
											<option value="<?= $item->id_negara; ?>"><?= $item->nama; ?></option>
										<?php endforeach;
									endif; ?>
								</select>
							</div>
                            <div class="mb-2">
                                <input type="text" name="mailingaddr" class="form-control form-input input-account" placeholder="<?= trans("mailingaddr"); ?>" value="<?= old("mailingaddr"); ?>" required autocomplete="off">
                            </div>
							<div class="mb-2">
                                <input type="text" name="city" class="form-control form-input input-account" placeholder="<?= trans("city"); ?>" value="<?= old("city"); ?>" required autocomplete="off">
                            </div>
							<div class="mb-2">
                                <input type="text" name="province" class="form-control form-input input-account" placeholder="<?= trans("province"); ?>" value="<?= old("province"); ?>" required autocomplete="off">
                            </div>
							<div class="mb-2">
                                <input type="text" name="postalcode" class="form-control form-input input-account" placeholder="<?= trans("postalcode"); ?>" value="<?= old("postalcode"); ?>" required autocomplete="off">
                            </div>
							<div class="mb-2">
                                <input type="text" name="hometelp" class="form-control form-input input-account" placeholder="<?= trans("hometelp"); ?>" value="<?= old("hometelp"); ?>" required autocomplete="off">
                            </div>
							<div class="mb-2">
                                <input type="text" name="mobilenomer" class="form-control form-input input-account" placeholder="<?= trans("mobilenomer"); ?>" value="<?= old("mobilenomer"); ?>" required autocomplete="off">
                            </div>
                            <div class="mb-2">
                                <input type="email" name="email" class="form-control form-input input-account" placeholder="<?= trans("email"); ?>" value="<?= old("email"); ?>" required>
                            </div>
                            <div class="mb-2">
                                <input type="password" name="password" class="form-control form-input input-account" placeholder="<?= trans("password"); ?>" value="<?= old("password"); ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="confirm_password" class="form-control form-input input-account" placeholder="<?= trans("confirm_password"); ?>" value="<?= old("confirm_password"); ?>" required>
                            </div>
                            <div class="<?= isRecaptchaEnabled($generalSettings) ? 'mb-3' : 'mb-4'; ?> form-check">
                                <input type="checkbox" class="form-check-input" name="terms_conditions" value="1" id="checkboxContactTerms" required>
                                <label class="form-check-label" for="checkboxContactTerms">
                                    <?= trans("terms_conditions_exp"); ?>&nbsp;<a href="<?= getPageLinkByDefaultName('terms_conditions', $activeLang->id); ?>" class="font-weight-600" target="_blank"><strong><?= trans("terms_conditions"); ?></strong></a>
                                </label>
                            </div>
                            <?php if (isRecaptchaEnabled($generalSettings)): ?>
                                <div class="mb-4 display-flex justify-content-center">
                                    <?php reCaptcha('generate', $generalSettings); ?>
                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-sm-12 m-t-15">
                                    <button type="submit" class="btn btn-custom btn-account"><?= trans("register"); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>