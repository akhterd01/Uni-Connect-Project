function updateBtn() {
    var input = document.getElementById('profile-photo');
    var output = document.getElementById('file-list');
    
    output.innerHTML = "<h3 style='color: black; font-size: 0.8rem;'>" + input.files[0].name + "</h3>";
    output.innerHTML += "<h3 style='color: black; font-size: 0.8rem;'> Press 'Save Changes' to confirm.</h3>";
}