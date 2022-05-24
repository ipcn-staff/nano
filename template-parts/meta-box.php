<?php $dp_options = get_design_plus_options(); ?>

<?php if ( $dp_options['show_author'] || $dp_options['show_category'] || $dp_options['show_tag'] || $dp_options['show_comment'] ) : ?>
<ul class="p-entry__meta-box c-meta-box u-clearfix">
	<?php if ( $dp_options['show_author'] ) : ?><li class="c-meta-box__item c-meta-box__item--author"><?php _e( 'Author', 'tcd-w' ); ?>: <?php the_author_posts_link(); ?></li><?php endif; if ( $dp_options['show_category'] ) : ?><li class="c-meta-box__item c-meta-box__item--category"><?php the_category( ', ' ); ?></li><?php endif; if ( $dp_options['show_tag'] && get_the_tags() ) : ?><li class="c-meta-box__item c-meta-box__item--tag"><?php echo get_the_tag_list( '', ', ', '' ); ?></li><?php endif; if ( $dp_options['show_comment'] ) : ?><li class="c-meta-box__item c-meta-box__item--comment"><?php _e( 'Comments', 'tcd-w' ); ?>: <a href="#comment_headline"><?php echo get_comments_number( '0', '1', '%' ); ?></a></li><?php endif; ?>
</ul>
<?php endif; ?>
