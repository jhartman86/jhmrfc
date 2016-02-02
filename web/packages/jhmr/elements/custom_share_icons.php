<?php
$pageURL  = BASE_URL . Page::getCurrentPage()->getCollectionPath();
$pageName = Page::getCurrentPage()->getCollectionName();
?>
<div class="share-icons">
    <span>Share on</span>
    <a share-on data-width="450" data-height="200" class="icon-circle-facebook share" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $pageURL; ?>&title=<?php echo $pageName; ?>"></a>
    <a share-on data-width="450" data-height="275" class="icon-circle-twitter share" target="_blank" href="http://twitter.com/intent/tweet?status=<?php echo $pageName; ?>+<?php echo $pageURL; ?>"></a>
    <a share-on data-width="500" data-height="500" class="icon-circle-google-plus share" target="_blank" href="https://plus.google.com/share?url=<?php echo $pageURL; ?>"></a>
    <a class="icon-circle-mail share" href="mailto:?subject=<?php echo rawurlencode('Shared From Center for the Arts') ?>&body=<?php echo rawurlencode($pageURL); ?>"></a>
</div>