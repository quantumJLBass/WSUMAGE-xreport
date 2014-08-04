<?php

class Wsu_Xreports_Model_Mysql4_Salesbynewandreturning extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('xreports/salesbynewandreturning', 'period');
    }

    public function init($table, $field = 'period') {
        $this->_init($table, $field);
        return $this;
    }

}