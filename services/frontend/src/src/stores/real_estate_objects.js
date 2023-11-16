import { defineStore } from 'pinia';
import { api } from 'boot/axios';

export default defineStore('real_estate_objects', {
  state: () => ({
    realEstateObjects: [],
  }),
  actions: {
    getObjects() {
      api.real_estate_objects.getObjects()
        .then((response) => {
          this.realEstateObjects = response.data;
        });
    },
  },
});
