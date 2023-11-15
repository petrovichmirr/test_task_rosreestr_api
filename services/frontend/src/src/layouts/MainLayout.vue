<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          aria-label="Menu"
          dense
          flat
          icon="menu"
          round
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
          Тестовое задание | Росреестр API тест
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      bordered
      show-if-above
    >
      <q-list>
        <q-item
          clickable
          :to="{ name: 'dashboard' }"
        >
          <q-item-section avatar>
            <q-icon
              color="primary"
              name="dashboard"
            />
          </q-item-section>
          <q-item-section>
            Сводка
          </q-item-section>
        </q-item>

        <q-item
          clickable
          :to="{ name: 'queries_new' }"
        >
          <q-item-section avatar>
            <q-icon
              color="primary"
              name="library_add"
            />
          </q-item-section>
          <q-item-section>
            Новый запрос в Росреестр
          </q-item-section>
        </q-item>

        <q-item
          clickable
          :to="{ name: 'queries_list' }"
        >
          <q-item-section avatar>
            <q-icon
              color="primary"
              name="list"
            />
          </q-item-section>
          <q-item-section>
            Список запросов
          </q-item-section>
        </q-item>

        <q-separator />

        <q-item
          clickable
          @click="logout()"
        >
          <q-item-section avatar>
            <q-icon
              color="primary"
              name="logout"
            />
          </q-item-section>
          <q-item-section>
            Выход
          </q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'MainLayout',

  setup() {
    const leftDrawerOpen = ref(false);

    return {
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },

  methods: {
    logout() {
      this.$api.auth.logout()
        .then(() => {
          this.$router.push({ name: 'login' });
        })
        .catch(() => {
          this.$q.notify({
            message: 'Ошибка, попробуйте позже.',
            color: 'accent',
          });
        });
    },
  },
});
</script>
