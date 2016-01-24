<?php
namespace Landmarx\Bundle\GeoLocationBundle\Handler;

use \Landmarx\Bundle\GeoLocationBundle\Interfaces\LocationInterface;

interface LocatorServiceInterface
{
    /**
     * Locate
     * @param LocationInterface $location
     *
     * @return LocationInterface 
     */
    public function locate(LocationInterface $location);
}
