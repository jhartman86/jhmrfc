<div class="photowall-image-links">
    <?php foreach((array)$fileListResults AS $fileObj){ if( is_object($fileObj) ){
        $imgPath = $fileObj->getThumbnailURL('file_manager_detail');
        $pageObj = Page::getByID($fileObj->getAttribute('link'));
        $link = '';
        if( is_object($pageObj) && $pageObj->getCollectionID() >= 1 ){
            $link = sprintf('href="%s"', $pageObj->getCollectionPath());
        }
        ?>
        <a class="item" <?php echo $link; ?> style="background-image:url('<?php echo $imgPath; ?>');">
            <img src="<?php echo $imgPath; ?>" />
            <div class="overlay">
                <div class="tabular">
                    <div class="cellular">
                        <span><?php echo $fileObj->getTitle(); ?></span>
                    </div>
                </div>
            </div>
        </a>
    <?php } } ?>
</div>