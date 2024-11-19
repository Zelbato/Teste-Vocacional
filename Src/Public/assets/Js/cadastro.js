// const togglePassword = document.getElementById('togglePassword');
// const passwordInput = document.getElementById('senha');
// const passwordIcon = document.getElementById('passwordIcon');

// togglePassword.addEventListener('click', () => {
//   // Alterna o tipo do campo entre 'password' e 'text'
//   const type = passwordInput.type === 'password' ? 'text' : 'password';
//   passwordInput.type = type;

//   // Alterna o ícone entre olho aberto e olho fechado
//   if (type === 'password') {
//     passwordIcon.classList.remove('fa-eye-slash');
//     passwordIcon.classList.add('fa-eye');
//   } else {
//     passwordIcon.classList.remove('fa-eye');
//     passwordIcon.classList.add('fa-eye-slash');
//   }
// });


const tooltip = document.querySelector(".tooltip");
const menuButton = document.querySelector(".menu-button");

menuButton.addEventListener("click", () => {
    tooltip.classList.toggle("active");
    alternarMenuButtonIcon();
})


//muda cor do menu
window.addEventListener('scroll', function (){
    let header = document.querySelector('.header');
    header.classList.toggle('rolagem',window.scrollY > 150);
})


function menu(){

    let menuMobile = document.querySelector(".menu-mobile");
    if(menuMobile.classList.contains('open')) {
        menuMobile.classList.remove('open');
        document.querySelector('.icon').src = "/Src/Public/assets/Img/cardapio.png";
    } else {
        menuMobile.classList.add('open');
        document.querySelector(".icon").src = "/Src/Public/assets/Img/botao-excluir.png";
    }
}

let boxBusca = document.querySelector('.busca');
let lupa = document.querySelector('.lupa-buscar');
let btnFechar = document.querySelector('.btn-fechar');

lupa.addEventListener('click', ()=> {
   boxBusca.classList.add('ativar')

})



