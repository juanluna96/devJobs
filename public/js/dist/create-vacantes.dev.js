"use strict";

Dropzone.autoDiscover = false;
document.addEventListener('DOMContentLoaded', function () {
  /* ------------------------------ Medium editor ----------------------------- */
  var editor = new MediumEditor('.editable', {
    toolbar: {
      buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', 'orderedList', 'unorderedList', 'h2', 'h3'],
      "static": true,
      sticky: true
    },
    placeholder: {
      text: 'Informacion de la vacante'
    }
  }); // Agrega al input hidden lo que el usuario escribe en medium editor

  editor.subscribe('editableInput', function (eventObj, editable) {
    var contenido = editor.getContent();
    document.querySelector('#descripcion').value = contenido;
  }); // Llena el editor con el contenido del input hidden

  editor.setContent(document.querySelector('#descripcion').value);
  /* -------------------------------- Dropzone -------------------------------- */

  var dropzoneDevJobs = new Dropzone('#dropzoneDevJobs', {
    url: '/vacantes/imagen',
    dictDefaultMessage: 'Sube aquí tu archivo',
    acceptedFiles: '.png,.jpg,.jpeg,.gif,.bmp',
    addRemoveLinks: true,
    maxFiles: 1,
    dictRemoveFile: 'Borrar archivo',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    init: function init() {
      if (document.querySelector('#imagen').value.trim()) {
        var imagenPublicada = {};
        imagenPublicada.size = 1234;
        imagenPublicada.name = document.querySelector('#imagen').value;
        this.options.addedfile.call(this, imagenPublicada);
        this.options.thumbnail.call(this, imagenPublicada, "/storage/vacantes/".concat(imagenPublicada.name));
        imagenPublicada.previewElement.classList.add('dz-sucess');
        imagenPublicada.previewElement.classList.add('dz-complete');
      }
    },
    success: function success(file, response) {
      console.log(response);
      document.querySelector('#error').textContent = ''; // Coloca la respuesta del servidor en el input hidden

      document.querySelector('#imagen').value = response.correcto; // Añadir al objeto de archivo el nombre del servidor

      file.nombreServidor = response.correcto;
    },
    error: function error(file, response) {
      // console.log(response);
      document.querySelector('#error').textContent = 'Formato no valido';
    },
    maxfilesexceeded: function maxfilesexceeded(file) {
      if (this.files[1] != null) {
        this.removeFile(this.files[0]);
        this.addFile(file);
      }
    },
    removedfile: function removedfile(file, response) {
      file.previewElement.parentNode.removeChild(file.previewElement);
      console.log('El archivo borrado fue', file);
      params = {
        imagen: file.nombreServidor || document.querySelector('#imagen').value
      };
      axios.post('/vacantes/borrarimagen', params).then(function (respuesta) {
        return console.log(respuesta);
      });
    }
  });
});