<template>
  <div class="q-pa-md">
    <h4 class="q-my-none">
      Описание проекта (тестовое задание)
    </h4>

    <h6 class="q-mt-lg q-mb-sm">
      Стек использованных технологий
    </h6>
    <ul class="q-my-none">
      <li>PHP 8.1</li>
      <li>Laravel 10</li>
      <li>Quasar VueJS</li>
      <li>MariaDB</li>
      <li>composer</li>
      <li>git</li>
      <li>docker compose</li>
    </ul>

    <h6 class="q-mt-md q-mb-sm">
      Цель
    </h6>
    <p>
      Разработать мини-проект, который по введённому кадастровому номеру получит информацию из Росреестра.
    </p>

    <h6 class="q-mt-md q-mb-sm">
      Страницы сайта
    </h6>
    <ul>
      <li>Страница авторизации</li>
      <li>Форма запроса новых данных</li>
      <li>Список полученных данных</li>
    </ul>

    <h6 class="q-mt-md q-mb-sm">
      Требования
    </h6>

    <p class="text-weight-bold">
      Страница авторизации
    </p>
    <p>
      Создать 5 пользователей, которые могут авторизовываться в системе, без системы ролей и прав.
    </p>

    <p class="text-weight-bold">
      Список полученных данных
    </p>
    <p>
      Реализовать БД заявок, которые доступны пользователю (отображать только те, которые внёс сам пользователь).
      Внешний вид - таблица с сортировкой по любому столбцу, с постраничной навигацией.
    </p>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'DashboardPage',
});
</script>
