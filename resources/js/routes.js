const Home = () => import('./components/Home.vue')
const Contacto = () => import('./components/Contacto.vue')
const Mostrar = () => import('./components/blog/Mostrar.vue')
const Crear = () => import('./components/blog/Crear.vue')
const Editar = () => import('./components/blog/Editar.vue')
const mostrarMovies = () => import('./components/movie/Mostrar.vue')
const crearMovie = () => import('./components/movie/Crear.vue')
const EditarMovie = () => import('./components/movie/Editar.vue');

const mostrarSchedule = () => import('./components/schedule/Mostrar.vue')
const crearSchedule = () => import('./components/schedule/Crear.vue')
const EditarSchedule = () => import('./components/schedule/Editar.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'mostrarBlogs',
        path: '/blogs',
        component: Mostrar
    },
    {
        name: 'crearBlog',
        path: '/blogs/crear',
        component: Crear
    },
    {
        name: 'editarBlog',
        path: '/blogs/editar/:id',
        component: Editar
    },
    {
        name: 'contacto',
        path: '/contacto',
        component: Contacto
    },
    {
        name: 'mostrarMovies',
        path: '/movies',
        component: mostrarMovies
    },
    {
        name: 'crearMovie',
        path: '/movies/crear',
        component: crearMovie
    },
    {
        name: 'editarMovie',
        path: '/movies/editar/:id',
        component: EditarMovie
    },
    {
        name: 'mostrarSchedule',
        path: '/schedules',
        component: mostrarSchedule
    },
    {
        name: 'crearSchedule',
        path: '/schedules/crear',
        component: crearSchedule
    },
    {
        name: 'editarSchedule',
        path: '/schedules/editar/:id',
        component: EditarSchedule
    },
]
