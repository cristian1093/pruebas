<template>
    <div class="row">
        <div class="col-12 mb-2">
            <router-link :to="{ name: 'crearSchedule' }" class="btn btn-success"><i class="fas fa-plus-circle"></i> Crear</router-link>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Turno</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="schedule in sortedSchedules" :key="schedule.id">
                            <td>{{ schedule.id }}</td>
                            <td>{{ schedule.time }}</td>
                            <td>{{ schedule.state }}</td>
                            <td>
                                <router-link :to="{ name: 'editarSchedule', params: { id: schedule.id } }" class="btn btn-info"><i class="fas fa-edit"></i> Editar</router-link>
                                <button type="button" @click="borrarSchedule(schedule.id)" class="btn btn-danger"><i class="fas fa-trash"></i> Borrar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Schedules",
    data() {
        return {
            schedules: []
        };
    },
    computed: {
        sortedSchedules() {
            // Ordenar películas por ID ascendente
            return this.schedules.sort((a, b) => a.id - b.id);
        }
    },
    async mounted() {
        await this.mostrarSchedules();
    },
    methods: {
        async mostrarSchedules() {
            try {
                const response = await this.axios.get('/api/schedule/');
                this.schedules = response.data;
            } catch (error) {
                console.error('Error fetching schedules:', error);
                this.schedules = [];
            }
        },
        async borrarSchedule(id) {
            if (confirm("¿Confirma eliminar el registro?")) {
                try {
                    await this.axios.delete(`/api/schedule/delete/${id}`);
                    await this.mostrarSchedules(); // Actualizar lista después de eliminar
                } catch (error) {
                    console.error('Error deleting schedule:', error);
                }
            }
        }
    }
};
</script>

