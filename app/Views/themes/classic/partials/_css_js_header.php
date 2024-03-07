<style>body {<?= getFontFamily($activeFonts, 'primary'); ?>  } .font-1,.post-content .post-summary {<?= getFontFamily($activeFonts, 'secondary'); ?>}.font-text{<?= getFontFamily($activeFonts, 'tertiary'); ?>}.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {<?= getFontFamily($activeFonts, 'secondary'); ?>}.section-mid-title .title {<?= getFontFamily($activeFonts, 'secondary'); ?>}.section .section-content .title {<?= getFontFamily($activeFonts, 'secondary'); ?>}.section .section-head .title {<?= getFontFamily($activeFonts, 'primary'); ?>}.sidebar-widget .widget-head .title {<?= getFontFamily($activeFonts, 'primary'); ?>}.post-content .post-text {<?= getFontFamily($activeFonts, 'tertiary'); ?>}  .top-bar,.news-ticker-title,.section .section-head .title,.sidebar-widget .widget-head,.section-mid-title .title, #comments .comment-section > .nav-tabs > .active > a,.reaction-num-votes, .modal-newsletter .btn {background-color: <?= $activeTheme->block_color; ?>} .section .section-head,.section-mid-title, .comment-section .nav-tabs {border-bottom: 2px solid <?= $activeTheme->block_color; ?>;} .post-content .post-summary h2 {<?= getFontFamily($activeFonts, 'tertiary'); ?>}
a:hover, a:focus, a:active, .btn-link:hover, .btn-link:focus, .btn-link:active, .navbar-inverse .navbar-nav > li > a:hover, .navbar-inverse .navbar-nav .dropdown-menu > li:hover > a, .navbar-inverse .navbar-nav .dropdown-menu > li:focus > a, .navbar-inverse .navbar-nav .dropdown-menu > li.active > a, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:focus, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:hover, .comment-lists li .btn-comment-reply, .comment-lists li .btn-comment-like, .f-random-list li .title a:hover, .link-forget, .captcha-refresh, .nav-footer li a:hover, .mobile-menu-social li a:hover, .mobile-menu-social li a:focus, .post-files .file button, .icon-newsletter, .btn-load-more:hover, .post-next-prev p span, .list-footer-categories li a:hover {color: <?= $activeTheme->theme_color; ?>;}  .navbar-toggle, .navbar-inverse .navbar-toggle, .nav-payout-accounts > li.active > a, .nav-payout-accounts > li.active > a:focus, .nav-payout-accounts > li.active > a:hover, .nav-payout-accounts .active > a, .swal-button--danger, .sidebar-widget .tag-list li a:hover, .spinner > div, .search-form button {background-color: <?= $activeTheme->theme_color; ?> !important;}  .navbar-default .navbar-nav > .active > a::after, .navbar-default .navbar-nav > li > a:hover:after, .navbar-inverse .navbar-nav .active a::after, .poll .result .progress .progress-bar {background-color: <?= $activeTheme->theme_color; ?>;}  .btn-custom {background-color: <?= $activeTheme->theme_color; ?>;border-color: <?= $activeTheme->theme_color; ?>;}  ::selection {background: <?= $activeTheme->theme_color; ?> !important;color: #fff;}  ::-moz-selection {background: <?= $activeTheme->theme_color; ?> !important;color: #fff;}  .navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus, .navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:hover, .navbar-inverse .navbar-nav > .open > a:focus {color: <?= $activeTheme->theme_color; ?> !important;background-color: transparent;}  .navbar-inverse .navbar-nav > li > a:focus, .navbar-inverse .navbar-nav > li > a:hover {background-color: transparent;color: <?= $activeTheme->theme_color; ?>;}  .form-input:focus {border-color: <?= $activeTheme->theme_color; ?>;outline: 0 none;}  .post-content .post-tags .tag-list li a:hover, .profile-buttons ul li a:hover {border-color: <?= $activeTheme->theme_color; ?>;background-color: <?= $activeTheme->theme_color; ?>;}  .auth-form-input:focus, .form-textarea:focus, .custom-checkbox:hover + label:before, .leave-reply .form-control:focus, .page-contact .form-control:focus, .comment-error {border-color: <?= $activeTheme->theme_color; ?>;}  .custom-checkbox:checked + label:before {background: <?= $activeTheme->theme_color; ?>;border-color: <?= $activeTheme->theme_color; ?>;}  .comments .comments-title {border-bottom: 2px solid <?= $activeTheme->theme_color; ?>;}  .comment-loader-container .loader, .sub-comment-loader-container .loader {border-top: 5px solid <?= $activeTheme->theme_color; ?>;}  .newsletter .newsletter-button {background-color: <?= $activeTheme->theme_color; ?>;border: 1px solid <?= $activeTheme->theme_color; ?>;}  .post-author-meta a:hover, .post-item-no-image .caption-video-no-image .title a:hover, .comment-meta .comment-liked, .cookies-warning a {color: <?= $activeTheme->theme_color; ?> !important;}  .video-label, .filters .btn:focus:after, .filters .btn:hover:after, .filters .btn:active:after, .filters .active::after {background: <?= $activeTheme->theme_color; ?>;}  .pagination .active a {border: 1px solid <?= $activeTheme->theme_color; ?> !important;background-color: <?= $activeTheme->theme_color; ?> !important;color: #fff !important;}  .pagination li a:hover, .pagination li a:focus, .pagination li a:active, .custom-checkbox input:checked + .checkbox-icon {background-color: <?= $activeTheme->theme_color; ?>;border: 1px solid <?= $activeTheme->theme_color; ?>;}  .search-form, .dropdown-more {border-top: 3px solid <?= $activeTheme->theme_color; ?>;}.mobile-language-options li .selected, .mobile-language-options li a:hover {color: <?= $activeTheme->theme_color; ?>;border: 1px solid <?= $activeTheme->theme_color; ?>;}@media screen and (max-width: 480px) {.reaction-num-votes {right: 0 !important;}}.post-text iframe{max-width: 100% !important}
<?php if (!empty($adSpaces)):
foreach ($adSpaces as $item):
if (!empty($item->desktop_width) && !empty($item->desktop_height)):
echo '.bn-ds-'.$item->id. '{width: ' . $item->desktop_width . 'px; height: ' . $item->desktop_height . 'px;}';
echo '.bn-mb-'.$item->id. '{width: ' . $item->mobile_width . 'px; height: ' . $item->mobile_height . 'px;}';
endif;
endforeach;
endif; ?></style>
<script>var TrConfig = {baseURL: '<?= base_url(); ?>', csrfTokenName: '<?= csrf_token() ?>', authCheck: <?= authCheck() ? 1 : 0; ?>, sysLangId: '<?= $activeLang->id; ?>', isRecaptchaEnabled: '<?= isRecaptchaEnabled($generalSettings) ? 1 : 0; ?>', textOk: "<?= clrQuotes(trans("ok")); ?>", textCancel: "<?= clrQuotes(trans("cancel")); ?>", textCorrectAnswer : "<?= clrQuotes(trans("correct_answer")); ?>", textWrongAnswer : "<?= clrQuotes(trans("wrong_answer")); ?>"};</script>