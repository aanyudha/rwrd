<?= view('common/_json_ld'); ?>
    <footer id="footer">
        <div class="footer-copyright">
          
                       <div align="center">
                            <?= esc($baseSettings->copyright); ?>
                        </div>
            
        </div>
    </footer>
    <a href="#" class="scrollup"><i class="icon-arrow-up"></i></a>
	<!--<li class="scrollup">
		<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCart">Cart</a>
	</li>-->
<?php if (empty(helperGetCookie('cks_warning')) && $baseSettings->cookies_warning): ?>
    <div class="cookies-warning">
        <button type="button" aria-label="close" class="close" onclick="closeCookiesWarning();">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        <div class="text">
            <?= $baseSettings->cookies_warning_text; ?>
        </div>
        <button type="button" class="btn btn-md btn-block btn-custom" aria-label="close" onclick="closeCookiesWarning();"><?= trans("accept_cookies"); ?></button>
    </div>
<?php endif; ?>
    <script src="<?= base_url($assetsPath . '/js/jquery-3.6.1.min.js'); ?> "></script>
	<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?> "></script>
	<script src="<?= base_url('assets/vendor/cart/js/jquery.smartCart.min.js'); ?> "></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartCart/3.0.2/js/jquery.smartCart.min.js"></script>-->
    <script src="<?= base_url($assetsPath . '/js/plugins.js'); ?> "></script>
    <script src="<?= base_url($assetsPath . '/js/main-2.2.js'); ?> "></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    
<?= loadView('partials/_js_footer'); ?>
    <script>$("form[method='post']").append("<input type='hidden' name='sys_lang_id' value='<?= $activeLang->id; ?>'>");</script>
<?php if ($generalSettings->pwa_status == 1): ?>
    <script>if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('<?= base_url('pwa-sw.js');?>').then(function (registration) {
                }, function (err) {
                    console.log('ServiceWorker registration failed: ', err);
                }).catch(function (err) {
                    console.log(err);
                });
            });
        } else {
            console.log('service worker is not supported');
        }</script>
<?php endif; ?>
<?= $generalSettings->adsense_activation_code; ?>
<?= $generalSettings->google_analytics; ?>
<?= $generalSettings->custom_footer_codes; ?>
    </body>
    </html>
<?php if (!empty($isPage404)): exit(); endif; ?>