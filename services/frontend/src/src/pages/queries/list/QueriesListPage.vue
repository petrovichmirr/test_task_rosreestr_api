<template>
  <div class="q-pa-md">
    <h5 class="q-my-none">
      Список запросов в Росреестр
    </h5>
    <div class="q-mt-lg">
      <q-btn
        color="primary"
        icon="refresh"
        label="Обновить данные"
        @click="load()"
      />
    </div>
    <div class="q-mt-lg">
      <q-table
        :columns="tableColumns"
        row-key="id"
        :rows="realEstateObjectsStore.realEstateObjects"
      />
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import useRealEstateObjectsStore from 'stores/real_estate_objects';

const tableColumns = [
  {
    name: 'id',
    label: '№ заявки',
    field: 'id',
    sortable: true,
  },
  {
    name: 'status',
    label: 'Статус',
    field: (row) => (row.status ? 'Успех' : 'Ошибка'),
    sortable: true,
  },
  {
    name: 'status',
    label: 'Описание статуса',
    field: 'text_status',
    sortable: true,
  },
  {
    name: 'cadastral_number',
    label: 'Кадастровый номер',
    field: (row) => (row.real_estate_object ? row.real_estate_object.cadastral_number : ''),
    sortable: true,
  },
  {
    name: 'address',
    label: 'Адрес',
    field: (row) => (row.real_estate_object ? row.real_estate_object.address : ''),
    sortable: true,
  },
];

export default defineComponent({
  name: 'QueriesListPage',

  setup() {
    const realEstateObjectsStore = useRealEstateObjectsStore();

    return {
      realEstateObjectsStore,
      tableColumns,

      load() {
        realEstateObjectsStore.getObjects();
      },
    };
  },

  mounted() {
    this.load();
  },
});
</script>
