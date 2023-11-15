import { boot } from 'quasar/wrappers';
import axios from 'axios';
import getApi from 'src/app/api_routes';

axios.defaults.withCredentials = true;

const apiClient = axios.create({
  baseURL: process.env.API_BASE_URL,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    Accept: 'application/json',
  },
});
const api = getApi(apiClient);

export default boot(({ app }) => {
  // in Vue: this.$axios
  app.config.globalProperties.$axios = axios;

  // in Vue: this.$apiClient
  app.config.globalProperties.$apiClient = apiClient;

  // in Vue: this.$api
  app.config.globalProperties.$api = api;
});

export {
  apiClient,
  api,
};
