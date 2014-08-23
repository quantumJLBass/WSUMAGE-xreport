<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Refunded extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');
        $model = Mage::getModel('sales/order')->load($id);
		$total = 0;
        if ( isset($model->getTotalRefunded()) ) {
            $total = $model->getTotalRefunded();
        }
		$html = Mage::helper('core')->currency($total, true, false);
        return $html;
    }

}