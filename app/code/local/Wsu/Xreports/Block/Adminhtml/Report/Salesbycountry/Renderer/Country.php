<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbycountry_Renderer_Country extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('country');
        $address = Mage::getModel('sales/order_address')->load($id);
        if ( isset( Mage::app()->getLocale()->getCountryTranslation($address->getCountryId()) ) ) {
            $html = Mage::app()->getLocale()->getCountryTranslation($address->getCountryId());
        } else {
            $html = 'Other';
        }
        return $html;
    }

}