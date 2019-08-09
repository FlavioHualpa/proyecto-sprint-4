window.onload = function () {
  var links = document.querySelectorAll('a.page-link');
  var form = document.querySelector('#change-page-form');

  for (var link of links) {
    link.addEventListener('click', function (event) {
      event.preventDefault();
      form.page.setAttribute('value', this.innerText);
      form.submit();
    });
  }
}
