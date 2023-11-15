export default (apiClient) => ({
  auth: {
    csrfCookie: () => apiClient.get(process.env.API_END_POINT_AUTH_CSRF),

    login: (data) => apiClient.post('auth/login', data),

    logout: () => apiClient.post('auth/logout'),

    check: () => apiClient.post('auth/check'),

    // getCurrentUser: () => apiClient.post('auth/get-current-user'), // TODO: реализовать
  },

  // todo: {
  // },
});
