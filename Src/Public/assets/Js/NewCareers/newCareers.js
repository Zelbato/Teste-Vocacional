
const tooltip = document.querySelector(".tooltip");
const menuButton = document.querySelector(".menu-button");

menuButton.addEventListener("click", () => {
    tooltip.classList.toggle("active");
    alternarMenuButtonIcon();
})

let currentQuestionIndex = 0;
let score = 0;


document.addEventListener('DOMContentLoaded', function () {
    const questions = [
        {
            question: "O emprego ideal é aquele no qual você:",
            options: [
                { id: 1, text: "Trabalha com criatividade" },
                { id: 2, text: "Segue regras estabelecidas" },
                { id: 3, text: "Lidera uma equipe" }
            ]
        },
        {
            question: "Você prefere trabalhar em um ambiente:",
            options: [
                { id: 1, text: "Estruturado e previsível" },
                { id: 2, text: "Flexível e dinâmico" },
                { id: 3, text: "Competitivo e desafiador" }
            ]
        },
        // Adicione mais perguntas aqui...
    ];

    let currentQuestionIndex = 0;
    let score = 0;

    function loadQuestion() {
        const currentQuestion = questions[currentQuestionIndex];
        document.querySelector('.question-text').textContent = currentQuestion.question;

        const optionsHtml = currentQuestion.options.map(option => `
            <div class="option">
                <input type="radio" id="option${option.id}" name="option" value="${option.id}">
                <label for="option${option.id}">${option.text}</label>
            </div>
        `).join('');

        document.querySelector('.option-list').innerHTML = optionsHtml;
        document.querySelector('.question-total').textContent = `${currentQuestionIndex + 1} / ${questions.length} Questões`;
    }

    function showResult() {
        document.querySelector('.quiz').style.display = 'none';
        document.querySelector('.result-box').style.display = 'block';
        document.querySelector('.score-text').textContent = `Você respondeu ${questions.length} questões.`;
    }

    document.querySelector('.next-btn').addEventListener('click', function () {
        const selectedOption = document.querySelector('input[name="option"]:checked');

        if (selectedOption) {
            // Avança para a próxima pergunta
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                loadQuestion();
            } else {
                showResult();
            }
        } else {
            alert('Por favor, selecione uma opção!');
        }
    });

    loadQuestion(); // Carregar a primeira pergunta
});
