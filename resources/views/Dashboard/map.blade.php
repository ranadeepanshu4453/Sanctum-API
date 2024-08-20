<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
        #map {
            height: 500px; /* Set the height of the map */
            width: 500px;
            margin: auto;
        }
    </style>
</head>
<body>
<div id="map"></div>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
    // Replace these variables with your dynamic latitude and longitude values
    var latitude = {{ $latitude }};
    var longitude = {{ $longitude }};

    // Initialize the map and set its view to the provided coordinates
    var map = L.map('map').setView([latitude, longitude], 13);

    // Load and display the tile layer on the map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Add a marker at the specified location
    L.marker([latitude, longitude]).addTo(map)
        .bindPopup('You are here.')
        .openPopup();
</script>

</body>
</html>