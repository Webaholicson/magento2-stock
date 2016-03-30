<?php
namespace EWD\Stock\Test\Block\Adminhtml\Warehouse;

use \Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

/**
 *  Test the Warehouse grid
 * 
 *  @author Antonio Mendes <webaholicson@gmail.com>
 * 
 */
class GridTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EWD\Stock\Block\Adminhtml\Warehouse\Grid
     */
    protected $_block;
    
    /**
     * @var EWD\Stock\Block\Adminhtml\Warehouse\Grid|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_mock;
    
    /**
     * @var \Magento\Backend\Block\Widget\Context|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_context;
    
    /**
     * @var \Magento\Framework\Filesystem|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_filesystem;
    
    /**
     * @var \Magento\Backend\Helper\Data|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_backendHelper;
    
    /**
     * @var \Magento\Backend\Model\Session|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_backendSession;
    
    /**
     * @var \EWD\Stock\Model\ResourceModel\Warehouse\Grid\Collection|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_collection;
    
    /**
     * @var \Magento\Framework\Url|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_urlBuilder;
    
    /**
     * @var \Magento\Framework\DataObject|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_dataObject;
    
    protected function setUp()
    {
        $objectManager = new ObjectManager($this);
        
        $this->_context = $this->getMockBuilder('\Magento\Backend\Block\Widget\Context')
            ->setMethods(['getUrlBuilder', 'getBackendSession', 'getFilesystem'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_urlBuilder = $this->getMockBuilder('\Magento\Framework\Url')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_backendSession = $this->getMockBuilder('\Magento\Backend\Model\Session')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_backendHelper = $this->getMockBuilder('\Magento\Backend\Helper\Data')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_filesystem = $this->getMockBuilder('\Magento\Framework\Filesystem')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_collection = $this->getMockBuilder('\EWD\Stock\Model\ResourceModel\Warehouse\Grid\Collection')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_dataObject = $this->getMockBuilder('\Magento\Framework\DataObject')
            ->setMethods(['getId'])
            ->getMock();
        
        $this->_context->expects($this->atLeastOnce())
            ->method('getUrlBuilder')
            ->willReturn($this->_urlBuilder);
        
        $this->_context->expects($this->atLeastOnce())
            ->method('getBackendSession')
            ->willReturn($this->_backendSession);
        
        $this->_context->expects($this->atLeastOnce())
            ->method('getFilesystem')
            ->willReturn($this->_filesystem);
        
        $this->_block = $objectManager->getObject('\EWD\Stock\Block\Adminhtml\Warehouse\Grid', [
            'context' => $this->_context,
            'backendHelper' => $this->_backendHelper,
            'collection' => $this->_collection
        ]);
        
        $this->_mock = $this->getMockBuilder('\EWD\Stock\Block\Adminhtml\Warehouse\Grid')
            ->disableOriginalConstructor()
            ->setMethods(['getUrl', 'addColumn', 'sortColumnsByOrder'])
            ->getMock();
    }
    
    /**
     *  Test the Warehouse grid
     * 
     *  @author Antonio Mendes <webaholicson@gmail.com>
     *  @group warehouse
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse\Grid::_construct
     * 
     */
    public function testConstruct()
    {
        $sort = new \ReflectionProperty('\EWD\Stock\Block\Adminhtml\Warehouse\Grid', '_defaultSort');
        $dir = new \ReflectionProperty('\EWD\Stock\Block\Adminhtml\Warehouse\Grid', '_defaultDir');
        
        $sort->setAccessible(true);
        $dir->setAccessible(true);
        
        $this->assertEquals($this->_block->getId(), 'warehouseGrid');
        $this->assertEquals($sort->getValue($this->_block), 'identifier');
        $this->assertEquals($dir->getValue($this->_block), 'ASC');
    }
    
    /**
     *  Test getting a row url from the grid
     * 
     *  @author Antonio Mendes <webaholicson@gmail.com>
     *  @group warehouse
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse\Grid::getRowUrl
     * 
     */
    public function testGetRowUrl()
    {
        $this->_dataObject->expects($this->exactly(2))
            ->method('getId')
            ->willReturn(1);
        
        $this->_mock->expects($this->once())
            ->method('getUrl')
            ->with('*/*/edit', ['warehouse_id' => 1])
            ->willReturn($this->_block->getRowUrl($this->_dataObject));
        
        $this->_mock->getRowUrl($this->_dataObject);
    }
    
    /**
     *  Test preparing the grid columns
     * 
     *  @author Antonio Mendes <webaholicson@gmail.com>
     *  @group warehouse
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse\Grid::_prepareColumns
     * 
     */
    public function testPrepareColumns()
    {
        $this->_mock->expects($this->exactly(6))
            ->method('addColumn')
            ->withConsecutive(
                array('warehouse_id',['header' => __('ID'),'index'=>'warehouse_id']),
                array('warehouse_code',['header'=>__('Code'),'index'=>'warehouse_code']),
                array('warehouse_contact_name',['header'=>__('Contact Name'),'index'=>'warehouse_contact_name']),
                array('warehouse_contact_email',['header'=>__('Contact Email'),'index'=>'warehouse_contact_email']),
                array('creation_time', ['header'=>__('Created On'),'index'=>'creation_time']),
                array('update_time', ['header'=>__('Updated On'),'index'=>'update_time'])
            )->willReturnSelf();
        
        $this->_mock->expects($this->once())
            ->method('sortColumnsByOrder')
            ->willReturnSelf();
        
        $method = new \ReflectionMethod(
            '\EWD\Stock\Block\Adminhtml\Warehouse\Grid',
            '_prepareColumns'
        );
        
        $method->setAccessible(true);
        $method->invokeArgs($this->_mock, array());
    }
}