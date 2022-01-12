//all divs containing alert messages (success, warning, error)
const alerts = document.querySelectorAll('.alert');

alerts.forEach((alertMsg) => {
  //i used console log to look at the lenght of the alert div when it is empty which returned 5. if it increases it means theres an error message displayed. the div will become visible
  if (alertMsg.innerHTML.length >= 6) {
    alertMsg.classList.remove('hidden');
  }
});
