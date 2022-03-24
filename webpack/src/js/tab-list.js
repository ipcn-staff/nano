export default class TabList {
  constructor(args) {
    this.tabList = args.tabList;
    this.tabs = this.tabList.querySelector('.' + args.tabsClassName);
    this.tabItemClassName = args.tabItemClassName;
    this.tabPanelClassName = args.tabPanelClassName;
    this.tabs.addEventListener('click', e => this.handleClick(e));
  }

  handleClick(e) {
    e.preventDefault();

    if ('a' !== e.target.tagName.toLowerCase()) {
      return;
    }

    if (e.target.parentNode.classList.contains('is-active')) {
      return;
    }

    this.toggleTab(e);
    this.togglePanel(e.target.getAttribute('href'));
  }

  toggleTab(e) {
    this.tabList.querySelector('.' + this.tabItemClassName + '.is-active').classList.remove('is-active');
    e.target.parentNode.classList.add('is-active');
  }

  togglePanel(href) {
    this.tabList.querySelector('.' + this.tabPanelClassName + '.is-active').classList.remove('is-active');
    document.querySelector(href).classList.add('is-active');
  }
}
