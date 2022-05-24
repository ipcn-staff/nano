<?php
/*
 * Add a meta box of the page header
 */
$ph_fields = array(
	array(
		'id' => 'ph_title',
		'title' => __( 'Title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_title_font_size',
		'title' => __( 'Font size of the title', 'tcd-w' ),
    'type' => 'number',
    'default' => 40,
    'unit' => 'px',
    'min' => 1,
    'step' => 1,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_title_font_size_sp',
		'title' => __( 'Font size of the title for mobile', 'tcd-w' ),
    'type' => 'number',
    'default' => 18,
    'unit' => 'px',
    'min' => 1,
    'step' => 1,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_title_color',
		'title' => __( 'Font color of the title', 'tcd-w' ),
    'type' => 'color',
    'default' => '#ffffff',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  ),
	array(
		'id' => 'ph_sub',
		'title' => __( 'Sub title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_sub_color',
		'title' => __( 'Font color of the sub title', 'tcd-w' ),
    'type' => 'color',
    'default' => '#ffffff',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  ),
	array(
		'id' => 'ph_img',
		'title' => __( 'Background image', 'tcd-w' ),
    'description' => __( 'Recommended image size. Width: 1450px, Height: 450px', 'tcd-w' ),
		'type' => 'image',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_overlay',
		'title' => __( 'Color overlay on the background image', 'tcd-w' ),
    'type' => 'color',
    'default' => '#000000',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_overlay_opacity',
		'title' => __( 'Opacity of the overlay on the background image', 'tcd-w' ),
    'type' => 'number',
    'default' => 0,
    'min' => 0,
    'max' => 1.0,
    'step' => 0.1,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
);

$ph_args = array(
	'id' => 'ph_meta_box',
	'title' => __( 'Page header settings', 'tcd-w' ),
	'screen' => array( 'page' ),
	'context' => 'normal',
	'fields' => $ph_fields
);

$ph_meta_box = new TCD_Meta_Box( $ph_args );

/*
 * Add a meta box of the catchphrase and the description
 */
$catch_and_desc_fields = array(
	array(
		'id' => 'catch_and_desc_catch',
		'title' => __( 'Catchphrase', 'tcd-w' ),
		'type' => 'textarea',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'catch_and_desc_catch_font_size',
		'title' => __( 'Font size of the catchphrase', 'tcd-w' ),
    'type' => 'number',
    'default' => 38,
    'unit' => 'px',
    'min' => 1,
    'step' => 1,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'catch_and_desc_catch_font_size_sp',
		'title' => __( 'Font size of the catchphrase for mobile', 'tcd-w' ),
    'type' => 'number',
    'default' => 26,
    'unit' => 'px',
    'min' => 1,
    'step' => 1,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'catch_and_desc_catch_color',
		'title' => __( 'Font color of the catchphrase', 'tcd-w' ),
    'type' => 'color',
    'default' => '#000000',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'catch_and_desc_desc',
		'title' => __( 'Description', 'tcd-w' ),
		'type' => 'textarea',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'catch_and_desc_desc_font_size',
		'title' => __( 'Font size of the description', 'tcd-w' ),
    'type' => 'number',
    'default' => 16,
    'unit' => 'px',
    'min' => 1,
    'step' => 1,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'catch_and_desc_desc_font_size_sp',
		'title' => __( 'Font size of the description for mobile', 'tcd-w' ),
    'type' => 'number',
    'default' => 14,
    'unit' => 'px',
    'min' => 1,
    'step' => 1,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'catch_and_desc_desc_color',
		'title' => __( 'Font color of the description', 'tcd-w' ),
    'type' => 'color',
    'default' => '#000000',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  )
);

$catch_and_desc_args = array(
	'id' => 'catch_and_desc_meta_box',
	'title' => __( 'Catchphrase and description', 'tcd-w' ),
	'screen' => array( 'page' ),
	'context' => 'normal',
	'fields' => $catch_and_desc_fields
);

$catch_and_desc_meta_box = new TCD_Meta_Box( $catch_and_desc_args );
