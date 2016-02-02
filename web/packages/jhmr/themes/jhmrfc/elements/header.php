<header<?php if(!empty($mastheadImageSrc)){echo ' style="background-image:url('.$mastheadImageSrc.');"';} ?>>
    <a class="logo" href="/">
        <?php //$this->inc('../../images/logo-breakup-small.svg'); ?>
    </a>

    <?php if($expanded === true): ?>
        <?php
            $blockTypeNav                                       = BlockType::getByHandle('autonav');
            $blockTypeNav->controller->orderBy                  = 'display_asc';
            $blockTypeNav->controller->displayPages             = 'top';
            $blockTypeNav->controller->displaySubPages          = 'relevant_breadcrumb';
            $blockTypeNav->controller->displaySubPageLevels     = 'all';
            $blockTypeNav->render('templates/breadcrumbs');
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1>
                        <?php
                            if( is_string($titleOverride) ):
                                echo $titleOverride;
                            else:
                                echo Page::getCurrentPage()->getCollectionName();
                            endif;
                        ?>
                    </h1>
                    <p><?php echo Page::getCurrentPage()->getCollectionDescription(); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</header>