<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Src/assets/styles/ADM/adm.css">
</head>
<body>

<header class="header">

<div class="menu-mobile">
    <label for="chk1" onclick="menu()">
        <img class="icon" id="icon-mobile" src="/Src/assets/Imagens/cardapio.png" alt="">
    </label>
</div>

<input type="checkbox" name="" id="chk1">

<div class="logo">
    <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
</div>

<ul>
    <li><a id="#home" href="/index.html" id="inicio">Inicio</a></li>
    <li><a id="#vocacional" href="/Src/pages/vocacional.html" id="destaque"><span
                class="teste">Teste Vocacional</span></a>
    </li>
    <li><a id="#facul" href="/Src/pages/faculdade.html" id="eventos">Faculdades</a></li>

    <li><a class="mobile-entrar" href="cadastro.view.php" id="eventos">Entrar</a></li>
    <li><a class="mobile-excluir" href="#" id="eventos">Excluir conta</a></li>

    <a href="#" class="menu-button">
         <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
    </a>

    <div class="tooltip">
        <a href="/Src/pages/cadastro.html" class="menu-item">
       

            <div class="menu-item-content">
                <span class="menu-item-content-title">
                   Ainda não se cadastrou?<br>
                   Clique aqui para se cadastrar!
                </span>
                
                <span class="menu-item-content-subtitle">
                  
                    Cadastrar-se <br>
                     Login
                 </span>
            </div>
        </a>

        <a href="/Src/pages/questoe.html" class="menu-item">

            <div class="menu-item-content">
                <span class="menu-item-content-title">
                   Deseja excluir sua conta <br>
                   Clique aqui para finalizar!
                </span>
                <span class="menu-item-content-subtitle">
                    Excluir conta
                 </span>
            </div>
        </a> 

</ul>
</header>

    <div class="start_btn">
        <button class="btn" id="button_play">Cadastrar Questões</button>
        <a class="btn" id="button_score" href="#">Exluir Questões</a>
      </div>
      <div class="info_box">
        <div class="info-title"><span>Bem-Vindo ao espaço do ADM</span></div>
        <div class="info-list">
          <div class="info">
            1. Você pode<span> cadastrar </span> as perguntas.
          </div>
          <div class="info">
            2. Cada pergunta tem 4 alternativas.
          </div>
          <div class="info">
            3. Para cada pergunta é obrigatório uma area de atuação.
          </div>
          <div class="info">
            4. Você pode <span> Cadastrar </span> as faculdades e seus cursos.
          </div>
          <div class="info">5. É obrigatório preencher todas as lacunas</div>
        </div>
        <div class="buttons">
            <button class="quit">Voltar</button>
            <a class="restart" href="../View/cadastrarQ.view.php">Continuar</a>
          </div>
      </div>

      <script src="../../Public/assets/Js/index_adm.js"></script>
</body>
</html>