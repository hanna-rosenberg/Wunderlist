//all divs containing alert messages (success, warning, error)
const alerts = document.querySelectorAll('.alert');

alerts.forEach((alertMsg) => {
  if (trim(alertMsg.innerHTML) != '') {
    alertMsg.classList.remove('hidden');
  }
});
