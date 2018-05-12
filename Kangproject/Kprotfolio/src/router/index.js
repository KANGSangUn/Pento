import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/index'
// import main from '@/components/mainpage'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'index',
      component: HelloWorld
    },
    // {
    //   path: '/main',
    //   name: 'main',
    //   component: main
    // }
  ]
})
