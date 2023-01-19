import { createApp } from 'vue'
import App from './App.vue'
import './assets/css/index.css'
import router from './router'
import store from './store'

import CKEditor from '@ckeditor/ckeditor5-vue'
// import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2/dist/sweetalert2.js';
// const options = {
//     confirmButtonColor: '#41b882',
//     cancelButtonColor: '#ff7674',
//   };
// https://vueup.github.io/vue-quill/guide/toolbar.html#pre-configure-toolbar-options
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import moment from 'moment'

const app = createApp(App);
app.provide('$Swal', Swal);
app.provide('$moment', moment);
app.component('Loading', Loading);
app.component('QuillEditor', QuillEditor);
app.use(store).use(router).use(CKEditor).mount('#app');