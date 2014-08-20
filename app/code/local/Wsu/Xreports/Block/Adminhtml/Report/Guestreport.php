<?php

class Wsu_Xreports_Block_Adminhtml_Report_Guestreport extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_blockGroup = 'xreports';
        $this->_controller = 'adminhtml_report_guestreport';
        $this->_headerText = Mage::helper('xreports')->__('Guest Report');
        parent::__construct();
        $this->_removeButton('add');
    }

}