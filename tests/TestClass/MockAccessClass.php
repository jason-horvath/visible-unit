<?php
/**
 * Visible Unit: Simplified unit testing on non-visible properties and methods
 * 
 * @author      Jason Horvah <jason.horvath@greaterdevelopment.com>
 * @link        https://greaterdevelopment.com
 * @since       1.0.0
 * @license     https://opensource.org/licenses/mit-license.php MIT License
 */
namespace VisibleUnit\Test\TestClass;

/**
 * MockAccessClass: Used for unit testing non-visible property access. Only intended for unit testing purposes.
 */
class MockAccessClass
{
    /**
     * @var string
     */
    private $mockProp1 = 'Initial Test String';

    /**
     * @var array
     */
    private $mockProp2 = [
        'element 0',
        'element 1',
        'element 2',
        'element 3',
        'element 4',
    ];

    /**
     * @var int
     */
    protected $mockProp3 = 12345;

    /**
     * @var string
     */
    protected $mockProp4;

    /**
     * Construct
     * 
     * @return void
     */
    public function __construct()
    {
        $this->mockProp4 = 'This was set in the __construct()';
    }

    /**
     * Change Test Prop 1
     * 
     * @param ... $params
     * @return void
     */
    private function setMockProp1(...$params)
    {
        $args = func_get_args($params);
        $this->mockProp1 = count($args[0]) === 0 ? 'This was set in setMockProp1()' : implode(' ', $args[0]);
    }

    /**
     * Change Test Prop 2
     * 
     * @param ... $params
     * @return void
     */
    protected function setMockProp2(...$params)
    {
        $args = func_get_args($params);
        
        $mockProp2 = [
            'setMockProp2() - 0',
            'setMockProp2() - 1',
            'setMockProp2() - 2',
            'setMockProp2() - 3'
        ];

        $this->mockProp2 = count($args[0]) === 0 ? $mockProp2 : $args[0];
    }

    /**
     * Change Test Prop 3
     * 
     * @return void
     */
    public function setMockProp3()
    {
        $this->mockProp3 = 54321;
    }

    /**
     * Change Test Prop 4
     * 
     * @return bool
     */
    public function setMockProp4()
    {
        $this->mockProp4 = 'This was set in setMockProp4()';
        return true;
    }
}
