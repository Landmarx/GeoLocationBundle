<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Interfaces;

    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressInterface;
    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface;

    interface HydratorInterface
    {
        /**
         * @param Array $data
         *
         * @return LocationInterface
         */
        public function hydrate(Array $data, $entity_name);

        /**
         * @param AddressInterface $address
         * @param Array $data
         *
         * @return AddressInterface
         */
        public function populateAddress(AddressInterface $address, Array $data);

        /**
         * @param CoordinatesInterface $coordinates
         * @param Array $data
         *
         * @return CoordinatesInterface
         */
        public function populateCoordinates(CoordinatesInterface $coordinates, Array $data);
    }
