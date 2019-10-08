<?php
/**
 * Visible Unit: Simplified unit testing on non-visible properties and methods
 * 
 * @author      Jason Horvah <jason.horvath@greaterdevelopment.com>
 * @link        https://greaterdevelopment.com
 * @since       1.0.0
 * @license     https://opensource.org/licenses/mit-license.php MIT License
 */
namespace VisibleUnit\Test\TestCase\Reflections;

use PHPUnit\Framework\TestCase;
use VisibleUnit\Reflections\BaseReflection;
use VisibleUnit\Test\TestClass\MockAccessClass;

class BaseReflectionTest extends TestCase
{
    /**
     * @var \VisibleUnit\Test\TestClass\MockAccessClass
     */
    protected $mockAccessClass;

    /**
     * @var \VisibleUnit\Reflections\BaseReflection
     */
    protected $mockReflection;
    
    /**
     * Set Up
     * 
     * @return void
     */
    public function setUp()
    {
        $this->mockAccessClass = new MockAccessClass();
        $this->mockReflection = new BaseReflection($this->mockAccessClass);
    }

    /**
     * Test Get Prop Value
     * 
     * Tests getting property values of the reflection class.
     * 
     * @return void
     */
    public function testGetPropValue()
    {
        $propValue1 = $this->mockReflection->getPropValue('mockProp1');
        $this->assertSame('Initial Test String', $propValue1);

        $propValue2 = $this->mockReflection->getPropValue('mockProp2');
        $this->assertCount(5, $propValue2);
        $this->assertSame('element 0', $propValue2[0]);
        $this->assertSame('element 1', $propValue2[1]);
        $this->assertSame('element 2', $propValue2[2]);
        $this->assertSame('element 3', $propValue2[3]);
        $this->assertSame('element 4', $propValue2[4]);

        $propValue3 = $this->mockReflection->getPropValue('mockProp3');
        $this->assertSame(12345, $propValue3);

        $propValue4 = $this->mockReflection->getPropValue('mockProp4');
        $this->assertSame('This was set in the __construct()', $propValue4);
    }

    /**
     * Test Invoke Method
     * 
     * Tests the invocation of the method setting its appropriate property value,
     * and also if the invocation returns the value of the invoked method, if any.
     * 
     * @return void
     */
    public function testInvokeMethod()
    {
        $this->mockReflection->invokeMethod('setMockProp1');
        $propValue1 = $this->mockReflection->getPropValue('mockProp1');
        $this->assertSame('This was set in setMockProp1()', $propValue1);

        $this->mockReflection->invokeMethod('setMockProp1', 'FirstParam', 'SecondParam', 'ThirdParam');
        $propValue1 = $this->mockReflection->getPropValue('mockProp1');
        $this->assertSame('FirstParam SecondParam ThirdParam', $propValue1);

        // Test invocation with no parameters
        $this->mockReflection->invokeMethod('setMockProp2');
        $propValue2 = $this->mockReflection->getPropValue('mockProp2');
        $this->assertSame('setMockProp2() - 0', $propValue2[0]);
        $this->assertSame('setMockProp2() - 1', $propValue2[1]);
        $this->assertSame('setMockProp2() - 2', $propValue2[2]);
        $this->assertSame('setMockProp2() - 3', $propValue2[3]);

        // Test invocation with variable parameters
        $this->mockReflection->invokeMethod('setMockProp2', 'PassedParam1', 'PassedParam2', 'PassedParam3');
        $propValue2 = $this->mockReflection->getPropValue('mockProp2');
        $this->assertSame('PassedParam1', $propValue2[0]);
        $this->assertSame('PassedParam2', $propValue2[1]);
        $this->assertSame('PassedParam3', $propValue2[2]);

        $methodReturnValue3 = $this->mockReflection->invokeMethod('setMockProp3');
        $this->assertNull($methodReturnValue3);
        $propValue3 = $this->mockReflection->getPropValue('mockProp3');
        $this->assertSame(54321, $propValue3);

        $methodReturnValue4 = $this->mockReflection->invokeMethod('setMockProp4');
        $this->assertTrue($methodReturnValue4);
        $propValue4 = $this->mockReflection->getPropValue('mockProp4');
        $this->assertSame('This was set in setMockProp4()', $propValue4);
    }
}
