const tooltip = document.querySelector(".tooltip");
const menuButton = document.querySelector(".menu-button");

menuButton.addEventListener("click", () => {
    tooltip.classList.toggle("active");
    alternarMenuButtonIcon();
})

function menu() {

    let menuMobile = document.querySelector(".menu-mobile");
    if (menuMobile.classList.contains('open')) {
        menuMobile.classList.remove('open');
        document.querySelector('.icon').src = "/Src/Public/assets/Img/cardapio.png";
    } else {
        menuMobile.classList.add('open');
        document.querySelector(".icon").src = "/Src/Public/assets/Img/botao-excluir.png";
    }
}

