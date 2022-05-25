<?php
get_header();
?>
<ol class="c-breadcrumb l-inner">
    <li class="c-breadcrumb__item--home"><a></a></li>
    <li class="c-breadcrumb__item">不動産なんでも相談</li>
</ol>
<main class="l-contents">
    <div class="l-contents__inner l-inner">
        <div class="l-contents__left p-left">
            <div class="p-left__header">
                不動産<br>
                なんでも相談
            </div>
            <ul class="p-list">
                <li class="p-list__item">
                    <a class="p-list__label p-list__label--is-current">不動産なんでも相談</a>
                </li>
                <li class="p-list__item">
                    <a class="p-list__label">相続問題・相続対策</a>
                </li>
                <li class="p-list__item">
                    <a class="p-list__label">借地・借家問題</a>
                </li>
                <li class="p-list__item">
                    <a class="p-list__label">その他・諸問題</a>
                </li>
            </ul>

            <?php get_template_part('template-parts/common-sidebar') ?>
        </div>
        <div class="l-contents__right">
            <h1 class="p-headline">物件・土地をお持ちのオーナー様向け相談</h1>
            <div class="p-entry">
                <article class="p-entry__body">
                    <section class="p-entry__body-row">
                        <p>弊社は、不動産コンサルティングのスペシャリストが展開する全国ネットワーク『財産ドック』に加盟しており、弁護士、 公認会計士、不動産鑑定士、税理士、司法書士、一級建築士等とタイアップして、不動産に関する様々な諸問題を解決いたします。</p>
                        <div class="u-flex--justify-center u-mt--5">
                            <img src="<?php echoImgPath('consultation/soudan.jpg'); ?>">
                        </div>
                    </section>
                    <section class="p-entry__body-row">
                        <h2 class="p-entry__body-title">不動産有効活用</h2>
                        <p>●現在所有の土地、建物の収益性を今以上にあげたいと考えておられる方。</p>
                        <p>●賃貸マンションや老人ホーム、グループホームなどの福祉施設の建設をハウスメーカーや建設会社から 勧められているが、収益性や立地が大丈夫なのかお悩みの方</p>
                        <p>
                            ●現在、賃貸マンションやテナントビルを運営しているが、空き室が多くて困っておられる方。<br>
                            また、リフォームやリノベーションをどのように行ったらよいか悩んでおられる方
                        </p>
                    </section>
                    <section class="p-entry__body-row">
                        <h2 class="p-entry__body-title">相続問題・相続対策</h2>
                        <p>●将来の相続が発生したときの節税方法または相続人の間で争いが起こらないかと思案されている方</p>
                        <p>●不動産を所有している運営・管理で共有者と意見が相違して悩んでおられる方</p>
                        <p class="u-mt--4">
                            相続税対策について相続税の仕組みは複雑です。不動産をお持ちの方はより有効に利用することにより、相続税対策を講じることが出来ます。不動産を他の資産に組み替えることにより、効果を上げることも可能です。<br>
                            また、将来、親族間で争わないためにも現在の資産状況を調査し、いずれ発生する相続税額を事前に把握し、相続発生に備えておくことが必要と思われます。 弊社は、相続税対策に精通した税理士とチームを組んで効果の出る方法をアドバイス致します。
                        </p>
                    </section>
                    <section class="p-entry__body-row">
                        <h2 class="p-entry__body-title">借地・借家問題</h2>
                        <p>
                            ●アパートが老朽化したので立て替えたいが、入居者がいるので計画が進まない。<br>
                            現在立ち退き交渉で苦労しておられる方
                        </p>
                        <p>●現在、借家でいずれ地主に借地を売却したい、あるいは、地主から底地を買い取りたいが、売却価格、買取価格を含め、相手方とどのように交渉したらよいか分からない。</p>
                    </section>
                    <section class="p-entry__body-row">
                        <h2 class="p-entry__body-title">その他・諸問題</h2>
                        <p>
                            ●親族間や友人間で不動産を売買したいが、価格をいくらに設定したらよいか分からない。<br>
                            また、きちんとした契約書を作成して、後々もめないようにトラブルを回避したい。
                        </p>
                        <p>
                            ●遠隔地に不動産を所有しており、管理が煩わしい。売却を考えているがどの不動産屋さんに声をかけて良いのか分からない。
                        </p>
                    </section>
                    <section class="p-entry__body-row">
                        <h2 class="p-entry__body-title">ご相談・お問い合わせ</h2>
                        <?php echo do_shortcode('[mwform_formkey key="47"]') ?>
                    </section>
                </article>
            </div>
        </div>
    </div>
</main>



<?php
get_footer()
?>
