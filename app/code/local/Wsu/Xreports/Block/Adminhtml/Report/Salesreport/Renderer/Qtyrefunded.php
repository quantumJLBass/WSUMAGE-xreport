<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Qtyrefunded extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');
        $model = Mage::getModel('sales/order_item')->getCollection()->addFieldToFilter('order_id', array('eq' => $id))->getFirstItem();
        if ((int) $model->getQtyRefunded() == 0) {
            $html = '0';
        } else {
            $html = (int) $model->getQtyRefunded();
        }
        return $html;
    }

}