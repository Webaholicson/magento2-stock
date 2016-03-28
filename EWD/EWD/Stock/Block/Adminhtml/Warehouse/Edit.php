<?php
namespace EWD\Stock\Block\Adminhtml\Warehouse;

 use \Magento\Backend\Block\Widget\Form\Container;

/**
 * Warehouse edit page
 *
 * @author     Antonio Mendes <webaholicson@gmail.com>
 */
class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize warehouse edit block
     *
     * @return void
     * @
     */
    protected function _construct()
    {
        $this->_objectId = 'warehouse_id';
        $this->_blockGroup = 'EWD_Stock';
        $this->_controller = 'adminhtml_warehouse';

        parent::_construct();

        if ($this->_isAllowedAction('EWD_Stock::warehouse_save')) {
            $this->buttonList->update('save', 'label', __('Save Warehouse'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        /* if ($this->_isAllowedAction('EWD_Stock::warehouse_delete')) {
            $this->buttonList->update('delete', 'label', __('Delete Warehouse'));
        } else {
            $this->buttonList->remove('delete');
        } */
        
        $this->buttonList->remove('delete');
    }

    /**
     * Retrieve text for header element depending on loaded warehouse
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('warehouse')->getId()) {
            return __("Edit Warehouse '%s'", $this->escapeHtml($this->_coreRegistry->registry('warehouse')->getCode()));
        } else {
            return __('New Warehouse');
        }
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

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '{{tab_id}}']);
    }
    
    protected function _buildFormClassName()
    {
        return str_replace("_", "\\", $this->_blockGroup) . '\\' . $this->nameBuilder->buildClassName(
            ['Block', $this->_controller, $this->_mode, 'Form']
        );
    }
    
    protected function _prepareLayout()
    {
        if ($this->_blockGroup && $this->_controller && $this->_mode && !$this->_layout->getChildName(
            $this->_nameInLayout,
            'form'
        )
        ) {
            $this->addChild('form', $this->_buildFormClassName());
        }
        
        $this->toolbar->pushButtons($this, $this->buttonList);
        return $this;
    }
}
