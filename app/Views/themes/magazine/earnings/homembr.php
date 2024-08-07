<section class="section section-page">
    <div class="container-xl">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                    <li class="breadcrumb-item active"><?= trans("earnings"); ?></li>
                </ol>
            </nav>
            <h1 class="page-title"><?= trans("earnings"); ?></h1>
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <?= loadView('earnings/_tabs'); ?>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        <div class="d-flex justify-content-center gap-5 earnings-box-container">
                            <div class="earnings-box justify-content-between">
                                <div class="flex-column">
								<label><?= trans("your_id_member"); ?></label>
								 <strong><?= member()->id_member; ?></strong>
                                </div>
                                <div class="flex-column">
								<?php if(getMmbrTypeNameMtrCmn(getMmbrTypeMtrCommon(esc(member()->id_member))) == 'Blue'){ ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#3498db" class="bi bi-people" viewBox="0 0 16 16">
									  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
								</svg>
								<?php } elseif(getMmbrTypeNameMtrCmn(getMmbrTypeMtrCommon(esc(member()->id_member))) == 'Gold') { ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#FAFAD2" class="bi bi-diamond-fill" viewBox="0 0 16 16">
								  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
								</svg>
								<?php } elseif(getMmbrTypeNameMtrCmn(getMmbrTypeMtrCommon(esc(member()->id_member))) == 'Platinum') { ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#E6E5E3" class="bi bi-diamond-fill" viewBox="0 0 16 16">
								  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
								</svg>
								<?php } else { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-diamond-fill" viewBox="0 0 16 16">
								  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
								</svg>
								<?php } ?>
                                </div>
                            </div>
                            <div class="earnings-box justify-content-between">
                                <div class="flex-column">
								<label><?= trans("balance"); ?></label>
                                    <strong><?= getLastPointMember(); ?> Points</strong>
                                    <label><?= trans("member_type_act"); ?></label>
								<strong><?= getMmbrTypeNameMtrCmn(getMmbrTypeMtrCommon(esc(member()->id_member))); ?> </strong>
                                </div>
								<div class="flex-column">
								<?php if(getMmbrTypeNameMtrCmn(getMmbrTypeMtrCommon(esc(member()->id_member))) == 'Blue'){ ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#3498db" class="bi bi-diamond-fill" viewBox="0 0 16 16">
								  <path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098z"/>
								</svg>
								<?php } elseif(getMmbrTypeNameMtrCmn(getMmbrTypeMtrCommon(esc(member()->id_member))) == 'Gold') { ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#FAFAD2" class="bi bi-diamond-fill" viewBox="0 0 16 16">
								  <path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098z"/>
								</svg>
								<?php } elseif(getMmbrTypeNameMtrCmn(getMmbrTypeMtrCommon(esc(member()->id_member))) == 'Platinum') { ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#E6E5E3" class="bi bi-diamond-fill" viewBox="0 0 16 16">
								  <path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098z"/>
								</svg>
								<?php } else { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-diamond-fill" viewBox="0 0 16 16">
								  <path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098z"/>
								</svg>
								<?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>