<?php if( Page::getCurrentPage()->isEditMode() ): ?>
    <div style="background:#eaeaea;padding:1rem;border:1px solid #cacaca;text-align:center;">
        <strong>Note:</strong> Block may not display properly in edit mode
    </div>
<?php endif; ?>

<div masonry ng-cloak>
    <?php foreach((array)$fileListResults AS $fileObj): ?>
        <div node>
            <div nest>
                <div nester style="background-image:url(<?php echo $fileObj->getThumbnailURL('event_thumb'); ?>);"></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>