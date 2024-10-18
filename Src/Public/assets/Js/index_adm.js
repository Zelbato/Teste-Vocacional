

const initTypingAnimation = () => {
  const title = document.querySelector('.cards .card-titulo h1')
  const span = document.querySelector('.cards .card-titulo .sub-title')

  const typingAnimation = (element) => {

      if (element == title) {
          element.innerHTML = 'Bem-Vindo   '
          const textToArray = element.innerHTML.split('')
          element.innerHTML = ''

          textToArray.forEach((item, index) => {
              setTimeout(() => element.innerHTML += item, 120 * index)
          })

      } else if (element == span) {
          element.innerHTML = 'área do Administrador! \n '
          const textToArray = element.innerHTML.split('')
          element.innerHTML = ''

          textToArray.forEach((item, index) => {
              setTimeout(() => element.innerHTML += item, 150 * index)
          })

      }

  }

  typingAnimation(title)
  setTimeout(() => typingAnimation(span), 1600)

}



initTypingAnimation()



const tooltip = document.querySelector(".tooltip");
const menuButton = document.querySelector(".menu-button");

menuButton.addEventListener("click", () => {
    tooltip.classList.toggle("active");
    alternarMenuButtonIcon();
})


//selecting all required elements
const start_btn_home = document.querySelector(".start_btn");
const start_btn = document.querySelector(".start_btn #button_play");
const info_box = document.querySelector(".info_box");
const highscores = document.querySelector("#highscores");
const scoreTextPoint = document.getElementById("score");
const exit_btn = info_box.querySelector(".buttons .quit");
const continue_btn = info_box.querySelector(".buttons .restart");

// if startQuiz button clicked
start_btn.onclick = () => {
    info_box.classList.add("activeInfo"); //show info box
  };
  
  // if exitQuiz button clicked
  exit_btn.onclick = () => {
    info_box.classList.remove("activeInfo"); //hide info box
  };

  continue_btn.onclick = () => {
  
    info_box.classList.remove("activeInfo"); //hide info box
    start_btn_home.classList.add("hidden");
  
    loader.classList.remove("hidden");
    const myTimeout = setTimeout(startQuiz, 3000);
  
    function startQuiz() {    
      loader.classList.add("hidden");
      start_btn_home.classList.remove("hidden");
      quiz_box.classList.add("activeQuiz"); //show quiz box
      showQuetions(0); //calling showQestions function
      queCounter(1); //passing 1 parameter to queCounter
      startTimer(15); //calling startTimer function
      startTimerLine(0);
    }
  };

  const restart_quiz = result_box.querySelector(".buttons .restart");
const quit_quiz = result_box.querySelector(".buttons .quit");

// if restartQuiz button clicked
restart_quiz.onclick = () => {
    localStorage.setItem("mostRecentScore", userScore); /*go to the end page*/
    return window.location.assign("./Src/assets/pages/questoe.html");
  };
  
  // if quitQuiz button clicked
  quit_quiz.onclick = () => {
    window.location.reload(); //reload the current window
  };

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