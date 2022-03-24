jQuery(document).ready(function($){

	if ($('.pb-modal-edit-widget.pb-widget-simple_table_3column').size() == 0) return;

	// content_type変更
	$(document).on('change', '.pb-modal-edit-widget.pb-widget-simple_table_3column .pb_repeater_content .content_type', function(){
		var $pb_repeater_content = $(this).closest('.pb_repeater_content');
		$pb_repeater_content.find('[class*=content_type-]').not('.content_type-'+$(this).val()).hide();
		$pb_repeater_content.find('.content_type-'+$(this).val()).slideDown('fast');
	});

	// Saturation
	$(document).on('change', '.pb-widget-simple_table_3column .range', function() {
		$(this).prev('.range-output').find('span').text($(this).val());
	});

	// マーカータイプ
	$(document).on('change', '.pb-widget-simple_table_3column .form-field-marker_type :radio', function(){
		if (this.checked) {
			var $cl = $(this).closest('.pb_repeater_content');
			if (this.value == 'type3') {
				$cl.find('.form-field-marker_type-type3').show();
			} else {
				$cl.find('.form-field-marker_type-type3').hide();
			}
		}
	});
	$('.pb-widget-simple_table_3column .form-field-marker_type :radio:checked').trigger('change');

	// カスタムマーカータイプ
	$(document).on('change', '.pb-widget-simple_table_3column .form-field-custom_marker_type :radio', function(){
		if (this.checked) {
			var $cl = $(this).closest('.pb_repeater_content');
			if (this.value == 'type1') {
				$cl.find('.form-field-marker_text').show();
				$cl.find('.form-field-marker_img').hide();
			} else {
				$cl.find('.form-field-marker_text').hide();
				$cl.find('.form-field-marker_img').show();
			}
		}
	});
	$('.pb-widget-simple_table_3column .form-field-custom_marker_type :radio:checked').trigger('change');

});