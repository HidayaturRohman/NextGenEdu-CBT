document.addEventListener("DOMContentLoaded", function() {
    const timeEl = document.getElementById('live-time');
    const dateEl = document.getElementById('live-date');
    const tempEl = document.getElementById('weather-temp');
    const descEl = document.getElementById('weather-desc');
    const iconEl = document.getElementById('weather-icon');

    // --- Update Time and Date ---
    function updateTime() {
        const now = new Date();
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        
        if (timeEl) timeEl.textContent = now.toLocaleTimeString('id-ID', timeOptions).replace(/\./g, ':');
        if (dateEl) dateEl.textContent = now.toLocaleDateString('id-ID', dateOptions);
    }
    
    // Initial call & loop
    updateTime();
    setInterval(updateTime, 1000);

    // --- Fetch Weather ---
    // Mapping Open-Meteo WMO weather codes to string & icons
    function getWeatherDetails(code) {
        // SVG paths for different weathers
        const sunIcon = `<svg class="icon-32 animated-scaleX text-warning" width="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>`;
        const cloudIcon = `<svg class="icon-32 animated-scaleX text-white" width="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path></svg>`;
        const rainIcon = `<svg class="icon-32 animated-scaleX text-info" width="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="16" y1="13" x2="16" y2="21"></line><line x1="8" y1="13" x2="8" y2="21"></line><line x1="12" y1="15" x2="12" y2="23"></line><path d="M20 16.58A5 5 0 0 0 18 7h-1.26A8 8 0 1 0 4 15.25"></path></svg>`;
        const thunderIcon = `<svg class="icon-32 animated-scaleX text-danger" width="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>`;

        if (code === 0) return { text: 'Cerah', icon: sunIcon };
        if (code >= 1 && code <= 3) return { text: 'Berawan', icon: cloudIcon };
        if (code >= 45 && code <= 48) return { text: 'Berkabut', icon: cloudIcon };
        if (code >= 51 && code <= 67) return { text: 'Hujan', icon: rainIcon };
        if (code >= 71 && code <= 77) return { text: 'Salju', icon: cloudIcon };
        if (code >= 80 && code <= 82) return { text: 'Hujan Deras', icon: rainIcon };
        if (code >= 95) return { text: 'Badai Petir', icon: thunderIcon };
        
        return { text: 'Berawan', icon: cloudIcon };
    }

    function fetchWeather(lat, lon) {
        if (!tempEl || !descEl || !iconEl) return;
        
        fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`)
            .then(res => res.json())
            .then(data => {
                const weather = data.current_weather;
                const details = getWeatherDetails(weather.weathercode);
                
                tempEl.innerHTML = `${Math.round(weather.temperature)}&deg;C`;
                descEl.textContent = details.text;
                iconEl.innerHTML = details.icon;
            })
            .catch(err => {
                console.error("Gagal mengambil data cuaca:", err);
                descEl.textContent = "Data cuaca gagal";
            });
    }

    // Default to Jakarta if geolocation fails
    const defaultLat = -6.2088;
    const defaultLon = 106.8456;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                fetchWeather(position.coords.latitude, position.coords.longitude);
            },
            (error) => {
                console.log("Lokasi tidak diizinkan, menggunakan default (Jakarta).");
                fetchWeather(defaultLat, defaultLon);
            },
            { timeout: 5000 }
        );
    } else {
        fetchWeather(defaultLat, defaultLon);
    }
});
