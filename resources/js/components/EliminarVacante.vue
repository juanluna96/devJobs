<template>
  <button @click="eliminarVacante" class="text-red-600 hover:text-red-900 mr-5">
    Eliminar
  </button>
</template>

<script>
export default {
  props: ["vacanteId"],
  methods: {
    eliminarVacante() {
      console.log("eliminando", this.vacanteId);
      this.$swal
        .fire({
          title: "¿Deseas eliminar esta vacante?",
          text: "No seras capaz de eliminar esta accion!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, borrar!",
          cancelButtonText: "Cancelar",
        })
        .then((result) => {
          if (result.isConfirmed) {
            const params = {
              id: this.vacanteId,
              _method: "delete",
            };

            // Enviar peticion a axios

            axios
              .post(`/vacantes/${this.vacanteId}`, params)
              .then((response) => {
                this.$swal.fire(
                  "Vacante eliminada!",
                  response.data.mensaje,
                  "success"
                );

                // Eliminar del DOM

                this.$el.parentNode.parentNode.parentNode.removeChild(
                  this.$el.parentNode.parentNode
                );
              })
              .catch(function (error) {
                console.log(error);
              });
          }
        });
    },
  },
};
</script>