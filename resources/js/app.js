import './bootstrap';
import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Set up Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Set up Pusher and Laravel Echo
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
});

// Listen for MQTT messages
Echo.channel('mqtt-messages')
    .listen('MqttMessageReceived', (e) => {
        console.log('MQTT Message Received:', e);
    });
