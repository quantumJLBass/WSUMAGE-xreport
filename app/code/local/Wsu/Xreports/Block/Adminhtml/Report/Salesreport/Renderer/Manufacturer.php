<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Manufacturer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');
        $model = Mage::getModel('sales/order_item')->getCollection()->addFieldToFilter('order_id', array('eq' => $id))->getFirstItem();
        $product = Mage::getModel('catalog/product')->load($model->getProductId());
        $html = $product->getAttributeText('manufacturer');
        return $html;
    }

}