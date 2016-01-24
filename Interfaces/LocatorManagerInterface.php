<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Interfaces;

    interface LocatorManagerInterface extends LocatorServiceInterface
    {
        /**
         * Get locators
         * @return array<LocatorInterface>
         */
        public function getLocators();

        /**
         * Add locator
         * @param LocatorInterface $locator
         * @param array $attributes
         *
         * @return self
         */
        public function addLocator(LocatorInterface $locator, array $attributes = array());
    }
