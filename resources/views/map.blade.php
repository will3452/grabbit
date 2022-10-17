<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hello world</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
     integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
     integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg="
     crossorigin=""></script>
     <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
     <style>
        #map { height: 80vh; }
     </style>
</head>
<body>
    <div x-data="alphineScript">
        <div id="map" ></div>
        <button>save</button>
    </div>
    <script>

        var alphineScript = {
            map: {},
            location: {},
            clickHandler(e) {
                console.log("e >> ", e)
            },
            lat: 0,
            lng: 0,
            successHandler: async ({coords}) => {
                this.lat = await coords.latitude
                this.lng = await coords.longitude
                console.log("successHandler >> ", coords)
            },
            errorHandler(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
            },
            initMap() {
                this.map = L.map('map').setView([this.lat, this.lng], 13);
            },
            async init () {

                await navigator.geolocation.getCurrentPosition(this.successHandler, this.errorHandler,)

                console.log(this.lat, this.lng)

                this.map = L.map('map')

                this.map.setView([14.54476, 120.990112], 20)

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(this.map);

                this.map.on('click', this.clickHandler)
            }
        }
    </script>
</body>
</html>
