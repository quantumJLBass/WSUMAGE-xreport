<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbycustomergroup_Renderer_Percent extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $qty = $row->getData('total_item_count');
        $html = round(($qty / $this->getTotalQty()) * 100, 1);
        return $html . ' %';
    }

    public function getTotalQty() {
        $requestData = Mage::helper('adminhtml')->prepareFilterString($this->getRequest()->getParam('filter'));
        $from = date('Y-m-d', strtotime($requestData['from']));
        $to = date('Y-m-d', strtotime($requestData['to']));
        $totalQty = 0;
        if (Mage::app()->getRequest()->getParam('store_ids') == null) {
            if (isset($requestData['order_statuses']) && $requestData['order_statuses'] != null) {
                $orders = Mage::getModel('sales/order')->getCollection()
                        ->addAttributeToFilter('created_at', array('from' => $from, 'to' => $to))
                        ->addAttributeToFilter('status', array('in' => explode(',', $requestData['order_statuses'][0])));
            } else {
                $orders = Mage::getModel('sales/order')->getCollection()
                        ->addAttributeToFilter('created_at', array('from' => $from, 'to' => $to));
            }
        } else {
            if (isset($requestData['order_statuses']) && $requestData['order_statuses'] != null) {
                $arrStoreIds = explode(',', Mage::app()->getRequest()->getParam('store_ids'));
                $orders = Mage::getModel('sales/order')->getCollection()
                        ->addAttributeToFilter('created_at', array('from' => $from, 'to' => $to))
                        ->addAttributeToFilter('status', array('in' => explode(',', $requestData['order_statuses'][0])))
                        ->addAttributeToFilter('store_id', array('in' => $arrStoreIds));
            } else {
                $arrStoreIds = explode(',', Mage::app()->getRequest()->getParam('store_ids'));
                $orders = Mage::getModel('sales/order')->getCollection()
                        ->addAttributeToFilter('created_at', array('from' => $from, 'to' => $to))
                        ->addAttributeToFilter('store_id', array('in' => $arrStoreIds));
            }
        }
        foreach ($orders as $order) {
            $totalQty += $order->getTotalItemCount();
        }
        return $totalQty;
    }

}