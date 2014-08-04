<?php

class Wsu_Xreports_Model_Salesbycountry extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('xreports/salesbycountry');
    }

}