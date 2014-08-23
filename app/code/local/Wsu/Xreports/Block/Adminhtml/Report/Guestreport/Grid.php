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



    protected function _addColumnFilterToCollection($column){
        $filterArr = Mage::registry('preparedFilter');
        /*if (($column->getId() === 'store_id' || $column->getId() === 'status') 
			&& $column->getFilter()->getValue() && strpos($column->getFilter()->getValue(), ',')) {
            $_inNin = explode(',', $column->getFilter()->getValue());
            $inNin = array();
            foreach ($_inNin as $k => $v) {
                if (is_string($v) && strlen(trim($v))) {
                    $inNin[] = trim($v);
                }
            }
            if (count($inNin)>1 && in_array($inNin[0], array('in', 'nin'))) {
                $in = $inNin[0];
                $values = array_slice($inNin, 1);
                $this->getCollection()->addFieldToFilter($column->getId(), array($in => $values));
            } else {
                parent::_addColumnFilterToCollection($column);
            }
        } elseif (is_array($filterArr) && array_key_exists($column->getId(), $filterArr) && isset($filterArr[$column->getId()])) {
            $this->getCollection()->addFieldToFilter($column->getId(), $filterArr[$column->getId()]);
        } else {
            parent::_addColumnFilterToCollection($column);
        }*/
		
		//print((string)$this->getCollection()->getSelect());
		//var_dump($filterArr);
        //Zend_Debug::dump((string)$this->getCollection()->getSelect(), 'Prepared filter:');
		
		/*
		Mage::unregister('dyno_col'); 
		Mage::register('dyno_col', Mage::helper('xreports')->dynoColCallback($this->getCollection()));
		$newCollection = new Varien_Data_Collection();
		$dyno_col=(array)Mage::registry('dyno_col');
		
		foreach($this->getCollection() as $item){
			foreach($dyno_col as $keyed){
				$item->setData("${keyed}",Mage::helper('xreports')->dynoColValue($item,$keyed));
			 }
			 $newCollection->addItem($item);
		}
		
		$this->setCollection($newCollection);
		var_dump($newCollection);
		
		die();*/

        return $this;
    }
/*	*/


    protected function _prepareColumns() {
		$_col = $this->getRequest()->getParam('_col');
		$_col = Mage::getSingleton('core/session')->getFilteredCol();
		$post_col = $this->getRequest()->getParam('_col');
		
		$currencyCode = $this->getCurrentCurrencyCode();
		
		if(!empty($post_col)){
			$_col = $post_col;
			Mage::getSingleton('core/session')->setFilteredCol($_col);
		}
		if(!isset($_col)){
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
		if(empty($_col) || isset($_col['name'])){
			$this->addColumn('name', array(
				'header' => Mage::helper('xreports')->__('Name'),
				'align' => 'left',
				'index' => 'name',
				'type' => 'text',
				'width' => '200',
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Name',
				'sortable' => true
			));
		}		
		if(empty($_col) || isset($_col['customer_firstname'])){
			$this->addColumn('customer_firstname', array(
				'header' => Mage::helper('xreports')->__('Customer first name'),
				'align' => 'left',
				'width' => '250',
				'index' => 'customer_firstname',
				'type' => 'text',
				'sortable' => true
			));
		}
		if(empty($_col) || isset($_col['customer_lastname'])){
			$this->addColumn('customer_lastname', array(
				'header' => Mage::helper('xreports')->__('Customer last name'),
				'align' => 'left',
				'width' => '250',
				'index' => 'customer_lastname',
				'type' => 'text',
				'sortable' => true
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
				'renderer' => 'Wsu_Xreports_Block_Adminhtml_Report_Salesreport_Renderer_Createdat',
				'filter_condition_callback' => array($this, '_fromFilter'),
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

	protected function _fromFilter($collection, $column) {
        /* if (!$value = $column->getFilter()->getValue()) {
            return $this;
        }
		
		var_dump($value);
		
		
		if(isset($value['from'])){
        	//$this->getCollection()->getSelect()->where( "main_table.created_at >= ?" , $value['from']->toString('Y-m-d H:i:s') );
		}
		
		
		Format our dates */

		
		
		
		
		
        return $this;
    }








}
