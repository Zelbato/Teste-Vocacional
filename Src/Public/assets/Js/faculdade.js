
const tooltip = document.querySelector(".tooltip");
const menuButton = document.querySelector(".menu-button");

menuButton.addEventListener("click", () => {
    tooltip.classList.toggle("active");
    alternarMenuButtonIcon();
})


function menu() {

    let menuMobile = document.querySelector(".menu-mobile");
    // if (menuMobile.classList.contains('open')) {
    //     menuMobile.classList.remove('open');
    //     document.querySelector('.icon').src = "/Src/Public/assets/Img/cardapio.png";
    // } else {
    //     menuMobile.classList.add('open');
    //     document.querySelector(".icon").src = "/Src/Public/assets/Img/botao-excluir.png";
    // }
}

/*
let boxBusca = document.querySelector('.busca');
let lupa = document.querySelector('.lupa-buscar');
let btnFechar = document.querySelector('.btn-fechar');

lupa.addEventListener('click', () => {
    boxBusca.classList.add('ativar')
})*/

//muda cor do menu
window.addEventListener('scroll', function (){
    let header = document.querySelector('.header');
    header.classList.toggle('rolagem',window.scrollY > 100);
})