<head data-image-path="<?php echo JHMR_IMAGE_PATH; ?>">
<base href="/" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="no" />
<?php Loader::element('header_required'); // REQUIRED BY C5 // ?>
<?php
    if( ! $this->controller instanceof \Concrete\Package\Jhmr\Controller\JhmrPageController ){
        \Concrete\Package\Jhmr\Controller\JhmrPageController::attachThemeAssets($this->controller);
    }
?>
</head>
