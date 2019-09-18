window.onload = function () {

  let buttons = document.querySelectorAll('[type=submit]');

  for (var button of buttons) {
    button.addEventListener(
      'click',
      function (ev) {
        ev.preventDefault();
        Swal.fire({
          text: 'Confirma la eliminación de este item?',
          type: 'question',
          background: '#f0f0f0',
          showConfirmButton: true,
          showCancelButton: true,
          confirmButtonText: 'Sí',
          cancelButtonText: 'No',
          customClass: {
            content: 'sweetalert',
            confirmButton: 'sweetalert',
            cancelButton: 'sweetalert'
          }
        })
        .then(
          result => { if (result.value) window.location = this.parentElement.submit(); }
        );
      }
    );
  }
}
