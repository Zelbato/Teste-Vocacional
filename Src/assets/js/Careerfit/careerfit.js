let currentQuestionIndex = 0;
let score = 0;

document.addEventListener('DOMContentLoaded', function() {
    loadQuestion();

    document.querySelector('.next-btn').addEventListener('click', function() {
        const selectedOption = document.querySelector('input[name="option"]:checked');
        
        if (selectedOption) {
            const selectedValue = selectedOption.value;
            const currentQuestion = questions[currentQuestionIndex];
            
            // Verifica se a resposta está correta
            if (selectedValue === currentQuestion.correctAnswer) {
                score++;
            }
            
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
    
});

function loadQuestion() {
    const question = questions[currentQuestionIndex];
    document.querySelector('.question-text').textContent = question.question;
    
    const optionsHtml = question.options.map((option, index) => `
        <div class="option">
            <input type="radio" id="option${index}" name="option" value="${option.value}">
            <label for="option${index}">${option.text}</label>
        </div>
    `).join('');

    const optionList = document.querySelector('.option-list');

    optionList.action = () => {//Selecionar a opção
    
    }
    
    document.querySelector('.option-list').innerHTML = optionsHtml;
    document.querySelector('.question-total').textContent = `${currentQuestionIndex + 1} / ${questions.length} Questões`;
}

function showResult() {
    document.querySelector('.quiz').style.display = 'none';
    document.querySelector('.result-box').style.display = 'block';
    document.querySelector('.score-text').textContent = `Você acertou ${score} de ${questions.length}`;
}

