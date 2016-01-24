<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Model;

    class Coordinates extends Location implements \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface
    {
        /**
         * Latitude
         * @var float
         */
        protected $latitude;

        /**
         * Longitude
         * @var float
         */
        protected $longitude;

        /**
         * Set latitude
         * @param float $latitude
         *
         * @return \Landmarx\Bundle\GeoLocationBundle\Model\Coordinates
         */
        public function setLatitude($latitude)
        {
            $this->latitude = $latitude;

            return $this;
        }

        /**
         * Set longitude
         * @param float $longitude
         *
         * @return \Landmarx\Bundle\GeoLocationBundle\Model\Coordinates
         */
        public function setLongitude($longitude)
        {
            $this->longitude = $longitude;

            return $this;
        }

        /**
         * {@inheritDoc}
         */
        public function getLatitude()
        {
            return $this->latitude;
        }

        /**
         * {@inheritDoc}
         */
        public function getLongitude()
        {
            return $this->longitude;
        }
    }
