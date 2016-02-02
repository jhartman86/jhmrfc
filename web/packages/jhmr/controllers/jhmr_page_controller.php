<?php namespace Concrete\Package\Jhmr\Controller {

    use Config;
    use PageController;
    use Concrete\Package\Jhmr\Controller AS PackageController;

    /**
     * Class JhmrPageController
     * @package Concrete\Package\Jhmr\Controller
     */
    class JhmrPageController extends PageController {

        protected $supportsPageCache            = true;
        protected $_includeThemeAssets          = false;
        protected $_includeSocialTags           = true;
        protected $_includeOpenGraphImageTag    = true;

        /**
         * Base controller's view method.
         * @return void
         */
        public function view(){
            if( $this->_includeThemeAssets === true ){
                $this->attachThemeAssets( $this );
            }

            // Facebook opengraph meta tags
            if( $this->_includeSocialTags   === true ){
                $this->socialMetaTags( $this );
            }

            if( $this->_includeOpenGraphImageTag === true ){
                $this->addHeaderItem(sprintf('<meta property="og:image" content="%s" />', BASE_URL . JHMR_IMAGE_PATH . 'logo-black.svg'));
            }
        }

        /**
         * @return void
         */
        public function on_start(){
            $this->set('documentClasses', join(' ', array(
                $this->pagePermissionObject()->canWrite() ? 'cms-admin' : null,
                $this->getPageObject()->isEditMode() ? 'cms-edit-mode' : null
            )));

            $templateHandle = $this->getPageObject()->getPageTemplateHandle();
            $templateHandle = !empty($templateHandle) ? $templateHandle : $this->getPageObject()->getCollectionHandle();
            $this->set('templateHandle', sprintf('pg-%s', $templateHandle));
        }

        /**
         * Include css/js assets in page output.
         * @param $pageController PageController : Forces the page controller to be injected
         * for the scenario that this method gets called statically to inject
         * these for a different controller (ie. page_not_found)
         * @return void
         */
        public function attachThemeAssets( PageController $pageController ){
            $htmlHelper = \Core::make('helper/html');
            // CSS
            $pageController->addHeaderItem( $htmlHelper->css('core.css', PackageController::PACKAGE_HANDLE) );
            $pageController->addHeaderItem( $htmlHelper->css('app.css', PackageController::PACKAGE_HANDLE) );
            // JS
            $pageController->addFooterItem( $htmlHelper->javascript('core.js', PackageController::PACKAGE_HANDLE) );
            $pageController->addFooterItem( $htmlHelper->javascript('app.js', PackageController::PACKAGE_HANDLE) );
        }

        public function socialMetaTags( PageController $pageController ){
            $siteName   = Config::get('concrete.site');
            $pageName   = $pageController->getPageObject()->getCollectionName();
            $pageURL    = BASE_URL . $pageController->getPageObject()->getCollectionPath();
            $metaDescr  = $pageController->getPageObject()->getAttribute('meta_description');
            $fbAppID    = PackageController::FACEBOOK_APP_ID;

            // Facebook
            $pageController->addHeaderItem(sprintf('<meta property="og:title" content="%s" />', $pageName));
            $pageController->addHeaderItem(sprintf('<meta property="og:site_name" content="%s" />', $siteName));
            $pageController->addHeaderItem(sprintf('<meta property="og:url" content="%s" />', $pageURL));
            if( !empty($metaDescr) ){
                $pageController->addHeaderItem(sprintf('<meta property="og:description" content="%s" />', $metaDescr));
            }
            if( !empty($fbAppID) ){
                $pageController->addHeaderItem(sprintf('<meta property="fb:app_id" content="%s" />', $fbAppID));
            }

            // Twitter
            $pageController->addHeaderItem('<meta name="twitter:card" content="summary" />');
            $pageController->addHeaderItem(sprintf('<meta name="twitter:site" content="@thecenterjh" />'));
        }

        /**
         * Memoize helpers (beware, once loaded its always the same instance).
         * @param string $handle Handle of the helper to load
         * @param bool | Package $pkg Package to get the helper from
         * @return ...Helper class of some sort
         */
        public function getHelper( $handle, $pkg = false ){
            $helper = '_helper_' . preg_replace("/[^a-zA-Z0-9]+/", "", $handle);
            if( $this->{$helper} === null ){
                $this->{$helper} = \Core::make($handle);
            }
            return $this->{$helper};
        }

        /**
         * Get the Concrete5 permission object for the given page.
         * @return Permissions
         */
        protected function pagePermissionObject(){
            if( $this->_pagePermissionObj === null ){
                $this->_pagePermissionObj = new \Concrete\Core\Permission\Checker( \Concrete\Core\Page\Page::getCurrentPage() );
            }
            return $this->_pagePermissionObj;
        }

    }

}