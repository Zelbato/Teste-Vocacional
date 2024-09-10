<?php header("Context-type: text\css"); ?>



@import '/Src/assets/global/style/header/header.css';
@import '/Src/assets/styles/index/section-1.css';
@import '/Src/assets/styles/index/sobre.css';
@import '/Src/assets/styles/index/cards.css';
@import '/Src/assets/global/style/footer/footer.css';
@import '/Src/assets/global/style/index.css';

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    height: auto;
    width: 100%;
    font-family: var(--font);
    background: var(--white);
}

.js-global {
    opacity: 0;
    transition: .5s;
    transform: translateX(-10rem);
}

.js-global.active {
    transform: translateX(0);
    opacity: 1;
}



@media (max-width: 1000px) {
    .main {
        display: flex;
        flex-direction: column;
    }
}

