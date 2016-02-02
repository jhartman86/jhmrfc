<?php namespace Concrete\Package\Jhmr\Controller\PageType {

    use \Concrete\Package\Jhmr\Controller\JhmrPageController;

    class Page extends JhmrPageController {

        protected $_includeThemeAssets = true;

        public function on_start(){
            parent::on_start();
        }

    }

}