<?php
get_header();
if (have_posts()) : while (have_posts()) :
the_post();
?>
<ol class="c-breadcrumb l-inner">
    <li class="c-breadcrumb__item--home"><a></a></li>
    <li class="c-breadcrumb__item">不動産ブログ</li>
</ol>
<main class="l-contents">
    <div class="l-contents__inner l-inner">
        <?php get_template_part('template-parts/post-sidebar' ); ?>
        <div class="l-contents__right">
            <h1 class="p-headline"><?php the_title(); ?></h1>
            <time class="p-headline__date"><?php the_time( 'Y.m.d' ); ?></time>
            <div class="p-entry">
                <article class="p-entry__body">
                    <div class="p-entry__body-row">
                        <?php echo the_content(); ?>
                    </div>
                    <p class="c-button u-mt--10">
                        <a href="<?php echoHomeUrl('blog'); ?>" class="c-button__label">記事の一覧</a>
                    </p>
                </article>
            </div>
        </div>
    </div>
</main>

<?php endwhile; endif; ?>

<?php
get_footer()
?>
