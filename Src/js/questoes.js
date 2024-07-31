
function menu() {

    let menuMobile = document.querySelector(".menu-mobile");
    if (menuMobile.classList.contains('open')) {
        menuMobile.classList.remove('open');
        document.querySelector('.icon').src = "Src/assets/Imagens/cardapio.png";
    } else {
        menuMobile.classList.add('open');
        document.querySelector(".icon").src = "Src/assets/Imagens/botao-excluir.png";
    }
}
