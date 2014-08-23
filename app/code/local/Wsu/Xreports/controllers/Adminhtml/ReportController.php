<?php

class Wsu_Xreports_Adminhtml_ReportController extends Mage_Adminhtml_Controller_Action {

    public function _initAction() {
        $this->loadLayout()
                ->_addBreadcrumb(Mage::helper('xreports')->__('xReports'), Mage::helper('xreports')->__('xReports'));
        return $this;
    }

    public function _initReportAction($blocks) {
        if (!is_array($blocks)) {
            $blocks = array($blocks);
        }

        $requestData = Mage::helper('adminhtml')->prepareFilterString($this->getRequest()->getParam('filter'));
        $params = new Varien_Object();

        foreach ($requestData as $key => $value) {
            if (!empty($value)) {
                $params->setData($key, $value);
            }
        }

        foreach ($blocks as $block) {
            if ($block) {
                $block->setPeriodType($params->getData('period_type'));
                $block->setFilterData($params);
            }
        }
        return $this;
    }

    public function salesByCustomerGroupAction() {
		$this->_title($this->__('xReports'))
				->_title($this->__('Sales by Customer Group'));

		$this->_initAction()
				->_setActiveMenu('report/xreports')
				->_addBreadcrumb(Mage::helper('xreports')->__('Sales by Customer Group'), Mage::helper('xreports')->__('Sales by Customer Group'));

		$gridBlock = $this->getLayout()->getBlock('adminhtml_report_salesbycustomergroup.grid');

		$filterFormBlock = $this->getLayout()->getBlock('grid.filter.form');

		$this->_initReportAction(array(
			$gridBlock,
			$filterFormBlock
		));

		$this->renderLayout();
    }

