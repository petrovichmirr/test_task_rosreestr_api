import { route } from 'quasar/wrappers';
import {
  createRouter, createMemoryHistory, createWebHistory, createWebHashHistory,
} from 'vue-router';
import { api } from 'src/boot/axios';
import routes from './routes';

export default route(async (/* { store, ssrContext } */) => {
  const createHistory = process.env.SERVER
    ? createMemoryHistory
    : (process.env.VUE_ROUTER_MODE === 'history' ? createWebHistory : createWebHashHistory);

  const Router = createRouter({
    scrollBehavior: () => ({ left: 0, top: 0 }),
    routes,

    // Leave this as is and make changes in quasar.conf.js instead!
    // quasar.conf.js -> build -> vueRouterMode
    // quasar.conf.js -> build -> publicPath
    history: createHistory(process.env.VUE_ROUTER_BASE),
  });

  await api.auth.csrfCookie();

  Router.beforeEach(async (to) => {
    const authCheckResponse = await api.auth.check()
      .then((response) => {
        const isAuthenticated = response.data;

        if (!isAuthenticated && (to.name !== 'login')) {
          // redirect the user to the login page
          return { name: 'login' };
        }

        if (isAuthenticated && (to.name === 'login')) {
          // redirect the user to the dashboard page
          return { name: 'dashboard' };
        }

        return true;
      })
      .catch(() => false);

    return authCheckResponse;
  });

  return Router;
});
