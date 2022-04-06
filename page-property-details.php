<?php
get_header();
$kbn = $_GET["kbn"];
$type = $_GET["type"];
$id = $_GET["id"];
$data = apiPost('mansion/show', ['id' => $id]);
?>

<article class="l-inner u-mt--10">
    <div class="p-article-header">
        <h2 class="p-article-header__title">物件詳細</h2>
        <p class="p-article-header__sub">お知らせ</p>
    </div>

    <?php get_template_part('template-parts/property-details/buy-mansion', null, $data) ?>
</article>



<?php
get_footer()
?>
