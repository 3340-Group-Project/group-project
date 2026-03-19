/* NOTE: Comments explain styling/behavior only (no logic change). */
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
