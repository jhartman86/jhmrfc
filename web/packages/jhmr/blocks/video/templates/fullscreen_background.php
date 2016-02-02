<? defined('C5_EXECUTE') or die("Access Denied.");
$posterFileObj = $this->controller->getPosterFileObject();
if( is_object($posterFileObj) ){
    $posterURL = $posterFileObj->getRelativePath();
} ?>

<style type="text/css">
<?php if( Page::getCurrentPage()->isEditMode() ){ ?>
    .video-fs video {max-width:100%;height:auto;max-height:none;width:auto;}
<?php } ?>
</style>

<div revealing class="video-fs" style="background-image:url('<?php echo $posterURL; ?>');">
    <video autoplay loop<?php echo $posterURL ? ' poster="'.$posterURL.'"' : '' ?>>
        <?php if($webmURL): ?>
            <source src="<?php echo $webmURL ?>" type="video/webm" />
        <?php endif; ?>
        <?php if($mp4URL): ?>
            <source src="<?php echo $mp4URL ?>" type="video/mp4" />
        <?php endif; ?>
    </video>
</div>