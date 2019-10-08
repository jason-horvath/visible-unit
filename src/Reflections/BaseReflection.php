<?php
/**
 * Visible Unit: Simplified unit testing on non-visible properties and methods
 * 
 * @author      Jason Horvah <jason.horvath@greaterdevelopment.com>
 * @link        https://greaterdevelopment.com
 * @since       1.0.0
 * @license     https://opensource.org/licenses/mit-license.php MIT License
 */
namespace VisibleUnit\Reflections;

use \ReflectionClass;

/**
 * BaseReflection class. Used for creating a reflection of a class full access.
 * 
 * Allows access to non-visible methods, and properties. This should only be used in unit testing.
 */
class BaseReflection
{
    /**
     * Class that will be subject to reflection.
     * 
     * @var object
     */
    protected $class;

    /**
     * Reflection of self::class
     * 
     * @var ReflectionClass
     */
    protected $reflection;

    /**
     * Construct
     * 
     * @param object $class
     * @return void
     */
    public function __construct(object $class)
    {
        $this->class = $class;
        $this->reflection = new ReflectionClass($this->class);
    }

    /**
     * Invoke Method
     * 
     * @param string $methodName
     * @param ... $params - Parameters that the reflected method takes
     * @return mixed
     */
    public function invokeMethod(string $methodName, ...$params)
    {
        $method = $this->reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invoke($this->class, ...$params);
    }

    /**
     * Get Prop Value
     * 
     * @param string $property
     * @return mixed
     */
    public function getPropValue(string $propertyName)
    {
        $property = $this->reflection->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($this->class);
    }
}
