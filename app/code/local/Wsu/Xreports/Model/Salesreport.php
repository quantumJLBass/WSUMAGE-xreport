<?php

class Wsu_Xreports_Model_Salesreport extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('xreports/salesreport');
    }

}