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
                <div class="d-flex align-items-center justify-content-center">
                    <div class="section-account">
                        <div class="title text-center">
                            <h1 class="page-title"><?= trans("register"); ?></h1>
                        </div>
                        <div class="social-login text-center mb-4">
                            <?= view("common/_social_login", ['orText' => trans("or_register_with_email")]); ?>
                        </div>
                        <?= loadView('partials/_messages'); ?>
                        <form action="<?= base_url('register-post-spc'); ?>" method="post" class="needs-validation">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="sys_lang_id" value="<?= $activeLang->id; ?>">
                            <div class="mb-3">
                                <select id="title" class="form-control form-input input-account" name="title" required autocomplete="off">
                                    <option value=""><?= trans("select_ttle"); ?></option>
                                    <?php if (!empty($ttle)):
                                        foreach ($ttle as $item=>$value): ?>
                                            <option value="<?= $value; ?>"><?= $value; ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select id="jenis_identitas" class="form-control form-input input-account" name="jenis_identitas" required autocomplete="off">
                                    <option value=""><?= trans("select_identype"); ?></option>
                                    <?php if (!empty($jnsident)):
                                        foreach ($jnsident as $item=>$value): ?>
                                            <option value="<?= $value; ?>"><?= $value; ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="no_identitas" class="form-control form-input input-account" placeholder="<?= trans("no_identitas_reg"); ?>" value="<?= old("no_identitas"); ?>" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="fullname" class="form-control form-input input-account" placeholder="<?= trans("fullnamedesc"); ?>" value="<?= old("fullname"); ?>" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="namecard" class="form-control form-input input-account" placeholder="<?= trans("namecarddesc"); ?>" value="<?= old("namecard"); ?>" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="date" id="dob" class="form-control form-input input-account" name="dob" value="<?= old("dob"); ?>" required autocomplete="off" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
                                <script>
                                    document.getElementById('dob').type = 'text';
                                    document.getElementById('dob').placeholder = 'DOB';
                                </script>
									 
										 
																				
						   
				  
				 
                            </div>
                            <div class="mb-3">
                                <input type="text" name="mailingaddr" class="form-control form-input input-account" placeholder="<?= trans("mailingaddr"); ?>" value="<?= old("mailingaddr"); ?>" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="city" class="form-control form-input input-account" placeholder="<?= trans("city"); ?>" value="<?= old("city"); ?>" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="province" class="form-control form-input input-account" placeholder="<?= trans("province"); ?>" value="<?= old("province"); ?>" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="postalcode" class="form-control form-input input-account" placeholder="<?= trans("postalcode"); ?>" value="<?= old("postalcode"); ?>" required autocomplete="off">
                            </div>
						    <div class="mb-3">
                                <select id="nationalities" class="form-control form-input input-account" name="nationality" required autocomplete="off">
                                    <option value=""><?= trans("select_country"); ?></option>
                                    <?php if (!empty($nationl)):
                                        foreach ($nationl as $item): ?>
                                            <option value="<?= $item->id_negara; ?>"><?= $item->nama; ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="hometelp" class="form-control form-input input-account" placeholder="<?= trans("hometelp"); ?>" value="<?= old("hometelp"); ?>"   autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="mobilenomer" class="form-control form-input input-account" placeholder="<?= trans("mobilenomer"); ?>" value="<?= old("mobilenomer"); ?>"   autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control form-input input-account" placeholder="<?= trans("email"); ?>" value="<?= old("email"); ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control form-input input-account" placeholder="<?= trans("password"); ?>" value="<?= old("password"); ?>" required>
                            </div>
                            <div class="mb-4">
                                <input type="password" name="confirm_password" class="form-control form-input input-account" placeholder="<?= trans("confirm_password"); ?>" value="<?= old("confirm_password"); ?>" required>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" name="terms_conditions" value="1" id="checkboxContactTerms" required>
                                <label class="form-check-label" for="checkboxContactTerms">
                                    <?= trans("terms_conditions_exp"); ?>&nbsp;<a href="<?= getPageLinkByDefaultName('terms_conditions', $activeLang->id); ?>" class="font-weight-600" target="_blank"><strong><?= trans("terms_conditions"); ?></strong></a>
                                </label>
                            </div>
                            <?php if (isRecaptchaEnabled($generalSettings)): ?>
                                <div class="mb-4 d-flex justify-content-center">
                                    <?php reCaptcha('generate', $generalSettings); ?>
                                </div>
                            <?php endif; ?>
                            <div class="d-grid">
															  
                                <button type="submit" class="btn btn-custom btn-account"><?= trans("register"); ?></button>
									  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.section-page {
    background: #f8f9fa;
    padding: 50px 0;
}

.section-account {
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 600px;
}

.page-title {
    font-size: 24px;
    color: #333333;
}

.form-control {
    height: 45px;
    border-radius: 5px;
    border: 1px solid #ced4da;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 5px rgba(128,189,255,0.5);
}

.btn-custom {
    background: #007bff;
    color: #ffffff;
    border-radius: 5px;
    padding: 10px 15px;
}

.btn-custom:hover {
    background: #0056b3;
}

.breadcrumb-item a {
    color: #007bff;
}

.breadcrumb-item.active {
    color: #6c757d;
}

@media (max-width: 768px) {
    .section-account {
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .section-account {
        padding: 15px;
    }
}
</style>
