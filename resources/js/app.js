import Vue from 'vue'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import { App, plugin } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress/src'
import * as Sentry from '@sentry/vue'
import { Integrations } from '@sentry/tracing'

Sentry.init({
  Vue,
  dsn: "https://0b7c28fcfa5b466fa678d03169483c18@o808326.ingest.sentry.io/5804155",
  integrations: [new Integrations.BrowserTracing()],

  // Set tracesSampleRate to 1.0 to capture 100%
  // of transactions for performance monitoring.
  // We recommend adjusting this value in production
  tracesSampleRate: 1.0,
});

Vue.config.productionTip = false
Vue.mixin({ methods: { route: window.route } })
Vue.use(plugin)
Vue.use(PortalVue)
Vue.use(VueMeta)

InertiaProgress.init()

const el = document.getElementById('app')

new Vue({
  metaInfo: {
    titleTemplate: title => (title ? `${title} - Ping CRM` : 'Ping CRM'),
  },
  render: h =>
    h(App, {
      props: {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => require(`./Pages/${name}`).default,
      },
    }),
}).$mount(el)
