<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Handler;

    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\BalancerFactoryInterface;
    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressInterface;
    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface;
    

    /**
     *
     */
    class LocatorManager implements LocatorManagerInterface
    {
        /**
         * @var BalancerFactoryInterface
         */
        protected $balancerFactory;

        /**
         * @var \Psr\Log\LoggerInterface
         */
        protected $logger = null;

        /**
         * @var Array
         */
        protected $locators = array();

        public function __construct(
            BalancerFactoryInterface $balancerFactory,
            \Psr\Log\LoggerInterface $logger = null
        ) {
            $this->balancerFactory = $balancerFactory;
            $this->logger          = $logger;
        }

        /**
         * {@inheritDoc}
         */
        public function getLocators()
        {
            return $this->locators;
        }

        /**
         * {@inheritDoc}
         */
        public function addLocator(LocatorInterface $locator, array $attributes = array())
        {
            $this->locators[] = $locator;

            return $this;
        }

        /**
         * {@inheritDoc}
         */
        public function locate(\Landmarx\Bundle\GeoLocationBundle\Interfaces\LocationInterface $location)
        {
            $result = $this->tryLocate($location);

            $this->log($location, $result);

            return $result;
        }

        private function tryLocate(\Landmarx\Bundle\GeoLocationBundle\Interfaces\LocationInterface $location)
        {
            $balancer = $this
                ->balancerFactory
                ->create($this->locators)
            ;

            $result = null;

            try {
                while(!$result) {
                    $locator = $balancer->next();
                    try {
                        $result = $locator->locate($location);
                    } catch (\Exception $e) {

                    }
                }
            } catch (\OutOfRangeException $e) {

            }

            return $result;
        }

        private function log($location, $result)
        {
            if ($this->logger) {
                if ($location instanceof AddressInterface) {
                    $this
                        ->logger
                        ->debug(
                            'Geocoding : Find coordinates by address',
                            array(
                                'address'   => $location->getFullAddress(),
                                'latitude'  => $result->getLatitude(),
                                'longitude' => $result->getLongitude(),
                            )
                        )
                    ;
                }

                if ($location instanceof CoordinatesInterface) {
                    $this
                        ->logger
                        ->debug(
                            'Geocoding : Locate address by coordinates',
                            array(
                                'address'   => $result->getFullAddress(),
                                'latitude'  => $location->getLatitude(),
                                'longitude' => $location->getLongitude(),
                            )
                        )
                    ;
                }
            }
        }
    }
