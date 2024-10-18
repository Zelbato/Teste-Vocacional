
const tooltip = document.querySelector(".tooltip");
const menuButton = document.querySelector(".menu-button");

menuButton.addEventListener("click", () => {
    tooltip.classList.toggle("active");
    alternarMenuButtonIcon();
})


function menu() {
    let menuMobile = document.querySelector(".menu-mobile");
    // let icon = document.querySelector('.icon');

    // if (menuMobile.classList.contains('open')) {
    //     menuMobile.classList.remove('open');
    //     icon.src = "Img/cardapio.png"; // Update with the path to the closed icon
    // } else {
    //     menuMobile.classList.add('open');
    //     icon.src = "Img/botao-excluir.png"; // Update with the path to the open icon
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

// Scroll Animation

const initAnimationScroll = () => {
    const sections = document.querySelectorAll('.js-global')

    const windowHalfSize = window.innerHeight * 0.6

    const animateScroll = () => {
        sections.forEach(item => {
            const sectionTop = item.getBoundingClientRect().top

            const isSectionVisible = (sectionTop - windowHalfSize) < 0

            if (isSectionVisible) {
                item.classList.add('active')
            } else {
                item.classList.remove('active')
            }

        })
    }

    animateScroll()

    window.addEventListener('scroll', animateScroll)

}

initAnimationScroll()

// Scroll Smooth

const initTypingAnimation = () => {
    const title = document.querySelector('.inicio .description h2')
    const span = document.querySelector('.inicio .description .texto')
    const paragraph = document.querySelector('.inicio .description .texto-2')

    const typingAnimation = (element) => {

        if (element == title) {
            element.innerHTML = 'Começe a Estudar Agora Mesmo! '
            const textToArray = element.innerHTML.split('')
            element.innerHTML = ''

            textToArray.forEach((item, index) => {
                setTimeout(() => element.innerHTML += item, 120 * index)
            })

        } else if (element == span) {
            element.innerHTML = 'Faça o Teste Vocacional \n '
            const textToArray = element.innerHTML.split('')
            element.innerHTML = ''

            textToArray.forEach((item, index) => {
                setTimeout(() => element.innerHTML += item, 150 * index)
            })

        } else  {
            element.innerHTML = 'e descubra qual é a sua área de atuação.'
            const textToArray = element.innerHTML.split('')
            element.innerHTML = ''

            textToArray.forEach((item, index) => {
                setTimeout(() => element.innerHTML += item, 75 * index)
            })

        }

    }

    typingAnimation(title)
    setTimeout(() => typingAnimation(span), 1600)
    setTimeout(() => typingAnimation(paragraph), 3700)

}



initTypingAnimation()
