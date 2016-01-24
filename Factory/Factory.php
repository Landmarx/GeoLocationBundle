<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Factory;

    /**
     * Factory
     */
    abstract class Factory implements \Landmarx\Bundle\GeoLocationBundle\Interfaces\FactoryInterface
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
         * Create
         * @param  array  $arguments
         * @return mixed
         */
        public function create(array $arguments = array())
        {
            return $this->refClass->newInstanceArgs($arguments);
        }
    }