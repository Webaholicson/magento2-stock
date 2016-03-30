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
     * Save product action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        $warehouseId = $this->getRequest()->getParam('warehouse_id');
        $data = $this->getRequest()->getPostValue();
        
        if ($data) {
            try {
                $warehouse =  $this->_objectManager->create('EWD\Stock\Model\Warehouse');
                $data['update_time'] = $data['creation_time'] = date('Y-m-d H:i:s');
                
                if ($warehouseId) {
                    $warehouse->load($warehouseId);
                    unset($data['creation_time']);
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
            $this->messageManager->addError('No data to save');
            return $this->_redirect('ewdstock/*/index');
        }

        if ($redirectBack === 'new') {
            return $this->_redirect('ewd_stock/*/edit');
        } elseif ($redirectBack) {
            return $this->_redirect('ewdstock/*/edit', [
                'warehouse_id' => $warehouseId,
                'active_tab' => $this->getRequest()->getParam('active_tab')
            ]);
        } 
        
        return $this->_redirect('ewdstock/*/index');
    }
}