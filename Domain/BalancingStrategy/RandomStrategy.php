<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Domain\BalancingStrategy;

    /**
     * Strategy to priorize randomly
     *
     * @author Gilles <gilles@1001pharmacies.com>
     */
    class RandomStrategy implements StrategyInterface
    {
        /**
         * {inheritdoc}
         */
        public function priorize(array $locators)
        {
            shuffle($locators);

            return $locators;
        }
    }
