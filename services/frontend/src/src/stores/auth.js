import { defineStore } from 'pinia';
import { api } from 'boot/axios';

export default defineStore('auth', {
  state: () => ({
    user: null,
  }),
  actions: {
    check() {
      return api.auth.check()
        .then((response) => {
          const isAuthenticated = response.data;

          if (isAuthenticated) {
            this.user = response.user;
          }

          return isAuthenticated;
        });
    },
  },
});
