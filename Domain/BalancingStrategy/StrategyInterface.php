<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Domain\BalancingStrategy;

    /**
     * Interface for balancing strategy interface
     *
     * @author Gilles <gilles@1001pharmacies.com>
     */
    interface StrategyInterface
    {
        /**
         * Priorize locators
         *
         * @param array $locators
         *
         * @return array
         */
        public function priorize(array $locators);
    }
