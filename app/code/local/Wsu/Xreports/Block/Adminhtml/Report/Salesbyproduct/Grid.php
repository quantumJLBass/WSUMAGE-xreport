<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbyproduct_Grid extends Mage_Adminhtml_Block_Report_Grid_Abstract {

    protected $_columnGroupBy = 'period';

    public function __construct() {
        parent::__construct();
        $this->setCountTotals(true);
    }

    public function getResourceCollectionName() {
        return 'xreports/report_salesbyproduct_collection';
    }

    protected function _prepareColumns() {
        $this->addColumn('period', array(
            'header' => Mage::helper('xreports')->__('Period'),
            'index' => 'period',
            'width' => 100,
            'sortable' => false,
            'period_type' => $this->getPeriodType(),
            'renderer' => 'adminhtml/report_sales_grid_column_renderer_date',
            'totals_label' => Mage::helper('xreports')->__('Total'),
            'html_decorators' => array('nobr')
        ));

        $this->addColumn('qty_ordered', array(
            'header' => Mage::helper('xreports')->__('Quantity'),
            'align' => 'right',
            'index' => 'qty_ordered',
            'type' => 'number',
            //'renderer'          => 'Wsu_Xreports_Block_Adminhtml_Report_Salesbyproduct_Renderer_Quantity',            
            'sortable' => false,
                //'totals_label'      => Mage::helper('xreports')->__(''),
                //html_decorators'   => array('nobr')
        ));

        $currencyCode = $this->getCurrentCurrencyCode();

        $this->addColumn('row_total', array(
            'header' => Mage::helper('xreports')->__('Total'),
            'align' => 'right',
            'index' => 'row_total',
            'currency_code' => $currencyCode,
            'width' => '100px',
            'type' => 'currency',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addExportType('*/*/exportSalesByProductCsv', Mage::helper('xreports')->__('CSV'));
        $this->addExportType('*/*/exportSalesByProductExcel', Mage::helper('xreports')->__('Excel XML'));

        return parent::_prepareColumns();
    }

}