<?php
?>

<section class="u-mt--5">
    <h3>物件概要</h3>
    <dl class="p-details-list">
        <div class="p-details-list__item">
            <dt class="p-details-list__term">番号</dt>
            <dd class="p-details-list__description"><?php echo $args->id ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">マンション名</dt>
            <dd class="p-details-list__description"><?php echo $args->mansion_name ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">所在地</dt>
            <dd class="p-details-list__description"><?php echo $args->district_name.$args->town_name.$args->address ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">価格</dt>
            <dd class="p-details-list__description"><?php echo $args->price.'万円' ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">間取り</dt>
            <dd class="p-details-list__description"><?php echo $args->layout_num.getRoomLayout($args->room_layout) ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">専有面積</dt>
            <dd class="p-details-list__description"><?php echo $args->floor_area.'㎡' ?></dd>
        </div>
    </dl>

    <?php get_template_part('template-parts/property-details/slider', null, ['type' => 'mansion', 'seq' => $args->seq]) ?>

    <h3 class="u-mt--10">物件詳細</h3>
    <dl class="p-details-list">
        <div class="p-details-list__item">
            <dt class="p-details-list__term">交通/駅</dt>
            <dd class="p-details-list__description"><?php echo $args->railroad_name.'/'.$args->station_name ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">徒歩（分）</dt>
            <dd class="p-details-list__description"><?php echo $args->walk.'分' ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">小学校区</dt>
            <dd class="p-details-list__description"><?php echo $args->area_name ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">構造</dt>
            <dd class="p-details-list__description"><?php echo getArchitecture($args->architecture) ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">築年月</dt>
            <dd class="p-details-list__description"><?php echo getEra($args->era).$args->era_year.'年'.$args->era_month.'月' ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">階/階建</dt>
            <dd class="p-details-list__description"><?php echo $args->floor_number.'/'.$args->floor_levels ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">バルコニー向き</dt>
            <dd class="p-details-list__description"><?php echo $args->balcony ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">総戸数</dt>
            <dd class="p-details-list__description"><?php echo $args->door ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">管理費(円)</dt>
            <dd class="p-details-list__description"><?php echo $args->admin_cost ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">修繕積立金(円)</dt>
            <dd class="p-details-list__description"><?php echo $args->fix ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">現状</dt>
            <dd class="p-details-list__description"><?php echo getActualCondition($args->actual_condition) ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">引き渡し</dt>
            <dd class="p-details-list__description"><?php echo getDelivery($args->delivery).$args->delivery_year.$args->delivery_month ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">媒介</dt>
            <dd class="p-details-list__description"><?php echo getAspect($args->aspect) ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">更新月日</dt>
            <dd class="p-details-list__description"><?php echo date('Y-m-d', $args->contract_date); ?></dd>
        </div>
        <div class="p-details-list__item">
            <dt class="p-details-list__term">備考</dt>
            <dd class="p-details-list__description"><?php echo $args->remarks; ?></dd>
        </div>
    </dl>
</section>
