// Formulário
const form = document.getElementById('formulario');
const nomePet = document.getElementById('nomePet');
const formMsg = document.getElementById('formMsg');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  if (nomePet.value.trim() === '') {
    formMsg.textContent = 'Ops! Diga o nome do seu pet. 🐾';
    formMsg.className = 'form-msg erro';
    return;
  }
  formMsg.textContent = `Au au! ${nomePet.value.trim()} já está na fila do carinho. 🐶`;
  formMsg.className = 'form-msg sucesso';
  form.reset();
});

// Cookies
document.getElementById('aceitarCookies').addEventListener('click', () => {
  document.getElementById('cookieBar').style.display = 'none';
});
