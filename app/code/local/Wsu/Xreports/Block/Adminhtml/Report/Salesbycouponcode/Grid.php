<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbycouponcode_Grid extends Mage_Adminhtml_Block_Report_Grid_Abstract {

    protected $_columnGroupBy = 'coupon_code';

    public function __construct() {
        parent::__construct();
        $this->setCountTotals(true);
    }

    public function getResourceCollectionName() {
        return 'xreports/report_salesbycouponcode_collection';
    }

    protected function _prepareColumns() {
        $this->addColumn('coupon_code', array(
            'header' => Mage::helper('xreports')->__('Coupon Code'),
            'index' => 'coupon_code',
            'type' => 'number',
            'sortable' => false,
            'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesbycouponcode_Renderer_Couponcode',
            'totals_label' => Mage::helper('xreports')->__('Total'),
            'html_decorators' => array('nobr')
        ));

        $this->addColumn('total_item_count', array(
            'header' => Mage::helper('xreports')->__('Orders'),
            'align' => 'right',
            'index' => 'total_item_count',
            'type' => 'number',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addColumn('total_qty_ordered', array(
            'header' => Mage::helper('xreports')->__('Items'),
            'align' => 'right',
            'index' => 'total_qty_ordered',
            'type' => 'number',
            'total' => 'sum',
            'sortable' => false
        ));

        $currencyCode = $this->getCurrentCurrencyCode();

        $this->addColumn('subtotal', array(
            'header' => Mage::helper('xreports')->__('Subtotal'),
            'align' => 'right',
            'index' => 'subtotal',
            'currency_code' => $currencyCode,
            'width' => '100px',
            'type' => 'currency',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addColumn('tax_amount', array(
            'header' => Mage::helper('xreports')->__('Tax'),
            'align' => 'right',
            'index' => 'tax_amount',
            'currency_code' => $currencyCode,
            'width' => '100px',
            'type' => 'currency',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addColumn('shipping_amount', array(
            'header' => Mage::helper('xreports')->__('Shipping'),
            'align' => 'right',
            'index' => 'shipping_amount',
            'currency_code' => $currencyCode,
            'width' => '100px',
            'type' => 'currency',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addColumn('discount_amount', array(
            'header' => Mage::helper('xreports')->__('Discount'),
            'align' => 'right',
            'index' => 'discount_amount',
            'currency_code' => $currencyCode,
            'width' => '100px',
            'type' => 'currency',
            'total' => 'sum',
            'sortable' => false
        ));

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

        $this->addColumn('total_invoiced', array(
            'header' => Mage::helper('xreports')->__('Invoiced'),
            'align' => 'right',
            'index' => 'total_invoiced',
            'currency_code' => $currencyCode,
            'width' => '100px',
            'type' => 'currency',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addColumn('base_total_refunded', array(
            'header' => Mage::helper('xreports')->__('Refunded'),
            'align' => 'right',
            'index' => 'base_total_refunded',
            'currency_code' => $currencyCode,
            'width' => '100px',
            'type' => 'currency',
            'total' => 'sum',
            'sortable' => false
        ));

        $this->addExportType('*/*/exportSalesByCouponCodeCsv', Mage::helper('xreports')->__('CSV'));
        $this->addExportType('*/*/exportSalesByCouponCodeExcel', Mage::helper('xreports')->__('Excel XML'));

        return parent::_prepareColumns();
    }

}