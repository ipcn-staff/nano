import $ from 'jquery'
import AOS from './js/aos';
import archives from './js/archives';
import dropdown from './js/dropdown';
import globalNav from './js/global-nav';
import header from './js/header';
import pagetop from './js/pagetop';
import search from './js/search';
import TabList from './js/tab-list';

import './css/aos.css';

archives();
dropdown();
globalNav();
header();
pagetop();

if ($('#js-header__search').length) {
  search();
}


AOS.init({
  duration: 600,
  easing: 'ease-in-out',
  once: true
});

const tabLists = document.querySelectorAll('.p-tab-list');

for (let i = 0, len = tabLists.length; i < len; i++) {
  new TabList({
    tabList: tabLists[i],
    tabsClassName: 'p-tab-list__tab',
    tabItemClassName: 'p-tab-list__tab-item',
    tabPanelClassName: 'p-tab-list__panel'
  });
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
