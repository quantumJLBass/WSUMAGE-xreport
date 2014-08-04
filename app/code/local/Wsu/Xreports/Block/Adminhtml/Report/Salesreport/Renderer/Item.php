<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Item extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');

		
		$finalResult = array();
		$model = Mage::getModel('sales/order')->load($id);
		// Loop through all items in the cart
		foreach ($model->getAllVisibleItems() as $item) {
			$product = $item->getProduct();
		  // Array to hold the item's options
		  $result = array();
		  // Load the configured product options
		  $options = $product->getTypeInstance(true)->getOrderOptions($product);
		  // Check for options
		  if (isset($options['info_buyRequest'])){
			  $info = $options['info_buyRequest'];
			/*if (isset($info['options'])){
			  $result = array_merge($result, $info['options']);
			}*/
			if (isset($info['options']['additional_options'])){
			  $result = array_merge($result, unserialize($info['options']['additional_options']) );
			}
			/*if (!empty($info['attributes_info'])){
			  $result = array_merge($info['attributes_info'], $result);
			}*/
		  }
		  $finalResult = array_merge($finalResult, $result);
		}
		ob_start();
		var_dump($finalResult);
		$html = ob_get_clean(); 

        return $html;
    }

}