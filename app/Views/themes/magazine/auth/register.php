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
                            <h1 class="page-title"><?= trans("form_register"); ?></h1>
                        </div>
                        <div class="social-login text-center mb-4">
                            <?= view("common/_social_login", ['orText' => trans("or_register_with_email")]); ?>
                        </div>
                        <?= loadView('partials/_messages'); ?>
                        <form action="<?= base_url('register-post-spc'); ?>" method="post" class="needs-validation">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="sys_lang_id" value="<?= $activeLang->id; ?>">

                            <div class="form-group mb-3">
                                <label for="title"><?= trans("select_ttle"); ?><span class="required-asterisk">*</span></label>
                                <select id="title" class="form-control form-input input-account" name="title" required>
                                    <option value=""><?= trans("select_ttle"); ?></option>
                                    <?php if (!empty($ttle)):
                                        foreach ($ttle as $item=>$value): ?>
                                            <option value="<?= $value; ?>"><?= $value; ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="jenis_identitas"><?= trans("select_identype"); ?><span class="required-asterisk">*</span></label>
                                <select id="jenis_identitas" class="form-control form-input input-account" name="jenis_identitas" required>
                                    <option value=""><?= trans("select_identype"); ?></option>
                                    <?php if (!empty($jnsident)):
                                        foreach ($jnsident as $item=>$value): ?>
                                            <option value="<?= $value; ?>"><?= $value; ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="no_identitas"><?= trans("no_identitas_reg"); ?><span class="required-asterisk">*</span></label>
                                <input type="text" id="no_identitas" name="no_identitas" class="form-control form-input input-account" value="<?= old("no_identitas"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="fullname"><?= trans("fullnamedesc"); ?><span class="required-asterisk">*</span></label>
                                <input type="text" id="fullname" name="fullname" class="form-control form-input input-account" value="<?= old("fullname"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="namecard"><?= trans("namecarddesc"); ?><span class="required-asterisk">*</span></label>
                                <input type="text" id="namecard" name="namecard" class="form-control form-input input-account" value="<?= old("namecard"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="dob"><?= trans("dob"); ?><span class="required-asterisk">*</span></label>
                                <input type="date" id="dob" class="form-control form-input input-account" name="dob" value="<?= old("dob"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="mailingaddr"><?= trans("mailingaddr"); ?><span class="required-asterisk">*</span></label>
                                <input type="text" id="mailingaddr" name="mailingaddr" class="form-control form-input input-account" value="<?= old("mailingaddr"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="city"><?= trans("city"); ?><span class="required-asterisk">*</span></label>
                                <input type="text" id="city" name="city" class="form-control form-input input-account" value="<?= old("city"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="province"><?= trans("province"); ?><span class="required-asterisk">*</span></label>
                                <input type="text" id="province" name="province" class="form-control form-input input-account" value="<?= old("province"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="postalcode"><?= trans("postalcode"); ?><span class="required-asterisk">*</span></label>
                                <input type="text" id="postalcode" name="postalcode" class="form-control form-input input-account" value="<?= old("postalcode"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="nationality"><?= trans("select_country"); ?><span class="required-asterisk">*</span></label>
                                <select id="nationality" class="form-control form-input input-account" name="nationality" required>
                                    <option value=""><?= trans("select_country"); ?></option>
                                    <?php if (!empty($nationl)):
                                        foreach ($nationl as $item): ?>
                                            <option value="<?= $item->id_negara; ?>"><?= $item->nama; ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="hometelp"><?= trans("hometelp"); ?></label>
                                <input type="text" id="hometelp" name="hometelp" class="form-control form-input input-account" value="<?= old("hometelp"); ?>" autocomplete="off">
                            </div>

                            <div class="form-group mb-3">
                                <label for="mobilenomer"><?= trans("mobilenomer"); ?></label>
                                <input type="text" id="mobilenomer" name="mobilenomer" class="form-control form-input input-account" value="<?= old("mobilenomer"); ?>" autocomplete="off">
                            </div>

                            <div class="form-group mb-3">
                                <label for="email"><?= trans("email"); ?><span class="required-asterisk">*</span></label>
                                <input type="email" id="email" name="email" class="form-control form-input input-account" value="<?= old("email"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password"><?= trans("password"); ?><span class="required-asterisk">*</span></label>
                                <input type="password" id="password" name="password" class="form-control form-input input-account" value="<?= old("password"); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="confirm_password"><?= trans("confirm_password"); ?><span class="required-asterisk">*</span></label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control form-input input-account" value="<?= old("confirm_password"); ?>" required>
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

.form-group label {
    font-weight: 500;
    margin-bottom: 5px;
    color: #495057;
}

.required-asterisk {
    color: #808080; /* Grey color */
    font-weight: bold;
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
