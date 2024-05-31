import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', function () {
    var spinner = document.getElementById('spinner');

    function showSpinner() {
        spinner.style.display = 'flex';
    }

    function hideSpinner() {
        spinner.style.display = 'none';
    }

    // Show spinner on page load
    showSpinner();

    // Hide spinner with a delay once the page is fully loaded
    window.addEventListener('load', function () {
        setTimeout(hideSpinner, 470); // Delay of 470 milliseconds (0.47 seconds)
    });

    // Example: Show spinner during AJAX requests
    document.addEventListener('ajaxStart', function () {
        showSpinner();
    });

    document.addEventListener('ajaxStop', function () {
        setTimeout(hideSpinner, 470); // Delay of 470 milliseconds (0.47 seconds)
    });
});

