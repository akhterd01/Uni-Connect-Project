// Navbar settings dropdown event

const settingsIcon = document.querySelector('#settings-link');
const hoverOutSection = document.querySelector('.profile-page-container');
const hiddenLinks = document.querySelector('#dropdown-menu');

settingsIcon.addEventListener('click', () => {
    if(hiddenLinks.style.display == 'block') {
        hiddenLinks.style.display = 'none';
    } else {
        hiddenLinks.style.display = 'block';
    }
});

hoverOutSection.addEventListener('click', () => {
    hiddenLinks.style.display = 'none';
});