<?php

class Wsu_Xreports_Block_Adminhtml_Report_Guestreport_Renderer_Productname extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');
		
		$request = Mage::app()->getRequest();
		$requestData = Mage::helper('adminhtml')->prepareFilterString($request->getParam('filter'));
		
		$model = Mage::getModel('sales/order')->load($id);
		
		if(isset( $requestData['sku'] )){
			 $html = 'failed to load sku';
			 
			foreach ($model->getAllVisibleItems() as $item) {
				//print_r($item->getSku());
				if( strtolower($requestData['sku'])==strtolower($item->getSku()) ){	
					 $html = $item->getName();
				}
			}
		}else{
			$model->getFirstItem();
			$html = $model->getName();
		}
		
		
		
        //$model = Mage::getModel('sales/order_item')->getCollection()->addFieldToFilter('order_id', array('eq' => $id))->getFirstItem();
        //$html = $model->getName();
        return $html;
    }

}