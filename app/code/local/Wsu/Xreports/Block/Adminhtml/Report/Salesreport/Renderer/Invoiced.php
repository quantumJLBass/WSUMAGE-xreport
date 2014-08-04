<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Invoiced extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');
        $model = Mage::getModel('sales/order')->load($id);
        if ($model->getTotalInvoiced() != null) {
            $html = Mage::helper('core')->currency($model->getTotalInvoiced(), true, false);
        } else {
            $html = Mage::helper('core')->currency(0, true, false);
        }
        return $html;
    }

}