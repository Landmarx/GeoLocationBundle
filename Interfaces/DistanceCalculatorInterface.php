<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Interfaces;

    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface;

    interface DistanceCalculatorInterface
    {
        /**
         * Calculate the distance between two given points.
         * @param CoordinatesInterface $from
         * @param CoordinatesInterface $to
         * @return integer Number of kilometers between the locations
         */
        public function getDistance(CoordinatesInterface $from, CoordinatesInterface $to);
    }
