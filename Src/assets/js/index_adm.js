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