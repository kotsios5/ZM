<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetLocationsRequest;
use App\Models\Location;

/**
 * Class LocationController
 * @package App\Http\Controllers\V1
 */
class LocationController extends Controller
{
    /**
     * Return locations within given radius.
     *
     * @param  \App\Http\Requests\GetLocationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function getLocations(GetLocationsRequest $request)
    {
        $latitude = $request->all()['latitude'];
        $longitude = $request->all()['longitude'];
        $radius = $request->all()['radius'];
        $locations = Location::all();
        $locationsWithinRadius = [];

        foreach($locations as $location) {
            $distance = $this->getDistanceFromCurrentLocation($latitude, $longitude, $location['latitude'], $location['longitude']);
            if ($distance <= $radius) {
                $locationsWithinRadius[] = $location;
            }
        }
        return $locationsWithinRadius;
    }

    /**
     * Return distance between user coordinates and location
     *
     * @param $currentLatitude
     * @param $currentLongitude
     * @param $locationLatitude
     * @param $locationLongitude
     * @return float|int
     */
    protected function getDistanceFromCurrentLocation($currentLatitude, $currentLongitude, $locationLatitude, $locationLongitude)
    {
        $distanceLatitude = deg2rad($currentLatitude - $locationLatitude);
        $distanceLongitude = deg2rad($currentLongitude - $locationLongitude);

        $a = sin($distanceLatitude/2) * sin($distanceLatitude/2) +
            cos(deg2rad($currentLatitude)) * cos(deg2rad($locationLatitude)) * sin($distanceLongitude/2) * sin($distanceLongitude/2);
        $c = 2 * asin(sqrt($a));

        return LOCATION::EARTH_RADIUS * $c;
    }
}
