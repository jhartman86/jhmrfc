angular.module("artsy.common").

    directive('imageSlider', ['Tween', 'imagesLoaded',
        function( Tween, imagesLoaded ){

            function _link(scope, $elem, attrs){
                var element     = $elem[0],
                    containerW  = element.clientWidth,
                    elPrev      = element.querySelector('[prev]'),
                    elNext      = element.querySelector('[next]'),
                    track       = element.querySelector('.track'),
                    itemList    = track.querySelectorAll('.item'),
                    itemsLength = itemList.length,
                    active      = element.querySelector('.item.active'),
                    idxActive   = Array.prototype.indexOf.call(itemList, active);

                function next( _callback ){
                    var idxNext     = itemList[idxActive + 1] ? idxActive + 1 : 0,
                        elCurrent   = itemList[idxActive],
                        elNext      = itemList[idxNext],
                        xPosition   = elNext.offsetLeft - ((containerW - elNext.getBoundingClientRect().width)/2);

                    Tween.to(track, 0.5, {x:-xPosition, onComplete:function(){
                        elNext.classList.add('active');
                        elCurrent.classList.remove('active');
                        idxActive = idxNext;
                        if( angular.isFunction(_callback) ){ _callback(); }
                    }});
                }

                function prev( _callback ){
                    var idxPrev = itemList[idxActive - 1] ? idxActive - 1 : itemsLength - 1,
                        elCurrent   = itemList[idxActive],
                        elPrev      = itemList[idxPrev],
                        xPosition   = elPrev.offsetLeft - ((containerW - elPrev.getBoundingClientRect().width)/2);

                    Tween.to(track, 0.5, {x:-xPosition, onComplete:function(){
                        elPrev.classList.add('active');
                        elCurrent.classList.remove('active');
                        idxActive = idxPrev;
                        if( angular.isFunction(_callback) ){ _callback(); }
                    }});
                }

                angular.element(elPrev).on('click', prev);

                angular.element(elNext).on('click', next);

                (function _loop(){
                    setTimeout(function(){
                        next(_loop);
                    }, 4000);
                })();
            }

            return {
                restrict:   'A',
                scope:      true,
                link:       _link
            };
        }
    ]);