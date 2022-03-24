<?php
/*
 * Add a meta box of the archive page settings
 */

$archive_fields = array(
	array(
		'id' => 'archive_title',
		'title' => __( 'Title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'archive_sub',
		'title' => __( 'Sub title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'archive_desc',
		'title' => __( 'Description', 'tcd-w' ),
		'type' => 'textarea',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
);

$archive_args = array(
	'id' => 'archive_meta_box',
	'title' => __( 'Archive page settings', 'tcd-w' ),
	'screen' => array( 'company' ),
	'context' => 'normal',
	'fields' => $archive_fields
);

$archive_meta_box = new TCD_Meta_Box( $archive_args );

/*
 * Add a meta box of the content header
 */
$content_header_fields = array(
	array(
		'id' => 'content_header_title',
		'title' => __( 'Title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'content_header_title_font_size',
		'title' => __( 'Font size of the title', 'tcd-w' ),
    'type' => 'number',
    'min' => 1,
    'step' => 1,
    'default' => 28,
    'unit' => 'px',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'content_header_title_font_size_sp',
		'title' => __( 'Font size of the title (mobile)', 'tcd-w' ),
    'type' => 'number',
    'min' => 1,
    'step' => 1,
    'default' => 20,
    'unit' => 'px',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'content_header_title_color',
		'title' => __( 'Font color of the title', 'tcd-w' ),
    'type' => 'color',
    'default' => '#ffffff',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'content_header_sub',
		'title' => __( 'Sub title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'content_header_sub_font_size',
		'title' => __( 'Font size of the sub title', 'tcd-w' ),
    'type' => 'number',
    'min' => 1,
    'step' => 1,
    'default' => 16,
    'unit' => 'px',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'content_header_sub_font_size_sp',
		'title' => __( 'Font size of the sub title (mobile)', 'tcd-w' ),
    'type' => 'number',
    'min' => 1,
    'step' => 1,
    'default' => 14,
    'unit' => 'px',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'content_header_sub_color',
		'title' => __( 'Font color of the sub title', 'tcd-w' ),
    'type' => 'color',
    'default' => '#ffffff',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	)
);

$content_header_args = array(
	'id' => 'content_header_meta_box',
	'title' => __( 'Content header settings', 'tcd-w' ),
	'screen' => array( 'company' ),
	'context' => 'normal',
	'fields' => $content_header_fields
);

$content_header_meta_box = new TCD_Meta_Box( $content_header_args );
