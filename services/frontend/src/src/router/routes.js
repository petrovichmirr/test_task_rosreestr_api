const routes = [
  // no auth routes
  {
    path: '/login',
    name: 'login',
    component: () => import('pages/login/LoginPage.vue'),
  },

  // auth routes
  {
    path: '',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '/',
        name: 'dashboard',
        component: () => import('pages/dashboard/DashboardPage.vue'),
      },
      {
        path: '/queries/new',
        name: 'queries_new',
        component: () => import('pages/queries/new/NewQueryPage.vue'),
      },
      {
        path: '/queries/list',
        name: 'queries_list',
        component: () => import('pages/queries/list/QueriesListPage.vue'),
      },
      {
        path: '/queries/list/:id',
        name: 'queries_list_item',
        component: () => import('pages/queries/item/QueriesItemPage.vue'),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
