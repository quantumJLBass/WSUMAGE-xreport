<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbynewandreturning_Grid extends Mage_Adminhtml_Block_Report_Grid_Abstract {

    protected $_columnGroupBy = 'period';

    public function __construct() {
        parent::__construct();
        $this->setCountTotals(true);
    }

    public function getResourceCollectionName() {
        return 'xreports/report_salesbynewandreturning_collection';
    }

    protected function _prepareColumns() {
        $this->addColumn('period', array(
            'header' => Mage::helper('xreports')->__('Period'),
            'width' => 100,
            'index' => 'period',
            'type' => 'text',
            'sortable' => false,
            'totals_label' => Mage::helper('xreports')->__('Total'),
            'html_decorators' => array('nobr')
        ));

        $this->addColumn('new_customers', array(
            'header' => Mage::helper('xreports')->__('New Customers'),
            'align' => 'right',
            'index' => 'new_customers',
            'type' => 'number',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addColumn('returning_customers', array(
            'header' => Mage::helper('xreports')->__('Returning Customers'),
            'align' => 'right',
            'index' => 'returning_customers',
            'type' => 'number',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addColumn('percent_of_new', array(
            'header' => Mage::helper('xreports')->__('Percent of New Customers'),
            'align' => 'right',
            'index' => 'percent_of_new',
            'type' => 'text',
            'sortable' => false
        ));

        $this->addColumn('percent_of_returning', array(
            'header' => Mage::helper('xreports')->__('Percent of Returning Customers'),
            'align' => 'right',
            'index' => 'percent_of_returning',
            'type' => 'text',
            'sortable' => false
        ));

        $this->addExportType('*/*/exportSalesByNewAndReturningCsv', Mage::helper('xreports')->__('CSV'));
        $this->addExportType('*/*/exportSalesByNewAndReturningExcel', Mage::helper('xreports')->__('Excel XML'));

        return parent::_prepareColumns();
    }

}