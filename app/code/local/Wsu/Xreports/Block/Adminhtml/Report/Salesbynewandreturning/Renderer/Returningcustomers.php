<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbynewandreturning_Renderer_Returningcustomers extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('returning_customers');
        $order = Mage::getModel('sales/order')->load($id);
        $collection = Mage::getModel('sales/order')->getCollection()->addFieldToFilter('customer_id', $order->getCustomerId());
        if (count($collection) == 1) {
            $html = (int) $order->getTotalQtyOrdered();
        } else if (count($collection) > 1) {
            $html = '0';
        }
        return $html;
    }

}