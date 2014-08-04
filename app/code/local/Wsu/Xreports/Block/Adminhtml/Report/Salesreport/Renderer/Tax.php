<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Tax extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');
        $model = Mage::getModel('sales/order')->load($id);
        $html = Mage::helper('core')->currency($model->getTaxAmount(), true, false);
        return $html;
    }

}