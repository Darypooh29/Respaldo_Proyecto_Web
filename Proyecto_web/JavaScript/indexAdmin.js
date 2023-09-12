const toggleBtn = document.querySelector('.toggle_btn')
const toggleBtnIcon = document.querySelector('.toggle_btn i')
const dropDownMenu = document.querySelector('.dropdown_menu')

toggleBtn.onclick = function(){
    dropDownMenu.classList.toggle('open')
    const isOpen = dropDownMenu.classList.contains('open')

    toggleBtnIcon.classList = isOpen
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'
}

document.getElementById("userManagement").addEventListener("click", function(){
    window.location.href = './usersAdmin.php';
});
document.getElementById("productsManagement").addEventListener("click", function(){
    window.location.href = "./productsAdmin.php";
});