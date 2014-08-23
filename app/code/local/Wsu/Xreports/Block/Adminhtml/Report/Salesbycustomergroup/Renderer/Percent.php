<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbycustomergroup_Renderer_Percent extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $qty = $row->getData('total_item_count');
        $html = round(($qty / $this->getTotalQty()) * 100, 1);
        return $html . ' %';
    }

    public function getTotalQty() {
		$request=Mage::app()->getRequest();
        $requestData = Mage::helper('adminhtml')->prepareFilterString($request->getParam('filter'));
        $from = date('Y-m-d', strtotime($requestData['from']));
        $to = date('Y-m-d', strtotime($requestData['to']));
        $totalQty = 0;
		
		$orders = Mage::getModel('sales/order')->getCollection();
		$orders->addAttributeToFilter('created_at', array('from' => $from, 'to' => $to));
		
        if ( !isset($request->getParam('store_ids')) ) {
            if ( isset($requestData['order_statuses']) && !is_null($requestData['order_statuses']) ) {
                $orders->addAttributeToFilter('status', array('in' => explode(',', $requestData['order_statuses'][0])));
            }
        } else {
            if ( isset($requestData['order_statuses']) && !is_null($requestData['order_statuses']) ) {
                $arrStoreIds = explode(',', $request->getParam('store_ids'));
                $orders->addAttributeToFilter('status', array('in' => explode(',', $requestData['order_statuses'][0])));
                $orders->addAttributeToFilter('store_id', array('in' => $arrStoreIds));
            } else {
                $arrStoreIds = explode(',', $request->getParam('store_ids'));
                $orders->addAttributeToFilter('store_id', array('in' => $arrStoreIds));
            }
        }
        foreach ($orders as $order) {
            $totalQty += $order->getTotalItemCount();
        }
        return $totalQty;
    }

}