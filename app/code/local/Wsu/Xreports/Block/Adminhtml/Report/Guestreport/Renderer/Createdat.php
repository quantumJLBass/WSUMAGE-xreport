<?php

class Wsu_Xreports_Block_Adminhtml_Report_Guestreport_Renderer_Createdat extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');
        $model = Mage::getModel('sales/order')->load($id);
        $html = Mage::helper('core')->formatDate($model->getCreatedAt(), 'medium', true);
        return $html;
    }

}