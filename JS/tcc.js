const btn = document.getElementById("open-modal");
const btnClose = document.getElementById("close-modal");
const modal = document.querySelector("dialog");

btn.onclick = function () {
  modal.showModal();
};

btnClose.onclick = function () {
  modal.close();
};

/*Copiar texto*/

function copiarTexto() {
  let textoCopiado = document.getElementById("link");
  textoCopiado.select();
  document.execCommand("copy");
  // textoCopiado.style.color("#f22b29");
}

function CopiaRef(indice) {
  let refCopiado = document.getElementById("ref" + indice);
  refCopiado.select();
  document.execCommand("copy");
  // textoCopiado.style.color("#f22b29");
}

// Type 1
// document.getElementById('copiar').addEventListener('click', execCopy);
// function execCopy() {
//   document.getElementById("link-pesquisa").select();
//   document.execCommand("copy");
// }

// // Type 2
// document.getElementById('copiar').addEventListener('click', clipboardCopy);
// async function clipboardCopy() {
//   let text = document.getElementById("linkPesquisa");
//   await navigator.clipboard.writeText(text.value);
// }

// const btnCopy = document.getElementById("copiar");
// const texto = document.getElementById("link");

// btnCopy.addEventListener('click', (e) => {
//   e.preventDefault();

//   navigator.clipboard.writeText(link.value);

//   alert('Texto copiado para área de transferência! Ctrl+V em algum local para colar');
// });
