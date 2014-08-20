<?php

class Wsu_Xreports_Block_Adminhtml_Report_Guestreport_Filter_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * Report type options
     */
    protected $_reportTypeOptions = array();

    /**
     * Report field visibility
     */
    protected $_fieldVisibility = array();

    /**
     * Report field opions
     */
    protected $_fieldOptions = array();

    /**
     * Set field visibility
     *
     * @param string Field id
     * @param bool Field visibility
     */
    public function setFieldVisibility($fieldId, $visibility) {
        $this->_fieldVisibility[$fieldId] = (bool) $visibility;
    }

    /**
     * Get field visibility
     *
     * @param string Field id
     * @param bool Default field visibility
     * @return bool
     */
    public function getFieldVisibility($fieldId, $defaultVisibility = true) {
        if (!array_key_exists($fieldId, $this->_fieldVisibility)) {
            return $defaultVisibility;
        }
        return $this->_fieldVisibility[$fieldId];
    }

    /**
     * Set field option(s)
     *
     * @param string $fieldId Field id
     * @param mixed $option Field option name
     * @param mixed $value Field option value
     */
    public function setFieldOption($fieldId, $option, $value = null) {
        if (is_array($option)) {
            $options = $option;
        } else {
            $options = array($option => $value);
        }
        if (!array_key_exists($fieldId, $this->_fieldOptions)) {
            $this->_fieldOptions[$fieldId] = array();
        }
        foreach ($options as $k => $v) {
            $this->_fieldOptions[$fieldId][$k] = $v;
        }
    }

    /**
     * Add report type option
     *
     * @param string $key
     * @param string $value
     * @return Mage_Adminhtml_Block_Report_Filter_Form
     */
    public function addReportTypeOption($key, $value) {
        $this->_reportTypeOptions[$key] = $this->__($value);
        return $this;
    }

    /**
     * Add fieldset with general report fields
     *
     * @return Mage_Adminhtml_Block_Report_Filter_Form
     */
    protected function _prepareForm() {
        $actionUrl = $this->getUrl('*/*/sales');
        $form = new Varien_Data_Form(
                array('id' => 'filter_form', 'action' => $actionUrl, 'method' => 'get')
        );
        $htmlIdPrefix = 'sales_report_';
        $form->setHtmlIdPrefix($htmlIdPrefix);
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('reports')->__('Filter')));

        $dateFormatIso = 'dd-MM-yyyy';

        $fieldset->addField('store_ids', 'hidden', array(
            'name' => 'store_ids'
        ));

        $fieldset->addField('report_type', 'select', array(
            'name' => 'report_type',
            'options' => $this->_reportTypeOptions,
            'label' => Mage::helper('reports')->__('Match Period To'),
        ));

        $orderCollection = Mage::getModel('sales/order')
                ->getCollection()
                ->addAttributeToSelect('*');
        if (count($orderCollection) > 0) {
            $firstItem = $orderCollection->getFirstItem();
            $lastItem = $orderCollection->getLastItem();
            $firstItemCreatedAt = Mage::helper('core')->formatDate($firstItem->getCreatedAt() . '- 2 days', 'long', false);
            $lastItemCreatedAt = Mage::helper('core')->formatDate($lastItem->getCreatedAt() . '+ 2 days', 'long', false);
        }

        if (count($orderCollection) > 0) {
            $fieldset->addField('custom_date_range', 'select', array(
                'name' => 'custom_date_range',
                'options' => array(
                    'custom' => Mage::helper('reports')->__('Custom date'),
                    'today' => Mage::helper('reports')->__('Today'),
                    'yesterday' => Mage::helper('reports')->__('Yesterday'),
                    'last_7_days' => Mage::helper('reports')->__('Last 7 days'),
                    'last_week' => Mage::helper('reports')->__('Last week (Sunday - Saturday)'),
                    'last_business_week' => Mage::helper('reports')->__('Last business week (Monday - Friday)'),
                    'this_month' => Mage::helper('reports')->__('This month'),
                    'last_month' => Mage::helper('reports')->__('Last month'),
                    'first_to_last' => Mage::helper('reports')->__('* From ' . $firstItemCreatedAt . ' to ' . $lastItemCreatedAt)
                ),
                'label' => Mage::helper('reports')->__('Custom Date Range'),
                'title' => Mage::helper('reports')->__('Custom Date Range'),
                'onchange' => 'switchCustomDateRange(this.value);'
            ));
        } else {
            $fieldset->addField('custom_date_range', 'select', array(
                'name' => 'custom_date_range',
                'options' => array(
                    'custom' => Mage::helper('reports')->__('Custom date'),
                    'today' => Mage::helper('reports')->__('Today'),
                    'yesterday' => Mage::helper('reports')->__('Yesterday'),
                    'last_7_days' => Mage::helper('reports')->__('Last 7 days'),
                    'last_week' => Mage::helper('reports')->__('Last week (Sunday - Saturday)'),
                    'last_business_week' => Mage::helper('reports')->__('Last business week (Monday - Friday)'),
                    'this_month' => Mage::helper('reports')->__('This month'),
                    'last_month' => Mage::helper('reports')->__('Last month')
                ),
                'label' => Mage::helper('reports')->__('Custom Date Range'),
                'title' => Mage::helper('reports')->__('Custom Date Range'),
                'onchange' => 'switchCustomDateRange(this.value);'
            ));
        }

        $fieldset->addField('from', 'date', array(
            'name' => 'from',
            'format' => $dateFormatIso,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => Mage::helper('reports')->__('From'),
            'title' => Mage::helper('reports')->__('From'),
            'required' => true
        ));

        $fieldset->addField('to', 'date', array(
            'name' => 'to',
            'format' => $dateFormatIso,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => Mage::helper('reports')->__('To'),
            'title' => Mage::helper('reports')->__('To'),
            'required' => true
        ));

        $statuses = Mage::getModel('sales/order_config')->getStatuses();
        $values = array();
        foreach ($statuses as $code => $label) {
            if (false === strpos($code, 'pending')) {
                $values[] = array(
                    'label' => Mage::helper('reports')->__($label),
                    'value' => $code
                );
            }
        }

        $fieldset->addField('show_order_statuses', 'select', array(
            'name' => 'show_order_statuses',
            'label' => Mage::helper('reports')->__('Order Status'),
            'options' => array(
                '0' => Mage::helper('reports')->__('Any'),
                '1' => Mage::helper('reports')->__('Specified'),
            ),
            'note' => Mage::helper('reports')->__('Applies to Any of the Specified Order Statuses'),
                ), 'to');

        $fieldset->addField('order_statuses', 'multiselect', array(
            'name' => 'order_statuses',
            'values' => $values,
            'display' => 'none'
                ), 'show_order_statuses');

        // Define field dependencies
        if ($this->getFieldVisibility('show_order_statuses') && $this->getFieldVisibility('order_statuses')) {
            $this->setChild('form_after', $this->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
                            ->addFieldMap("{$htmlIdPrefix}show_order_statuses", 'show_order_statuses')
                            ->addFieldMap("{$htmlIdPrefix}order_statuses", 'order_statuses')
                            ->addFieldDependence('order_statuses', 'show_order_statuses', '1')
            );
        }

        //$fieldset->addField('show_empty_rows', 'select', array(
        //    'name'      => 'show_empty_rows',
        //    'options'   => array(
        //        '1' => Mage::helper('reports')->__('Yes'),
        //        '0' => Mage::helper('reports')->__('No')
        //    ),
        //    'label'     => Mage::helper('reports')->__('Empty Rows'),
        //    'title'     => Mage::helper('reports')->__('Empty Rows')
        //));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Initialize form fileds values
     * Method will be called after prepareForm and can be used for field values initialization
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _initFormValues() {
        $data = $this->getFilterData()->getData();
        foreach ($data as $key => $value) {
            if (is_array($value) && isset($value[0])) {
                $data[$key] = explode(',', $value[0]);
            }
        }
        $this->getForm()->addValues($data);
        return parent::_initFormValues();
    }

    /**
     * This method is called before rendering HTML
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _beforeToHtml() {
        $result = parent::_beforeToHtml();

        /** @var Varien_Data_Form_Element_Fieldset $fieldset */
        $fieldset = $this->getForm()->getElement('base_fieldset');

        if (is_object($fieldset) && $fieldset instanceof Varien_Data_Form_Element_Fieldset) {
            // apply field visibility
            foreach ($fieldset->getElements() as $field) {
                if (!$this->getFieldVisibility($field->getId())) {
                    $fieldset->removeField($field->getId());
                }
            }
            // apply field options
            foreach ($this->_fieldOptions as $fieldId => $fieldOptions) {
                $field = $fieldset->getElements()->searchById($fieldId);
                /** @var Varien_Object $field */
                if ($field) {
                    foreach ($fieldOptions as $k => $v) {
                        $field->setDataUsingMethod($k, $v);
                    }
                }
            }
        }

        return $result;
    }

}
