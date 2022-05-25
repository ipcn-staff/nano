const m1 = $('#mv1')
const m2 = $('#mv2')
const m3 = $('#mv3')

const v1  = m1.children('video')[0]
const v2  = m2.children('video')[0]
const v3  = m3.children('video')[0]
let isFirstPlay = false

const firstPlay = () => {
  if (isFirstPlay) {
    return false
  }
  s1()
  isFirstPlay = true
}

v1.addEventListener('canplay', function() {
  firstPlay()
});

v1.addEventListener('error', () => {
  console.log('err')
  firstPlay()
});



const s1 = () => {
  m3.removeClass('p-header-slider__item--show')
  v1.currentTime = 0
  m1.addClass('p-header-slider__item--show')
  v1.play()
  v1.onended = () => {
    s2()
  }
}

const s2 = () => {
  m1.removeClass('p-header-slider__item--show')
  v2.currentTime = 0
  m2.addClass('p-header-slider__item--show')
  v2.play()
  v2.onended = () => {
    s3()
  }
}

const s3 = () => {
  m2.removeClass('p-header-slider__item--show')
  v3.currentTime = 0
  m3.addClass('p-header-slider__item--show')
  v3.play()
  v3.onended = () => {
    s1()
  }
}
