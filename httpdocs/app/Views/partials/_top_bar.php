<div class="top-bar">
<div class="container">
<div class="row">
<div class="col-6 col-left">
<?php if (!empty($menuLinks)): ?>
<ul class="navbar-nav">
<?php if (!empty($menuLinks)):
foreach ($menuLinks as $menuLink):
if ($menuLink->location == 'top_menu'):
$itemLink = generateMenuItemUrl($menuLink);
if (!empty($menuLink->page_default_name)):
$itemLink = generateUrl($menuLink->page_default_name);
endif; ?>
<li class="nav-item"><a href="<?= $itemLink; ?>" class="nav-link"><?= esc($menuLink->title); ?></a></li>
<?php endif;
endforeach;
endif; ?>
</ul>
<?php endif; ?>
</div>
<div class="col-6 col-right">
<ul class="navbar-nav">
<?php if ($generalSettings->location_search_header == 1 && countItems($activeCountries) > 0): ?>
<li class="nav-item">
<a href="javascript:void(0)" data-toggle="modal" data-target="#locationModal" class="nav-link btn-modal-location">
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16" fill="#888888" class="mds-svg-icon">
<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
</svg>
<?= !empty($baseVars->defaultLocationInput) ? $baseVars->defaultLocationInput : trans("location"); ?>
</a>
</li>
<?php endif;
if ($paymentSettings->currency_converter == 1 && !empty($currencies)): ?>
<li class="nav-item dropdown top-menu-dropdown">
<a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
<?= getSelectedCurrency()->code; ?>&nbsp;(<?= getSelectedCurrency()->symbol; ?>)&nbsp;<i class="icon-arrow-down"></i>
</a>
<form action="<?= base_url('set-selected-currency-post'); ?>" method="post">
<?= csrf_field(); ?>
<ul class="dropdown-menu">
<?php foreach ($currencies as $currency):
if ($currency->status == 1):?>
<li>
<button type="submit" name="currency" value="<?= $currency->code; ?>"><?= $currency->code; ?>&nbsp;(<?= $currency->symbol; ?>)</button>
</li>
<?php endif;
endforeach; ?>
</ul>
</form>
</li>
<?php endif; ?>
<?php if ($generalSettings->multilingual_system == 1 && countItems($activeLanguages) > 1): ?>
<li class="nav-item dropdown top-menu-dropdown">
<a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
<img src="<?= base_url($activeLang->flag_path); ?>" class="flag"><?= esc($activeLang->name); ?>&nbsp;<i class="icon-arrow-down"></i>
</a>
<ul class="dropdown-menu dropdown-menu-lang">
<?php foreach ($activeLanguages as $language): ?>
<li>
<a href="<?= convertUrlByLanguage($language); ?>" class="dropdown-item <?= $language->id == $activeLang->id ? 'selected' : ''; ?>">
<img src="<?= base_url($language->flag_path); ?>" class="flag"><?= esc($language->name); ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</li>
<?php endif;
if (authCheck()): ?>
<li class="nav-item dropdown profile-dropdown p-r-0">
<a class="nav-link dropdown-toggle a-profile" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false">
<img src="<?= getUserAvatar(user()); ?>" alt="<?= esc(getUsername(user())); ?>">
<?= characterLimiter(esc(getUsername(user())), 15, '..'); ?>
<i class="icon-arrow-down"></i>
<?php if ($baseVars->unreadMessageCount > 0): ?>
<span class="message-notification"><?= $baseVars->unreadMessageCount; ?></span>
<?php endif; ?>
</a>
<ul class="dropdown-menu">
<?php if (hasPermission('admin_panel')): ?>
<li><a href="<?= adminUrl(); ?>"><i class="icon-admin"></i><?= trans("admin_panel"); ?></a></li>
<?php endif;
if (isVendor()): ?>
<li><a href="<?= dashboardUrl(); ?>"><i class="icon-dashboard"></i><?= trans("dashboard"); ?></a></li>
<?php endif; ?>
<li><a href="<?= generateProfileUrl(user()->slug); ?>"><i class="icon-user"></i><?= trans("profile"); ?></a></li>
<?php if (isSaleActive()): ?>
<li>
<a href="<?= generateUrl('orders'); ?>"><i class="icon-shopping-basket"></i><?= trans("orders"); ?></a>
</li>
<?php if ($generalSettings->bidding_system == 1): ?>
<li><a href="<?= generateUrl('quote_requests'); ?>"><i class="icon-price-tag-o"></i><?= trans("quote_requests"); ?></a></li>
<?php endif;
if ($generalSettings->digital_products_system == 1): ?>
<li><a href="<?= generateUrl('downloads'); ?>"><i class="icon-download"></i><?= trans("downloads"); ?></a></li>
<?php endif; ?>
<li>
<a href="<?= generateUrl('my_coupons'); ?>">
<div class="isvg">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-perforated" viewBox="0 0 16 16">
<path d="M4 4.85v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Z"/>
<path d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3h-13ZM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9V4.5Z"/>
</svg>
</div>
<?= trans("my_coupons"); ?>
</a>
</li>
<li>
<a href="<?= generateUrl('refund_requests'); ?>">
<div class="isvg">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="mds-svg-icon">
<path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z"/>
</svg>
</div>
<?= trans("refund"); ?>
</a>
</li>
<?php endif; ?>
<li>
<a href="<?= generateUrl('messages'); ?>"><i class="icon-mail"></i><?= trans("messages"); ?>&nbsp;
<?php if ($baseVars->unreadMessageCount > 0): ?>
(<?= $baseVars->unreadMessageCount; ?>)
<?php endif; ?>
</a>
</li>
<li><a href="<?= generateUrl('settings', 'edit_profile'); ?>"><i class="icon-settings"></i><?= trans("settings"); ?></a></li>
<li>
<form action="<?= base_url('logout'); ?>" method="post" class="form-logout">
<?= csrf_field(); ?>
<input type="hidden" name="back_url" value="<?= getCurrentUrl(); ?>">
<button type="submit" class="btn-logout"><i class="icon-logout"></i>&nbsp;&nbsp;<?= trans("logout"); ?></button>
</form>
</li>
</ul>
</li>
<?php else: ?>
<li class="nav-item">
<a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="nav-link"><?= trans("login"); ?></a>
<span class="auth-sep">/</span>
<a href="<?= generateUrl('register'); ?>" class="nav-link"><?= trans("register"); ?></a>
</li>
<?php endif; ?>
</ul>
</div>
</div>
</div>
</div>