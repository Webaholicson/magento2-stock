<?php
namespace EWD\Stock\Controller\Adminhtml;

/**
 * Warehouse manage blocks controller
 *
 * @author      Antonio Mendes <antoniom@internationalvapor.com>
 */
class Warehouse extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        // return $this->_authorization->isAllowed('Magento_Cms::block');
        return true;
    }
}