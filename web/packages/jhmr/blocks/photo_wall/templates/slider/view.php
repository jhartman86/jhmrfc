<div image-slider class="covered">
    <?php foreach((array)$fileListResults AS $index => $fileObj){ if( is_object($fileObj) ){
        $imgPath = $fileObj->getThumbnailURL('event_thumb');
        ?>
        <div class="item <?php echo $index == 0 ? 'active' : ''; ?>" style="background-image:url('<?php echo $imgPath; ?>');">
            <div class="descr">
                <h4><?php echo $fileObj->getTitle(); ?></h4>
                <p><?php echo $fileObj->getDescription(); ?></p>
            </div>
        </div>
    <?php } } ?>
    <span prev><i class="icon-angle-left"></i></span>
    <span next><i class="icon-angle-right"></i></span>
</div>