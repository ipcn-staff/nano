<?php

/**
 * ページビルダーウィジェット登録
 */
add_page_builder_widget(array(
	'id' => 'pb-widget-simple_table_3column',
	'form' => 'form_page_builder_widget_simple_table_3column',
	'form_rightbar' => 'form_rightbar_page_builder_widget', // 標準右サイドバー
	'save' => 'save_page_builder_repeater',
	'display' => 'display_page_builder_widget_simple_table_3column',
	'title' => __('Three columns sipmle table', 'tcd-w'),
	'description' => __('You can display three columns table.', 'tcd-w'),
	'additional_class' => 'pb-repeater-widget',
	'priority' => 42
));

/**
 * フォーム
 */
function form_page_builder_widget_simple_table_3column($values = array()) {
	// デフォルト値
	$default_values = apply_filters('page_builder_widget_simple_table_3column_default_values', array(
		'widget_index' => '',
		'group_color' => page_builder_get_primary_color('#000000'),
		'group_background_color' => '#f9f9f9',
		'th_color' => page_builder_get_primary_color('#000000'),
		'th_background_color' => '#f9f9f9',
		'repeater' => array()
	), 'form');

	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);

	// リピーター行の並び
	$repeater_indexes = array();
	if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
		$repeater_indexes = $values['repeater_index'];

		// リピーター行データが無ければ削除
		foreach($repeater_indexes as $key => $repeater_index) {
			if (empty($values['repeater'][$repeater_index])) {
				unset($repeater_indexes[$key]);
			}
		}
	} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
		$repeater_indexes = array_keys($values['repeater']);
	}

	// リピーター行 最大インデックス
	$repeater_index_max = 0;
	if ($repeater_indexes) {
		$repeater_indexes = array_map('intval', $repeater_indexes);
		$repeater_index_max = max($repeater_indexes);
	}

	echo '<div class="pb_repeater_wrap" data-rows="'.$repeater_index_max.'">'."\n";
	echo '	<div class="pb_repeater_sortable">'."\n";

	// リピーター行あり
	if ($repeater_indexes) {
		// リピーター行ループ
		foreach($repeater_indexes as $repeater_index) {
			// リピーター行データあり
			if (!empty($values['repeater'][$repeater_index])) {
				// リピーター行出力
				form_page_builder_widget_simple_table_3column_repeater_row(
					array(
						'widget_index' => $values['widget_index'],
						'repeater_index' => $repeater_index
					),
					$values['repeater'][$repeater_index]
				);
			}
		}
	}

	echo '	</div>'."\n"; // .pb_repeater_sortable

	// 項目の追加ボタン
	echo '<div class="form-field">';
	echo '<a href="#" class="pb_add_repeater button-primary">'.__('Add item', 'tcd-w').'</a>';
	echo '</div>'."\n";

	// 追加ボタン時に差し込むHTML
	echo '<div class="add_pb_repeater_clone hidden" style="display:none">'."\n";

	// 行出力
	form_page_builder_widget_simple_table_3column_repeater_row(
		array(
			'widget_index' => $values['widget_index'],
			'repeater_index' => 'pb_repeater_add_index'
		),
		array(
			'repeater_label' => __('New item', 'tcd-w')
		)
	);

	echo '</div>'."\n"; // .add_pb_repeater_clone
?>

<div class="form-field">
	<h4><?php _e('Color for group', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][group_color]" value="<?php echo esc_attr($values['group_color']); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_values['group_color']); ?>" />
</div>

<div class="form-field">
	<h4><?php _e('Background color for group', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][group_background_color]" value="<?php echo esc_attr($values['group_background_color']); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_values['group_background_color']); ?>" />
</div>

<div class="form-field">
	<h4><?php _e('Color for headline', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][th_color]" value="<?php echo esc_attr($values['th_color']); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_values['th_color']); ?>" />
</div>

<div class="form-field">
	<h4><?php _e('Background color for headline', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][th_background_color]" value="<?php echo esc_attr($values['th_background_color']); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_values['th_background_color']); ?>" />
</div>

<?php
	echo '</div>'."\n"; // .pb_repeater_wrap
}

/**
 * リピーター行出力
 */
