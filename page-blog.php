<?php
get_header();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 15
);
$the_query = new WP_Query( $args );
?>
<ol class="c-breadcrumb l-inner">
    <li class="c-breadcrumb__item--home"><a></a></li>
    <li class="c-breadcrumb__item">不動産ブログ</li>
</ol>
<main class="l-contents">
    <div class="l-contents__inner l-inner">
        <?php get_template_part('template-parts/post-sidebar' ); ?>
        <div class="l-contents__right">
            <h1 class="p-headline">最新情報</h1>
            <div class="p-archive">
                <article class="p-archive__body">
                    <?php if ( $the_query->have_posts() ) : ?>
                        <ul class="p-archive__list">
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                <li class="p-archive__item">
                                    <a class="p-archive__link" href="<?php the_permalink() ?>">
                                        <time class="p-archive__time"><?php the_time( 'Y.m.d' ); ?></time>
                                        <span class="p-archive__label"><?php the_title(); ?></span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </article>
            </div>
        </div>
    </div>
</main>


<?php
get_footer()
?>
