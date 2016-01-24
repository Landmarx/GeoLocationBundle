<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Model;

    class Address extends Location implements \Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressInterface
    {
        /**
         * Address
         * @var string $address
         */
        protected $address;

        /**
         * Set full address
         * @param string $address
         * @return \Landmarx\Bundle\GeoLocationBundle\Model\Address
         */
        public function setFullAddress($address)
        {
            $this->address = $address;

            return $this;
        }

        /**
         * {@inheritDoc}
         */
        public function getFullAddress()
        {
            return $this->address;
        }
    }
