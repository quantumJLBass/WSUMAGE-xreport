<?php

class Wsu_Xreports_Model_Mysql4_Salesreport extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('xreports/salesreport', 'entity_id');
    }

    public function init($table, $field = 'entity_id') {
        $this->_init($table, $field);
        return $this;
    }

}