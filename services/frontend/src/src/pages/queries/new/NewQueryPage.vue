<template>
  <div class="q-pa-md">
    <h5 class="q-my-none">
      Новый запрос в Росреестр
    </h5>

    <form @submit.prevent.stop="onSubmit">
      <div class="q-mt-lg">
        <q-input
          ref="cadastralNumberRef"
          v-model="cadastralNumber"
          clearable
          label="Кадастровый номер объекта недвижимости"
          :rules="cadastralNumberRules"
        />
      </div>

      <div class="q-mt-sm">
        <q-btn
          color="primary"
          icon="send"
          label="Отправить запрос"
          type="submit"
        />
      </div>
    </form>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import { api } from 'boot/axios';

export default defineComponent({
  name: 'NewQueryPage',

  setup() {
    const cadastralNumberRef = ref(null);
    const cadastralNumber = ref('');

    return {
      cadastralNumberRef,
      cadastralNumber,
      cadastralNumberRules: [
        (value) => (value && value.length > 0) || 'Поле обязательно для заполнения',
      ],

      onSubmit() {
        if (cadastralNumberRef.value.validate()) {
          api.real_estate_objects.getObjectByCadastralNumber(cadastralNumber.value)
            .then((response) => {
              this.$q.notify({
                caption: 'Результат запроса',
                message: response.status
                  ? `${response.text_status} Результаты запроса можно посмотреть в списке запросов`
                  : response.text_status,
                type: response.status ? 'positive' : 'warning',
                timeout: 15000,
                progress: true,
                position: 'top',
                actions: [
                  { icon: 'close', color: 'white', round: true },
                ],
              });
            });
        }
      },
    };
  },
});
</script>
