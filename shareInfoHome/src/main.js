// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Axios from 'axios'
import Config from '@/config'
Vue.prototype.axios = Axios
Vue.config.productionTip = false
Axios.interceptors.request.use(
	config=>{
		config.url=Config.apiRoot+config.url
		return config
	}
)
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
