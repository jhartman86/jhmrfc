<?php namespace Concrete\Package\Jhmr\Theme\Jhmrfc {

    class PageTheme extends \Concrete\Core\Page\Theme\Theme {

        protected $pThemeGridFrameworkHandle = 'bootstrap3';

        protected static $contentBlockClasses = array(
            'wrap-theme-highlight'
        );

        protected static $sectionClasses = array(
            'wrap-theme-highlight',
            'wrap-theme-extra-light',
            'wrap-theme-light',
            'wrap-theme-dark'
        );

        public function getThemeEditorClasses(){
            return array(
                array('title' => t('Theme Highlight Color'), 'menuClass' => 'theme-highlight-color', 'spanClass' => 'theme-highlight-color'),
                array('title' => t('Theme Light Color'), 'menuClass' => '', 'spanClass' => 'theme-light-color'),
                array('title' => t('Theme Dark Color'), 'menuClass' => '', 'spanClass' => 'theme-dark-color'),
                array('title' => t('Font:Large'), 'menuClass' => '', 'spanClass' => 'theme-text-large'),
                array('title' => t('Font:XLarge'), 'menuClass' => '', 'spanClass' => 'theme-text-xlarge'),
                array('title' => t('Font:Lead'), 'menuClass' => '', 'spanClass' => 'lead'),
                array('title' => t('Font:TradeGothicBold'), 'menuClass' => '', 'spanClass' => 'theme-font-bold')
            );
        }

        /**
         * @return array|void
         */
        public function getThemeAreaClasses(){
            return array(
                'Main'   => self::$sectionClasses,
                'Main 1' => self::$sectionClasses,
                'Main 2' => self::$sectionClasses,
                'Main 3' => self::$sectionClasses,
                'Main 4' => self::$sectionClasses,
                'Main 5' => self::$sectionClasses,
                'Main 6' => self::$sectionClasses,
                'Main 7' => self::$sectionClasses,
                'Main 8' => self::$sectionClasses,
                'Main 9' => self::$sectionClasses,
                'Main 10' => self::$sectionClasses
            );
        }


        public function getThemeBlockClasses(){
            return array(
                'content'   => self::$contentBlockClasses,
                'photo_wall' => array(
                    'grid-scale-images',
                    'grid-grayscale',
                    'grid-white-blocks',
                    'grid-animate-on-hover',
                    'grid-4-max',
                    'grid-3-max'
                )
            );
        }


        public function getThemeDefaultBlockTemplates(){
            return array(
                'html' => 'naked.php'
            );
        }

    }

}