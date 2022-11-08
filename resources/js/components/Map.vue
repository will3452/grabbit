<template>
    <div>
        <l-map :center="[lat, lng]" style="height:300px" :zoom="19">
            <l-tile-layer :url="'https://tile.openstreetmap.org/{z}/{x}/{y}.png'" ></l-tile-layer>
            <l-marker v-on:update:latLng="setLatLng" :lat-lng="[lat, lng]" :draggable="true" :icon="icon"></l-marker>
        </l-map>
        <div class="mt-2 text-center" v-if="! readOnly">

            <button @click="reset" class="btn btn-success" v-show="current">
                Set to current location
            </button>
            <button class="btn btn-primary" @click="submit">
                submit post
            </button>
        </div>
    </div>
</template>


<script>
export default {
    props: ['saveUrl', 'latx', 'lngx', 'readOnly'],
    async mounted() {
        this.lat = await this.latx
        this.lng = await this.lngx

        this.getCurrentLocation()
    },
    data () {
        return {
            lat: 0, lng: 0,
            icon: L.icon({
            iconUrl: '/pin.png',
            iconSize: [37, 37],
            iconAnchor: [37, 37]
        }),
        current: null,
        }
    },
    methods: {
        getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(({coords}) => {
                    // this.lat = coords.latitude
                    // this.lng = coords.longitude
                    this.current = coords
                })
            } else {
                console.log('geolocation >> not supported');
            }
        },

        async submit () {
            let url = new URL(this.saveUrl)
            url.searchParams.append('lat', this.lat)
            url.searchParams.append('lng', this.lng)
            window.location.href = url.href
        },

        reset() {
            this.lat = this.current.latitude
            this.lng = this.current.longitude
        },

        setLatLng ({lat, lng}) {
            this.lat = lat
            this.lng = lng
            console.log('lat lng', lat, lng)
            // this.value = []
            this.$emit('input', [this.lat, this.lng]);
        }
    }
}
</script>
