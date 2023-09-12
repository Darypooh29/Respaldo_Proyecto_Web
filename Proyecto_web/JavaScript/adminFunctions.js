const btnCloseModal = document.querySelector("#btnCloseModal");
const btnOpenModal = document.querySelector("#openModal");
const modal = document.querySelector("#modal");
const toggleBtn = document.querySelector('.toggle_btn')
const toggleBtnIcon = document.querySelector('.toggle_btn i')
const dropDownMenu = document.querySelector('.dropdown_menu')
const openModalModify = document.querySelectorAll(".modifyUserClass");
const sendModifications = document.querySelector("#sendModifications");

toggleBtn.onclick = function(){
    dropDownMenu.classList.toggle('open')
    const isOpen = dropDownMenu.classList.contains('open')

    toggleBtnIcon.classList = isOpen
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'
}

btnOpenModal.addEventListener("click", (event) => {
    event.preventDefault(); 
    modal.showModal();
});

btnCloseModal.addEventListener("click", ()=>{
    modal.close();
});

// openModalModify.forEach((button) => {
//     button.addEventListener("click", (event) => {
//         event.preventDefault();
//         modifyModal.showModal();
//     });
// });

// document.getElementById("boton").addEventListener("click", function(){
//     window.location.href = "/Views/login.html";
// });


