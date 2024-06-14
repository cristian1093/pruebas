<template>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Time</th>
                            <th>State</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody v-for="movie_schedule in sortedMovieSchedules" :key="movie_schedule.id">
                        <tr v-for="schedule in movie_schedule.schedules" :key="schedule.id">
                            <td>{{ schedule.id }}</td>
                            <td>{{ schedule.time }}</td>
                            <td>{{ schedule.state ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <router-link :to="{ name: 'editarMovieSchedule', params: { id: schedule.id } }" class="btn btn-info">
                                    <i class="fas fa-edit"></i> Editar Horario
                                </router-link>
                                <button type="button" @click="borrarMovie(schedule.id)" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Borrar
                                </button>
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
    name: "MovieSchedules",
    data() {
        return {
            movie_schedules: []
        };
    },
    computed: {
        sortedMovieSchedules() {
            return this.movie_schedules.sort((a, b) => a.id - b.id);
        }
    },
    async mounted() {
        await this.mostrarMovies();
    },
    methods: {
        async mostrarMovies() {
            const movieId = this.$route.params.id;
            try {
                const response = await this.axios.get(`/api/movie/get-schedules/${movieId}`);
                this.movie_schedules = [response.data.movie_schedules];
            } catch (error) {
                console.error('Error fetching movie schedules:', error);
                this.movie_schedules = [];
            }
        },
        async borrarMovie(id) {
            if (confirm("¿Confirma eliminar el registro?")) {
                try {
                    await this.axios.delete(`/api/movie/delete/${id}`);
                    await this.mostrarMovies(); // Refresh the list after deleting
                } catch (error) {
                    console.error('Error deleting movie schedule:', error);
                }
            }
        }
    }
};
</script>
