<?php
namespace EWD\Stock\Block\Adminhtml\Warehouse\Edit\Tab;

use \Magento\Backend\Block\Widget\Form\Generic;
use \Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Cms page edit form main tab
 * 
 * @author     Antonio Mendes <webaholicson@gmail.com>
 */
class Main extends Generic implements TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('warehouse');
        
        /*
         * Checking if user have permissions to save information
         */
        if ($this->_isAllowedAction('EWD_Stock::warehouse_save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('warehouse_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Warehouse Information')]);

        if ($model->getId()) {
            $fieldset->addField('warehouse_id', 'hidden', ['name' => 'warehouse_id']);
        }

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Warehouse Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => array(0 => __('Disabled'), 1 => __('Enabled'))
            ]
        );
        
        $fieldset->addField(
            'warehouse_code',
            'text',
            [
                'name' => 'warehouse_code',
                'label' => __('Warehouse Code'),
                'title' => __('Warehuse Code'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'warehouse_name',
            'text',
            [
                'name' => 'warehouse_name',
                'label' => __('Warehouse Name'),
                'title' => __('Warehouse Name'),
                'disabled' => $isElementDisabled
            ]
        );

        /* if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'store_id',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                    'disabled' => $isElementDisabled
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'store_id',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        } */
        
        $fieldset->addField(
            'contact_email',
            'text',
            [
                'label' => __('Contact Email'),
                'title' => __('Contact Email'),
                'name' => 'warehouse_contact_email',
                'class' => 'validate-email',
                'required' => true
            ]
        );
        
        $fieldset->addField(
            'contact_name',
            'text',
            [
                'label' => __('Contact Name'),
                'title' => __('Contact Name'),
                'name' => 'warehouse_contact_name',
                'required' => true
            ]
        );
        
        $fieldset->addField(
            'warehouse_lat',
            'text',
            [
                'name' => 'warehouse_lat',
                'label' => __('Latitude'),
                'title' => __('Warehouse Latitude'),
                'disabled' => $isElementDisabled
            ]
        );
        
        $fieldset->addField(
            'warehouse_lng',
            'text',
            [
                'name' => 'warehouse_lng',
                'label' => __('Longitude'),
                'title' => __('Warehouse Longiture'),
                'disabled' => $isElementDisabled
            ]
        );
        
        $fieldset->addField(
            'warehouse_location',
            'textarea',
            [
                'name' => 'warehouse_location',
                'label' => __('Address'),
                'title' => __('Warehouse Address'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
        
        $this->_eventManager->dispatch('adminhtml_ewdstock_warehouse_edit_tab_main_prepare_form', 
            ['form' => $form]);
        
        if ($this->_backendSession->getWarehouseData()) {
            $form->setValues($this->_backendSession->getWarehouseData());
        } else {
            $form->setValues($model->getData());
        }
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Warehouse Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Warehouse Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}