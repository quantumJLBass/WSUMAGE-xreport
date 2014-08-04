<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbycountry_Grid extends Mage_Adminhtml_Block_Report_Grid_Abstract {

    protected $_columnGroupBy = 'country';

    public function __construct() {
        parent::__construct();
        $this->setCountTotals(true);
    }

    public function getResourceCollectionName() {
        return 'xreports/report_salesbycountry_collection';
    }

    protected function _prepareColumns() {
        $this->addColumn('country', array(
            'header' => Mage::helper('xreports')->__('Country'),
            'index' => 'country',
            'type' => 'text',
            'sortable' => false,
            'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesbycountry_Renderer_Country',
            'totals_label' => Mage::helper('xreports')->__('Total'),
            'html_decorators' => array('nobr')
        ));

        $this->addColumn('percent', array(
            'header' => Mage::helper('xreports')->__('Percent'),
            'align' => 'right',
            'index' => 'percent',
            'type' => 'text',
            'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesbycountry_Renderer_Percent',
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

        $this->addExportType('*/*/exportSalesByCountryCsv', Mage::helper('xreports')->__('CSV'));
        $this->addExportType('*/*/exportSalesByCountryExcel', Mage::helper('xreports')->__('Excel XML'));

        return parent::_prepareColumns();
    }

}