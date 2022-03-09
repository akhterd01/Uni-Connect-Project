const deleteBtn_1 = document.getElementById('delete-btn-1');
const cancelBtn = document.getElementById('cancel-btn');
const popUpContainer = document.querySelector('.pop-up-delete-account');

deleteBtn_1.addEventListener('click', () => {
    popUpContainer.style.display = 'block';
});

cancelBtn.addEventListener('click', () => {
    popUpContainer.style.display = 'none';
});