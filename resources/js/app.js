import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css'

const theme = {
	dark: false,
	colors: {
	  background: '#FFFFFF',
	  surface: '#FFFFFF',
	  primary: '#008fee',
	  'primary-darken-1': '#3700B3',
	  secondary: '#03DAC6',
	  'secondary-darken-1': '#018786',
	  error: '#B00020',
	  info: '#2196F3',
	  success: '#4CAF50',
	  warning: '#FB8C00',
	},
  }

const vuetify = createVuetify({
	components,
	directives,
	theme: {
		defaultTheme: 'theme',
		themes: {
		  theme,
		},
	  },
  })

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
	  .use(vuetify)
      .mount(el)
  },
})