    public function exportSalesByCustomerGroupCsvAction() {
        $fileName = 'sales_by_customer_group.csv';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbycustomergroup_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile($fileName));
    }

    public function exportSalesByCustomerGroupExcelAction() {
        $fileName = 'sales_by_customer_group.xml';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbycustomergroup_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    public function salesByCountryAction() {
		$this->_title($this->__('xReports'))
				->_title($this->__('Sales by Country'));

		$this->_initAction()
				->_setActiveMenu('report/xreports')
				->_addBreadcrumb(Mage::helper('xreports')->__('Sales by Country'), Mage::helper('xreports')->__('Sales by Country'));

		$gridBlock = $this->getLayout()->getBlock('adminhtml_report_salesbycountry.grid');

		$filterFormBlock = $this->getLayout()->getBlock('grid.filter.form');

		$this->_initReportAction(array(
			$gridBlock,
			$filterFormBlock
		));

		$this->renderLayout();
    }

    public function exportSalesByCountryCsvAction() {
        $fileName = 'sales_by_country.csv';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbycountry_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile($fileName));
    }

    public function exportSalesByCountryExcelAction() {
        $fileName = 'sales_by_country.xml';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbycountry_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    public function salesByCouponCodeAction() {
		$this->_title($this->__('xReports'))
				->_title($this->__('Sales by Coupon Code'));

		$this->_initAction()
				->_setActiveMenu('report/xreports')
				->_addBreadcrumb(Mage::helper('xreports')->__('Sales by Coupon Code'), Mage::helper('xreports')->__('Sales by Coupon Code'));

		$gridBlock = $this->getLayout()->getBlock('adminhtml_report_salesbycouponcode.grid');

		$filterFormBlock = $this->getLayout()->getBlock('grid.filter.form');

		$this->_initReportAction(array(
			$gridBlock,
			$filterFormBlock
		));

		$this->renderLayout();
    }

    public function exportSalesByCouponCodeCsvAction() {
        $fileName = 'sales_by_coupon_code.csv';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbycouponcode_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile($fileName));
    }

    public function exportSalesByCouponCodeExcelAction() {
        $fileName = 'sales_by_country.xml';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbycouponcode_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    public function salesReportAction() {
            $this->_title($this->__('xReports'))
                    ->_title($this->__('Sales Report'));
			if((Mage::registry('csv_export')!=true)){
				Mage::register('csv_export', false);
			}
            $this->_initAction()
                    ->_setActiveMenu('report/xreports')
                    ->_addBreadcrumb(Mage::helper('xreports')->__('Sales Report'), Mage::helper('xreports')->__('Sales Report'))
                    ->_addContent($this->getLayout()->createBlock('xreports/adminhtml_report_salesreport'));
            $this->renderLayout();
			Mage::unregister('csv_export');
    }

    public function exportSalesReportCsvAction() {
        $fileName = 'sales_report.csv';
		Mage::register('csv_export', true);
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesreport_grid');
        $this->_initReportAction($grid);
		
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile($fileName));
    }

    public function exportSalesReportExcelAction() {
        $fileName = 'sales_report.xml';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesreport_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    public function salesByProductAction() {
		$this->_title($this->__('xReports'))
				->_title($this->__('Sales by Product'));

		$this->_initAction()
				->_setActiveMenu('report/xreports')
				->_addBreadcrumb(Mage::helper('xreports')->__('Sales by Product'), Mage::helper('xreports')->__('Sales by Product'));

		$gridBlock = $this->getLayout()->getBlock('adminhtml_report_salesbyproduct.grid');

		$filterFormBlock = $this->getLayout()->getBlock('grid.filter.form');

		$this->_initReportAction(array(
			$gridBlock,
			$filterFormBlock
		));

		$this->renderLayout();
    }

    public function exportSalesByProductCsvAction() {
        $fileName = 'sales_by_product.csv';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbyproduct_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile($fileName));
    }

    public function exportSalesByProductExcelAction() {
        $fileName = 'sales_by_product.xml';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbyproduct_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    public function salesByHourAction() {
		$this->_title($this->__('xReports'))
				->_title($this->__('Sales by Hour'));

		$this->_initAction()
				->_setActiveMenu('report/xreports')
				->_addBreadcrumb(Mage::helper('xreports')->__('Sales by Hour'), Mage::helper('xreports')->__('Sales by Hour'));

		$requestData = Mage::helper('adminhtml')->prepareFilterString($this->getRequest()->getParam('filter'));
		if (count($requestData) > 0) {
			$storeIds = explode(',', $this->getRequest()->getParam('store_ids'));
			if ( is_null($this->getRequest()->getParam('store_ids')) ) {
				$orders = Mage::getModel('sales/order')->getCollection();
			} else {
				$orders = Mage::getModel('sales/order')->getCollection()
						->addFieldToFilter('store_id', array('in' => $storeIds));
			}
			$strStatuses = null;
			if (isset($requestData['order_statuses']) && $requestData['order_statuses'] != null) {
				$orderStatuses = explode(',', $requestData['order_statuses'][0]);
				$arrOrderStatuses = array();
				foreach ($orderStatuses as $status) {
					$arrOrderStatuses[] = '\'' . $status . '\'';
				}
				$strStatuses = implode(',', $arrOrderStatuses);
			} else {
				$strStatuses = null;
			}
			if (count($orders) > 0) {
				$from = str_replace(' ', '', date('Y-m-d', strtotime($requestData['from'])));
				$to = str_replace(' ', '', date('Y-m-d', strtotime($requestData['to'])));
				$resource = Mage::getSingleton('core/resource');
				$readConnection = $resource->getConnection('core_read');
				$writeConnection = $resource->getConnection('core_write');
				$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_hour');
				$writeConnection->query($delete);
				$insert = 'INSERT INTO ' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . ' (h,total_item_count,grand_total) VALUES(0,0,"0.0000"),(1,0,"0.0000"),(2,0,"0.0000"),(3,0,"0.0000"),(4,0,"0.0000"),(5,0,"0.0000"),(6,0,"0.0000"),(7,0,"0.0000"),(8,0,"0.0000"),(9,0,"0.0000"),(10,0,"0.0000"),(11,0,"0.0000"),(12,0,"0.0000"),(13,0,"0.0000"),(14,0,"0.0000"),(15,0,"0.0000"),(16,0,"0.0000"),(17,0,"0.0000"),(18,0,"0.0000"),(19,0,"0.0000"),(20,0,"0.0000"),(21,0,"0.0000"),(22,0,"0.0000"),(23,0,"0.0000")';
				$writeConnection->query($insert);
				if ( is_null($this->getRequest()->getParam('store_ids')) ) {
					if ($strStatuses != null) {
						$query = 'SELECT `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` AS `hour`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`total_item_count`), 0) AS `total_item_count`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`grand_total`), 0) AS `grand_total`, `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` FROM `' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '` RIGHT JOIN `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '` ON HOUR(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at`) = `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` WHERE (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`status` IN(' . $strStatuses . ')) AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` >= "' . $from . '") AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` <= "' . $to . '") GROUP BY `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h`';
					} else {
						$query = 'SELECT `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` AS `hour`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`total_item_count`), 0) AS `total_item_count`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`grand_total`), 0) AS `grand_total`, `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` FROM `' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '` RIGHT JOIN `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '` ON HOUR(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at`) = `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` WHERE (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` >= "' . $from . '") AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` <= "' . $to . '") GROUP BY `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h`';
					}
				} else {
					if ($strStatuses != null) {
						$query = 'SELECT `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` AS `hour`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`total_item_count`), 0) AS `total_item_count`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`grand_total`), 0) AS `grand_total`, `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` FROM `' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '` RIGHT JOIN `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '` ON HOUR(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at`) = `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` WHERE (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`status` IN(' . $strStatuses . ')) AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`store_id` IN(' . $this->getRequest()->getParam('store_ids') . ')) AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` >= "' . $from . '") AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` <= "' . $to . '") GROUP BY `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h`';
					} else {
						$query = 'SELECT `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` AS `hour`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`total_item_count`), 0) AS `total_item_count`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`grand_total`), 0) AS `grand_total`, `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` FROM `' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '` RIGHT JOIN `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '` ON HOUR(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at`) = `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h` WHERE (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`store_id` IN(' . $this->getRequest()->getParam('store_ids') . ')) AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` >= "' . $from . '") AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` <= "' . $to . '") GROUP BY `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`.`h`';
					}
				}
				$results = $readConnection->fetchAll($query);
				if (count($results) > 0) {
					foreach ($results as $order) {
						$update = 'UPDATE ' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . ' SET total_item_count=' . $order['total_item_count'] . ', grand_total=' . $order['grand_total'] . ' WHERE h=' . (int) $order['hour'];
						$writeConnection->query($update);
					}
				} else {
					$resource = Mage::getSingleton('core/resource');
					$writeConnection = $resource->getConnection('core_write');
					$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_hour');
					$writeConnection->query($delete);
				}
			} else {
				$resource = Mage::getSingleton('core/resource');
				$writeConnection = $resource->getConnection('core_write');
				$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_hour');
				$writeConnection->query($delete);
			}
		} else {
			$resource = Mage::getSingleton('core/resource');
			$writeConnection = $resource->getConnection('core_write');
			$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_hour');
			$writeConnection->query($delete);
		}

		$gridBlock = $this->getLayout()->getBlock('adminhtml_report_salesbyhour.grid');

		$filterFormBlock = $this->getLayout()->getBlock('grid.filter.form');

		$this->_initReportAction(array(
			$gridBlock,
			$filterFormBlock
		));

		$this->renderLayout();
    }

    public function exportSalesByHourCsvAction() {
        $fileName = 'sales_by_hour.csv';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbyhour_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile($fileName));
    }

    public function exportSalesByHourExcelAction() {
        $fileName = 'sales_by_product.xml';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbyhour_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    public function salesByDayOfWeekAction() {

		$this->_title($this->__('xReports'))
				->_title($this->__('Sales by Day of Week'));

		$this->_initAction()
				->_setActiveMenu('report/xreports')
				->_addBreadcrumb(Mage::helper('xreports')->__('Sales by Day of Week'), Mage::helper('xreports')->__('Sales by Day of Week'));

		$requestData = Mage::helper('adminhtml')->prepareFilterString($this->getRequest()->getParam('filter'));
		if (count($requestData) > 0) {
			$storeIds = explode(',', $this->getRequest()->getParam('store_ids'));
			if ( is_null($this->getRequest()->getParam('store_ids')) ) {
				$orders = Mage::getModel('sales/order')->getCollection();
			} else {
				$orders = Mage::getModel('sales/order')->getCollection()
						->addFieldToFilter('store_id', array('in' => $storeIds));
			}
			$strStatuses = null;
			if (isset($requestData['order_statuses']) && $requestData['order_statuses'] != null) {
				$orderStatuses = explode(',', $requestData['order_statuses'][0]);
				$arrOrderStatuses = array();
				foreach ($orderStatuses as $status) {
					$arrOrderStatuses[] = '\'' . $status . '\'';
				}
				$strStatuses = implode(',', $arrOrderStatuses);
			} else {
				$strStatuses = null;
			}
			if (count($orders) > 0) {
				$from = str_replace(' ', '', date('Y-m-d', strtotime($requestData['from'])));
				$to = str_replace(' ', '', date('Y-m-d', strtotime($requestData['to'])));
				$resource = Mage::getSingleton('core/resource');
				$readConnection = $resource->getConnection('core_read');
				$writeConnection = $resource->getConnection('core_write');
				$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek');
				$writeConnection->query($delete);
				$insert = 'INSERT INTO ' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . ' (d, total_item_count, grand_total,n) VALUES("Sunday",0,"0.0000",1),("Monday",0,"0.0000",2),("Tuesday",0,"0.0000",3),("Wednesday",0,"0.0000",4),("Thursday",0,"0.0000",5),("Friday",0,"0.0000",6),("Saturday",0,"0.0000",7)';
				$writeConnection->query($insert);
				if ( is_null($this->getRequest()->getParam('store_ids')) ) {
					if ($strStatuses != null) {
						$query = 'SELECT `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` AS `day`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`total_item_count`), 0) AS `total_item_count`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`grand_total`), 0) AS `grand_total`, `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` FROM `' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '` RIGHT JOIN `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '` ON DATE_FORMAT(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at`, "%W") = `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` WHERE (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`status` IN(' . $strStatuses . ')) AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` >= "' . $from . '") AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` <= "' . $to . '") GROUP BY `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d`';
					} else {
						$query = 'SELECT `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` AS `day`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`total_item_count`), 0) AS `total_item_count`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`grand_total`), 0) AS `grand_total`, `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` FROM `' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '` RIGHT JOIN `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '` ON DATE_FORMAT(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at`, "%W") = `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` WHERE (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` >= "' . $from . '") AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` <= "' . $to . '") GROUP BY `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d`';
					}
				} else {
					if ($strStatuses != null) {
						$query = 'SELECT `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` AS `day`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`total_item_count`), 0) AS `total_item_count`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`grand_total`), 0) AS `grand_total`, `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` FROM `' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '` RIGHT JOIN `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '` ON DATE_FORMAT(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at`, "%W") = `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` WHERE (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`status` IN(' . $strStatuses . ')) AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`store_id` IN(' . $this->getRequest()->getParam('store_ids') . ')) AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` >= "' . $from . '") AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` <= "' . $to . '") GROUP BY `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d`';
					} else {
						$query = 'SELECT `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` AS `day`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`total_item_count`), 0) AS `total_item_count`, IFNULL(SUM(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`grand_total`), 0) AS `grand_total`, `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` FROM `' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '` RIGHT JOIN `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '` ON DATE_FORMAT(`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at`, "%W") = `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d` WHERE (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`store_id` IN(' . $this->getRequest()->getParam('store_ids') . ')) AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` >= "' . $from . '") AND (`' . Mage::getSingleton('core/resource')->getTableName('sales_flat_order') . '`.`created_at` <= "' . $to . '") GROUP BY `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`.`d`';
					}
				}
				$results = $readConnection->fetchAll($query);
				if (count($results) > 0) {
					foreach ($results as $order) {
						$update = 'UPDATE ' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . ' SET total_item_count=' . $order['total_item_count'] . ', grand_total=' . $order['grand_total'] . ' WHERE d="' . $order['day'] . '"';
						$writeConnection->query($update);
					}
				} else {
					$resource = Mage::getSingleton('core/resource');
					$writeConnection = $resource->getConnection('core_write');
					$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek');
					$writeConnection->query($delete);
				}
			} else {
				$resource = Mage::getSingleton('core/resource');
				$writeConnection = $resource->getConnection('core_write');
				$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek');
				$writeConnection->query($delete);
			}
		} else {
			$resource = Mage::getSingleton('core/resource');
			$writeConnection = $resource->getConnection('core_write');
			$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek');
			$writeConnection->query($delete);
		}

		$gridBlock = $this->getLayout()->getBlock('adminhtml_report_salesbydayofweek.grid');

		$filterFormBlock = $this->getLayout()->getBlock('grid.filter.form');

		$this->_initReportAction(array(
			$gridBlock,
			$filterFormBlock
		));

		$this->renderLayout();

    }

    public function exportSalesByDayOfWeekCsvAction() {
        $fileName = 'sales_by_day_of_week.csv';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbydayofweek_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile($fileName));
    }

    public function exportSalesByDayOfWeekExcelAction() {
        $fileName = 'sales_by_day_of_week.xml';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbydayofweek_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    public function salesByNewAndReturningAction() {
		$this->_title($this->__('xReports'))
				->_title($this->__('New and Returning Customers'));

		$this->_initAction()
				->_setActiveMenu('report/xreports')
				->_addBreadcrumb(Mage::helper('xreports')->__('New and Returning Customers'), Mage::helper('xreports')->__('New and Returning Customers'));

		$requestData = Mage::helper('adminhtml')->prepareFilterString($this->getRequest()->getParam('filter'));
		if (count($requestData) > 0) {
			$storeIds = explode(',', $this->getRequest()->getParam('store_ids'));
			if ( is_null($this->getRequest()->getParam('store_ids')) ) {
				$orders = Mage::getModel('sales/order')->getCollection();
			} else {
				$orders = Mage::getModel('sales/order')->getCollection()
						->addFieldToFilter('store_id', array('in' => $storeIds));
			}
			if (count($orders) > 0) {
				$from = str_replace(' ', '', date('Y-m-d', strtotime($requestData['from'])));
				$to = str_replace(' ', '', date('Y-m-d', strtotime($requestData['to'])));
				$resource = Mage::getSingleton('core/resource');
				$readConnection = $resource->getConnection('core_read');
				$writeConnection = $resource->getConnection('core_write');
				$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_newandreturning');
				$writeConnection->query($delete);
				if ($requestData['period_type'] == 'day') {
					$n = 1;
					foreach ($this->getDatesFromRange($from, $to) as $date) {
						$collection = Mage::getModel('sales/order')->getCollection()
								->addFieldToFilter('created_at', array('from' => $date, 'to' => $date . '+ 2 days'));
						$collection->getSelect()->where('customer_id IS NOT NULL');
						$new = 0;
						$returning = 0;
						$total = 0;
						foreach ($collection as $order) {
							$orders = Mage::getModel('sales/order')->getCollection()
									->addFieldToFilter('customer_id', array('eq' => $order->getCustomerId()));
							if (count($orders) >= 2) {
								$returning += $order->getTotalItemCount();
								$new += 0;
							} else {
								$new += $order->getTotalItemCount();
								$returning += 0;
							}
						}
						$total = $new + $returning;
						if ($total == 0) {
							$percentOfNew = ' 0%';
							$percentOfReturning = ' 0%';
						} else {
							$percentOfNew = round(($new / $total) * 100, 1) . ' %';
							$percentOfReturning = round(($returning / $total) * 100, 1) . ' %';
						}
						$dateTimestamp = Mage::getModel('core/date')->timestamp(strtotime($date . '+' . '2 days'));
						$insert = 'INSERT INTO ' . Mage::getSingleton('core/resource')->getTableName('xreports_newandreturning') . ' (period, new_customers, returning_customers, percent_of_new, percent_of_returning, n) VALUES("' . date('M d, Y', $dateTimestamp) . '",' . $new . ',' . $returning . ',"' . $percentOfNew . '","' . $percentOfReturning . '",' . $n . ')';
						$writeConnection->query($insert);
						$n++;
					}
				} else if ($requestData['period_type'] == 'month') {
					$n = 1;
					foreach ($this->getMonths($from, $to) as $month) {
						$data = explode('/', $month);
						$num = cal_days_in_month(CAL_GREGORIAN, $data[0], $data[1]);
						$collection = Mage::getModel('sales/order')->getCollection()
								->addFieldToFilter('created_at', array('from' => $data[1] . '-' . $data[0] . '-01', 'to' => $data[1] . '-' . $data[0] . '-' . $num));
						$collection->getSelect()->where('customer_id IS NOT NULL');
						$new = 0;
						$returning = 0;
						foreach ($collection as $order) {
							$orders = Mage::getModel('sales/order')->getCollection()
									->addFieldToFilter('customer_id', array('eq' => $order->getCustomerId()));
							if (count($orders) >= 2) {
								$returning += $order->getTotalItemCount();
								$new += 0;
							} else {
								$new += $order->getTotalItemCount();
								$returning += 0;
							}
						}
						$total = $new + $returning;
						$percentOfNew = round(($new / $total) * 100, 1) . ' %';
						$percentOfReturning = round(($returning / $total) * 100, 1) . ' %';
						$insert = 'INSERT INTO ' . Mage::getSingleton('core/resource')->getTableName('xreports_newandreturning') . ' (period, new_customers, returning_customers, percent_of_new, percent_of_returning, n) VALUES("' . $month . '",' . $new . ',' . $returning . ',"' . $percentOfNew . '","' . $percentOfReturning . '",' . $n . ')';
						$writeConnection->query($insert);
						$n++;
					}
				} else {
					$arrFromYears = explode('-', $from);
					$fromYear = (int) $arrFromYears[0];
					$arrToYears = explode('-', $to);
					$toYear = (int) $arrToYears[0];
					$n = 1;
					for ($i = $fromYear; $i <= $toYear; $i++) {
						$collection = Mage::getModel('sales/order')->getCollection()
								->addFieldToFilter('created_at', array('from' => $i . '-01-01', 'to' => $i . '-12-31'));
						$collection->getSelect()->where('customer_id IS NOT NULL');
						$new = 0;
						$returning = 0;
						$total = 0;
						foreach ($collection as $order) {
							$orders = Mage::getModel('sales/order')->getCollection()
									->addFieldToFilter('customer_id', array('eq' => $order->getCustomerId()));
							if (count($orders) >= 2) {
								$returning += $order->getTotalItemCount();
								$new += 0;
							} else {
								$new += $order->getTotalItemCount();
								$returning += 0;
							}
						}
						$total = $new + $returning;
						if ($total == 0) {
							$percentOfNew = ' 0%';
							$percentOfReturning = ' 0%';
						} else {
							$percentOfNew = round(($new / $total) * 100, 1) . ' %';
							$percentOfReturning = round(($returning / $total) * 100, 1) . ' %';
						}
						$insert = 'INSERT INTO ' . Mage::getSingleton('core/resource')->getTableName('xreports_newandreturning') . ' (period, new_customers, returning_customers, percent_of_new, percent_of_returning, n) VALUES("' . $i . '",' . $new . ',' . $returning . ',"' . $percentOfNew . '","' . $percentOfReturning . '",' . $n . ')';
						$writeConnection->query($insert);
						$n++;
					}
				}
			} else {
				$resource = Mage::getSingleton('core/resource');
				$writeConnection = $resource->getConnection('core_write');
				$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_newandreturning');
				$writeConnection->query($delete);
			}
		} else {
			$resource = Mage::getSingleton('core/resource');
			$writeConnection = $resource->getConnection('core_write');
			$delete = 'DELETE FROM ' . Mage::getSingleton('core/resource')->getTableName('xreports_newandreturning');
			$writeConnection->query($delete);
		}

		$gridBlock = $this->getLayout()->getBlock('adminhtml_report_salesbynewandreturning.grid');

		$filterFormBlock = $this->getLayout()->getBlock('grid.filter.form');

		$this->_initReportAction(array(
			$gridBlock,
			$filterFormBlock
		));

		$this->renderLayout();
    }

    public function exportSalesByNewAndReturningCsvAction() {
        $fileName = 'new_and_returning_customers.csv';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbynewandreturning_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile($fileName));
    }

    public function exportSalesByNewAndReturningExcelAction() {
        $fileName = 'new_and_returning_customers.xml';
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_salesbynewandreturning_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }










    public function guestReportAction() {
            $this->_title($this->__('xReports'))->_title($this->__('Guest Report'));
			if((Mage::registry('csv_export')!=true)){ Mage::register('csv_export', false); }
			Mage::register( 'collection', Mage::helper('xreports')->_findCollection() );
            $this->_initAction()
                    ->_setActiveMenu('report/xreports')
                    ->_addBreadcrumb(Mage::helper('xreports')->__('Guest Report'), Mage::helper('xreports')->__('Guest Report'))
                    ->_addContent($this->getLayout()->createBlock('xreports/adminhtml_report_guestreport'));
            $this->renderLayout();
			Mage::unregister('csv_export');
    }

    public function exportGuestReportCsvAction() {
        $fileName = 'guest_report-' . gmdate('YmdHis') . '.csv';
		Mage::register( 'collection', Mage::helper('xreports')->_findCollection() );
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_guestreport_grid');
        $this->_initReportAction($grid);
		
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile($fileName));
    }

    public function exportGuestReportExcelAction() {
        $fileName = 'guest_report.xml';
		Mage::register( 'collection', Mage::helper('xreports')->_findCollection() );
        $grid = $this->getLayout()->createBlock('xreports/adminhtml_report_guestreport_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }


















    public function getSkusAction() {
        $data = $this->getRequest()->getPost();
        foreach ($data as $key => $value) {
            if ($key == 'sku') {
                $sku = $value;
            }
        }
        $products = Mage::getModel('catalog/product')->getCollection()
                ->addFieldToFilter('sku', array('like' => '%' . $sku . '%'));
        if (count($products) > 0) {
            foreach ($products as $product) {
                $li .= "<li>" . $product->getSku() . "</li>" . "\n";
            }
            print "<ul>$li</ul>";
        }
    }

    public function getSalesByCountryDataAction() {
        $storeIds = $this->getRequest()->getParam('store_ids');
        $from = date('Y-m-d', strtotime($this->getRequest()->getParam('from')));
        $to = date('Y-m-d', strtotime($this->getRequest()->getParam('to')));
        $orderStatuses = $this->getRequest()->getParam('order_statuses');
        $collection = Mage::getModel('sales/order')->getCollection()
                ->addFieldToSelect('billing_address_id')
                ->addFieldToFilter('created_at', array('from' => $from, 'to' => $to));
        if ($orderStatuses != null) {
            $arrOrderStatuses = explode(',', $orderStatuses);
            $collection->getSelect()->where('status IN(?)', $arrOrderStatuses);
        }
        if ($storeIds != null) {
            $arrStoreIds = explode(',', $storeIds);
            $collection->getSelect()->where('store_id IN(?)', $arrStoreIds);
        }
        $collection->getSelect()
                ->columns('IFNULL(SUM(main_table.total_item_count), 0) as total_item_count')
                ->columns('IFNULL(SUM(main_table.grand_total), 0) as grand_total')
                ->join(array('sfoa' => Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address')), 'sfoa.entity_id=main_table.billing_address_id', array('sfoa.country_id'))
                ->group('sfoa.country_id');
        $data = array();
        foreach ($collection as $order) {
            if ($order->getCountryId() != null) {
                if (Mage::app()->getLocale()->getCountryTranslation($order->getCountryId()) != null) {
                    $data[] = array('label' => Mage::app()->getLocale()->getCountryTranslation($order->getCountryId()), 'value' => $order->getTotalItemCount());
                }
            }
        }
        $this->getResponse()->setBody(json_encode($data));
    }

    public function getSalesByCustomerGroupDataAction() {
        $storeIds = $this->getRequest()->getParam('store_ids');
        $from = date('Y-m-d', strtotime($this->getRequest()->getParam('from')));
        $to = date('Y-m-d', strtotime($this->getRequest()->getParam('to')));
        $orderStatuses = $this->getRequest()->getParam('order_statuses');
        $collection = Mage::getModel('sales/order')->getCollection()
                ->addFieldToSelect('customer_group_id')
                ->addFieldToFilter('created_at', array('from' => $from, 'to' => $to));
        if ($orderStatuses != null) {
            $arrOrderStatuses = explode(',', $orderStatuses);
            $collection->getSelect()->where('status IN(?)', $arrOrderStatuses);
        }
        if ($storeIds != null) {
            $arrStoreIds = explode(',', $storeIds);
            $collection->getSelect()->where('store_id IN(?)', $arrStoreIds);
        }
        $collection->getSelect()
                ->columns('IFNULL(SUM(main_table.total_item_count), 0) as total_item_count')
                ->columns('IFNULL(SUM(main_table.grand_total), 0) as grand_total')
                ->group('customer_group_id');
        $data = array();
        foreach ($collection as $order) {
            $customerGroup = Mage::getModel('customer/group')->load($order->getCustomerGroupId());
            if ($customerGroup->getCustomerGroupCode() != null) {
                $data[] = array('label' => $customerGroup->getCustomerGroupCode(), 'value' => $order->getTotalItemCount());
            }
        }
        $this->getResponse()->setBody(json_encode($data));
    }

    public function getSalesByHourDataAction() {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $query = 'SELECT * FROM `' . Mage::getSingleton('core/resource')->getTableName('xreports_hour') . '`';
        $results = $readConnection->fetchAll($query);
        $data = array();
        foreach ($results as $r) {
            if ($r['h'] < 10) {
                $data[] = array('label' => '0' . $r['h'], 'value' => $r['total_item_count']);
            } else {
                $data[] = array('label' => $r['h'], 'value' => $r['total_item_count']);
            }
        }
        $this->getResponse()->setBody(json_encode($data));
    }

    public function getSalesByDayOfWeekDataAction() {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $query = 'SELECT * FROM `' . Mage::getSingleton('core/resource')->getTableName('xreports_dayofweek') . '`';
        $results = $readConnection->fetchAll($query);
        $data = array();
        foreach ($results as $r) {
            $data[] = array('label' => $r['d'], 'value' => $r['total_item_count']);
        }
        $this->getResponse()->setBody(json_encode($data));
    }

    public function getSalesByNewAndReturningDataAction() {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $query = 'SELECT * FROM `' . Mage::getSingleton('core/resource')->getTableName('xreports_newandreturning') . '`';
        $results = $readConnection->fetchAll($query);
        $data = array();
        foreach ($results as $r) {
            $data[] = array('label' => $r['period'], 'value_1' => $r['new_customers'], 'value_2' => $r['returning_customers']);
        }
        $this->getResponse()->setBody(json_encode($data));
    }

    public function getDatesFromRange($startDate, $endDate) {
        $return = array($startDate);
        $start = $startDate;
        $i = 1;
        if (strtotime($startDate) < strtotime($endDate)) {
            while (strtotime($start) < strtotime($endDate)) {
                $start = date('Y-m-d', strtotime($startDate . '+' . $i . ' days'));
                $return[] = $start;
                $i++;
            }
        }
        return $return;
    }

    public function getMonths($date1, $date2) {
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        $my = date('mY', $time2);

        $months = array();
        $f = '';

        while ($time1 < $time2) {
            $time1 = strtotime((date('Y-m-d', $time1) . ' +15days'));
            if (date('m/Y', $time1) != $f) {
                $f = date('m/Y', $time1);
                if (date('mY', $time1) != $my && ($time1 < $time2))
                    $months[] = date('m/Y', $time1);
            }
        }
        $months[] = date('m/Y', $time2);
        return $months;
    }    

    public function denyAction() {
        $this->_title($this->__('xReports'))
                ->_title($this->__('Access Denied'));

        $this->_initAction()
                ->_setActiveMenu('report/xreports')
                ->_addBreadcrumb(Mage::helper('xreports')->__('Access Denied'), Mage::helper('xreports')->__('Access Denied'));
        $enabled = Mage::app()->getRequest()->getParam('enabled');
        if ($enabled == 0) {
            $str = 'Incorrect license key.';
        } else if ($enabled == 2) {
            $str = 'License key for this extension has expired.';
        }
        if (isset($str) && $str != null) {
            $block = $this->getLayout()
                    ->createBlock('core/text', 'access-denied-block')
                    ->setText('<h2>' . $str . '</h2>');

            $this->_addContent($block);
        } else {
            $block = $this->getLayout()
                    ->createBlock('core/text', 'access-denied-block');

            $this->_addContent($block);
        }
        $this->renderLayout();
    }

}
