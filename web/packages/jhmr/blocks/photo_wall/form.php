<style type="text/css">
    #photoWall {}
    #photoWall .controls-wrap {position:absolute;top:0;left:0;right:0;width:100%;height:10%;}
    #photoWall .controls-wrap .inner {padding-top:6px;position:relative;width:100%;height:100%;}
    #photoWall .selected-wrap {position:absolute;bottom:0;left:0;right:0;width:100%;height:90%;}
    #photoWall .selected-wrap .inner {text-align:center;padding:15px;background:#f1f1f1;position:relative;width:100%;height:100%;}
    #photoWall .selected-wrap .inner:nth-of-type(2)::before {content:'Cannot add / remove / re-order within a File Set';color:#fff;display:block;position:absolute;top:0;left:0;font-size:15px;padding:5px 9px;background:rgba(0,0,0,0.35);transform:rotate(-90deg) translateX(-100%);transform-origin:0 0;}
    #photoWall .selected-wrap .node {position:relative;display:inline-block;margin:1%;width:10%;padding-bottom:10%;background-size:cover;background-position:50% 50%;box-shadow:0 0 5px rgba(0,0,0,0.35);border-radius:50%;}
    #photoWall .selected-wrap .inner:nth-of-type(1) .node {cursor:move;}
    #photoWall .selected-wrap .node .remover {color:#c2c2c2;display:block;padding:4px;position:absolute;top:0;right:100%;visibility:hidden;opacity:0;line-height:1;font-size:22px;font-weight:900;cursor:pointer;transform:translate(50%,-50%);transition:all 0.25s ease 0.15s;}
    /* transition states */
    #photoWall .selected-wrap .node:hover .remover {right:0;visibility:visible;opacity:1;text-decoration:none;}
</style>

<div id="photoWall">
    <div class="controls-wrap">
        <div class="inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3">
                        <?php echo $form->select('fileSource', \Concrete\Package\Jhmr\Block\PhotoWall\Controller::$fileSourceOptions, $this->controller->fileSource); ?>
                    </div>
                    <div class="col-sm-9" data-source-method="<?php echo \Concrete\Package\Jhmr\Block\PhotoWall\Controller::FILE_SOURCE_CUSTOM; ?>">
                        <button type="button" class="btn btn-default btn-block" add-file>Add Image</button>
                    </div>
                    <div class="col-sm-9" data-source-method="<?php echo \Concrete\Package\Jhmr\Block\PhotoWall\Controller::FILE_SOURCE_SET; ?>">
                        <?php echo $form->select('fileSetID', $availableFileSets, $this->controller->fileSetID); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="selected-wrap">
        <div class="inner" chosen-files data-source-method="<?php echo \Concrete\Package\Jhmr\Block\PhotoWall\Controller::FILE_SOURCE_CUSTOM; ?>">
            <?php if((int)$this->controller->fileSource === \Concrete\Package\Jhmr\Block\PhotoWall\Controller::FILE_SOURCE_CUSTOM):
                foreach($fileListResults AS $file){
                    echo '<div class="node" style="background-image:url(\''.$file->getThumbnailURL('file_manager_listing').'\');"><a class="remover">&#x2715;</a><input name="fileID[]" type="hidden" value="'.$file->getFileID().'" /></div>';
                }
            endif; ?>
        </div>
        <div class="inner" chosen-files data-source-method="<?php echo \Concrete\Package\Jhmr\Block\PhotoWall\Controller::FILE_SOURCE_SET; ?>">
            <?php if((int)$this->controller->fileSource === \Concrete\Package\Jhmr\Block\PhotoWall\Controller::FILE_SOURCE_SET):
                foreach($fileListResults AS $file){
                    echo '<div class="node" style="background-image:url(\''.$file->getThumbnailURL('file_manager_listing').'\');"></div>';
                }
            endif; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        _photoWallHandler({
            sourceMethod: {
                custom: <?php echo \Concrete\Package\Jhmr\Block\PhotoWall\Controller::FILE_SOURCE_CUSTOM; ?>,
                fileSet: <?php echo \Concrete\Package\Jhmr\Block\PhotoWall\Controller::FILE_SOURCE_SET; ?>
            },
            paneSource: '<?php echo Loader::helper('concrete/urls')->getBlockTypeToolsURL($bt); ?>/fileset_pane'
        });
    });
</script>