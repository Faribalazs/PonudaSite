import axios from 'axios';
window.axios = axios;

import { createApp } from 'vue'
import NewPonuda from './components/NewPonuda.vue'

import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp({})

app.component('new-ponuda', NewPonuda)

app.mount('#app');