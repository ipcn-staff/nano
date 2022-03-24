$('#tab1').show()

$('.p-tab__tabs-item').click(function () {
  $('.p-tab__tabs-label--is-active').removeClass('p-tab__tabs-label--is-active')
  $(this).children('a').addClass('p-tab__tabs-label--is-active')
  $('.p-tab__content').hide()
  $(`#${$(this).data('content')}`).show()
})
