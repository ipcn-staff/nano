<!DOCTYPE html>
<html lang="html" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php seo_description(); ?>">
    <?php wp_head(); ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="<?php echoAssetsPath('css/slick.min.css'); ?>">
    <link rel="stylesheet" href="<?php echoAssetsPath('css/slick-theme.min.css'); ?>">
</head>
<body <?php body_class(); ?>>
<header class="l-header">
    <div class="l-header__inner l-inner">
        <a href="<?php echoHomeUrl('/'); ?>" class="l-header__logo">
            <img class="l-header__logo-img" src="<?php echoImgPath('common/logo_pc.jpg'); ?>">
        </a>
        <div class="l-header-right">
            <div class="c-tel-bnr">
                <a href="tel:066-762-0005" class="c-tel-bnr__item">
                    <span class="c-tel-bnr__icon material-icons-outlined">call</span>
                    <span class="c-tel-bnr__number">06-6762-0005</span>
                </a>
                <div class="c-tel-bnr__item u-mt--2">
                    <span class="c-tel-bnr__text">営業時間/9:00～18:30 ※ご来店の際は事前にご連絡下さい</span>
                </div>
            </div>
        </div>
        <button id="js-menu-btn" class="c-menu-button"></button>
    </div>
    <nav id="js-header__nav" class="l-header__nav">
        <ul class="l-global-nav l-inner">
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">不動産ブログ</a></li>
            <li class="l-global-nav__item"><a href="<?php echoHomeUrl('consultation'); ?>" class="l-global-nav__label">不動産活用相談</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">買う</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">借りる</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">売る</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">貸す</a></li>
            <li class="l-global-nav__item"><a href="<?php echoHomeUrl('compan'); ?>" class="l-global-nav__label">会社案内</a></li>
        </ul>
        <button id="js-header__nav-close" class="l-header__nav-close is-active">閉じる</button>
    </nav>
</header>
<main class="l-main">
