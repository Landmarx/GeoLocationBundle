<?php
namespace Landmarx\Bundle\GeoLocationBundle\Interfaces;

interface LocatorInterface extends LocatorServiceInterface
{
    /**
     * Get coordinates
     * @param \Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressInterface $address
     *
     * @return \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface
     */
    public function getCoordinates(\Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressInterface $address);

    /**
     * @param \Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface $coordinates
     * 
     * @return \Landmarx\Bundle\GeoLocationBundle\Interfaces\AddressInterface
     */
    public function getAddress(\Landmarx\Bundle\GeoLocationBundle\Interfaces\CoordinatesInterface $coordinates);
}
