import { Notify } from 'quasar';

const defaultErrorMessage = 'Упс, что-то пошло не так! Попробуйте позже.';

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
        type: 'negative',
        timeout: 15000,
        progress: true,
        position: 'top',
        actions: [
          { icon: 'close', color: 'white', round: true },
        ],
      });
    });

  return {
    auth: {
      csrfCookie: () => getResponseFromApi(process.env.API_END_POINT_AUTH_CSRF, {}, 'get'),

      login: (data) => getResponseFromApi(
        'auth/login',
        data,
        'post',
        'Ошибка входа, проверьте правильность email и пароля!',
      ),

      logout: () => getResponseFromApi('auth/logout'),

      check: () => getResponseFromApi('auth/check'),
    },

    real_estate_objects: {
      getObjectByCadastralNumber: (cadastralNumber) => getResponseFromApi(
        'real-estate-objects/get-object-by-cadastral-number',
        { cadastral_number: cadastralNumber },
      ),
    },
  };
};
