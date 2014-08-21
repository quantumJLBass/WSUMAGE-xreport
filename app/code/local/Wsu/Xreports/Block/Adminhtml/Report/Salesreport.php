<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_blockGroup = 'xreports';
        $this->_controller = 'adminhtml_report_salesreport';
        $this->_headerText = Mage::helper('xreports')->__('Sales Report');
				
        parent::__construct();
        $this->_removeButton('add');
    }

}