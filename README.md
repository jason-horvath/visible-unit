# Visible Unit

Simplified unit testing on non-visible properties and methods. This repository is intended for development use only, since its main purpose is to bypass class visibility in unit testing.

### Usage
Run `composer require --dev kaingnx/visible-unit`

#### Unit Testing

```PHP
// src/Your/Path/ExampleUnitTest.php
namespace Your\Namespace\Test;

use VisibleUnit\Reflections\BaseReflection;
use Your\Namespace\YourObject;

class ExampleUnitTest
{
    /**
     * Set Up
     * 
     * @return void
     */
    public function setUp()
    {
        $this->yourObject = new YourObject();
        $this->mockReflection = new BaseReflection($this->yourObject);
    }

    /**
     * Test Example Prop and Method
     * 
     * @return void
     */
    public function testExamplePropAndMethod()
    {
        $this->mockReflection->invokeMethod('privateOrProtectedMethod');
        $privateOrProtectedProp = $this->mockReflection->getPropValue('privateOrProtectedProp');
    }
}
    
##### More Info

See source of:
1.) `src/Reflections/BaseReflection.php`
2.) `tests/TestCase/Reflections/BaseReflectionTest.php`
3.) `tests/TestCase/TestClass/MockAccessObject.php`

