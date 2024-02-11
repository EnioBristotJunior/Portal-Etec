var btnFiltro = document.getElementById("open-options");
var opcoes = document.querySelector(".opcoes-filtro");
btnFiltro.addEventListener("click", function () {
  if (opcoes.style.display === "block") {
    opcoes.style.display = "none";
  } else {
    opcoes.style.display = "block";
  }
});

//Modal

const btn = document.getElementById("open-modal");
const btnClose = document.getElementById("close-modal");
const modal = document.querySelector("dialog");

btn.onclick = function () {
  modal.showModal();
};

btnClose.onclick = function () {
  modal.close();
};