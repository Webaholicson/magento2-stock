<?php
namespace EWD\Stock\Test\Block\Adminhtml;

use EWD\Stock\Block\Adminhtml\Warehouse;
use Magento\Framework\TestFramework\Unit\Block\Adminhtml as TestCase;

class Warehouse extends TestCase
{
    public function testAddNewWrehouseButton()
    {
        $warehouse = new Warehouse();
        $mock = $this->_makeMock('Warehouse');
        $this->_setStub($mock, $this->once(), 'getAddButtonLabel', 'Add New Warehouse');
        $this->assertEquals($warehouse, 'Add New Warehouse');
    }
}
