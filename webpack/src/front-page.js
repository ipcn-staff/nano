import $ from 'jquery';
import archives from './js/archives';
import header from './js/header';
import headerSlider from './js/header-slider';
import globalNav from './js/global-nav';
import pagetop from './js/pagetop';
import search from './js/search';
import TabList from './js/tab-list';
import youtube from './js/youtube';

archives();
globalNav();
header();
pagetop();

if ($('#js-header__search').length) {
  search();
}

const headerContentLink = document.getElementById('js-header-content__link');
headerContentLink.addEventListener('click', e => {
  e.preventDefault()

  // Use jQuery for Safari
  $('body, html').animate({
    scrollTop: $(e.target.getAttribute('href')).offset().top
  }, 1000);
});

if ($('#js-header-slider').length) {
  headerSlider();
} else if ($('#js-header-video').length) {
  $('.p-header-content').addClass('is-active');
} else {
  $('.p-header-content').addClass('is-active');
  youtube();
}


const newsTabList = document.getElementById('js-news-tab-list');

if (newsTabList) {
  new TabList({
    tabList: newsTabList,
    tabsClassName: 'p-news-tab-list__tabs',
    tabItemClassName: 'p-news-tab-list__tabs-item',
    tabPanelClassName: 'p-news-tab-list__panel'
  });
}

const tabLists = document.querySelectorAll('.p-tab-list');

for (let i = 0, len = tabLists.length; i < len; i++) {
  new TabList({
    tabList: tabLists[i],
    tabsClassName: 'p-tab-list__tab',
    tabItemClassName: 'p-tab-list__tab-item',
    tabPanelClassName: 'p-tab-list__panel'
  });
}