function form_page_builder_widget_simple_table_3column_repeater_row($values = array(), $row_values = array()) {
	$primary_color = page_builder_get_primary_color('#000000');

	// デフォルト値に入力値をマージ
	$values = array_merge(
		array(
			'widget_index' => '',
			'repeater_index' => ''
		),
		(array) $values
	);

	// 行デフォルト値
	$default_row_values = apply_filters('page_builder_widget_simple_table_3column_default_row_values', array(
		'repeater_label' => '',
		'group' => '',
		'headline' => '',
		'content_type' => 'type1',
		'content_text' => '',
		'website_url' => '',
		'facebook_url' => '',
		'twitter_url' => '',
		'instagram_url' => '',
		'pinterest_url' => '',
		'flickr_url' => '',
		'tumblr_url' => '',
		'youtube_url' => '',
		'contact_url' => '',
		'rss_url' => '',
		'map_address' => '', // Google Maps で使用する住所
		'map_desc' => '', // マップの下に表示する説明文（住所情報等に使用）
		'map_link_label' => __( 'View in Google Maps', 'tcd-w' ), // 「大きな地図で見る」のラベル
		'map_link_label_sp' => __( 'View in Google Maps', 'tcd-w' ), // 「大きな地図で見る」のラベル（スマホ用）
		'map_link' => '', // 「大きな地図で見る」のリンクURL
		'map_link_bg' => '#ffffff', // 「大きな地図で見る」の背景色
		'map_link_color' => '#000000', // 「大きな地図で見る」の文字色
		'map_link_border_color' => '#dddddd', // 「大きな地図で見る」の枠線の色
		'map_link_bg_hover' => '#ffffff', // 「大きな地図で見る」の背景色（ホバー）
		'map_link_color_hover' => '#000000', // 「大きな地図で見る」の文字色（ホバー）
		'map_link_border_color_hover' => '#dddddd', // 「大きな地図で見る」の枠線の色（ホバー）
		'saturation' => -100, // Google Maps の彩度（デフォルトは -100 のモノクロ）
		'marker_type' => 'type1', // マーカーのタイプ（テーマオプション設定、デフォルト、カスタム）
		'custom_marker_type' => 'type1', // カスタムマーカーのタイプ（テキスト、画像）
		'marker_text' => '', // カスタムマーカーのテキスト
		'marker_color' => '#ffffff', // カスタムマーカーの文字色
		'marker_img' => '', // カスタムマーカーの画像
		'marker_bg' => '#000000', // カスタムマーカーの背景色
	));

	// 行デフォルト値に行の値をマージ
	$row_values = array_merge(
		$default_row_values,
		(array) $row_values
	);

	// リピーター表示名
	if (!$row_values['repeater_label'] && $row_values['headline']) {
		$row_values['repeater_label'] = $row_values['headline'];
	} elseif (!$row_values['repeater_label']) {
		$row_values['repeater_label'] = __('New item', 'tcd-w');
	}

	// font family 選択肢
	$font_family_options = array(
		'type1' => __('Meiryo', 'tcd-w'),
		'type2' => __('YuGothic', 'tcd-w'),
		'type3' => __('YuMincho', 'tcd-w'),
	);

	// text align 選択肢
	$text_align_options = array(
		'left' => __('Align left', 'tcd-w'),
		'center' => __('Align center', 'tcd-w'),
		'right' => __('Align right', 'tcd-w')
	);
?>

<div id="pb_simple_table_3column-<?php echo esc_attr($values['widget_index'].'-'.$values['repeater_index']); ?>" class="pb_repeater pb_repeater-<?php echo esc_attr($values['repeater_index']); ?>">
	<input type="hidden" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater_index][]" value="<?php echo esc_attr($values['repeater_index']); ?>" />
	<ul class="pb_repeater_button pb_repeater_cf">
		<li><span class="pb_repeater_move"><?php _e('Move', 'tcd-w'); ?></span></li>
		<li><span class="pb_repeater_delete" data-confirm="<?php _e('Are you sure you want to delete this item?', 'tcd-w'); ?>"><?php _e('Delete', 'tcd-w'); ?></span></li>
	</ul>
	<div class="pb_repeater_content">
		<h3 class="pb_repeater_headline"><span class="index_label"><?php echo esc_attr($row_values['repeater_label']); ?></span><a href="#"><?php _e('Open', 'tcd-w'); ?></a></h3>
		<div class="pb_repeater_field">
			<div class="form-field">
				<h4><?php _e('Group', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][group]" value="<?php echo esc_attr($row_values['group']); ?>" />
				<p class="pb-description"><?php _e( 'When this is empty, span to upper row group.<br>When all row group are empty, not display group column.', 'tcd-w' ); ?></p>
			</div>
			<div class="form-field">
				<h4><?php _e('Headline', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][headline]" value="<?php echo esc_attr($row_values['headline']); ?>" class="index_label" />
			</div>
			<div class="form-field form-field-radio">
				<h4><?php _e('Content type', 'tcd-w'); ?></h4>
				<?php
					$radio_options = array(
						'type1' => __('Text', 'tcd-w'),
						'type2' => __('SNS icon', 'tcd-w'),
						'type3' => __('Google Map', 'tcd-w'),
					);
					$radio_html = array();
					foreach($radio_options as $key => $value) {
						$attr = '';
						if ($row_values['content_type'] == $key) {
							$attr .= ' checked="checked"';
						}
						$radio_html[] = '<label><input type="radio" name="pagebuilder[widget]['.esc_attr($values['widget_index']).'][repeater]['.esc_attr($values['repeater_index']).'][content_type]" value="'.esc_attr($key).'" class="content_type"'.$attr.' />'.esc_html($value).'</label>';
					}
					echo implode("<br>\n\t\t\t\t", $radio_html);
				?>
			</div>
			<div class="form-field content_type-type1"<?php if ($row_values['content_type'] != 'type1') echo ' style="display:none;"'; ?>>
				<h4><?php _e('Text', 'tcd-w'); ?></h4>
				<textarea name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][content_text]" rows="2"><?php echo esc_textarea($row_values['content_text']); ?></textarea>
			</div>
			<div class="content_type-type2"<?php if ($row_values['content_type'] != 'type2') echo ' style="display:none;"'; ?>>
				<div class="form-field">
					<h4><?php _e('Website URL', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][website_url]" value="<?php echo esc_attr($row_values['website_url']); ?>" />
				</div>
				<div class="form-field">
					<h4><?php _e('Facebook URL', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][facebook_url]" value="<?php echo esc_attr($row_values['facebook_url']); ?>" />
				</div>
				<div class="form-field">
					<h4><?php _e('Twitter URL', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][twitter_url]" value="<?php echo esc_attr($row_values['twitter_url']); ?>" />
				</div>
				<div class="form-field">
					<h4><?php _e('Instagram URL', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][instagram_url]" value="<?php echo esc_attr($row_values['instagram_url']); ?>" />
				</div>
				<div class="form-field">
					<h4><?php _e('Pinterest URL', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][pinterest_url]" value="<?php echo esc_attr($row_values['pinterest_url']); ?>" />
				</div>
				<div class="form-field">
					<h4><?php _e('Flickr URL', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][flickr_url]" value="<?php echo esc_attr($row_values['flickr_url']); ?>" />
				</div>
				<div class="form-field">
					<h4><?php _e('Tumblr URL', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][tumblr_url]" value="<?php echo esc_attr($row_values['tumblr_url']); ?>" />
				</div>
				<div class="form-field">
					<h4><?php _e('Youtube URL', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][youtube_url]" value="<?php echo esc_attr($row_values['youtube_url']); ?>" />
				</div>
				<div class="form-field">
					<h4><?php _e('Contact page URL (You can use mailto:)', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][contact_url]" value="<?php echo esc_attr($row_values['contact_url']); ?>" />
				</div>
				<div class="form-field">
					<h4><?php _e('RSS URL', 'tcd-w'); ?></h4>
					<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][rss_url]" value="<?php echo esc_attr($row_values['rss_url']); ?>" />
				</div>
			</div>

			<div class="form-field content_type-type3"<?php if ($row_values['content_type'] != 'type3') echo ' style="display:none;"'; ?>>
				<div class="form-field form-field-map_address">
					<h4><?php _e( 'Map address', 'tcd-w' ); ?></h4>
					<input class="large-text" type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_address]" value="<?php echo esc_attr( $row_values['map_address'] ); ?>">
				</div>

				<div class="form-field form-field-map_desc">
					<h4><?php _e( 'Description', 'tcd-w' ); ?></h4>
					<p class="pb-description"><?php _e( 'The description is displayed before the map.', 'tcd-w' ); ?></p>
					<textarea class="large-text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_desc]"><?php echo esc_textarea( $row_values['map_desc'] ); ?></textarea>
				</div>

				<div class="form-field form-field-map_link">
					<h4><?php _e( '"View in Google Maps" settings', 'tcd-w' ); ?></h4>
					<table style="width: 100%;">
						<tr>
							<td><?php _e( 'Link label', 'tcd-w' ); ?></td>
							<td><input class="large-text" type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_link_label]" value="<?php echo esc_attr( $row_values['map_link_label'] ); ?>"></td>
						</tr>
						<tr>
							<td><?php _e( 'Link label for mobile', 'tcd-w' ); ?></td>
							<td><input class="large-text" type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_link_label_sp]" value="<?php echo esc_attr( $row_values['map_link_label_sp'] ); ?>"></td>
						</tr>
						<tr>
							<td><?php _e( 'Link URL', 'tcd-w' ); ?></td>
							<td><input class="large-text" type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_link]" value="<?php echo esc_attr( $row_values['map_link'] ); ?>"></td>
						</tr>
						<tr>
							<td><?php _e( 'Background color', 'tcd-w' ); ?></td>
							<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_link_bg]" value="<?php echo esc_attr( $row_values['map_link_bg'] ); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_row_values['map_link_bg'] ); ?>"></td>
						</tr>
						<tr>
							<td><?php _e( 'Font color', 'tcd-w' ); ?></td>
							<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_link_color]" value="<?php echo esc_attr( $row_values['map_link_color'] ); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_row_values['map_link_color'] ); ?>"></td>
						</tr>
						<tr>
							<td><?php _e( 'Border color', 'tcd-w' ); ?></td>
							<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_link_border_color]" value="<?php echo esc_attr( $row_values['map_link_border_color'] ); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_row_values['map_link_border_color'] ); ?>"></td>
						</tr>
						<tr>
							<td><?php _e( 'Background color on hover', 'tcd-w' ); ?></td>
							<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_link_bg_hover]" value="<?php echo esc_attr( $row_values['map_link_bg_hover'] ); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_row_values['map_link_bg_hover'] ); ?>"></td>
						</tr>
						<tr>
							<td><?php _e( 'Font color on hover', 'tcd-w' ); ?></td>
							<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_link_color_hover]" value="<?php echo esc_attr( $row_values['map_link_color_hover'] ); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_row_values['map_link_color_hover'] ); ?>"></td>
						</tr>
						<tr>
							<td><?php _e( 'Border color on hover', 'tcd-w' ); ?></td>
							<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][map_link_border_color_hover]" value="<?php echo esc_attr( $row_values['map_link_border_color_hover'] ); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_row_values['map_link_border_color_hover'] ); ?>"></td>
						</tr>
					</table>
				</div>

				<div class="form-field form-field-saturation">
					<h4><?php _e( 'Saturation', 'tcd-w' ); ?></h4>
					<p class="pb-description"><?php _e( 'Please set the saturation of the map. If you set it to -100 the output map is monochrome.', 'tcd-w' ); ?></p>
					<?php // range をスライドした時、現在の彩度がわかるように表示する ?>
					<p class="range-output"><?php _e( 'Current value: ', 'tcd-w' ); ?><span><?php echo esc_attr( $row_values['saturation'] ); ?></span></p>
					<input class="range" type="range" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][saturation]" value="<?php echo esc_attr( $row_values['saturation'] ); ?>" min="-100" max="100" step="10">
				</div>

				<div class="form-field form-field-radio form-field-marker_type">
					<h4><?php _e( 'Marker type', 'tcd-w' ); ?></h4>
					<?php
						$radio_options = array(
							'type1' => __( 'Use settings in Theme Options', 'tcd-w' ),
							'type2' => __( 'Use default marker', 'tcd-w' ),
							'type3' => __( 'Use custom marker', 'tcd-w' )
						);
						$radio_html = array();
						foreach($radio_options as $key => $value) {
							$attr = '';
							if ($row_values['marker_type'] == $key) {
								$attr .= ' checked="checked"';
							}
							$radio_html[] = '<label><input type="radio" name="pagebuilder[widget]['.esc_attr($values['widget_index']).'][repeater]['.esc_attr($values['repeater_index']).'][marker_type]" value="'.esc_attr($key).'"'.$attr.' />'.esc_html($value).'</label>';
						}
						echo implode("<br>\n\t", $radio_html);
					?>
				</div>

				<div class="form-field form-field-marker_type-type3">
					<div class="form-field form-field-radio form-field-custom_marker_type">
						<h4><?php _e( 'Custom marker type', 'tcd-w' ); ?></h4>
						<?php
							$radio_options = array(
								'type1' => __( 'Text', 'tcd-w' ),
								'type2' => __( 'Image', 'tcd-w' )
							);
							$radio_html = array();
							foreach($radio_options as $key => $value) {
								$attr = '';
								if ($row_values['custom_marker_type'] == $key) {
									$attr .= ' checked="checked"';
								}
								$radio_html[] = '<label><input type="radio" name="pagebuilder[widget]['.esc_attr($values['widget_index']).'][repeater]['.esc_attr($values['repeater_index']).'][custom_marker_type]" value="'.esc_attr($key).'"'.$attr.' />'.esc_html($value).'</label>';
							}
							echo implode("<br>\n\t", $radio_html);
						?>
					</div>

					<div class="form-field form-field-marker_text">
						<h4><?php _e( 'Custom marker text', 'tcd-w' ); ?></h4>
						<input type="text" class="large-text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][marker_text]" value="<?php echo esc_attr( $row_values['marker_text'] ); ?>">
						<p><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="pb-input-narrow pb-wp-color-picker" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][marker_color]" data-default-color="<?php echo esc_attr( $default_row_values['marker_color'] ); ?>" value="<?php echo esc_attr( $row_values['marker_color'] ); ?>"></p>
					</div>

					<div class="form-field form-field-marker_img">
						<h4><?php _e( 'Custom marker image', 'tcd-w' ); ?></h4>
						<p class="pb-description"><?php _e('Recommended size: width:60px, height:20px', 'tcd-w'); ?></p>
						<?php
							$input_name = 'pagebuilder[widget]['.$values['widget_index'].'][repeater]['.$values['repeater_index'].'][marker_img]';
							$media_id = $row_values['marker_img'];
							pb_media_form( $input_name, $media_id );
						?>
					</div>

					<div class="form-field form-field-marker_bg">
						<h4><?php _e('Marker style', 'tcd-w'); ?></h4>
						<p><?php _e( 'Background color', 'tcd-w' ); ?> <input type="text" class="pb-input-narrow pb-wp-color-picker" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][marker_bg]" data-default-color="<?php echo esc_attr( $default_row_values['marker_bg'] ); ?>" value="<?php echo esc_attr( $row_values['marker_bg'] ); ?>"></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
}

