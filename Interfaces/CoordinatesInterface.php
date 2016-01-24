<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Interfaces;

    interface CoordinatesInterface extends LocationInterface
    {
        /**
         * Get latitude
         * @return float
         */
        public function getLatitude();

        /**
         * Get longitude
         * @return float
         */
        public function getLongitude();
    }
