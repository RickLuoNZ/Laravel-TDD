<?php

namespace Tests;

/**
 * Trait ReflectionTrait for useful functions used in unit testing class properties and methods
 *
 * @package Tests
 *
 * @author Matthew Crankshaw
 *
 * @since 16/09/2020
 */
trait ReflectionTrait
{
    /**
     * This can call protected and private methods directly.
     *
     * It will call the defined method directly with the provided paramaters on the object.
     *
     * @param object $object - test object - object of the class containing the protected method
     * @param string $method - name of the protected method to test
     * @param array $arguments - input parameters for the protected method
     *
     * @return mixed
     */
    protected function runProtectedMethod($object, $method, $arguments = [])
    {
        $method = new \ReflectionMethod(get_class($object), $method);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $arguments);
    }

    /**
     * This method takes an objects property and makes it accessible, and returns the refection property
     *
     * @param object $object - instance of the class containing the property
     * @param string $property - name of the property
     *
     * @return \ReflectionProperty
     * @throws \ReflectionException
     */
    protected function getReflectionProperty(object $object, string $property)
    {
        $reflection = new \ReflectionObject($object);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);

        return $property;
    }

    /**
     * This method gets a properties value within the $object class
     *
     * @param $object
     * @param $property
     *
     * @return mixed
     * @throws \ReflectionException
     */
    protected function getProtectedPropertyValue(object $object, string $property)
    {
        $property = $this->getReflectionProperty($object, $property);
        return $property->getValue($object);
    }

    /**
     * This method sets a properties value within the $object class
     *
     * @param object $object
     * @param string $property
     * @param object $value
     *
     * @return void
     * @throws \ReflectionException
     */
    protected function setProtectedPropertyValue(object $object, string $property, $value): void
    {
        $property = $this->getReflectionProperty($object, $property);
        $property->setValue($object, $value);
    }
}
