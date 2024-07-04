// Script to toggle the profile dropdown
function toggleDropdown() {
    var dropdown = document.getElementById("profile-dropdown");
    if (dropdown.style.display !== "block") { dropdown.style.display = "block"; }
    else {dropdown.style.display = "none";}
}

// Script to toggle the patient page dropdown
function toggleDropdown2() {
    var dropdown2 = document.getElementById("patient-dropdown");
    if (dropdown2.style.display !== "block") { dropdown2.style.display = "block"; }
    else {dropdown2.style.display = "none";}
}

// Script to toggle an openable menu
function toggleOpenableMenu() {
    var menu = document.getElementById("openable-menu");
    if (menu.style.display !== "block") { menu.style.display = "block"; }
    else {menu.style.display = "none";}
}

// On small screens, script to toggle the small navigation menu
function toggleSmallNavMenu() {
    var snm = document.getElementById("small-nav-menu");
    if (snm.style.display !== "block") { snm.style.display = "block"; }
    else {snm.style.display = "none";}
}