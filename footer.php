<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>rodape</title>
  <link rel="stylesheet" href="./CSS/rodape.css">
</head>

<body>
  <footer>
    <div class="conteudo">
      <a href="https://www.etecatibaia.com.br/" class="footer_title" target="_blank" rel="noopener noreferrer">Etec
        Carmine Biagio Tundisi</a>
      <div class="icons">
        <a href="https://www.instagram.com/etecatibaia/" target="_blank" rel="noopener noreferrer">
          <span>
            <ion-icon name="logo-instagram"></ion-icon>
          </span>
        </a>
        <a href="https://api.whatsapp.com/send?text=Fale%20Conosco%20https%3A%2F%2Fwww.etecatibaia.com.br%2Fouvidoria%2F"
          target="_blank" rel="noopener noreferrer">
          <span>
            <ion-icon name="logo-whatsapp"></ion-icon>
          </span>
        </a>
        <a href="https://br.linkedin.com/school/etec-prof--carmine-biagio-tundisi/" target="_blank"
          rel="noopener noreferrer"><span>
            <ion-icon name="logo-linkedin"></ion-icon>
          </span></a>

      </div>

      <div class="links">
        <?php $ds = 1;
        $adm = 2;
        $mkt = 3; ?>
        <ul class="links-ul">
          <a href="cursos.php?data=<?= $ds ?>&per=todos" class="media">Des. de Sistemas</a>
          <a href="cursos.php?data=<?= $adm ?>&per=todos" class="media">Administração</a>
          <a href="cursos.php?data=<?= $mkt ?>&per=todos" class="media">Marketing</a>
        </ul>
       
        
      </div>
      <ul class="links-ul">
          <p class="media-nome">Davi Ibraim Almendra Freitas Silva</p>
          <p class="media-nome">Enio Bristot Junior</p>
          <p class="media-nome">Paulo André Lima dos Santos</p>
          <p class="media-nome">Saulo Giordani Arantes Goes</p>
        </ul>

      
    </div>
  </footer>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>