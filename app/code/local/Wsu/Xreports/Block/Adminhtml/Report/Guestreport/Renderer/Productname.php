<?php

class Wsu_Xreports_Block_Adminhtml_Report_Guestreport_Renderer_Productname extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');
        $model = Mage::getModel('sales/order_item')->getCollection()->addFieldToFilter('order_id', array('eq' => $id))->getFirstItem();
        $html = $model->getName();
        return $html;
    }

}