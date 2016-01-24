<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Provider\Bing;

    use \Landmarx\Bundle\GeoLocationBundle\Hydrator\Hydrator as BaseHydrator;
    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressInterface;
    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface;

    class Hydrator extends BaseHydrator
    {
        /**
         * {@inheritDoc}
         */
        public function populateAddress(AddressInterface $address, Array $data)
        {
            return $address->setFullAddress(
                $data['resourceSets'][0]['resources'][0]['name']
            );
        }

        /**
         * {@inheritDoc}
         */
        public function populateCoordinates(CoordinatesInterface $coordinates, Array $data)
        {
            list($latitude, $longitude) = $data['resourceSets'][0]['resources'][0]['point']['coordinates'];

            return $coordinates
                ->setLatitude($latitude)
                ->setLongitude($longitude)
            ;
        }
    }
