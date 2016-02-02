<div class="staff-list">
    <?php foreach((array)$fileListResults AS $fileObj): ?>
        <div class="staff-member" style="background-image:url('<?php echo $fileObj->getThumbnailURL('event_thumb'); ?>');">
            <span class="details">
                <span class="name"><?php echo $fileObj->getTitle(); ?></span>
                <span class="descr"><?php echo $fileObj->getDescription(); ?></span>
            </span>
            <?php
                $email = $fileObj->getAttribute('email_address');
                if( !empty($email) ){ ?>
                    <a class="mail" href="mailto:<?php echo $email; ?>"><i class="icon-mail2"></i></a>
            <?php } ?>
        </div>
    <?php endforeach; ?>
</div>