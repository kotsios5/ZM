# Zap-Map Technical Challenge

For this challenge I've used Laravel v9.19, PHP 8.1.7 and MySQL 5.7.

In order to save the locations into the database, I've created the database schema with:
<code>database\migrations\2022_07_02_172434_create_locations_table.php</code>
the Location model:
<code>app\Models\Location.php</code>
validating the request's parameters with:
<code>app\Http\Requests\GetLocationsRequest.php</code>
and using the following controller to get the locations that fall within the given radius:
<code>app/Http/Controllers/V1/LocationController.php</code>
The definition of the route is in <code>routes/api.php</code>. The post locations route is inside the v1 group for maintainability even if it wasn't required for this challenge. 

The <code>LocationController::getLocations()</code> is called when we make a request, which is calling the protected function <code>LocationController::getDistanceFromCurrentLocation()</code> to calculate and return the distance between the given coordinates and each of the locations in the database. If the returned distance falls into the given radius, the location is added to an array which is returned as a response.

<code>POST</code> /api/v1/locations/?latitude={lat}&longitude={long}&radius={radius}

## Example with Postman:

Request:
```
POST /api/v1/locations/?latitude=51&longitude=-2&radius=50 HTTP/1.1
Host: localhost
Accept: application/json
Content-Type: application/json
```

Response:
```
[
    {
        "id": 23,
        "name": "6 Nansen Road",
        "latitude": "51.41743187735718000000",
        "longitude": "-1.98512655633443910000"
    },
    {
        "id": 113,
        "name": "Fitzroy Court",
        "latitude": "51.41198069577813400000",
        "longitude": "-1.99404862818395420000"
    }
]
``` 
