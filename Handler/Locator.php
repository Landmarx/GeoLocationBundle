<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Handler;

    /**
     * Service used to join addresses and GPS coordinates.
     * @author Methylbro <thomas@1001pharmacies.com>
     */
    abstract class Locator implements \Landmarx\Bundle\GeoLocationBundle\Interfaces\LocatorInterface
    {
        /**
         * @var \Psr\Log\LoggerInterface
         */
        protected $logger;

        /**
         * @param \Psr\Log\LoggerInterface $logger
         */
        public function __construct(\Psr\Log\LoggerInterface $logger)
        {
            $this->logger = $logger;
        }

        /**
         * {@inheritDoc}
         */
        public function locate(\Landmarx\Bundle\GeoLocationBundle\Interfaces\LocationInterface $location)
        {
            /* */
            if ($location instanceof \Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressInterface) {
                return $this->getCoordinates($location);
            } 

            /* */
            if($location instanceof \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface) {
                return $this->getAddress($location);
            }

            return $location;
        }
    }
