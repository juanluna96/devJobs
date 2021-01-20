<template>
    <div class="mt-3">
        <ul class="flex flex-wrap justify-center">
            <li class="border border-gray-500 px-10 py-2 mb-2 rounded mr-4 cursor-pointer" :class="verificarClaseActiva(skill)" v-for="(skill, i) in this.skills" v-bind:key="i" @click="activar($event)">{{skill}}</li>
        </ul>
    
        <input type="hidden" name="skills" id="skills">
    </div>
</template>

<script>
export default {
    props: ['skills', 'oldSkills'],
    data: function(param) {
        return {
            habilidades: new Set()
        }
    },
    created: function() {
        if (this.oldSkills) {
            const skillsArray = this.oldSkills.split(',');
            skillsArray.forEach(skill => this.habilidades.add(skill))
        }
    },
    mounted: function() {
        document.querySelector('#skills').value = this.oldSkills;
    },
    methods: {
        activar(e) {
            if (e.target.classList.contains('bg-teal-400')) {
                // El skill esta activo
                e.target.classList.remove('bg-teal-400', 'text-white');

                // Eliminar del set de habilidades
                this.habilidades.delete(e.target.textContent);
            } else {
                // El skill no esta activo, añadirlo
                e.target.classList.add('bg-teal-400', 'text-white');
                // Agregar al set de habilidades
                this.habilidades.add(e.target.textContent);
            }

            // Agregar las habilidades al input hidden
            const stringHabilidades = [...this.habilidades];
            document.querySelector('#skills').value = stringHabilidades;

        },
        verificarClaseActiva(skill) {
            return this.habilidades.has(skill) ? 'bg-teal-400 text-white' : '';
        }
    }
}
</script>