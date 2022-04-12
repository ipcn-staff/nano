<?php
get_header();
$kbn = $_GET["kbn"];
$type = $_GET["type"];
$id = $_GET["id"];
$data = apiPost('mansion/show', ['id' => $id]);
?>
<ol class="c-breadcrumb l-inner">
    <li class="c-breadcrumb__item--home"><a></a></li>
    <li class="c-breadcrumb__item">売買物件情報</li>
    <li class="c-breadcrumb__item">マンション</li>
</ol>
<main class="l-contents">
    <div class="l-contents__inner l-inner">
        <div class="l-contents__left p-left">
            <div class="p-left__header">
                物件売買情報
            </div>
            <ul class="p-list">
                <li class="p-list__item">
                    <a class="p-list__label p-list__label--is-current">マンション</a>
                </li>
                <li class="p-list__item">
                    <a class="p-list__label">土地</a>
                </li>
                <li class="p-list__item">
                    <a class="p-list__label">戸建て</a>
                </li>
                <li class="p-list__item">
                    <a class="p-list__label">事業用</a>
                </li>
            </ul>

            <ul class="p-banner-list--column">
                <li class="p-banner-list__item">
                    <a href="https://www.fujimoto555.com" class="p-banner-list__content">
                        <span class="p-banner-list__label">東大阪Mビル</span>
                    </a>
                    <img class="p-banner-list__img" src="<?php echoImgPath('property-details/left01.jpg'); ?>">
                </li>
            </ul>
        </div>
        <div class="l-contents__right">
            <?php get_template_part('template-parts/property-details/buy-mansion', null, $data) ?>

        </div>
    </div>
</main>



<?php
get_footer()
?>
