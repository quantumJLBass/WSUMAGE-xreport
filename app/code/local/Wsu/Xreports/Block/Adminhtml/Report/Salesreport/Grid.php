<?php

class Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setTemplate('wsu/xreports/report/salesreport/grid.phtml');
        $this->setId('salesReportGrid');
        $this->setPagerVisibility(false);
        //$this->setCountTotals(true);
        $this->setDefaultSort('increment_id');
        $this->setDefaultDir('DESC');
        $this->setDefaultLimit(999999999);
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $today = date('Y-m-d', Mage::getModel('core/date')->timestamp(time()));
        $requestData = Mage::helper('adminhtml')->prepareFilterString($this->getRequest()->getParam('filter'));
        if (count($requestData) == 0) {
            $storeIds = $this->getRequest()->getParam('store_ids');
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
            $storeIds = $this->getRequest()->getParam('store_ids');
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
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
		$_col = $this->getRequest()->getParam('_col');
		$_col = Mage::getSingleton('core/session')->getFilteredCol();
		$post_col = $this->getRequest()->getParam('_col');
		if(!empty($post_col)){
			$_col = $post_col;
			Mage::getSingleton('core/session')->setFilteredCol($_col);
		}
		if($_col==null){
			$_col=array();
		}/**/
		
		//*/
		//var_dump($_col);
		if(empty($_col) || isset($_col['increment_id'])){
			$this->addColumn('increment_id', array(
				'header' => Mage::helper('xreports')->__('Order #'),
				'index' => 'increment_id',
				'width' => '80',
				'type' => 'text',
				'sortable' => true,
				'totals_label' => Mage::helper('xreports')->__('Total'),
				'html_decorators' => array('nobr')
			));
		}
		
		if(empty($_col) || isset($_col['created_at'])){
			$this->addColumn('created_at', array(
				'header' => Mage::helper('xreports')->__('Order Date'),
				'index' => 'main_table.created_at',
				'type' => 'datetime',
				'width' => '100',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Createdat'
			));
		}
		
		if(empty($_col) || isset($_col['status'])){
			$this->addColumn('status', array(
				'header' => Mage::helper('sales')->__('Status'),
				'index' => 'status',
				'type' => 'options',
				'width' => '70px',
				'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
			));
		}
		
		if(empty($_col) || isset($_col['sku'])){
			$this->addColumn('sku', array(
				'header' => Mage::helper('xreports')->__('Sku'),
				'align' => 'left',
				'index' => 'sku',
				'type' => 'text',
				'width' => '200',
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Sku',
				'sortable' => true
			));
		}

		
		if(empty($_col) || isset($_col['dyno_options'])){
			$this->addColumn('customer_email', array(
				'header' => Mage::helper('xreports')->__('Item options'),
				'align' => 'left',
				'width' => '250',
				'index' => 'increment_id',
				'type' => 'text',
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Item',
				'sortable' => true
			));
		}


		
		if(empty($_col) || isset($_col['customer_email'])){
			$this->addColumn('customer_email', array(
				'header' => Mage::helper('xreports')->__('Customer Email'),
				'align' => 'left',
				'width' => '250',
				'index' => 'customer_email',
				'type' => 'text',
				'sortable' => true
			));
		}
		
		if(empty($_col) || isset($_col['customer_group_id'])){
			$groups = Mage::getResourceModel('customer/group_collection')
					->addFieldToFilter('customer_group_id', array('gt' => 0))
					->load()
					->toOptionHash();
	
			$this->addColumn('customer_group_id', array(
				'header' => Mage::helper('xreports')->__('Customer Group'),
				'align' => 'left',
				'index' => 'customer_group_id',
				'width' => '200',
				'type' => 'options',
				'options' => $groups,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Customergroup',
				'sortable' => true
			));
		}
		
		if(empty($_col) || isset($_col['country_id'])){
			$this->addColumn('country_id', array(
				'header' => Mage::helper('xreports')->__('Country'),
				'index' => 'country_id',
				'width' => '200',
				'type' => 'country',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Country',
			));
		}
		
		if(empty($_col) || isset($_col['region'])){
			$this->addColumn('region', array(
				'header' => Mage::helper('xreports')->__('Region'),
				'index' => 'region',
				'type' => 'text',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Region',
			));
		}
		
		if(empty($_col) || isset($_col['city'])){	
			$this->addColumn('city', array(
				'header' => Mage::helper('xreports')->__('City'),
				'index' => 'city',
				'type' => 'text',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_City',
			));
		}
		
		if(empty($_col) || isset($_col['postcode'])){	
			$this->addColumn('postcode', array(
				'header' => Mage::helper('xreports')->__('Postcode'),
				'index' => 'postcode',
				'type' => 'text',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Postcode',
			));
		}
		
		if(empty($_col) || isset($_col['name'])){	
			$this->addColumn('name', array(
				'header' => Mage::helper('xreports')->__('Product Name'),
				'index' => 'name',
				'type' => 'text',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Productname',
			));
		}
		
		if(empty($_col) || isset($_col['total_qty_ordered'])){
			$this->addColumn('total_qty_ordered', array(
				'header' => Mage::helper('xreports')->__('Qty. Ordered'),
				'align' => 'left',
				'index' => 'total_qty_ordered',
				'type' => 'number',
				'total' => 'sum',
				'sortable' => true
			));
		}
		
		if(empty($_col) || isset($_col['qty_invoiced'])){
			$this->addColumn('qty_invoiced', array(
				'header' => Mage::helper('xreports')->__('Qty. Invoiced'),
				'align' => 'left',
				'index' => 'qty_invoiced',
				'type' => 'number',
				'total' => 'sum',
				'sortable' => true,
					//'renderer'          => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Qtyinvoiced',
			));
		}
		
		if(empty($_col) || isset($_col['qty_shipped'])){
			$this->addColumn('qty_shipped', array(
				'header' => Mage::helper('xreports')->__('Qty. Shipped'),
				'align' => 'left',
				'index' => 'qty_shipped',
				'type' => 'number',
				'total' => 'sum',
				'sortable' => true,
					//'renderer'          => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Qtyshipped',
			));
		}
		
		if(empty($_col) || isset($_col['qty_refunded'])){
			$this->addColumn('qty_refunded', array(
				'header' => Mage::helper('xreports')->__('Qty. Refunded'),
				'align' => 'left',
				'index' => 'qty_refunded',
				'type' => 'number',
				'total' => 'sum',
				'sortable' => true,
					//'renderer'          => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Qtyrefunded',
			));
		}
		
		if(empty($_col) || isset($_col['subtotal'])){	
			$currencyCode = $this->getCurrentCurrencyCode();
	
			$this->addColumn('subtotal', array(
				'header' => Mage::helper('xreports')->__('Subtotal'),
				'align' => 'right',
				'index' => 'subtotal',
				'currency_code' => $currencyCode,
				'width' => '100px',
				'type' => 'currency',
				'total' => 'sum',
				'sortable' => true
			));
		}
		
		if(empty($_col) || isset($_col['tax_amount'])){
			$this->addColumn('tax_amount', array(
				'header' => Mage::helper('xreports')->__('Tax'),
				'align' => 'right',
				'index' => 'main_table.tax_amount',
				'currency_code' => $currencyCode,
				'width' => '100px',
				'type' => 'currency',
				'total' => 'sum',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Tax',
			));
		}
		
		if(empty($_col) || isset($_col['discount_amount'])){
			$this->addColumn('discount_amount', array(
				'header' => Mage::helper('xreports')->__('Discount'),
				'align' => 'right',
				'index' => 'main_table.discount_amount',
				'currency_code' => $currencyCode,
				'width' => '100px',
				'type' => 'currency',
				'total' => 'sum',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Discount',
			));
		}
		
		if(empty($_col) || isset($_col['grand_total'])){
			$this->addColumn('grand_total', array(
				'header' => Mage::helper('xreports')->__('Total'),
				'align' => 'right',
				'index' => 'grand_total',
				'currency_code' => $currencyCode,
				'width' => '100px',
				'type' => 'currency',
				'total' => 'sum',
				'sortable' => true
			));
		}
		
		if(empty($_col) || isset($_col['total_invoiced'])){
			$this->addColumn('total_invoiced', array(
				'header' => Mage::helper('xreports')->__('Invoiced'),
				'align' => 'right',
				'index' => 'total_invoiced',
				'currency_code' => $currencyCode,
				'width' => '100px',
				'type' => 'currency',
				'total' => 'sum',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Invoiced'
			));
		}
		
		if(empty($_col) || isset($_col['total_refunded'])){
			$this->addColumn('total_refunded', array(
				'header' => Mage::helper('xreports')->__('Refunded'),
				'align' => 'right',
				'index' => 'total_refunded',
				'currency_code' => $currencyCode,
				'width' => '100px',
				'type' => 'currency',
				'total' => 'sum',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Refunded'
			));
		}
		
        $this->addExportType('*/*/exportSalesReportCsv', Mage::helper('xreports')->__('CSV'));
        $this->addExportType('*/*/exportSalesReportExcel', Mage::helper('xreports')->__('Excel XML'));

        return parent::_prepareColumns();
    }

    public function getCurrentCurrencyCode() {
        return Mage::app()->getStore()->getBaseCurrencyCode();
    }

}
