<section class="section section-page section-profile">
    <div class="container-fluid">
        <div class="row">
            <div class="profile-header">
                <div class="profile-cover-image"></div>
                <div class="profile-info-container">
                    <div class="container-xl">
                        <div class="tbl-container profile-info">
                            <div class="tbl-cell cell-left">
                                <div class="profile-image">
                                    <img src="<?= getUserAvatar($user->avatar); ?>" alt="<?= esc($user->username); ?>" class="img-fluid" width="152" height="152">
                                </div>
                            </div>
                            <div class="tbl-cell profile-username">
                                <h1 class="username"><?= esc($user->username); ?></h1>
                                <div class="profile-last-seen<?= isUserOnline($user->last_seen) ? ' online' : ''; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="icon-circle" viewBox="0 0 16 16">
                                        <circle cx="8" cy="8" r="8"/>
                                    </svg>
                                    <?= trans("last_seen"); ?>&nbsp;<?= timeAgo($user->last_seen); ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl container-profile">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 pt-2">
                <div class="sticky-lg-top">
                    <div class="row">
                        <div class="col-12">
                            <div class="profile-details">
                                <p class="description"><?= esc($user->about_me); ?></p>
                                <div class="d-flex flex-row mb-4 contact-details">
                                    <div class="item text-muted"><?= trans("member_since"); ?>&nbsp;<?= formatDateFront($user->created_at); ?></div>
                                    <?php if ($generalSettings->show_user_email_on_profile == 1 && $user->show_email_on_profile == 1): ?>
                                        <div class="item text-muted profile-email">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                            </svg>
                                            &nbsp;<?= esc($user->email); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (!empty($user->cover_image)): ?>
    <style>.container-bn-header {display: none !important;}  .profile-cover-image {background-image: url('<?= base_url(($user->cover_image)); ?>');}  .profile-header .profile-info-container {background-color: transparent;background-image: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7) 100%);background-image: -webkit-linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7) 100%);background-image: -moz-linear-gradient(to bottom, transparent, rgb(0, 0, 0, 0.7) 100%);background-image: -owg-linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7) 100%);background-image: -o-linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7) 100%);}</style>
<?php else: ?>
    <style>.container-bn-header {display: none !important;}  .profile-header {height: 160px;}  .profile-header .profile-info .profile-username .username {color: #222;}  .profile-header .profile-last-seen {color: #6c757d;}</style>
<?php endif; ?>