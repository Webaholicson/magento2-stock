<?php
namespace EWD\Stock\Controller\Adminhtml\Warehouse;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;

/**
 * Warehouse edit action
 *
 * @author      Antonio Mendes <webaholicson@gmail.com>
 */
class Edit extends \EWD\Stock\Controller\Adminhtml\Warehouse
{
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('EWD_Stock::warehouse_save');
    }
    
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(Context $context, Registry $coreRegistry)
    {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
    }
    
    /**
     * Init actions
     *
     * @return void
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('EWD_Stock::warehouse');
    }

    /**
     * Edit Warehouse
     *
     * @return void
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('warehouse_id');
        $model = $this->_objectManager->create('EWD\Stock\Model\Warehouse');
        
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This warehouse no longer exists.'));
                return $this->_forward('index');
            }
        }
        
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        
        $this->_coreRegistry->register('warehouse', $model);
        
        $this->_initAction();
        
        $this->_addBreadcrumb(
            $id ? __('Edit Warehouse') : __('New Warehouse'),
            $id ? __('Edit Warehouse') : __('New Warehouse')
        );
        
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Warehouses'));
        $this->_view->getPage()->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Warehouse'));
        
        $this->_view->renderLayout();
    }
}