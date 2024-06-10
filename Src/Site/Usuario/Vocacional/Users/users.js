
function menu(){

    let menuMobile = document.querySelector(".menu-mobile");
    if(menuMobile.classList.contains('open')) {
        menuMobile.classList.remove('open');
        document.querySelector('.icon').src = "Imagens/cardapio.png";
    } else {
        menuMobile.classList.add('open');
        document.querySelector(".icon").src = "Imagens/botao-excluir.png";
    }
}

let boxBusca = document.querySelector('.busca');
let lupa = document.querySelector('.lupa-buscar');
let btnFechar = document.querySelector('.btn-fechar');

lupa.addEventListener('click', ()=> {
   boxBusca.classList.add('ativar')

})


