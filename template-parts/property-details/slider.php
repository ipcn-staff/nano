<?php
?>
<div id="js-property-details-slider" class="p-property-details-slider">
    <?php
        for ($i = 0; $i < 8; $i++) {
            $path = $_SERVER['DOCUMENT_ROOT']."/fujimoto5/web/images/$args[type]/t/".sprintf("%08d",$args['seq'])."-".sprintf("%02d",$i).".jpg";
            if(file_exists($path)) {
                $img_path = getSystemImgPath($args['type'],$args['seq'],$i,false);
                echo "<a target='_blank' class='p-property-details-slider__item' href='$img_path'><img class='p-property-details-slider__img' src='$img_path'></a>";
            }
        }
    ?>
</div>
