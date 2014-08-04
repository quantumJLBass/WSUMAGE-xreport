<?php

class Wsu_Xreports_Model_Mysql4_Salesbydayofweek extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('xreports/salesbyhour', 'd');
    }

    public function init($table, $field = 'd') {
        $this->_init($table, $field);
        return $this;
    }

}