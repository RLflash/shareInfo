import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/views/home/Home'
import Index from '@/views/Index'
import List from '@/views/art/List'
import Detail from '@/views/art/Detail'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Index',
      component: Index,
      children:[
	      {
			      path: '/',
			      name: 'Home',
			      component: Home
	      },
	      {
			      path: '/list',
			      name: 'List',
			      component: List
	      },
	      {
	      	 path: '/detail',
			     name: 'Detail',
			     component: Detail
	      }
      ]
    }
  ]
})
