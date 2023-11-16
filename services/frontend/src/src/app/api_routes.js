import { Notify } from 'quasar';

const defaultErrorMessage = 'Упс, ошибка! Попробуйте позже.';

export default (apiClient) => {
  const getResponseFromApi = async (
    url,
    data = {},
    method = 'post',
    errorMessage = defaultErrorMessage,
  ) => apiClient.request({
    method,
    url,
    data,
  })
    .then((response) => response.data)
    .catch(() => {
      Notify.create({
        message: errorMessage,
        color: 'accent',
      });
    });

  return {
    auth: {
      csrfCookie: () => getResponseFromApi(process.env.API_END_POINT_AUTH_CSRF, {}, 'get'),

      login: (data) => getResponseFromApi('auth/login', data, 'post', 'Ошибка входа, проверьте правильность email и пароля!'),

      logout: () => getResponseFromApi('auth/logout'),

      check: () => getResponseFromApi('auth/check'),
    },

    // todo: {
    // },
  };
};
