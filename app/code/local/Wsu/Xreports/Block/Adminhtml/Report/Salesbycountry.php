<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbycountry extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_blockGroup = 'xreports';
        $this->_controller = 'adminhtml_report_salesbycountry';
        $this->_headerText = Mage::helper('xreports')->__('Sales by Country');
        $this->setTemplate('wsu/xreports/report/salesbycountry/grid/container.phtml');
        parent::__construct();
        $this->_removeButton('add');
        $this->addButton('filter_form_submit', array(
            'label' => Mage::helper('xreports')->__('Show Report'),
            'onclick' => 'filterFormSubmit()'
        ));
    }

    public function getFilterUrl() {
        $this->getRequest()->setParam('filter', null);
        return $this->getUrl('*/*/salesbycountry', array('_current' => true));
    }

    protected function _prepareLayout() {
        $this->setChild('grid', $this->getLayout()->createBlock($this->_blockGroup . '/' . $this->_controller . '_grid', $this->_controller . '.grid')->setSaveParametersInSession(true));
        return parent::_prepareLayout();
    }

}