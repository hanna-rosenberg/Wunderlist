//all divs containing alert messages (success, warning, error)
const alerts = document.querySelectorAll('.alert');

alerts.forEach((alertMsg) => {
  if (alertMsg.innerHTML != '') {
    alertMsg.classList.remove('hidden');
  }
});
