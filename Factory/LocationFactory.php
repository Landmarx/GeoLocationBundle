<?php
namespace Landmarx\Bundle\GeoLocationBundle\Factory;

/**
 * Factory
 */
abstract class LocationFactory extends \Landmarx\Bundle\CoreBundle\Factory\Factory implements \Landmarx\Bundle\CoreBundle\Interfaces\FactoryInterface
{
    /**
     * Reflection class
     * @var mixed
     */
    protected $refClass;

    /**
     * Construct
     * @param string $refClass          
     * @param string|null $locationInterface 
     */
    public function __construct($refClass, $locationInterface = '\Landmarx\Bundle\GeoLocationBundle\Interfaces\LocationInterface')
    {
        $this->refClass = new \ReflectionClass($refClass);

        if (!$this->refClass->implementsInterface($locationInterface)) {
            throw new \InvalidArgumentException();
        } 
    }

    /**
     * {@inheritdoc}
     */
    public function createNew(array $arguments = array())
    {
        return $this->refClass->newInstanceArgs($arguments);
    }
}