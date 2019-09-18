window.onload = function () {

  let link = document.querySelector('.finalize-button');

  link.addEventListener(
    'click',
    function (ev) {
      ev.preventDefault();
      Swal.fire({
        title: 'Atención!',
        text: 'Los productos ofrecidos aquí son ficticios y no están a la venta. Si continúa será redirigido a la página de testeo de cobro de Mercado Pago. El pago también es ficticio. Al finalizar podrá regresar a esta web para completar el proceso.',
        type: 'warning',
        background: '#f0f0f0',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Entiendo',
        cancelButtonText: 'Cancelar',
        customClass: {
          header: 'sweetalert',
          content: 'sweetalert',
          confirmButton: 'sweetalert',
          cancelButton: 'sweetalert'
        }
      })
      .then(
        result => { if (result.value) window.location = link.href; }
      );
    }
  );
}
