<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Customergroup extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $groupId = $row->getData('customer_group_id');
        $customerGroup = Mage::getModel('customer/group')->load($groupId);
        $html = $customerGroup->getCustomerGroupCode();
        return $html;
    }

}