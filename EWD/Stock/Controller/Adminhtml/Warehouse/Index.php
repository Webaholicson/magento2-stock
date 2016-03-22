<?php
namespace EWD\Stock\Controller\Adminhtml\Warehouse;

use EWD\Stock\Controller\Adminhtml\Warehouse;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;

class Index extends Warehouse
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry,
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, Registry $coreRegistry, PageFactory $resultPageFactory)
    {
        parent::__construct($context, $coreRegistry);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * EWD Stock management page
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('EWD_Stock::admin');
        $resultPage->getConfig()->getTitle()->set(__('Stock Management'));
        return $resultPage;
    }
    
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('EWD_Stock::warehouse');
    }
}
