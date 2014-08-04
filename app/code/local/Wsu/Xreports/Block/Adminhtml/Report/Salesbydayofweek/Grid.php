<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbydayofweek_Grid extends Mage_Adminhtml_Block_Report_Grid_Abstract {

    protected $_columnGroupBy = 'day';

    public function __construct() {
        parent::__construct();
        $this->setCountTotals(true);
    }

    public function getResourceCollectionName() {
        return 'xreports/report_salesbydayofweek_collection';
    }

    protected function _prepareColumns() {
        $this->addColumn('day', array(
            'header' => Mage::helper('xreports')->__('Day of Week'),
            'index' => 'day',
            'type' => 'text',
            'sortable' => false,
            'totals_label' => Mage::helper('xreports')->__('Total'),
            'html_decorators' => array('nobr')
        ));

        $this->addColumn('percent', array(
            'header' => Mage::helper('xreports')->__('Percent'),
            'align' => 'right',
            'index' => 'percent',
            'type' => 'text',
            'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesbydayofweek_Renderer_Percent',
            'sortable' => false,
            'totals_label' => Mage::helper('xreports')->__(null),
        ));

        $this->addColumn('total_item_count', array(
            'header' => Mage::helper('xreports')->__('Number of Orders'),
            'align' => 'right',
            'index' => 'total_item_count',
            'type' => 'number',
            'total' => 'sum',
            'sortable' => false
        ));

        $currencyCode = $this->getCurrentCurrencyCode();

        $this->addColumn('grand_total', array(
            'header' => Mage::helper('xreports')->__('Total'),
            'align' => 'right',
            'index' => 'grand_total',
            'currency_code' => $currencyCode,
            'width' => '100px',
            'type' => 'currency',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addExportType('*/*/exportSalesByDayOfWeekCsv', Mage::helper('xreports')->__('CSV'));
        $this->addExportType('*/*/exportSalesByDayOfWeekExcel', Mage::helper('xreports')->__('Excel XML'));

        return parent::_prepareColumns();
    }

}