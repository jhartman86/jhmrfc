/* global Power2 */
angular.module('jhmr.common').

    directive('nav', ['$window', 'Tween', function( $window, Tween ){

        function _link( scope, $elem, attrs ){

            var $html      = angular.element(document.documentElement),
                lastScroll = 0,
                threshold  = $elem[0].offsetTop, //$elem[0].getBoundingClientRect().top,
                isDocked   = false;

            // Dock handler
            Tween.ticker.addEventListener('tick', function(){
                if( lastScroll !== window.pageYOffset ){
                    lastScroll = window.pageYOffset;
                    if( (lastScroll > threshold) !== isDocked ){
                        isDocked = !isDocked;
                        $html.toggleClass('nav-docked', isDocked);
                    }
                }
            });

            // Navigate to handler
            angular.element($elem[0].querySelectorAll('a[href]')).on('click', function( e ){
                e.preventDefault();

                var target = document.querySelector(this.getAttribute('href'));
                if( target ){
                    Tween.to($window, 0.65, {
                        scrollTo:   {y:target.offsetTop},
                        ease:       Power2.easeOut
                    });
                }
            });
        }

        return {
            restrict: 'E',
            link:     _link
        };
    }]);