<?php
namespace EWD\Stock\Controller\Adminhtml\Warehouse;

/**
 * Warehouse save action
 *
 * @author      Antonio Mendes <webaholicson@gmail.com>
 */
class Save extends \EWD\Stock\Controller\Adminhtml\Warehouse
{
    /**
     * @var \Magento\Backend\Model\View\Result\Forward
     */
    protected $resultForwardFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Save product action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        $warehouseId = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();
        
        if ($data) {
            try {
                $warehouse =  $this->_objectManager->create('EWD\Stock\Model\Warehouse');
                
                if ($warehouseId) {
                    $warehouse->load($warehouseId);
                }
                
                $warehouse->setData($data)->save();
                $this->messageManager->addSuccess(__('You saved the warehouse.'));

                $this->_eventManager->dispatch(
                    'controller_action_warehouse_save_entity_after',
                    ['controller' => $this]
                );
            } catch (\Exception $e) {
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->messageManager->addError($e->getMessage());
                $this->_session->setWarehouseData($data);
                $redirectBack = $warehouseId ? true : 'new';
            }
        } else {
            $resultRedirect->setPath('*/*/');
            $this->messageManager->addError('No data to save');
            return $resultRedirect;
        }

        if ($redirectBack === 'new') {
            $resultRedirect->setPath('*/*/new');
        } elseif ($redirectBack) {
            $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $warehouseId, '_current' => true]
            );
        } else {
            $resultRedirect->setPath('*/*/');
        }
        
        return $resultRedirect;
    }
}