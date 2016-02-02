<?php namespace Concrete\Package\Jhmr {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    /** @link https://github.com/concrete5/concrete5-5.7.0/blob/develop/web/concrete/config/app.php#L10-L90 Aliases */
    use Concrete\Core\User\User;
    use Loader; /** @see \Concrete\Core\Legacy\Loader */
    use Router; /** @see \Concrete\Core\Routing\Router */
    use Route; /** @see \Concrete\Core\Support\Facade\Route */
    use Package; /** @see \Concrete\Core\Package\Package */
    use BlockType; /** @see \Concrete\Core\Block\BlockType\BlockType */
    use BlockTypeSet; /** @see \Concrete\Core\Block\BlockType\Set */
    use Page;
    use PageType; /** @see \Concrete\Core\Page\Type\Type */
    use PageTemplate; /** @see \Concrete\Core\Page\Template */
    use PageTheme; /** @see \Concrete\Core\Page\Theme\Theme */
    use FileSet; /** @see \Concrete\Core\File\Set\Set */
    use CollectionAttributeKey; /** @see \Concrete\Core\Attribute\Key\CollectionKey */
    use UserAttributeKey; /** @see \Concrete\Core\Attribute\Key\UserKey */
    use FileAttributeKey; /** @see \Concrete\Core\Attribute\Key\FileKey */
    use Group; /** @see \Concrete\Core\User\Group\Group */
    use GroupSet; /** @see \Concrete\Core\User\Group\GroupSet */
    use Stack; /** @see \Concrete\Core\Page\Stack\Stack */
    use Concrete\Core\Page\Type\PublishTarget\Type\Type as PublishTargetType;
    use SinglePage;

    class Controller extends Package {

        const PACKAGE_HANDLE                    = 'jhmr';
        const AREA_MAIN                         = 'Main';
        const FACEBOOK_APP_ID                   = '';

        protected $pkgHandle 			        = self::PACKAGE_HANDLE;
        protected $appVersionRequired 	        = '5.7.3.2';
        protected $pkgVersion 			        = '0.01';


        /**
         * @return string
         */
        public function getPackageName(){
            return t('JHMR');
        }


        /**
         * @return string
         */
        public function getPackageDescription() {
            return t('Jackson Hole Moose Rugby Club');
        }


        /**
         * Run hooks high up in the load chain.
         * @return void
         */
        public function on_start(){
            define('JHMR_IMAGE_PATH', DIR_REL . '/packages/' . $this->pkgHandle . '/images/');

            // Email List Signup
            Route::register(
                Router::route(array('email_list_signup', $this->pkgHandle)),
                '\Concrete\Package\Jhmr\Controller\EmailListSignup::complete'
            );
        }


        /**
         * Proxy to the parent uninstall method
         * @return void
         */
        public function uninstall() {
            parent::uninstall();

            try {
                // delete database tables (if applicable)
            }catch(Exception $e){ /* FAIL GRACEFULLY */ }
        }


        /**
         * Run before install or upgrade to ensure dependencies
         * are present.
         * @todo: include package dependency checks
         */
        private function checkDependencies(){

        }


        /**
         * @return void
         */
        public function upgrade(){
            $this->checkDependencies();
            parent::upgrade();
            $this->installAndUpdate();
        }


        /**
         * @return void
         */
        public function install() {
            $this->checkDependencies();
            $this->_packageObj = parent::install();
            $this->installAndUpdate();
        }


        /**
         * Handle all the updating methods.
         * @return void
         */
        private function installAndUpdate(){
            $this->setupAttributeTypes()
                ->setupAttributeTypeAssociations()
                ->setupCollectionAttributes()
                ->setupFileAttributes()
                ->setupUserAttributes()
                ->setupFileSets()
                ->setupStacks()
                ->setupTheme()
                ->setupTemplates()
                ->setupPageTypes()
                ->assignPageTypes()
                ->setupSinglePages()
                ->setupBlockTypeSets()
                ->setupBlocks()
                ->setupThumbnailTypes();
        }


        /**
         * @return Controller
         */
        private function setupAttributeTypes(){
            $atPageSelector = $this->attributeType('page_selector');
            if( !($atPageSelector instanceof \Concrete\Core\Attribute\Type) ){
                \Concrete\Core\Attribute\Type::add('page_selector', t('Page Selector'), $this->packageObject());
                $this->attributeKeyCategory('file')->associateAttributeKeyType( $this->attributeType('page_selector') );
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupAttributeTypeAssociations(){
            return $this;
        }


        /**
         * @return Controller
         */
        private function setupCollectionAttributes(){
            return $this;
        }


        /**
         * @return Controller
         */
        private function setupFileAttributes(){
            return $this;
        }


        /**
         * @return $this
         */
        private function setupUserAttributes(){
            if( !is_object(UserAttributeKey::getByHandle('display_name')) ){
                UserAttributeKey::add($this->attributeType('text'), array(
                    'akHandle' => 'display_name',
                    'akName'   => 'Display Name'
                ));
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupFileSets(){
            return $this;
        }


        /**
         * @return Controller
         */
        private function setupStacks(){
            return $this;
        }


        /**
         * @return Controller
         */
        private function setupTheme(){
            try {
                if( ! is_object(PageTheme::getByHandle('jhmrfc')) ){
                    /** @var $theme \Concrete\Core\Page\Theme\Theme */
                    $theme = PageTheme::add('jhmrfc', $this->packageObject());
                    $theme->applyToSite();
                }
            }catch(Exception $e){ /* fail gracefully */ }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupTemplates(){
            if( ! PageTemplate::getByHandle('default') ){
                PageTemplate::add('default', t('Default'), 'full.png', $this->packageObject());
            }

            if( ! PageTemplate::getByHandle('home') ){
                PageTemplate::add('home', t('Home'), 'full.png', $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupPageTypes(){
            // "Page" page type
            $this->createPageType(array(
                'configs' => array(
                    'handle'            => 'page',
                    'name'              => 'Page',
                    'defaultTemplate'   => PageTemplate::getByHandle('default')
                ),
                'controls' => array(
                    'core_page_property' => array(
                        'name'           => true,
                        'publish_target' => true,
                        'page_template'  => true,
                        'description'    => false
                    )
                )
            ));

            return $this;
        }


        /**
         * @return Controller
         */
        function assignPageTypes(){
            Loader::db()->Execute('UPDATE Pages set pkgID = ? WHERE cID = 1', array(
                (int) $this->packageObject()->getPackageID()
            ));

            // Things available through the API
            $homePageCollection = \Concrete\Core\Page\Page::getByID(1)->getVersionToModify();
            $homePageCollection->update(array(
                'pTemplateID' => PageTemplate::getByHandle('home')->getPageTemplateID()
            ));
            $homePageCollection->setPageType(PageType::getByHandle('page'));

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupSinglePages(){
            return $this;
        }


        /**
         * @return Controller
         */
        private function setupBlockTypeSets(){
            if( !is_object(BlockTypeSet::getByHandle(self::PACKAGE_HANDLE)) ){
                BlockTypeSet::add(self::PACKAGE_HANDLE, self::PACKAGE_HANDLE, $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupBlocks(){
            if(!is_object(BlockType::getByHandle('photo_wall'))) {
                BlockType::installBlockTypeFromPackage('photo_wall', $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupThumbnailTypes(){
            $largeThumbnail = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('large');
            if( ! is_object($largeThumbnail) ){
                $type = new \Concrete\Core\File\Image\Thumbnail\Type\Type();
                $type->setName('Large');
                $type->setHandle('large');
                $type->setWidth(1440);
                $type->save();
            }

            return $this;
        }


        /**
         * Get the package object; if it hasn't been instantiated yet, load it.
         * @return \Concrete\Core\Package\Package
         */
        private function packageObject(){
            if( $this->_packageObj === null ){
                $this->_packageObj = Package::getByHandle( $this->pkgHandle );
            }
            return $this->_packageObj;
        }


        /**
         * @return AttributeType
         */
        private function attributeType( $handle ){
            if( is_null($this->{"at_{$handle}"}) ){
                $attributeType = \Concrete\Core\Attribute\Type::getByHandle($handle);
                if( is_object($attributeType) && $attributeType->getAttributeTypeID() >= 1 ){
                    $this->{"at_{$handle}"} = $attributeType;
                }
            }
            return $this->{"at_{$handle}"};
        }


        /**
         * @return mixed \Concrete\Core\Attribute\Key\Category || null
         */
        private function attributeKeyCategory( $handle ){
            if( is_null($this->{"akc_{$handle}"}) ){
                $attributeCategory = \Concrete\Core\Attribute\Key\Category::getByHandle($handle);
                if( is_object($attributeCategory) && $attributeCategory->getAttributeKeyCategoryID() >= 1 ){
                    $this->{"akc_{$handle}"} = $attributeCategory;
                }
            }
            return $this->{"akc_{$handle}"};
        }


        /**
         * Create a page type and assign defaults and shit
         */
        private function createPageType( array $settings ){
            // Cast to an object
            $settings = (object) $settings;

            // Get the page type if it exists previously
            $pageType = PageType::getByHandle($settings->configs['handle']);

            // Delete it? Only works if the $pageType isn't assigned to this package already
            if( is_object($pageType) && !((int)$pageType->getPackageID() >= 1) ){
                $pageType->delete();
            }

            if( !is_object(PageType::getByHandle($settings->configs['handle'])) ){
                /** @var $ptPage \Concrete\Core\Page\Type\Type */
                $ptPage = PageType::add(array_merge(array(
                    'ptIsFrequentlyAdded'   => 1,
                    'ptLaunchInComposer'    => 1
                ), $settings->configs), $this->packageObject());

                // Set configured publish target
                $ptPage->setConfiguredPageTypePublishTargetObject(
                    PublishTargetType::getByHandle('all')->configurePageTypePublishTarget($ptPage, array(
                        'ptID' => $ptPage->getPageTypeID()
                    ))
                );

                /** @var $layoutSet \Concrete\Core\Page\Type\Composer\FormLayoutSet */
                $layoutSet = $ptPage->addPageTypeComposerFormLayoutSet('Basics', 'Basics');

                // Are we adding composer controls?
                if( property_exists($settings, 'controls') && is_array($settings->controls) ){
                    // Core page properties
                    $corePageProperties = $settings->controls['core_page_property'];
                    if( is_array($corePageProperties) ){
                        /** @var $controlTypeObj \Concrete\Core\Page\Type\Composer\Control\Type\CorePagePropertyType */
                        $controlTypeObj = \Concrete\Core\Page\Type\Composer\Control\Type\Type::getByHandle('core_page_property');

                        if( is_object($controlTypeObj) ){
                            foreach($corePageProperties AS $controlName => $isRequired){
                                $control = $controlTypeObj->getPageTypeComposerControlByIdentifier($controlName);
                                $control->addToPageTypeComposerFormLayoutSet($layoutSet)
                                    ->updateFormLayoutSetControlRequired($isRequired);
                            }
                        }
                    }

                    // Blocks
                    $pageBlocks = $settings->controls['block'];
                    if( is_array($pageBlocks) ){
                        /** @var $controlTypeObj \Concrete\Core\Page\Type\Composer\Control\Type\CollectionAttributeType */
                        $controlTypeObj = \Concrete\Core\Page\Type\Composer\Control\Type\Type::getByHandle('block');

                        if( is_object($controlTypeObj) ){
                            foreach($pageBlocks AS $controlName){
                                $blockTypeObj = BlockType::getByHandle($controlName);
                                if( is_object($blockTypeObj) ){
                                    $control = $controlTypeObj->getPageTypeComposerControlByIdentifier($blockTypeObj->getBlockTypeID());
                                    $control->addToPageTypeComposerFormLayoutSet($layoutSet);
                                }
                            }
                        }
                    }

                    // Attributes
                    $pageAttributes = $settings->controls['collection_attribute'];
                    if( is_array($pageAttributes) ){
                        /** @var $controlTypeObj \Concrete\Core\Page\Type\Composer\Control\Type\CollectionAttributeType */
                        $controlTypeObj = \Concrete\Core\Page\Type\Composer\Control\Type\Type::getByHandle('collection_attribute');

                        if( is_object($controlTypeObj) ){
                            foreach($pageAttributes AS $controlName){
                                $collectionAttrKey = CollectionAttributeKey::getByHandle($controlName);
                                if( is_object($collectionAttrKey) ){
                                    $control = $controlTypeObj->getPageTypeComposerControlByIdentifier($collectionAttrKey->getAttributeKeyID());
                                    $control->addToPageTypeComposerFormLayoutSet($layoutSet);
                                }
                            }
                        }
                    }
                }
            }
        }

    }
}
