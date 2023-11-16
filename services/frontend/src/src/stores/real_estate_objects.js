import { defineStore } from 'pinia';
// import { api } from 'boot/axios';

export default defineStore('real_estate_objects', {
  state: () => ({
    realEstateObjects: null,
  }),
  actions: {
    // getObjectByCadastralNumber(cadastralNumber) {
    //   return api.real_estate_objects.getObjectByCadastralNumber(cadastralNumber);
    // },
  },
});
