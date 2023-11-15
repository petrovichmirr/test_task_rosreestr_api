<template>
  <div class="q-pa-lg text-center">
    <div class="dialog-container">
      <h3>Вход</h3>

      <div>
        <q-input
          v-model="email"
          clearable
          label="E-mail"
        />
        <q-input
          v-model="password"
          class="q-mt-sm"
          clearable
          label="Пароль"
          type="password"
        />
      </div>

      <div class="q-mt-lg">
        <q-btn
          color="primary"
          icon="login"
          label="Войти"
          @click="login()"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { api } from 'boot/axios';

export default defineComponent({
  name: 'LoginPage',

  data() {
    return {
      email: 'user_1@m.local',
      password: 'pwd_user_1',
    };
  },

  methods: {
    // TODO: обработка ошибок входа
    login() {
      api.auth.login({
        email: this.email,
        password: this.password,
      }).then(() => {
        this.$router.push({ name: 'dashboard' });
      }).catch(() => {
        this.$q.notify({
          message: 'Ошибка входа, проверьте правильность email и пароля!',
          color: 'accent',
        });
      });
    },
  },
});
</script>

<style
  lang="scss"
  scoped
>
.dialog-container {
  display: inline-block;
  min-width: 300px;
}
</style>
