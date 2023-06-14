import './bootstrap';
import '../sass/app.scss'

import { createApp } from 'vue';
import App from './components/App.vue';

const app = createApp();

app.component('app', App);

app.mount('#app');
