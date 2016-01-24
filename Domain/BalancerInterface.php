<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Domain;

    /**
     * Interface for balancer
     *
     * @author Gilles <gilles@1001pharmacies.com>
     */
    interface BalancerInterface
    {
        /**
         * Next locator
         *
         * @return LocatorInterface
         */
        public function next();
    }
