<?php
namespace Landmarx\Bundle\GeoLocationBundle\Interfaces;

interface AddressInterface extends LocationInterface
{
    /**
     * Get full address
     * @return string
     */
    public function getFullAddress();
}
