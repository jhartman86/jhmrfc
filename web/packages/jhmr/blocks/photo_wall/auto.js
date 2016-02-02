function _photoWallHandler( opts ){

    var $container              = $('#photoWall'),
        $sourceSelector         = $('[name="fileSource"]', $container),
        $sourceControls         = $('[data-source-method]', $container),
        $fileSetSelector        = $('[name="fileSetID"]', $container),
        $chosenFiles            = $('[chosen-files]', $container),
        $chosenFilesPaneCustom  = $chosenFiles.filter('[data-source-method="'+opts.sourceMethod.custom+'"]'),
        $chosenFilesPaneFileSet = $chosenFiles.filter('[data-source-method="'+opts.sourceMethod.fileSet+'"]');

    /**
     * Make the custom files area sortable
     */
    $chosenFilesPaneCustom.sortable({
        items: '.node',
        cursor: 'move',
        containment: 'parent',
        tolerance: 'pointer'
    });

    /**
     * When adding a file via custom method
     * @param data
     * @private
     */
    function _onCustomFileChosen( data ){
        for( var i = 0, len = data.fID.length; i < len; i++ ){
            ConcreteFileManager.getFileDetails(data.fID[i], function( resp ){
                var fileObj     = resp.files[0],
                    $inMemImg   = $(fileObj.resultsThumbnailImg),
                    thumbPath   = $inMemImg.attr('src');

                $chosenFilesPaneCustom.append($('<div />', {
                    'class' : 'node',
                    'style' : 'background-image:url('+thumbPath+')',
                    'html'  : '<a class="remover">&#x2715;</a><input name="fileID[]" type="hidden" value="'+fileObj.fID+'" />'
                })).sortable('refresh');
            });
        }
    }

    /**
     * Trigger add file dialog
     */
    $container.on('click', '[add-file]', function(){
        ConcreteFileManager.launchDialog( _onCustomFileChosen, {
            multipleSelection:true
        });
    });

    /**
     * When source method selector changes (we trigger right away on initializing to
     * show the right one!)
     */
    $sourceSelector.on('change', function(){
        $sourceControls.hide().filter('[data-source-method="'+$(this).val()+'"]').show();
    }).trigger('change');


    /**
     * When file set selector changes; trigger loading the preview pane
     */
    $fileSetSelector.on('change', function(){
        $.get(opts.paneSource, {fsID:$(this).val()}, function( _resp ){
            $chosenFilesPaneFileSet.empty().append(_resp);
        },'html');
    }).trigger('change');


    /**
     * Remove a node on the customizable ones
     */
    $chosenFilesPaneCustom.on('click', '.remover', function(){
        if( confirm('Delete Item From PhotoWall?') ){
            $(this).parent('.node').remove();
        }
    });
}