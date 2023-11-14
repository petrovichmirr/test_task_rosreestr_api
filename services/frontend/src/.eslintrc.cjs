module.exports = {
  // https://eslint.org/docs/user-guide/configuring#configuration-cascading-and-hierarchy
  // This option interrupts the configuration hierarchy at this file
  // Remove this if you have an higher level ESLint config file (it usually happens into a monorepos)
  root: true,

  parserOptions: {
    ecmaVersion: 2021, // Allows for the parsing of modern ECMAScript features
  },

  env: {
    node: true,
    browser: true,
    'vue/setup-compiler-macros': true
  },

  // Rules order is important, please avoid shuffling them
  extends: [
    // Base ESLint recommended rules
    // 'eslint:recommended',

    // Uncomment any of the lines below to choose desired strictness,
    // but leave only one uncommented!
    // See https://eslint.vuejs.org/rules/#available-rules
    'plugin:vue/vue3-essential', // Priority A: Essential (Error Prevention)
    // 'plugin:vue/vue3-strongly-recommended', // Priority B: Strongly Recommended (Improving Readability)
    // 'plugin:vue/vue3-recommended', // Priority C: Recommended (Minimizing Arbitrary Choices and Cognitive Overhead)

    'airbnb-base'

  ],

  plugins: [
    // https://eslint.vuejs.org/user-guide/#why-doesn-t-it-work-on-vue-files
    // required to lint *.vue files
    'vue',

  ],

  globals: {
    ga: 'readonly', // Google Analytics
    cordova: 'readonly',
    __statics: 'readonly',
    __QUASAR_SSR__: 'readonly',
    __QUASAR_SSR_SERVER__: 'readonly',
    __QUASAR_SSR_CLIENT__: 'readonly',
    __QUASAR_SSR_PWA__: 'readonly',
    process: 'readonly',
    Capacitor: 'readonly',
    chrome: 'readonly'
  },

  // add your custom rules here
  // https://eslint.vuejs.org
  rules: {
    // allow debugger during development only
    'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',

    'no-void': 'off',
    'no-nested-ternary': 'off',
    'no-shadow': ['error', { allow: ['state', 'getters'] }],
    'no-param-reassign': ['off'],
    'no-plusplus': 'off',
    'no-restricted-globals': 'off',
    'no-underscore-dangle': 'off',
    'no-multiple-empty-lines': "warn",

    'max-classes-per-file': 'off',
    'import/first': 'off',
    'import/named': 'error',
    'import/namespace': 'error',
    'import/default': 'error',
    'import/export': 'error',
    'import/no-extraneous-dependencies': ['error', { devDependencies: true }],
    'import/prefer-default-export': 'off',
    // 'import/extensions': ['warn', 'never'], // При импорте файлов необходимо указывать расширение. Это обязательно для сборщика Vite (для WebPack пока можно). См. https://github.com/vitejs/vite/issues/178#issuecomment-630138450
    'import/no-unresolved': 'off',
    'prefer-promise-reject-errors': 'off',

    'max-len': [
      'warn', {
        code: 180,
        ignoreComments: true,
        ignoreTrailingComments: true,
        ignoreUrls: true,
        ignoreStrings: true,
        ignoreTemplateLiterals: true,
        ignoreRegExpLiterals: true,
      }],

    // Vue Rules
    'vue/require-prop-types': ['error'],

    'vue/valid-v-slot': [
      'error', {
        allowModifiers: true,
      }],

    'vue/html-closing-bracket-newline': [
      'warn', {
        'singleline': 'never',
        'multiline': 'always',
      }],

    'vue/html-self-closing': [
      'warn', {
        'html': {
          'void': 'any',
          'normal': 'always',
          'component': 'always',
        },
        'svg': 'always',
        'math': 'always',
      }],

    'vue/html-closing-bracket-spacing': [
      'warn', {
        'startTag': 'never',
        'endTag': 'never',
        'selfClosingTag': 'always',
      }],

    'vue/max-attributes-per-line': [
      'warn', {
        'singleline': {
          'max': 1,
        },
        'multiline': {
          'max': 1,
        },
      }],

    'vue/html-indent': [
      'warn',
      2, // type (number | "tab") ... The type of indentation. Default is 2.
      // If this is a number, it's the number of spaces for one indent.
      // If this is "tab", it uses one tab for one indent.
      {
        'attribute': 1,
        'baseIndent': 1,
        'closeBracket': 0,
        'alignAttributesVertically': true,
        'ignores': [],
      }],

    'vue/multiline-html-element-content-newline': [
      'warn', {
        'ignoreWhenEmpty': true,
        // 'ignores': ['pre', 'textarea', ...INLINE_ELEMENTS],
        'allowEmptyLines': false,
      }],

    'vue/mustache-interpolation-spacing': ['warn', 'always'],

    'vue/no-multi-spaces': [
      'warn', {
        'ignoreProperties': false,
      }],

    'vue/no-spaces-around-equal-signs-in-attribute': 'warn',
    'vue/no-template-shadow': 'error',
    'vue/one-component-per-file': 'error',
    'vue/prop-name-casing': ['error', 'camelCase'],

    'vue/singleline-html-element-content-newline': [
      'warn', {
        'ignoreWhenNoAttributes': true,
        'ignoreWhenEmpty': true,
        // 'ignores': ['pre', 'textarea', ...INLINE_ELEMENTS],
      }],

    'vue/v-bind-style': ['error', 'shorthand'],
    'vue/v-on-style': ['error', 'shorthand'],

    'vue/v-slot-style': [
      'error', {
        'atComponent': 'v-slot',
        'default': 'shorthand',
        'named': 'shorthand',
      }],

    'vue/require-explicit-emits': [
      'error', {
        'allowProps': false,
      }],

    'vue/v-on-event-hyphenation': [
      'error',
      'always', {
        'autofix': false,
        'ignore': [],
      }],

    'vue/attributes-order': [
      'warn', {
        'order': [
          'DEFINITION',
          'LIST_RENDERING',
          'CONDITIONALS',
          'RENDER_MODIFIERS',
          'GLOBAL',
          ['UNIQUE', 'SLOT'],
          'TWO_WAY_BINDING',
          'OTHER_DIRECTIVES',
          'OTHER_ATTR',
          'EVENTS',
          'CONTENT',
        ],
        'alphabetical': true,
      }],

    'vue/component-tags-order': [
      'error', {
        'order': [
          ['template', 'script'],
          'style',
        ],
      }],

    'vue/no-v-html': 'warn',

    'vue/order-in-components': [
      'error', {
        'order': [
          'el',
          'name',
          'key',
          'parent',
          'functional',
          ['delimiters', 'comments'],
          ['components', 'directives', 'filters'],
          'extends',
          'mixins',
          ['provide', 'inject'],
          'ROUTER_GUARDS',
          'layout',
          'middleware',
          'validate',
          'scrollToTop',
          'transition',
          'loading',
          'inheritAttrs',
          'model',
          ['props', 'propsData'],
          'emits',
          'setup',
          'asyncData',
          'data',
          'fetch',
          'head',
          'computed',
          'watch',
          'watchQuery',
          'LIFECYCLE_HOOKS',
          'methods',
          ['template', 'render'],
          'renderError',
        ],
      }],

    'vue/this-in-template': ['error', 'never'],
  },
}
