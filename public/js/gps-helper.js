const GPSHelper = {
    calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371000;
        
        const radLat1 = this.toRadians(lat1);
        const radLon1 = this.toRadians(lon1);
        const radLat2 = this.toRadians(lat2);
        const radLon2 = this.toRadians(lon2);
        
        const dLat = radLat2 - radLat1;
        const dLon = radLon2 - radLon1;
        
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                  Math.cos(radLat1) * Math.cos(radLat2) *
                  Math.sin(dLon / 2) * Math.sin(dLon / 2);
        
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        
        const distance = R * c;
        
        return distance;
    },

    toRadians(degrees) {
        return degrees * (Math.PI / 180);
    },

    checkRadius(userLat, userLng, targetLat, targetLng, maxDistance = 100) {
        const distance = this.calculateDistance(userLat, userLng, targetLat, targetLng);
        
        return {
            isWithinRadius: distance <= maxDistance,
            distance: Math.round(distance),
            maxDistance: maxDistance
        };
    },

    getCurrentPosition() {
        return new Promise((resolve, reject) => {
            if (!navigator.geolocation) {
                reject(new Error('Geolocation tidak didukung oleh browser ini'));
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    resolve({
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude,
                        accuracy: position.coords.accuracy
                    });
                },
                (error) => {
                    let message = '';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            message = 'Izin akses lokasi ditolak';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            message = 'Informasi lokasi tidak tersedia';
                            break;
                        case error.TIMEOUT:
                            message = 'Waktu permintaan lokasi habis';
                            break;
                        default:
                            message = 'Terjadi kesalahan saat mendapatkan lokasi';
                    }
                    reject(new Error(message));
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        });
    },

    watchPosition(callback, errorCallback) {
        if (!navigator.geolocation) {
            errorCallback(new Error('Geolocation tidak didukung'));
            return null;
        }

        return navigator.geolocation.watchPosition(
            (position) => {
                callback({
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude,
                    accuracy: position.coords.accuracy
                });
            },
            (error) => {
                errorCallback(error);
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    },

    clearWatch(watchId) {
        if (watchId !== null) {
            navigator.geolocation.clearWatch(watchId);
        }
    }
};