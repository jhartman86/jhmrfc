<?php defined('C5_EXECUTE') or die("Access Denied.");
$nh = Loader::helper('navigation');
$previousLinkURL = is_object($previousCollection) ? $nh->getLinkToCollection($previousCollection) : '';
$parentLinkURL = is_object($parentCollection) ? $nh->getLinkToCollection($parentCollection) : '';
$nextLinkURL = is_object($nextCollection) ? $nh->getLinkToCollection($nextCollection) : '';
$previousLinkText = is_object($previousCollection) ? $previousCollection->getCollectionName() : '';
$nextLinkText = is_object($nextCollection) ? $nextCollection->getCollectionName() : '';

// Previous article image
if( is_object($previousCollection) ){
    $prevCollectionPageImg = $previousCollection->getAttribute('page_image');
    if( $prevCollectionPageImg instanceof \Concrete\Core\File\File ){
        $prevCollectionImg = $prevCollectionPageImg->getThumbnailURL('event_thumb');
    }
}

// Next article image
if( is_object($nextCollection) ){
    $nextCollectionPageImg = $nextCollection->getAttribute('page_image');
    if( $nextCollectionPageImg instanceof \Concrete\Core\File\File ){
        $nextCollectionImg = $nextCollectionPageImg->getThumbnailURL('event_thumb');
    }
}
?>

<?php if ($previousLinkURL || $nextLinkURL || $parentLinkText): ?>

    <div class="blog-next-previous">
        <a class="article pull-left" href="<?php echo $previousLinkURL ?>" style="background-image:url('<?php echo $prevCollectionImg; ?>');">
            <small>Previous Post</small>
            <span><?php echo $previousLinkText; ?></span>
        </a>
        <a class="article pull-right text-right" href="<?php echo $nextLinkURL; ?>" style="background-image:url('<?php echo $nextCollectionImg; ?>');">
            <small>Next Post</small>
            <span><?php echo $nextLinkText; ?></span>
        </a>
    </div>

<?php endif; ?>
