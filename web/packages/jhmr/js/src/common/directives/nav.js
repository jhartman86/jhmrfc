/* global Power2 */
angular.module('jhmr.common').

    directive('mainNav', ['$window', 'Tween', function( $window, Tween ){

        function _link( _, $elem ){

            var $html      = angular.element(document.documentElement),
                lastScroll = 0,
                threshold  = $elem[0].offsetTop,
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
            angular.element($elem[0].querySelectorAll('a[href^="#"]')).on('click', function(e){
                e.preventDefault();
                var target = document.querySelector(this.getAttribute('href'));
                if( target ){
                    Tween.to($window, 0.65, {
                        scrollTo:   {y:target.offsetTop},
                        ease:       Power2.easeOut
                    });
                }
                // not applicable unless user is on mobile device, but make sure class is always
                // removed (doesn't do anything if on large device)
                $html.toggleClass('sidebar-nav-open', false);
            });

            // Mobile: trigger nav open class
            angular.element($elem[0].querySelector('a[trigger]')).on('click', function(e){
                $html.toggleClass('sidebar-nav-open');
            });
        }

        return {
            restrict: 'A',
            link:     _link
        };
    }]);