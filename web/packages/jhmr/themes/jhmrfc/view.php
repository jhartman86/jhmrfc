<!DOCTYPE HTML>
<html lang="<?php echo LANGUAGE; ?>" class="<?php echo $documentClasses; ?>">
<?php $this->inc('elements/head.php'); ?>
<body class="<?php echo $templateHandle; ?>" data-handle="<?php echo Page::getCurrentPage()->getCollectionHandle(); ?>">

<div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>">

    <?php $this->inc('elements/nav.php'); ?>

    <main revealing>
        <?php
        $this->inc('elements/header.php', array(
            'expanded'          => true,
            'titleOverride'     => $titleOverride ? !empty($titleOverride) : false
        )); ?>

        <div class="area-main">
            <?php echo $innerContent; ?>
        </div>

        <?php $this->inc('elements/footer.php'); ?>
    </main>
</div>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>