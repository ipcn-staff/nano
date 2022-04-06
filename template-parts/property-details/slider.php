<?php
?>
<div class="p-property-details-slider">
    <?php
        for ($i = 0; $i < 10; $i++) {
            $path = $path = $_SERVER['DOCUMENT_ROOT']."/fujimoto5/web/images/$args[type]/t/".sprintf("%08d",$args['seq'])."-".$i.".jpg";
            echo $path;
            if(file_exists($path)) {
                echo 'true';
                //echo "<a class='p-property-details-slider__item' href=''><img class='p-property-details-slider__img' src=''></a>";
            }
            echo '<br>';
        }
    ?>
</div>
