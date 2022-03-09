const input = document.querySelector('#code');

input.addEventListener('keypress', (e) => {
    if(input.value.length > 4) {
        e.preventDefault();
    }
});