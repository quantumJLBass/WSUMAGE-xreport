<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbyproduct_Renderer_Quantity extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('qty_ordered');
        $order = Mage::getModel('sales/order')->load($id);
        $html = (int) $order->getTotalQtyOrdered();
        return $html;
    }

}