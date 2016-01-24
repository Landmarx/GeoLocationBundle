<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Hydrator;

    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressFactoryInterface;
    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesFactoryInterface;

    /**
     *
     */
    abstract class Hydrator implements \Landmarx\Bundle\GeoLocationBundle\Interfaces\HydratorInterface
    {
        const TYPE_ADDRESS     = 'address';
        const TYPE_COORDINATES = 'coordinates';

        /**
         * @var AddressFactoryInterface
         */
        protected $address_factory;

        /**
         * @var CoordinatesFactoryInterface
         */
        protected $coordinates_factory;

        /**
         * @param AddressFactoryInterface $address_factory
         * @param CoordinatesFactoryInterface $coordinates_factory
         */
        public function __construct(AddressFactoryInterface $address_factory, CoordinatesFactoryInterface $coordinates_factory)
        {
            $this->address_factory     = $address_factory;
            $this->coordinates_factory = $coordinates_factory;
        }

        /**
         * {@inheritDoc}
         */
        public function hydrate(Array $data, $entity_name)
        {
            $factory = sprintf('%s_factory', $entity_name);
            $entity  = $this->$factory->create();
            $method  = sprintf('populate%s', ucfirst($entity_name));

            return $this->$method($entity, $data);
        }
    }
