<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Crear Movie</h4></div>
                <div class="card-body">
                    <form @submit.prevent="crear">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" v-model="movie.name" required>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-floating">
                                    <textarea class="form-control" id="floatingTextarea2" v-model="movie.description" style="height: 100px" required></textarea>
                                    <label for="floatingTextarea2">Descripción</label>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Director</label>
                                    <input type="text" class="form-control" v-model="movie.director" required>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Fecha de Publicación</label>
                                    <input type="date" class="form-control" v-model="movie.publication_date" required>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="featured" v-model="movie.state">
                                    <label class="form-check-label" for="featured">Estado</label>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label >Imageen</label>
                                    <input type="file" class="form-control-file" @change="onFileChange" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'; // Asegúrate de importar axios

export default {
    name: "CrearMovie",
    data() {
        return {
            movie: {
                name: "",
                description: "",
                director: "",
                publication_date: "",
                state: false,
                image: null
            }
        };
    },
    methods: {
        async crear() {
            let formData = new FormData();
            formData.append("name", this.movie.name);
            formData.append("description", this.movie.description);
            formData.append("director", this.movie.director);
            formData.append("publication_date", this.movie.publication_date);
            formData.append("state", this.movie.state ? "1" : "0");
            if (this.movie.image) {
                formData.append("image", this.movie.image);
            }

            try {
                const response = await axios.post('/api/movie', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                console.log(response.data); // Mensaje de depuración
                this.$router.push({ name: "mostrarMovies" });
            } catch (error) {
                console.error("Error al guardar la película:", error.response ? error.response.data : error.message);
                alert("Error al guardar la película: " + (error.response ? error.response.data.message : error.message));
            }
        },
        onFileChange(event) {
            this.movie.image = event.target.files[0];
        }
    }
};
</script>
