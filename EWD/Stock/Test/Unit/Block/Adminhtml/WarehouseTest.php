<?php
namespace EWD\Stock\Test\Block\Adminhtml;

class WarehouseTest extends \PHPUnit_Framework_TestCase
{
    public function testAddNewWrehouseButton()
    {
        $mock = $this->getMockBuilder('EWD\Stock\Block\Adminhtml\Warehouse')
                ->disableOriginalConstructor()
                ->getMock();
        
        $mock->method('getAddButtonLabel')->willReturn('Add New Warehouse');
        $this->assertEquals($mock->getAddButtonLabel(), 'Add New Warehouse');
    }
    
    public function testGetHeaderText()
    {
        $mock = $this->getMockBuilder('EWD\Stock\Block\Adminhtml\Warehouse')
                ->disableOriginalConstructor()
                ->getMock();
        
        $mock->method('getHeaderText')->willReturn('Warehouses');
        $this->assertEquals($mock->getHeaderText(), 'Warehouses');
    }
    
    public function testParamBlockGroup()
    {
        $mock = $this->getMockBuilder('EWD\Stock\Block\Adminhtml\Warehouse')
                ->disableOriginalConstructor()
                ->getMock();
        
        $mock->expects($this->once())
                ->method('getDataByKey')
                ->with($this->equalTo('block_group'))
                ->willReturn('EWD_Stock');
        
        $this->assertEquals($mock->getDataByKey('block_group'), 'EWD_Stock');
    }
    
    public function testParamController()
    {
        $mock = $this->getMockBuilder('EWD\Stock\Block\Adminhtml\Warehouse')
                ->disableOriginalConstructor()
                ->getMock();
        
        $mock->expects($this->once())
                ->method('getDataByKey')
                ->with($this->equalTo('controller'))
                ->willReturn('adminhtml_warehouse');
        
        $this->assertEquals($mock->getDataByKey('controller'), 'adminhtml_warehouse');
    }
}
