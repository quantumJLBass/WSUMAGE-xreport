<?php

class Wsu_Xreports_Helper_Data extends Mage_Core_Helper_Abstract {

    public function isActiveModule() {
        return Mage::getStoreConfig('xreports/general/active');
    }

    public function isEnabledGoogleCharts() {
        return Mage::getStoreConfig('xreports/general/enable_google_charts');
    }
    
    public function getLicenseKey() {
        return Mage::getStoreConfig('xreports/license/key');
    }
    
    public function getStringExtension() {
        return 'xreports';
    }
    
    public function getStringModule() {
        return 'xreports';
    }


	public function _findCollection(){
		
		$today = date('Y-m-d', Mage::getModel('core/date')->timestamp(time()));
		$request = Mage::app()->getRequest();
        $requestData = Mage::helper('adminhtml')->prepareFilterString($request->getParam('filter'));
        if (!empty($requestData)) {
            $storeIds = $request->getParam('store_ids');
            if ($storeIds == null) {
                $collection = Mage::getModel('sales/order')->getCollection();
                $collection->addFieldToFilter('main_table.created_at', array('from' => $today));
                $collection->getSelect()->join(Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address'), 'main_table.billing_address_id = ' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address') . '.entity_id', array('country_id', 'region', 'city', 'postcode', 'main_table.total_qty_ordered', 'main_table.subtotal', 'main_table.tax_amount', 'main_table.discount_amount', 'main_table.grand_total', 'main_table.total_invoiced', 'main_table.total_refunded'));
                $collection->join(
                        'sales/order_item', '`sales/order_item`.order_id=`main_table`.entity_id', array(
                    'skus' => new Zend_Db_Expr('group_concat(`sales/order_item`.sku SEPARATOR ",")'),
                    'names' => new Zend_Db_Expr('group_concat(`sales/order_item`.name SEPARATOR ",")'),
                    'qty_invoiced',
                    'qty_shipped',
                    'qty_refunded',
                        )
                );
                $collection->getSelect()->group('main_table.entity_id');
            } else {
                $arrStoreIds = explode(',', $storeIds);
                $collection = Mage::getModel('sales/order')->getCollection();
                $collection->addFieldToFilter('main_table.created_at', array('from' => $today));
                $collection->getSelect()->join(Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address'), 'main_table.billing_address_id = ' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address') . '.entity_id', array('country_id', 'region', 'city', 'postcode', 'main_table.total_qty_ordered', 'main_table.subtotal', 'main_table.tax_amount', 'main_table.discount_amount', 'main_table.grand_total', 'main_table.total_invoiced', 'main_table.total_refunded'));
                $collection->join(
                        'sales/order_item', '`sales/order_item`.order_id=`main_table`.entity_id', array(
                    'skus' => new Zend_Db_Expr('group_concat(`sales/order_item`.sku SEPARATOR ",")'),
                    'names' => new Zend_Db_Expr('group_concat(`sales/order_item`.name SEPARATOR ",")'),
                    'qty_invoiced',
                    'qty_shipped',
                    'qty_refunded',
                        )
                );
                $collection->getSelect()->group('main_table.entity_id');
                $collection->getSelect()->where('main_table.store_id IN(?)', $arrStoreIds);
            }
        } else {
            $storeIds = $request->getParam('store_ids');
            if ($storeIds == null) {
                $collection = Mage::getModel('sales/order')->getCollection();
                $collection->getSelect()->join(Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address'), 'main_table.billing_address_id = ' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address') . '.entity_id', array('country_id', 'region', 'city', 'postcode', 'main_table.total_qty_ordered', 'main_table.subtotal', 'main_table.tax_amount', 'main_table.discount_amount', 'main_table.grand_total', 'main_table.total_invoiced', 'main_table.total_refunded'));
                $collection->join(
                        'sales/order_item', '`sales/order_item`.order_id=`main_table`.entity_id', array(
                    'skus' => new Zend_Db_Expr('group_concat(`sales/order_item`.sku SEPARATOR ",")'),
                    'names' => new Zend_Db_Expr('group_concat(`sales/order_item`.name SEPARATOR ",")'),
                    'qty_invoiced',
                    'qty_shipped',
                    'qty_refunded',
                        )
                );
                $collection->getSelect()->group('main_table.entity_id');
            } else {
                $arrStoreIds = explode(',', $storeIds);
                $collection = Mage::getModel('sales/order')->getCollection();
                $collection->getSelect()->join(Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address'), 'main_table.billing_address_id = ' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address') . '.entity_id', array('country_id', 'region', 'city', 'postcode', 'main_table.total_qty_ordered', 'main_table.subtotal', 'main_table.tax_amount', 'main_table.discount_amount', 'main_table.grand_total', 'main_table.total_invoiced', 'main_table.total_refunded'));
                $collection->join(
                        'sales/order_item', '`sales/order_item`.order_id=`main_table`.entity_id', array(
                    'skus' => new Zend_Db_Expr('group_concat(`sales/order_item`.sku SEPARATOR ",")'),
                    'names' => new Zend_Db_Expr('group_concat(`sales/order_item`.name SEPARATOR ",")'),
                    'qty_invoiced',
                    'qty_shipped',
                    'qty_refunded',
                        )
                );
                $collection->getSelect()->group('main_table.entity_id');
                $collection->getSelect()->where('main_table.store_id IN(?)', $arrStoreIds);
            }
        }
		Mage::unregister('dyno_col'); 
		Mage::register('dyno_col', Mage::helper('xreports')->dynoColCallback($collection));
		$newCollection = new Varien_Data_Collection();
		$dyno_col=(array)Mage::registry('dyno_col');
		
		foreach($collection as $item){
			foreach($dyno_col as $keyed){
				$item->setData("${keyed}",Mage::helper('xreports')->dynoColValue($item,$keyed));
			 }
			 //$newCollection->addItem($item);
		}
		return $collection;
	}


	// callback method
	public function dynoColValue($_item,$key) {
		$optionkeyarray=array();

		$finalResult = array();
		$model = Mage::getModel('sales/order')->load($_item->getId());

		// Loop through all items in the cart
		foreach ($model->getAllVisibleItems() as $item) {
			$product = $item->getProduct();
			// Array to hold the item's options
			$result = array();
			// Load the configured product options
			$options = $item->getProductOptions();
			//$finalResult = array_merge($finalResult, $options);
			// Check for options
			if (isset($options['info_buyRequest'])){
				$info = $options['info_buyRequest'];
				if (isset($info['options'])){
				//	$result = array_merge($result, $info['options']);
				}
				if (isset($info['options']['additional_options'])){
					$result = array_merge($result, unserialize($info['options']['additional_options']) );
				}
				if (!empty($info['attributes_info'])){
					$result = array_merge($info['attributes_info'], $result);
				}
			}
			$finalResult = array_merge($finalResult, $result);
		}
		foreach ($finalResult as $_option){
			$label = trim($this->escapeHtml($_option['label']));
			if ($label==$key){
				return $_option['value'];
			}
		}
		return "";
	}


	// callback method
	public function dynoColCallback($collection) {
		$optionkeyarray=array();
		try{
			foreach($collection as $_item){
				$finalResult = array();
				$model = Mage::getModel('sales/order')->load($_item->getId());
	
				// Loop through all items in the cart
				foreach ($model->getAllVisibleItems() as $item) {
					$product = $item->getProduct();
					// Array to hold the item's options
					$result = array();
					// Load the configured product options
					$options = $item->getProductOptions();
					//$finalResult = array_merge($finalResult, $options);
					// Check for options
					if (isset($options['info_buyRequest'])){
						$info = $options['info_buyRequest'];
						if (isset($info['options'])){
						//	$result = array_merge($result, $info['options']);
						}
						if (isset($info['options']['additional_options'])){
							$result = array_merge($result, unserialize($info['options']['additional_options']) );
						}
						if (!empty($info['attributes_info'])){
							$result = array_merge($info['attributes_info'], $result);
						}
					}
					$finalResult = array_merge($finalResult, $result);
				}
				foreach ($finalResult as $_option){
					$label = trim($this->escapeHtml($_option['label']));
					if ($label!=="" && strpos($label,'guest_')===false ){
						$optionkeyarray[]=$label;
					}
					if ( $label!=="" && strpos($label,'guest_')!==false && strpos($label,'_{%d%}_')===false ){
						$optionkeyarray[]=$label;
					}
				}
			}
		}catch(Exception $e){
			Mage::log($e,Zend_Log::ERR,"xRport.txt");
		}
		$optionkeyarray=array_unique($optionkeyarray);
		return $optionkeyarray;
	}






}