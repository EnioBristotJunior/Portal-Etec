<?php include_once("nav.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="./CSS/index.css">
  <link rel="stylesheet" href="./CSS/loader.css">
  <script src="/JS/loader.js"></script>
</head>

<body>



  <section class="slide">
    <div class="img">
      <div class="title">
        <h1>Todos os TCC's da ETEC</h1>
        <br />
        <p>em um só lugar!</p>
        <br>
        <button class="standart-btn" onclick="location.href='#cursos-section'">Ver</button>
      </div>
    </div>
  </section>
  <section class="sobre">
    <div class="text-side">
      <h1>Mas afinal, o que tem de bom nos TCC's da ETEC?</h1>
      <p>
        Todos os anos, os terceiranistas da Etec, tem a responsabilidade de desenvolver o Trabalho de Conclusão se Curso
        (TCC), venha ver os TCC's deste ano!!
      </p>
    </div>
    <div class="cards-side">
      <div class="card-sobre">
        <div class="img-card">
          <img src="./Imagens/luz.svg" />
        </div>
        <div class="text-card">
          <h1>Criatividade</h1>
          <p>
            Totalmente relacionada a capacidade de resolver problemas, nossos "etequianos" tiveram que identificar um
            problema e resolve-lo!
            Venha Conferir!
          </p>
        </div>
      </div>
      <div class="card-sobre">
        <div class="img-card">
          <img src="./Imagens/flecha-no-alvo.png" />
        </div>
        <div class="text-card">
          <h1>Planejamento</h1>
          <p>
            O ato ou efeito de planejar, criar um plano para otimizar o alcance de um determinado objetivo.
            O objetivo aqui é agradar a banca e passar de ano!
          </p>
        </div>
      </div>
    </div>
  </section>
  <section class="cursos" id="cursos-section">
    <h1 class="cursos-title">Cursos</h1>
    <br />
    <br />
    <br />
    <div class="cursos-cards">
      <div class="curso-card">
        <h1>Desenvolvimento de Sistemas</h1>
        <p>
          Veja todos os projetos de TCC's das turmas do curso de Desenvolvimento de Sistemas
        </p>
        <button onclick="window.location='cursos.php?data=<?= $ds ?>&per=todos'" class="standart-btn">Ver</button>
      </div>

      <div class="curso-card">
        <h1>Administração</h1>
        <p>
          Veja todos os projetos de TCC's das turmas do curso de Administração
        </p>
        <button onclick="window.location='cursos.php?data=<?= $adm ?>&per=todos'" class="standart-btn">Ver</button>
      </div>

      <div class="curso-card">
        <h1>Marketing</h1>
        <p>
          Veja todos os projetos de TCC's das turmas do curso de Marketing
        </p>
        <button onclick="window.location='cursos.php?data=<?= $mkt ?>&per=todos'" class="standart-btn">Ver</button>
      </div>

    </div>
  </section>

  <?php include_once("footer.php"); ?>