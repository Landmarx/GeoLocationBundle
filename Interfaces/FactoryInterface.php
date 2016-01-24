<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Interfaces;

    interface FactoryInterface
    {
        /**
         * Create
         * @param  array  $arguments
         * @return \Landmarx\Bundle\GeoLocationBundle\Interfaces\LocationInterface
         */
        public function create(array $arguments = array());
    }