<?php
namespace EWD\Stock\Controller\Adminhtml\Warehouse;

/**
 * Warehouse index action
 *
 * @author      Antonio Mendes <webaholicson@gmail.com>
 */
class Index extends \EWD\Stock\Controller\Adminhtml\Warehouse
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * EWD Stock management page
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        #$resultPage->setActiveMenu('EWD_Stock::admin');
        $resultPage->getConfig()->getTitle()->set(__('Stock Management'));
        
        return $resultPage;
    }
}