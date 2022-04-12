
  </main>
  <footer class="l-footer">
      <article class="l-footer-banner">
          <ul class="p-banner-list l-inner">
              <li class="p-banner-list__item">
                  <a href="https://m-bldg.fujimoto5.co.jp/" class="p-banner-list__content">
                      <span class="p-banner-list__label">東大阪Mビル</span>
                  </a>
                  <img class="p-banner-list__img" src="<?php echoImgPath('top/04.jpg'); ?>">
              </li>
              <li class="p-banner-list__item">
                  <a href="https://www.zaisandoc.jp/" class="p-banner-list__content">
                      <span class="p-banner-list__label">財産ドック</span>
                  </a>
                  <img class="p-banner-list__img" src="<?php echoImgPath('top/05.jpg'); ?>">
              </li>
              <li class="p-banner-list__item">
                  <a href="https://www.fujimoto555.com/" class="p-banner-list__content">
                      <span class="p-banner-list__label">最新物件情報</span>
                  </a>
                  <img class="p-banner-list__img" src="<?php echoImgPath('top/06.jpg'); ?>">
              </li>
          </ul>
      </article>

      <article class="l-footer-nav">
          <div class="l-footer-nav__inner l-inner">
              <section class="l-footer-nav__item">
                  <h2 class="l-footer-nav__title">不動産ブログ</h2>
                  <ul class="l-footer-nav-list">
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">不動産活用</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">収益物件オーナー様向け</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">相続・税金</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">その他全般</a>
                      </li>
                  </ul>
              </section>

              <section class="l-footer-nav__item">
                  <h2 class="l-footer-nav__title">不動産活用相談</h2>
                  <ul class="l-footer-nav-list">
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">不動産有効活用　</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">不動産なんでも相談</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">相続問題・相続対策</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">借地・借家問題</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">その他・諸問題</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">ご相談・お問合せ</a>
                      </li>
                  </ul>
              </section>

              <section class="l-footer-nav__item">
                  <h2 class="l-footer-nav__title"><a>売買物件情報</a></h2>
                  <h2 class="l-footer-nav__title"><a>賃貸物件情報</a></h2>
                  <h2 class="l-footer-nav__title"><a>売買物件情報</a></h2>
                  <h2 class="l-footer-nav__title"><a>物件査定</a></h2>
              </section>

              <section class="l-footer-nav__item">
                  <h2 class="l-footer-nav__title">会社案内</h2>
                  <ul class="l-footer-nav-list">
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">不動産アドバイザー紹介</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">総合医療施設運営管理</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">会社概要</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">アクセス</a>
                      </li>
                      <li class="l-footer-nav-list__item">
                          <a href="<?php echoHomeUrl(''); ?>" class="l-footer-nav-list__label">周辺地域のご紹介</a>
                      </li>
                  </ul>
              </section>
          </div>
      </article>

      <p class="p-copyright">Copyright(c) fujimoto sangyou .All Rights Reserved.</p>
      <div class="l-footer-fixed-banner">
          <div class="l-footer-fixed-banner__inner">
              <p>物件・土地をお持ちのオーナー様向け 収益を上げてリスクを回避する運用なんでも相談</p>
              <a>ご相談・お問合せ</a>
          </div>
          <button class="l-footer-fixed-banner__close-button">×</button>
      </div>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="<?php echoAssetsPath('js/src/global-nav.js'); ?>"></script>
  <script src="<?php echoAssetsPath('js/src/tab.js'); ?>"></script>
  <script src="<?php echoAssetsPath('js/src/slick.min.js'); ?>"></script>
  <script>
      $('#js-property-details-slider').slick({
        autoplay: true,
        slidesToShow: 3,
        dots: false,
        centerMode: true,
        centerPadding: '5%',
        prevArrow:'<div class="prev"><</div>',
        nextArrow:'<div class="next">></div>',
      })
  </script>
</body>
</html>
