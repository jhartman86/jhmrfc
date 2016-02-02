<?php namespace Concrete\Package\Jhmr\Attribute\PageSelector {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    use Loader;

    class Controller extends \Concrete\Core\Attribute\Controller {

        protected $searchIndexFieldDefinition = array('type' => 'integer', 'options' => array('default' => 0, 'notnull' => false));

        public function getValue() {
            $value = Loader::db()->GetOne("select value from atPageSelector where avID = ?", array($this->getAttributeValueID()));
            return $value;
        }

        public function getDisplaySanitizedValue(){
            if( is_object($this->attributeValue) ){
                return \Concrete\Core\Page\Page::getByID($this->getValue())->getCollectionName();
            }
        }

        public function searchForm($list) {
            $list->filterByAttribute($this->attributeKey->getAttributeKeyHandle(), $this->request('value'), '=');
            return $list;
        }

        public function search() {
            print Loader::helper('form/page_selector')->selectPage($this->field('value'), $this->request('value'), false);
        }

        public function form() {
            if (is_object($this->attributeValue)) {
                $value = $this->getAttributeValue()->getValue();
            }
            print Loader::helper('form/page_selector')->selectPage($this->field('value'), $value);
        }

        public function validateForm($p) {
            return $p['value'] != 0;
        }

        public function saveValue($value) {
            $db = Loader::db();
            if(!intval($value)) {
                $value = 0;
            }
            $db->Replace('atPageSelector', array('avID' => $this->getAttributeValueID(), 'value' => $value), 'avID', true);
        }

        public function deleteKey() {
            $db = Loader::db();
            $arr = $this->attributeKey->getAttributeValueIDList();
            foreach($arr as $id) {
                $db->Execute('delete from atPageSelector where avID = ?', array($id));
            }
        }

        public function saveForm($data) {
            $this->saveValue($data['value']);
        }

        public function deleteValue() {
            Loader::db()->Execute('delete from atPageSelector where avID = ?', array($this->getAttributeValueID()));
        }

    }

}