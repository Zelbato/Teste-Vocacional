


//muda cor do menu
window.addEventListener('scroll', function (){
    let header = document.querySelector('.header');
    header.classList.toggle('rolagem',window.scrollY > 150);
})


function menu(){

    let menuMobile = document.querySelector(".menu-mobile");
    if(menuMobile.classList.contains('open')) {
        menuMobile.classList.remove('open');
        document.querySelector('.icon').src = "/Src/assets/Imagens/cardapio.png";
    } else {
        menuMobile.classList.add('open');
        document.querySelector(".icon").src = "/Src/assets/Imagens/botao-excluir.png";
    }
}

let boxBusca = document.querySelector('.busca');
let lupa = document.querySelector('.lupa-buscar');
let btnFechar = document.querySelector('.btn-fechar');

lupa.addEventListener('click', ()=> {
   boxBusca.classList.add('ativar')

})


const main = document.querySelector('.main');
const quizSelection = document.querySelector('.quiz-section');
const quizBox = document.querySelector('.quiz-box');
const resultBox = document.querySelector('.result-box');


let quesCount = 0;
let quesNumb = 1;
let userScore = 0;

const nextBtn = document.querySelector('.next-btn');

nextBtn.onclick = () => {//Proxima questão
    if (quesCount < questions.length - 1) {
        quesCount++;
        showQuestions(quesCount);

        quesNumb++;
        questCounter(quesNumb);

        nextBtn.classList.remove('active');

    } else {
        showResultBox();
    }

}

const optionList = document.querySelector('.option-list');

optionList.onclick = () => {//Selecionar a opção

}

//Recebendo as questôes e opções em array

function showQuestions(index) {
    const questionText = document.querySelector('.question-text');
    questionText.textContent = `${questions[index].numb}. ${questions[index].question}`;

    let optionTag = `<div class="option"><span>${questions[index].options[0]}</span></div>
    <div class="option"><span>${questions[index].options[1]}</span></div>
    <div class="option"><span>${questions[index].options[2]}</span></div>
    <div class="option"><span>${questions[index].options[3]}</span></div>`;

    optionList.innerHTML = optionTag;

    const option = document.querySelectorAll('.option');
    for (let i = 0; i < option.length; i++) {
        option[i].setAttribute('onclick', 'optionSelected(this)');
    }
}

function optionSelected(answer) {
    let userAnswer = answer.textContent;
    let correctAnswer = questions[quesCount].answer;
    let allOptions = optionList.children.length;

    if (userAnswer == correctAnswer) {
        answer.classList.add('correct');
        userScore += 1;
        headerScore();

    } else {
        answer.classList.add('incorrect');

        //se a resposta estiver incorreta, selecione automaticamente a resposta correta

        for (let i = 0; i < allOptions; i++) {
            if (optionList.children[i].textContent == correctAnswer) {
                optionList.children[i].setAttribute('class', 'option correct');
            }
        }


    }

    //se o usuário selecionou outra opção, desativou todas as opções

    for (let i = 0; i < allOptions; i++) {
        optionList.children[i].classList.add('disabled');
    }

    nextBtn.classList.add('active');
}

function questCounter(index) {
    const questTotal = document.querySelector('.question-total');
    questTotal.textContent = `${index} de ${questions.length} Questôes`;
}