/**
 * フロント出力
 */
function display_page_builder_widget_simple_table_3column($values = array(), $widget_index = null, $widget = array(), $post_id = null) {
	// リピーター行の並び
	if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
		$repeater_indexes = $values['repeater_index'];
	} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
		$repeater_indexes = array_keys($values['repeater']);
	}

	if (!empty($repeater_indexes)) {
		// リピーター行ループし、行データが無ければ削除
		foreach($repeater_indexes as $key => $repeater_index) {
			if (empty($values['repeater'][$repeater_index])) {
				unset($repeater_indexes[$key]);
			}
		}
	}

	// リピーター行がなければ終了
	if (empty($repeater_indexes)) return;

	// Groupチェック
	$has_group = false;
	foreach($repeater_indexes as $repeater_index) {
		$repeater_values = $values['repeater'][$repeater_index];
		if (!empty($repeater_values['group'])) {
			$has_group = true;
			break;
		}
	}
	if ($has_group) {
		$last_group_index = false;
		foreach($repeater_indexes as $repeater_index) {
			$repeater_values = $values['repeater'][$repeater_index];
			if (!empty($repeater_values['group'])) {
				$last_group_index = $repeater_index;
				$values['repeater'][$last_group_index]['group_rowspan'] = 1;
			} elseif ($last_group_index === false) {
				$last_group_index = $repeater_index;
				$values['repeater'][$last_group_index]['group_rowspan'] = 1;
			} else {
				$values['repeater'][$last_group_index]['group_rowspan']++;
			}
		}
	}

	if ($has_group) {
		echo '<table class="pb_simple_table_3column pb_simple_table_3column-has_group">'."\n";
	} else {
		echo '<table class="pb_simple_table_3column">'."\n";
	}

	$tr_index = 0;
	foreach($repeater_indexes as $repeater_index) {
		$repeater_values = $values['repeater'][$repeater_index];
		$tr_index++;

		echo '<tr class="tr'.$tr_index.'">';

		if (!empty($repeater_values['group_rowspan'])) {
			echo '<th class="pb_simple_table_3column-group"';

			if ($repeater_values['group_rowspan'] > 1) {
				echo ' rowspan="'.esc_attr($repeater_values['group_rowspan']).'"';
			}

			echo '>'.esc_html($repeater_values['group']).'</th>';
		}

		echo '<th class="pb_simple_table_3column-headline">'.esc_html($repeater_values['headline']).'</th>';
		echo '<td>';

		// SNSアイコン表示
		if ($repeater_values['content_type'] == 'type2') {
			$sns_html = '';

			if ($repeater_values['website_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-website"><a href="' . esc_attr( $repeater_values['website_url'] ) . '" target="_blank"><span>website</span></a></li>';
			}
			if ($repeater_values['facebook_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-facebook"><a href="' . esc_attr( $repeater_values['facebook_url'] ) . '" target="_blank"><span>facebook</span></a></li>';
			}
			if ($repeater_values['twitter_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-twitter"><a href="' . esc_attr( $repeater_values['twitter_url'] ) . '" target="_blank"><span>twitter</span></a></li>';
			}
			if ($repeater_values['instagram_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-instagram"><a href="' . esc_attr( $repeater_values['instagram_url'] ) . '" target="_blank"><span>instagram</span></a></li>';
			}
			if ($repeater_values['pinterest_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-pinterest"><a href="' . esc_attr( $repeater_values['pinterest_url'] ) . '" target="_blank"><span>pinterest</span></a></li>';
			}
			if ($repeater_values['flickr_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-flickr"><a href="' . esc_attr( $repeater_values['flickr_url'] ) . '" target="_blank"><span>flickr</span></a></li>';
			}
			if ($repeater_values['tumblr_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-tumblr"><a href="' . esc_attr( $repeater_values['tumblr_url'] ) . '" target="_blank"><span>tumblr</span></a></li>';
			}
			if ($repeater_values['youtube_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-youtube"><a href="' . esc_attr( $repeater_values['youtube_url'] ) . '" target="_blank"><span>youtube</span></a></li>';
			}
			if ($repeater_values['contact_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-contact"><a href="' . esc_attr( $repeater_values['contact_url'] ) . '" target="_blank"><span>contact</span></a></li>';
			}
			if ($repeater_values['rss_url']) {
				$sns_html .= '<li class="pb_simple_table_icon-rss"><a href="' . esc_attr( $repeater_values['rss_url'] ) . '" target="_blank"><span>rss</span></a></li>';
			}

			if ($sns_html) {
				echo '<ul class="pb_simple_table_icons">'.$sns_html.'</ul>';
			}

		// Google map
		} elseif ($repeater_values['content_type'] == 'type3') {
			display_page_builder_widget_simple_table_3column_googlemap($repeater_values, $widget_index.'-'.$repeater_index);

		// テキスト表示
		} else {
			// URL自動リンク
			$pattern = '/(=[\"\'])?https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
			$content_text = preg_replace_callback( $pattern, function( $matches ) {
				// 既にリンク等の場合はそのまま
				if ( isset( $matches[1] ) ) return $matches[0];
				return "<a href=\"{$matches[0]}\" target=\"_blank\">{$matches[0]}</a>";
			}, $repeater_values['content_text'] );
			echo wpautop( trim( $content_text ) );
		}

		echo '</td>';
		echo '</tr>'."\n";
	}

	echo '</table>'."\n";
}

/**
 * googlemap出力
 */
function display_page_builder_widget_simple_table_3column_googlemap($values = array(), $widget_index = null, $widget = array(), $post_id = null) {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	// デフォルト値
	$default_values = apply_filters('page_builder_widget_googlemap_default_values', get_page_builder_widget_googlemap_default_values(), 'form');
	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);

	$use_custom_overlay = 0;
	$saturation = $values['saturation'];
	$marker_text = '';
	$marker_img = '';

	if ( 'type1' === $values['marker_type'] && 'type2' === $dp_options['gmap_marker_type'] ) { // Use custom marker in Theme Options
		$use_custom_overlay = 1;
		if ( 'type1' === $dp_options['gmap_custom_marker_type'] ) { // Use text
			$marker_text = $dp_options['gmap_marker_text'];
		} else { // Use image
			$marker_img = $dp_options['gmap_marker_img'] ? wp_get_attachment_url( $dp_options['gmap_marker_img'] ) : '';
		}
	 } elseif ( 'type3' === $values['marker_type'] ) { // Use custom overlay in googlemap module
		$use_custom_overlay = 1;
		if ( 'type1' === $values['custom_marker_type'] ) {
			$marker_text = $values['marker_text'];
		} else {
			$marker_img = $values['marker_img'] ? wp_get_attachment_url( $values['marker_img'] ) : '';
		}
	}

	// Render HTML
?>
<div class="pb_googlemap clearfix">
<?php if ( $values['map_desc'] ) : ?>
	<div class="pb_simple_table_3column-googlemap_header">
		<div class="pb_googlemap_address"><?php echo wpautop( $values['map_desc'] ); ?></div>
	</div>
<?php endif; ?>
	<div id="js-googlemap-<?php echo esc_attr( $widget_index ); ?>" class="pb_googlemap_embed"></div>
<?php if ( $values['map_link'] ) : ?>
	<div class="pb_simple_table_3column-googlemap_footer">
		<a href="<?php echo esc_url( $values['map_link'] ); ?>" target="_blank" class="pb_googlemap_footer_button"><?php echo is_mobile() ? esc_html( $values['map_link_label_sp'] ) : esc_html( $values['map_link_label'] ); ?></a>
	</div>
<?php endif; ?>
</div>
<script>jQuery(function($) { $(window).load(function() { initMap('js-googlemap-<?php echo esc_js( $widget_index ); ?>', '<?php echo esc_js( $values['map_address'] ); ?>', <?php echo esc_js( $saturation ); ?>, <?php echo esc_js( $use_custom_overlay ); ?>, '<?php echo esc_js( $marker_img ); ?>', '<?php echo esc_js( $marker_text ); ?>');});});</script>
<?php
}


/**
 * 管理画面用js
 */
function page_builder_simple_table_3column_admin_scripts() {
	wp_enqueue_script('page_builder-simple_table_3column', get_template_directory_uri().'/pagebuilder/assets/admin/js/simple_table_3column.js', array('jquery'), PAGE_BUILDER_VERSION, true);
}
add_action('page_builder_admin_styles', 'page_builder_simple_table_3column_admin_scripts', 12);

/**
 * フロント用css
 */
function page_builder_widget_simple_table_3column_styles() {
	wp_enqueue_style('page_builder-simple_table_3column', get_template_directory_uri().'/pagebuilder/assets/css/simple_table_3column.css', false, PAGE_BUILDER_VERSION);
}

function page_builder_widget_simple_table_3column_sctipts_styles($arg = null) {
	// wpフック時には第1引数にWPクラスが渡るので注意
	if ($arg === true) {
		add_action('wp_enqueue_scripts', 'page_builder_widget_simple_table_3column_styles', 11);
	}
	if (is_singular() && is_page_builder() && page_builder_has_widget('pb-widget-simple_table_3column')) {
		add_action('wp_enqueue_scripts', 'page_builder_widget_simple_table_3column_styles', 11);
		add_action('page_builder_css', 'page_builder_widget_simple_table_3column_css');
		page_builder_widget_simple_table_3column_googlemap_sctipts_styles();
	}
}
add_action('wp', 'page_builder_widget_simple_table_3column_sctipts_styles');

function page_builder_widget_simple_table_3column_googlemap_sctipts_styles() {
	if (!function_exists('page_builder_widget_googlemap_scripts')) return;

	// 現記事で使用しているsimple_table_3columnコンテンツデータを取得
	$post_widgets = get_page_builder_post_widgets(get_the_ID(), 'pb-widget-simple_table_3column');
	if ($post_widgets) {
		foreach($post_widgets as $post_widget) {
			$widget_index = $post_widget['widget_index'];
			$values = $post_widget['widget_value'];
			$repeater_values = $post_widget['widget_value'];

			// リピーター行の並び
			if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
				$repeater_indexes = $values['repeater_index'];

				// リピーター行ループし、行データが無ければ削除
				foreach($repeater_indexes as $key => $repeater_index) {
					if (empty($values['repeater'][$repeater_index])) {
						unset($repeater_indexes[$key]);
					}
				}
			} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
				$repeater_indexes = array_keys($values['repeater']);
			}

			// リピーター行がなければ終了
			if (empty($repeater_indexes)) continue;

			foreach($repeater_indexes as $repeater_index) {
				$repeater_values = $values['repeater'][$repeater_index];

				// Google map
				if ($repeater_values['content_type'] == 'type3') {
					add_action('wp_enqueue_scripts', 'page_builder_widget_googlemap_scripts', 11);
					add_action('wp_enqueue_scripts', 'page_builder_widget_googlemap_styles', 11);
					break 2;
				}
			}
		}
	}
}

function page_builder_widget_simple_table_3column_css() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	// 現記事で使用しているsimple_table_3columnコンテンツデータを取得
	$post_widgets = get_page_builder_post_widgets(get_the_ID(), 'pb-widget-simple_table_3column');
	if ($post_widgets) {
		foreach($post_widgets as $post_widget) {
			$values = $post_widget['widget_value'];

			echo $post_widget['css_class'].' .pb_simple_table_3column-group { background-color: '.esc_attr($values['group_background_color']).'; color: '.esc_attr($values['group_color']).'; }'."\n";
			echo $post_widget['css_class'].' .pb_simple_table_3column-headline { background-color: '.esc_attr($values['th_background_color']).'; color: '.esc_attr($values['th_color']).'; }'."\n";

			$widget_index = $post_widget['widget_index'];
			$values = $post_widget['widget_value'];
			$repeater_values = $post_widget['widget_value'];

			// リピーター行の並び
			if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
				$repeater_indexes = $values['repeater_index'];

				// リピーター行ループし、行データが無ければ削除
				foreach($repeater_indexes as $key => $repeater_index) {
					if (empty($values['repeater'][$repeater_index])) {
						unset($repeater_indexes[$key]);
					}
				}
			} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
				$repeater_indexes = array_keys($values['repeater']);
			}

			// リピーター行がなければ終了
			if (empty($repeater_indexes)) continue;

			$tr_index = 0;
			foreach($repeater_indexes as $repeater_index) {
				$repeater_values = $values['repeater'][$repeater_index];
				$tr_index++;

				// Google map
				if ($repeater_values['content_type'] == 'type3') {
					// 「大きな地図で見る」ボタン
					if ( $repeater_values['map_link'] ) {
						echo $post_widget['css_class'] . ' .tr'.$tr_index.' .pb_googlemap_footer_button { background: ' . esc_html( $repeater_values['map_link_bg'] ) . '; border: 1px solid ' . esc_html( $repeater_values['map_link_border_color'] ) . '; color: ' . esc_html( $repeater_values['map_link_color'] ) . '; }' . "\n";
						echo $post_widget['css_class'] . ' .tr'.$tr_index.' .pb_googlemap_footer_button:hover { background: ' . esc_html( $repeater_values['map_link_bg_hover'] ) . '; border: 1px solid ' . esc_html( $repeater_values['map_link_border_color_hover'] ) . '; color: ' . esc_html( $repeater_values['map_link_color_hover'] ) . '; }' . "\n";
					}

					// カスタムマーカー
					if ( ( 'type1' === $repeater_values['marker_type'] && 'type2' === $dp_options['gmap_marker_type'] ) || 'type3' === $repeater_values['marker_type'] ) {
						// Use custom marker in Theme Options
						if ( 'type1' === $repeater_values['marker_type'] && 'type2' === $dp_options['gmap_marker_type'] ) {
							$marker_color = $dp_options['gmap_marker_color'];
							$marker_bg = $dp_options['gmap_marker_bg'];
						// Use custom marker
						} elseif ( 'type3' === $repeater_values['marker_type'] ) {
							$marker_color = $repeater_values['marker_color'];
							$marker_bg = $repeater_values['marker_bg'];
						}

						echo $post_widget['css_class'] . ' .tr'.$tr_index.' .pb_googlemap_custom-overlay-inner { background: ' . esc_html( $marker_bg ) . '; color: ' . esc_html( $marker_color ) . '; }' . "\n";
						echo $post_widget['css_class'] . ' .tr'.$tr_index.' .pb_googlemap_custom-overlay-inner::after { border-color: ' . esc_html( $marker_bg ) . ' transparent transparent transparent; }' . "\n";
					}
				}
			}
		}
	}
}
