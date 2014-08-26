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
		$request = Mage::app()->getRequest();
        $requestData = Mage::helper('adminhtml')->prepareFilterString($request->getParam('filter'));
		
		//var_dump($requestData);die();
		
		
		$collection = Mage::getModel('sales/order')->getCollection();

		$fromDate = date('Y-m-d H:i:s', strtotime('now'));
		$toDate = date('Y-m-d H:i:s', strtotime('now'));
		if (!empty($requestData) && isset($requestData['created_at'])) {
			if( isset($requestData['created_at']['from'])
				 && strtotime($requestData['created_at']['from'].' 00:00:00' ) < strtotime('now')
				 && strtotime($requestData['created_at']['from'].' 00:00:00' ) < strtotime($requestData['created_at']['to'].' 23:59:59' )
			){
				$fromDate=date('Y-m-d H:i:s', strtotime( $requestData['created_at']['from'].' 00:00:00' ));
			}
			if( isset($requestData['created_at']['to']) 
			    && strtotime($requestData['created_at']['to'].' 23:59:59' )<strtotime('now')
			){
				$toDate=date('Y-m-d H:i:s', strtotime($requestData['created_at']['to'].' 23:59:59' ));
			}
		}
		$collection->addAttributeToFilter('main_table.created_at', array('from'=>$fromDate,'to'=>$toDate));

		$collection->getSelect()->join(
				Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address'),
				'main_table.billing_address_id = ' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address') . '.entity_id',
					array('country_id',
						'region',
						'city',
						'postcode',
						'main_table.total_qty_ordered',
						'main_table.subtotal',
						'main_table.tax_amount',
						'main_table.discount_amount',
						'main_table.grand_total',
						'main_table.total_invoiced',
						'main_table.total_refunded'
					 )
			);
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

		$storeIds = $request->getParam('store_ids');
		if (!is_null($storeIds)) {
			$arrStoreIds = explode(',', $storeIds);
			$collection->getSelect()->where('main_table.store_id IN(?)', $arrStoreIds);
		}
		if (!empty($requestData)) {
			if(isset( $requestData['status'] )){
				$collection->getSelect()->Where('main_table.status = ?',$requestData['status']);
			}
			if(isset( $requestData['customer_email'] )){
				$collection->getSelect()->Where('main_table.customer_email LIKE CONCAT(\'%\',?,\'%\')',$requestData['customer_email']);
			}
			if(isset( $requestData['customer_firstname'] )){
				$collection->getSelect()->Where('main_table.customer_firstname LIKE CONCAT(\'%\',?,\'%\')',$requestData['customer_firstname']);
			}
			if(isset( $requestData['customer_lastname'] )){
				$collection->getSelect()->Where('main_table.customer_lastname LIKE CONCAT(\'%\',?,\'%\')',$requestData['customer_lastname']);
			}
			if(isset( $requestData['name'] )){
				$collection->getSelect()->Having('names LIKE CONCAT(\'%\',?,\'%\')',$requestData['name']);
			}
			if(isset( $requestData['sku'] )){
				$collection->getSelect()->Having('skus LIKE CONCAT(\'%\',?,\'%\')', $requestData['sku']);
			}
        }
		print((string)$collection->getSelect());
		set_time_limit ('600');
			Mage::unregister('dyno_col'); 
			Mage::register('dyno_col', Mage::helper('xreports')->dynoColCallback($collection));
			$newCollection = new Varien_Data_Collection();
			$dyno_col=(array)Mage::registry('dyno_col');
			$collection=Mage::registry('collection');
			if(!empty($collection)){
				foreach($collection as $item){
					foreach($dyno_col as $keyed){
						$value=Mage::helper('xreports')->dynoColValue($item,$keyed);
						$item->setData("${keyed}",$value);
					 }
					 $newCollection->addItem($item);
				}
			}
		set_time_limit ('60');
		return $newCollection;
	}


	// callback method
	public function dynoColValue($_item,$key) {
		$finalResult = array();
		$dynoResult = $_item->getData('dynoresult');
		if(isset($dynoResult)){
			$finalResult=$dynoResult;
		}else{
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
			$newCollection = new Varien_Data_Collection();
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
				
				$_item->setData("dynoresult",$finalResult);
				$newCollection->addItem($_item);
			}
			Mage::unregister('collection'); 
			Mage::register('collection', $newCollection);
		}catch(Exception $e){
			Mage::log($e,Zend_Log::ERR,"xRport.txt");
		}
		$optionkeyarray=array_unique($optionkeyarray);
		return $optionkeyarray;
	}






}