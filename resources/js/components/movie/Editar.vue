<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Editar Movie</h4></div>
                <div class="card-body">
                    <form @submit.prevent="editar">
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
                                <div class="form-group">
                                    <label>Estado</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="movie.state" id="stateCheck">
                                        <label class="form-check-label" for="stateCheck">
                                            Activo
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nueva Imagen</label>
                                    <input type="file" class="form-control" @change="onFileChange">
                                    <img :src="imagePreview" v-if="imagePreview" class="img-thumbnail mt-2" style="max-width: 200px; max-height: 200px;" alt="Vista previa de la imagen">
                                </div>
                            </div>

                            <div class="col-12 mb-2" v-if="!imagePreview && movie.image">
                                <div class="form-group">
                                    <p>Imagen actual:</p>
                                    <img :src="getImageUrl(movie.image)" class="img-thumbnail mt-2" style="max-width: 200px; max-height: 200px;" alt="Imagen actual">
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "EditarMovie",
    data() {
        return {
            movie: {
                id: null,
                name: "",
                description: "",
                director: "",
                publication_date: "",
                state: false,
                image: null
            },
            imagePreview: null
        };
    },
    created() {
        const movieId = this.$route.params.id;
        axios.get(`/api/movie/show/${movieId}`)
            .then(response => {
                const movieData = response.data;
                this.movie.id = movieData.id;
                this.movie.name = movieData.name;
                this.movie.description = movieData.description;
                this.movie.director = movieData.director;
                this.movie.publication_date = movieData.publication_date;
                this.movie.state = movieData.state;
                this.movie.image = movieData.image;
                // Set the current image URL to the preview if no new image is selected
                this.imagePreview = this.movie.image ? this.getImageUrl(this.movie.image) : null;
            })
            .catch(error => {
                console.error('Error al obtener los datos de la película:', error);
            });
    },
    methods: {
        async editar() {
            let formData = new FormData();
            formData.append("name", this.movie.name);
            formData.append("description", this.movie.description);
            formData.append("director", this.movie.director);
            formData.append("publication_date", this.movie.publication_date);
            formData.append("state", this.movie.state ? "1" : "0");
            if (this.movie.image && typeof this.movie.image !== 'string') {
                formData.append("image", this.movie.image);
            }

            try {
                const response = await axios.post(`/api/movie/update/${this.movie.id}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PUT'
                    }
                });
                console.log(response.data);
                this.$router.push({ name: "mostrarMovies" });
            } catch (error) {
                console.error("Error al guardar los cambios:", error.response.data);
            }
        },
        onFileChange(event) {
            const file = event.target.files[0];
            this.movie.image = file;
            this.imagePreview = URL.createObjectURL(file);
        },
        getImageUrl(image) {
            // Adjust the base URL according to your setup
            return `/storage/${image}`;
        }
    },
    beforeDestroy() {
        if (this.imagePreview) {
            URL.revokeObjectURL(this.imagePreview);
        }
    }
};
</script>
