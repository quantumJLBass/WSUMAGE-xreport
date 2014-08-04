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

}