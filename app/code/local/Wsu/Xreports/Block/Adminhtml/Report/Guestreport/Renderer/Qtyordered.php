<?php

class Wsu_Xreports_Block_Adminhtml_Report_Guestreport_Renderer_Qtyordered extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');
		
		$request = Mage::app()->getRequest();
		$requestData = Mage::helper('adminhtml')->prepareFilterString($request->getParam('filter'));
		
		$model = Mage::getModel('sales/order')->load($id);
		
		if(isset( $requestData['sku'] )){
			$html =  '0';
			foreach ($model->getAllVisibleItems() as $item) {
				//var_dump($item);die();
				if( strtolower($requestData['sku'])==strtolower($item->getSku()) ){	
					 $html = $item->getQtyOrdered();
				}
			}
		}else{
			$model->getFirstItem();
			if ((int) $model->getQtyOrdered() == 0) {
				$html = '0';
			} else {
				$html = (int) $model->getQtyOrdered();
			}
		}
        return $html;
    }

}