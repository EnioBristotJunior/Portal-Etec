<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Etec TCC's</title>
  <link rel="stylesheet" href="./CSS/navbar.css">
</head>

<body>
  <?php $ds = 1;
  $adm = 2;
  $mkt = 3; ?>
  <header>
    <nav class="navbar">
      <div class="logo"><a href="index.php">ETEC TCC'S</a></div>
      <ul>
        <li><a href="cursos.php?data=<?= $ds ?>&per=todos"> Des. de Sistemas </a></li>
        <li><a href="cursos.php?data=<?= $adm ?>&per=todos"> Administração</a></li>
        <li><a href="cursos.php?data=<?= $mkt ?>&per=todos"> Marketing</a></li>
      </ul>
      <div class="search">
        <input type="text" placeholder="Pesquisar projeto" class="search-input" id="pesquisar">
        <ion-icon name="search-outline" class="input-btn" onclick="searchData()"></ion-icon>
      </div>
      <div class="menu-btn" id="mobile-menu" data-value="closed">
        <ion-icon name="menu-outline" id="change"></ion-icon>
      </div>
    </nav>
    <div class="dropdown-menu" id="dropMenu">
      <ul>
        <li><a href="cursos.php?data=<?= $ds ?>&per=todos"> Des. de Sistemas </a></li>
        <li><a href="cursos.php?data=<?= $adm ?>&per=todos"> Administração</a></li>
        <li><a href="cursos.php?data=<?= $mkt ?>&per=todos"> Marketing</a></li>
        <li>
          <div class="search">
            <input type="text" placeholder="Pesquisar projeto" class="search-input" id="pesquisar2">
            <ion-icon name="search-outline" class="input-btn" onclick="searchData2()"></ion-icon>
          </div>
        </li>
      </ul>
    </div>
  </header>

  <script>
    var search = document.getElementById("pesquisar")
    var search2 = document.getElementById("pesquisar2")

    // const Keys = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q","r", "s", "t","u", "v", "w", "x", "y", "z", ",", ".", "!", "^", "~", "´", "`", "''", "?", ":", "(", ")" ]

    search.addEventListener("keydown", function (event) {

      if (event.key === "Enter") {
        searchData();
      }
    })

    search2.addEventListener("keydown", function (event) {

      if (event.key === "Enter") {
        searchData2();
      }
    })

    function searchData() {

      if (search.value == "") {
        alert("Digita algo né garaio")
      } else {
        window.location = "cursos.php?data=0&per=0&search=" + search.value;
      }
    }

    function searchData2() {

      if (search2.value == "") {
        alert("Digita algo né garaio")
      } else {
        window.location = "cursos.php?data=0&per=0&search=" + search2.value;
      }
    }

    var toggleDiv = document.getElementById('mobile-menu')
    var toggleIcon = document.getElementById('change')
    var dropMenu = document.getElementById('dropMenu')

    toggleDiv.addEventListener("click", function () {
      dropMenu.classList.toggle('open')
      const open = dropMenu.classList.contains('open')

      toggleIcon.name = open ? 'close-outline' : 'menu-outline';
    })
  </script>
</body>

</html>