<?php

class Wsu_Xreports_Block_Adminhtml_Report_Guestreport_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setTemplate('wsu/xreports/report/guestreport/grid.phtml');
        $this->setId('guestReportGrid');
        $this->setPagerVisibility(false);
        //$this->setCountTotals(true);
        $this->setDefaultSort('increment_id');
        $this->setDefaultDir('DESC');
        $this->setDefaultLimit(999999999);
        $this->setSaveParametersInSession(true);
		
		
    }

    protected function _prepareCollection() {
		$collection = Mage::registry('collection');
		
		$this->setCollection($collection);
		
        return parent::_prepareCollection();
    }



    protected function _prepareColumns() {
		$_col = $this->getRequest()->getParam('_col');
		$_col = Mage::getSingleton('core/session')->getFilteredCol();
		$post_col = $this->getRequest()->getParam('_col');
		
		$currencyCode = $this->getCurrentCurrencyCode();
		
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
		
		
		$dyno_col=(array)Mage::registry('dyno_col');
		foreach($dyno_col as $keyed){
			$this->addColumn("option_${keyed}", array(
				'header' => Mage::helper('xreports')->__('Option').' '.str_replace('_',' ',$keyed),
				'index' => "${keyed}",
				'type' => 'text',
				'width' => '100',
				'sortable' => true,
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Guestreport_Renderer_Option'
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
			$this->addColumn('dyno_options', array(
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

		//$this->addExportType('*/*/exportCsvEnhanced', Mage::helper('xreports')->__('Guest List'));
        $this->addExportType('*/*/exportGuestReportCsv', Mage::helper('xreports')->__('CSV'));
        //$this->addExportType('*/*/exportGuestReportExcel', Mage::helper('xreports')->__('Excel XML'));

        return parent::_prepareColumns();
    }

    public function getCurrentCurrencyCode() {
        return Mage::app()->getStore()->getBaseCurrencyCode();
    }









}
