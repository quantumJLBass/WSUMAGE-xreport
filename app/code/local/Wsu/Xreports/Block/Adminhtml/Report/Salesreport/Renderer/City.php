<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_City extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('billing_address_id');
        $address = Mage::getModel('sales/order_address')->load($id);
        $html = $address->getCity();
        return $html;
    }

}