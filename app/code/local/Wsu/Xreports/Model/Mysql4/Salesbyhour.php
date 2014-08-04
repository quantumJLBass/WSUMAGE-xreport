<?php

class Wsu_Xreports_Model_Mysql4_Salesbyhour extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('xreports/salesbyhour', 'h');
    }

    public function init($table, $field = 'h') {
        $this->_init($table, $field);
        return $this;
    }

}