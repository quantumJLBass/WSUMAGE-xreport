<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesbyhour_Renderer_Percent extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $qty = $row->getData('total_item_count');
        $html = round(($qty / $this->getTotalQty()) * 100, 1);
        return $html . ' %';
    }

    public function getTotalQty() {
        $totalQty = 0;
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $query = 'SELECT IFNULL(SUM(total_item_count), 0) AS `total_item_count` FROM `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`';
        $results = $readConnection->fetchAll($query);
        foreach ($results as $r) {
            $totalQty += $r['total_item_count'];
        }
        return $totalQty;
    }

}
