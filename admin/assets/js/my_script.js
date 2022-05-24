(function($) {

  // archive pager type
  $(document).on('click', '#archive__pager_type_type1', function(event){
    $('#archive_pager_type_type1_area').show();
    $('#archive_pager_type_type2_area').hide();
  });
  $(document).on('click', '#archive__pager_type_type2', function(event){
    $('#archive_pager_type_type2_area').show();
    $('#archive_pager_type_type1_area').hide();
  });

	// Initialize wordpress color picker API
	$('.c-color-picker').wpColorPicker();
  $('.cf-color-picker').wpColorPicker();

  // Sortable
	$('.sortable').sortable({
  	placeholder: 'sortable-placeholder',
	handle: '.theme_option_subbox_headline',
  	//helper: 'clone',
  	forceHelperSize: true,
  	forcePlaceholderSize: true
	});

  // Repeater fields

    // Add and delete repeater fields in the footer bar
    $('.repeater-wrapper')

      .each(function() {

        var nextIndex = $(this).find('.repeater-item').last().index();
        $(this).find('.button-add-row').click(function(e) {
          e.preventDefault();
          var clone = $(this).attr('data-clone');
          var $parent = $(this).closest('.repeater-wrapper');
          if (clone && $parent.length) {
            nextIndex++;
            $parent.find('.repeater').append(clone.replace(/addindex/g, nextIndex));
          }
          $('.cf-color-picker').wpColorPicker();
        });
      })

      .on('click', '.button-delete-row', function(e) {
        e.preventDefault();
        var del = true;
        var confirmMessage = $(this).closest('.repeater-wrapper').attr('data-delete-confirm');
        if (confirmMessage.length) {
          del = confirm(confirmMessage);
        }
        if (del) {
          $(this).closest('.repeater-item').remove();
        }
  	  });

	// Theme options
  if (document.getElementById('my_theme_option')) {

		// CookieTab
  	$('#my_theme_option').cookieTab({
  		tabMenuElm: '#theme_tab',
   		tabPanelElm: '#tab-panel'
  	});

    // Get .theme_option_field
    var themeOptionField = document.getElementsByClassName('theme_option_field');

    for (var i = 0, len = themeOptionField.length; i < len; i++) {

      themeOptionField[i].addEventListener('click', function(e) {

        if (!e.target) return;

        if (e.target.classList.contains('theme_option_subbox_headline')) {
          e.target.parentNode.classList.toggle('active');

        // Toggle HTML to display on clicking radio button
        } else if ('INPUT' === e.target.nodeName && 'radio' === e.target.type) {

          // Get name attribute value inside bracket
          var name = e.target.name.match(/dp_options\[(\w+)\]/)[1];

          // Get value of the radio button
          var value = e.target.value;

          // Get target element
          var target = document.querySelectorAll('[id^="' + name + '"], [class^="' + name + '"]');

          if ('contents_builder' !== name && target.length) {

            // Hide all HTML related to the radio buttons
            target.forEach(function(element) {
              element.style.display = 'none';
            });

            // Display HTML related to checked radio button
            if (document.getElementById(name + '_' + value)) {
              document.getElementById(name + '_' + value).style.display = 'block';
            }
            document.querySelectorAll('.' + name + '_' + value).forEach(function(element) {
              element.style.display = 'block';
            });
          }
        }
      });
    }

    // Change .sub_box headline
	  $('.theme_option_field').on('change keyup', '.change_subbox_headline', function(e) {
      $(this).closest('.sub_box').find('.theme_option_subbox_headline').text($(this).val());
    });

    // Footer bar
    $('.repeater-wrapper').on('change', '.footer-bar-type select', function(e) {
			var subBox = $(this).parents('.sub_box');
			var target = subBox.find('.footer-bar-target');
			var url = subBox.find('.footer-bar-url');
			var number = subBox.find('.footer-bar-number');
			switch (e.target.value) {
			  case 'type1' :
				  target.show();
				  url.show();
				  number.hide();
				  break;
			  case 'type2' :
				  target.hide();
				  url.hide();
				  number.hide();
				  break;
			  case 'type3' :
				  target.hide();
				  url.hide();
				  number.show();
				  break;
			}
		});

	  // Submit by AJAX
    $('#tab-panel').on( 'click', '.ajax_button', function() {

      var $button = $('.button-ml');
      $('#saving_data').show();
      tinyMCE.triggerSave(); // tinymceを利用しているフィールドのデータを保存
      $('#myOptionsForm').ajaxSubmit({
        beforeSend: function() {
          $button.attr('disabled', true); // ボタンを無効化し、二重送信を防止
        },
        complete: function() {
          $button.attr('disabled', false); // ボタンを有効化し、送信を許可
        },
        success: function(){
          $('#saving_data').hide();
          $('#saved_data').html('<div id="saveMessage" class="successModal"></div>');
          $('#saveMessage').append('<p>' + error_messages.success + '</p>').show();
        },
        error: function() {
          $('#saving_data').hide();
          alert(error_messages.error);
        },
        timeout: 10000
      });
      setTimeout(function() {
	  		$('#saveMessage').hide();
	  	}, 3000);

      return false;
    });
	}

  // Logo preview
  if ($('[data-logo-width-input]').length) {
	  var logoPreviewVars = [];

	  // initialize
	  $('[data-logo-width-input]').each(function(i){

		  logoPreviewVars[i] = {};
		  var lpObj = logoPreviewVars[i];

		  lpObj.$preview = $(this);
		  lpObj.$logo = $('<div class="slider_logo_preview-logo">');
		  lpObj.$logoWidth = $($(this).attr('data-logo-width-input'));
		  lpObj.$logoImg = $($(this).attr('data-logo-img'));
		  lpObj.logoImgSrc = null;
		  lpObj.logoImgSrcFirst = null;
		  lpObj.$bgImg = null;
		  lpObj.$Overlay = $('<div class="slider_logo_preview-overlay"></div>');
		  lpObj.$overlayColor = $($(this).attr('data-overlay-color'));
		  lpObj.$overlayOpacity = $($(this).attr('data-overlay-opacity'));

		  lpObj.$preview.html('').append(lpObj.$logo).append(lpObj.$Overlay);
		  lpObj.$preview.closest('.slider_logo_preview-wrapper').hide();

		  if (lpObj.$logoImg && lpObj.$logoImg.length) {
			  lpObj.logoImgSrcFirst = lpObj.$logoImg.attr('src');
		  }

      // Reset width of the logo
		  lpObj.$logo.on('dblclick', function(){
			  lpObj.$logoWidth.val(0);
			  lpObj.$logo.width(lpObj.$logo.attr('data-origin-width'));
		  });
	  });

	  // logo, bg change
	  var logoPreviewChange = function() {

		  for (var i = 0; i < logoPreviewVars.length; i++) {

			  var lpObj = logoPreviewVars[i];
			  var isChange = false;

			  lpObj.$logoImg = $(lpObj.$preview.attr('data-logo-img'));
			  lpObj.$bgImg = null;

			  // logo
			  if (lpObj.$logoImg.length) {

				  if (lpObj.logoImgSrc !== lpObj.$logoImg.attr('src')) {

					  // サイズ取得するため読み込み完了を待つ
					  if (lpObj.$logoImg.prop('complete') || lpObj.$logoImg.prop('readyState') || lpObj.$logoImg.prop('readyState') === 'complete') {
						  isChange = true;

						  lpObj.logoImgSrc = lpObj.$logoImg.attr('src');
						  var img = new Image();
						  img.src = lpObj.logoImgSrc;

						  if (lpObj.$logo.hasClass('ui-resizable')) {
						  	lpObj.$logo.resizable('destroy');
						  }
						  lpObj.$logo.find('img').remove();
						  lpObj.$logo.html('<img src="' + lpObj.logoImgSrc + '" alt="" />').attr('data-origin-width', img.width).append('<div class="slider_logo_preview-logo-border-e"></div><div class="slider_logo_preview-logo-border-n"></div><div class="slider_logo_preview-logo-border-s"></div><div class="slider_logo_preview-logo-border-w"></div></div>');

						  // 初回は既存値
						  if (lpObj.logoImgSrcFirst) {
						  	var logoWidth = parseInt(lpObj.$logoWidth.val(), 10);

						  	lpObj.logoImgSrcFirst = null;
						  	if (logoWidth > 0) {
						  		lpObj.$logo.width(logoWidth);
						  	} else {
						  		lpObj.$logo.width(img.width);
						  	}

						  // 画像変更時はロゴ横幅リセット
						  } else {
						  	lpObj.$logoWidth.val(0);
						  	lpObj.$logo.width(img.width);
						  }

						  // logo resizable
						  lpObj.$logo.resizable({
						  	aspectRatio: true,
						  	distance: 5,
						  	handles: 'all',
						  	maxWidth: 1180,
						  	stop: function(event, ui) {
						  		// lpObj,iは変わっているため使えない
						  		$($(this).closest('[data-logo-width-input]').attr('data-logo-width-input')).val(parseInt(ui.size.width, 10));
						  	}
						  });
					  }
				  }
			  }

			  // overlay
			  lpObj.$Overlay.removeAttr('style');

				var overlayColor = lpObj.$overlayColor.val() || '';
				var overlayOpacity = parseFloat(lpObj.$overlayOpacity.val() || 0);
				if (overlayColor && overlayOpacity > 0) {
					var rgba = [];
					overlayColor = overlayColor.replace('#', '');
					if (overlayColor.length >= 6) {
						rgba.push(parseInt(overlayColor.substring(0,2), 16));
						rgba.push(parseInt(overlayColor.substring(2,4), 16));
						rgba.push(parseInt(overlayColor.substring(4,6), 16));
						rgba.push(overlayOpacity);
						lpObj.$Overlay.css('background-color', 'rgba(' + rgba.join(',') + ')');
					} else if (overlayColor.length >= 3) {
						rgba.push(parseInt(overlayColor.substring(0,1) + overlayColor.substring(0,1), 16));
						rgba.push(parseInt(overlayColor.substring(1,2) + overlayColor.substring(1,2), 16));
						rgba.push(parseInt(overlayColor.substring(2,3) + overlayColor.substring(2,3), 16));
						rgba.push(overlayOpacity);
						lpObj.$Overlay.css('background-color', 'rgba(' + rgba.join(',') + ')');
					}
				}

			  // 画像変更有
			  if (isChange) {

          // 画像スライダー（SP）・動画・YouTube はダミー画像なので背景セットなし
					if (lpObj.logoImgSrc) {
					  lpObj.$preview.closest('.slider_logo_preview-wrapper').show();
					} else {
					  lpObj.$preview.closest('.slider_logo_preview-wrapper').hide();
					}
			  }
		  }
	  };

	  // 画像読み込み完了を待つ必要があるためSetInterval
	  setInterval(logoPreviewChange, 500);

	  // 画像削除ボタンは即時反映可能
	  $('.cfmf-delete-img').on('click.logoPreviewChange', function(){
		  setTimeout(logoPreviewChange, 30);
	  });
  }

})(jQuery);
