<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Domain;

    /**
     * Interface for Balancer factory
     *
     * @author Gilles <gilles@1001pharmacies.com>
     */
    interface BalancerFactoryInterface
    {
        /**
         * Create balancer
         *
         * @param array $locators
         *
         * @return BalancerInterface
         */
        public function create(array $locators);
    }
