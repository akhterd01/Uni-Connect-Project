// Navbar toggler functionality

let toggler = document.querySelector('.toggler');
let linksContainer = document.querySelector('.links-container-inner');
let links = document.querySelector('.links-container');

toggler.addEventListener('click', () => {
    let linksContainerHeight = linksContainer.getBoundingClientRect().height;
    let navBarHeight = document.querySelector('nav.max-container').getBoundingClientRect().height;

    if(navBarHeight < 100) {
        links.style.height = `${linksContainerHeight}px`;
    } else {
        links.style.height = '0px'
    }
});

// Change toggler bars to toggler cross and vice versa on click

let togglerIcon = document.querySelector('.toggler i');

toggler.addEventListener('click', () => {
    if(togglerIcon.classList.contains('fa-bars')) {
        togglerIcon.classList.remove('fa-bars');
        togglerIcon.classList.add('fa-times');
    }
    else if(togglerIcon.classList.contains('fa-times')) {
        togglerIcon.classList.remove('fa-times');
        togglerIcon.classList.add('fa-bars');
    }
});