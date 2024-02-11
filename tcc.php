<?php include_once("nav.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TCC</title>
  <link rel="stylesheet" href="./CSS/tcc.css" />
</head>

<body>
  <?php
  $foto = "";
  $qrcode = "";
  $pasta_grupo = $_GET["pasta"];
  $itensgrupo = new DirectoryIterator($pasta_grupo);
  foreach ($itensgrupo as $itemgrupo) {
    if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
      $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
    } elseif ($itemgrupo->getExtension() == "svg") {
      $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
    }
  }
  ?>
  <ion-icon name="arrow-back-outline" id="btn-voltar" onclick="javascript:history.back()"></ion-icon>
  <div class="container">
    <div class="tcc-title">
      <?php echo "<img src=" . $foto . " class='imagem'>" ?>
      <h1 id="titulo" style="text-align: center; padding-left: 20px; padding-right: 20px"></h1>
      <p id="descricao" style="text-align: center; padding-left: 25px; padding-right: 25px">

      </p>
    </div>
    <div class="content">
      <h1>Equipe:</h1>
      <div class="equipe" id="equipeArea">
        <!-- <div class="membro">
            <p id="membro1">Enio Bristot</p>
            <p>/</p>
            <p id="membro1-email" class="email">eniobristotjunior@gmail.com</p>
          </div> -->

      </div>

      <h1>Orientadores:</h1>
      <div class="equipe" id="divOrientadores">
        <div class="membro">
          <p class="text-ori">Orientador:</p>
          <p id="orientador"></p>
          <p>/</p>
          <p id="orientador-email" class="email"></p>
        </div>
        <div class="membro">
          <p class="text-ori">Coorientador:</p>
          <p id="coorientador"></p>
          <p>/</p>
          <p id="coorientador-email" class="email"></p>
        </div>
      </div>
      <h1>Questão Problema:</h1>
      <p id="problema">

      </p>
      <h1>Justificativa:</h1>
      <p id="justificativa">

      </p>
      <h1>Hipótese:</h1>
      <p id="hipotese">

      </p>
      <h1>Objetivos:</h1>
      <div class="objetivos-tudo">
        <div class="into">
          <h1>Geral:</h1>
          <p id="objetivo_geral">

          </p>
        </div>
        <div class="into">
          <h1>Especificos:</h1>
          <ol id="objetivo_especifico"></ol>

          </p>
        </div>
      </div>
      <h1>Metodologia:</h1>
      <ol id="metodologia">

      </ol>
      <h1>Pesquisa de Campo:</h1>
      <div class="box-pesquisa">
        <div class="box-qr">
          <?php
          if ($qrcode != "") {
            echo "<img src=" . $qrcode . " alt='Não há qrcode de pesquisa'>";
          } else {
            echo "<h3 style='text-align:center'>Não há QRcode de pesquisa neste grupo</h3>";
          }
          ?>
          <!-- <img src="" id="qrcodar" /> -->
        </div>
        <div class="area-link">
          <h1>Link:</h1>
          <div class="box-link">
            <input id="link" class="input-link" value="" readonly>
            <ion-icon name="copy-outline" onclick="copiarTexto()"></ion-icon>

          </div>
        </div>
      </div>
      <div class="refere">
        <p>Referências bibliográficas</p>
        <ion-icon name="arrow-up-outline" id="open-modal"></ion-icon>
      </div>
      <dialog>
        <div class="modal-content">
          <div class="modal-header">
            <ion-icon name="close-outline" id="close-modal"></ion-icon>
            <h1>Referências:</h1>
          </div>
          <div class="modal-body" id="referencias">
            <!-- <div class="box-referencia">
              <input id="ref1" value="BORNHOLDT, Larissa et al. Cuidados de enfermagem a indivíduos
                com surdez e/ou mudez em instituição hospitalar: Nursing care
                to individuals with deafness and/or dumbness in hospital
                institution. Revista Enfermagem Atual In Derme, v. 89, n. 27,
                2019. Disponível em
                https://revistaenfermagematual.com/index.php/revista/article/view/422/513.
                Acesso em: 16/2/2023." readonly>


              <ion-icon name="copy-outline" onclick="CopiaRef()"></ion-icon>
            </div>

          
            <div class="box-referencia">
              <p>
                GOULART, Bárbara Niegia Garcia de; CHIARI, Brasília M.
                Distúrbios de fala e dificuldades de aprendizagem no Ensino
                Fundamental. Revista CEFAC, v. 16, p. 810-816, 2014.
                Disponível
                em:https://www.scielo.br/j/rcefac/a/yc8DC6bNqTMZ4mHKDQdfq6Q/?lang=pt.
                Acesso em 16/2/2023
              </p>
              <ion-icon name="copy-outline"></ion-icon>
            </div>

            <div class="box-referencia">
              <p>
                GOULART, Bárbara Niegia Garcia de; CHIARI, Brasília M.
                Distúrbios de fala e dificuldades de aprendizagem no Ensino
                Fundamental. Revista CEFAC, v. 16, p. 810-816, 2014.
                Disponível
                em:https://www.scielo.br/j/rcefac/a/yc8DC6bNqTMZ4mHKDQdfq6Q/?lang=pt.
                Acesso em 16/2/2023
              </p>
              <ion-icon name="copy-outline"></ion-icon>
            </div>
            <div class="box-referencia">
              <p>
                GOULART, Bárbara Niegia Garcia de; CHIARI, Brasília M.
                Distúrbios de fala e dificuldades de aprendizagem no Ensino
                Fundamental. Revista CEFAC, v. 16, p. 810-816, 2014.
                Disponível
                em:https://www.scielo.br/j/rcefac/a/yc8DC6bNqTMZ4mHKDQdfq6Q/?lang=pt.
                Acesso em 16/2/2023
              </p>
              <ion-icon name="copy-outline"></ion-icon>
            </div> -->
          </div>
        </div>
      </dialog>
    </div>


  </div>



  <?php if (isset($_GET["tcc"])) { ?>
    <script>

      var integrante = ""
      var referencia = ""
      var objEspec = ""
      var eachMetodo = ""

      //Variaveis

      var titulo = document.getElementById("titulo")
      var descricao = document.getElementById("descricao")

      //Pessoas
      var equipe = document.getElementById("equipeArea")
      var orientador = document.getElementById("orientador")
      var coorientador = document.getElementById("coorientador")
      var orientadorEmail = document.getElementById("orientador-email")
      var coorientadorEmail = document.getElementById("coorientador-email")
      //Content
      var problema = document.getElementById("problema")
      var justificativa = document.getElementById("justificativa")
      var hipotese = document.getElementById("hipotese")
      var metodologia = document.getElementById("metodologia")
      var objetivo_geral = document.getElementById("objetivo_geral")
      var objetivo_especificos = document.getElementById("objetivo_especifico")
      var link = document.getElementById("link")
      var referencias = document.getElementById("referencias")

      //Imagens

      var foto = document.getElementById("img")
      var qrcode = document.getElementById("qrcodar")

      //Pega foto


      var arquivojson = '<?= $_GET["tcc"]; ?>'
      var qrcode = '<?= $qrcode; ?>'
      var foto = '<?= $foto; ?>'

      fetch(arquivojson)
        .then(resposta => resposta.json())
        .then(dados => {

          //Imagens


          // var fotinho = dados.foto
          // var qr = dados.qrcode

          // foto.src = fotinho
          // qrcode.src = qr


          //Geral

          titulo.innerHTML = dados.titulo
          descricao.innerHTML = dados.descricao
          problema.innerHTML = dados.problema
          hipotese.innerHTML = dados.hipotese
          justificativa.innerHTML = dados.justificativa
          //Orientador
          var ori = dados.orientadores.orientador.Nome
          console.log(ori)
          var oriEmail = dados.orientadores.orientador.Email

          if (ori == "" || ori == undefined) {
            orientador.innerHTML = "Não Definido";
          } else {
            orientador.innerHTML = ori
          }

          if (oriEmail == "" || oriEmail == undefined) {
            orientadorEmail.innerHTML = "Não Definido";
          } else {
            orientadorEmail.innerHTML = oriEmail
          }

          // Coorientador
          var coo = dados.orientadores.coorientador.Nome;
          var cooEmail = dados.orientadores.coorientador.Email;
          if (coo == "" || coo == undefined) {
            coorientador.innerHTML = "Não Definido";
          } else {
            coorientador.innerHTML = coo
          }

          if (cooEmail == "" || cooEmail == undefined) {
            coorientadorEmail.innerHTML = "Não Definido";
          } else {
            coorientadorEmail.innerHTML = cooEmail
          }

          link.value = dados.pesquisa
          if (link.value == "" || link.value == "undefined") {
            link.value = "Não há link de pesquisa"
          }
          objetivo_geral.innerHTML = dados.objetivos.geral


          //for
          var nome = dados.equipe
          var ref = dados.referencias
          var especific = dados.objetivos.especificos
          var metodo = dados.metodologia

          //Pega imagem




          //Integrantes


          for (let item in nome) {
            var name = nome[item].Nome
            if (name == "" || name == undefined) {
              console.log("Membro de equipe incorreto no JSON")
            } else {
              var email = nome[item].Email
              if (email == "" || email == undefined) {
                email = "Email não informado"
              }
              integrante += "<div class='membro'>"
              integrante += "<p>"
              integrante += name
              integrante += "</p>"
              integrante += "<p>"
              integrante += "/"
              integrante += "</p>"
              integrante += "<p class='email'>"
              integrante += email
              integrante += "</p>"
              integrante += "</div>"
            }

          }

          equipe.innerHTML = integrante

          //Objetivos especificos

          for (let item in especific) {
            objEspec += "<li>"
            objEspec += especific[item]
            objEspec += "</li>"

          }

          objetivo_especificos.innerHTML = objEspec

          //Metodologia

          for (let item in metodo) {
            eachMetodo += "<li>"
            eachMetodo += metodo[item]
            eachMetodo += "</li>"
          }

          metodologia.innerHTML = eachMetodo

          //Referências
          let i = 0
          for (let item in ref) {
            i += 1
            referencia += "<div class='box-referencia'>"
            referencia += "<textarea style='resize: none' id='ref" + i + "' readonly>" + ref[item] + "</textarea>"
            referencia += "<ion-icon name='copy-outline' onclick='CopiaRef(" + i + ")'></ion-icon>"
            referencia += "</div>"


          }
          referencias.innerHTML = referencia

        })        
    </script>
  <?php } ?>

  <script src="./JS/tcc.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php include_once("footer.php"); ?>