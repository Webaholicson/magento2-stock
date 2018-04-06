<?php
namespace EWD\Stock\Block\Adminhtml\Warehouse\Edit\Tab;

use Magento\Catalog\Block\Adminhtml\Product\Grid;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Warehouse products tab
 * 
 * @author     Antonio Mendes <webaholicson@gmail.com>
 */
class Products extends Grid implements TabInterface
{
    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        parent::_prepareCollection();
        return $this;
    }
    
    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        
        $this->removeColumn('set_name');
        $this->removeColumn('visibility');
        $this->removeColumn('type');
        
        $this->getColumn('edit')->setActions([
            [
                'caption' => __('Manage Shelves'),
                'url' => '#',
                'onclick' => 'return warehouse.manageShelves();',
            ]
        ]);
        
        return $this;
    }
    
    protected function _prepareMassaction()
    {
        return $this;
    }
    
    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Warehouse Products');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Warehouse Products');
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