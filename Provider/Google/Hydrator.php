<?php
    namespace Landmarx\Bundle\GeoLocationBundle\Provider\Google;

    use \Landmarx\Bundle\GeoLocationBundle\Hydrator\Hydrator as BaseHydrator;
    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressInterface;
    use \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface;

    class Hydrator extends BaseHydrator
    {
        /**
         * Populate address
         * @param  AddressInterface $address
         * @param  Array            $data   
         * @return mixed
         */
        public function populateAddress(AddressInterface $address, Array $data)
        {
            return $address
                ->setFullAddress($data[0]['formatted_address']);
        }

        /**
         * Populate cordinates
         * @param  CoordinatesInterface $coordinates
         * @param  Array                $data
         * @return mixed
         */
        public function populateCoordinates(CoordinatesInterface $coordinates, Array $data)
        {
            return $coordinates
                ->setLatitude(
                    $data[0]['geometry']['location']['lat']
                )
                ->setLongitude(
                    $data[0]['geometry']['location']['lng']
                )
            ;
        }
    }
