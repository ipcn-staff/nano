<!DOCTYPE html>
<html lang="html" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php seo_description(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="l-header">
    <div class="l-header__inner l-inner">
        <div class="l-header__logo">
            <img class="l-header__logo-img" src="<?php echoImgPath('common/logo_pc.jpg'); ?>">
        </div>
        <button id="js-menu-btn" class="c-menu-button"></button>
    </div>
    <nav id="js-header__nav" class="l-header__nav">
        <ul class="l-global-nav l-inner">
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label--current">HOME</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">会社案内</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">事業案内</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">お知らせ</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">実績紹介</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">採用情報</a></li>
            <li class="l-global-nav__item"><a href="" class="l-global-nav__label">ブログ</a></li>
        </ul>
        <button id="js-header__nav-close" class="l-header__nav-close is-active">閉じる</button>
    </nav>
</header>
<main class="l-main">
