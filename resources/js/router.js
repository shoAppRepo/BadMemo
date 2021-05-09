import { createRouter, createWebHistory } from 'vue-router'

import login from './components/auth/login.vue' 
import register from './components/auth/register.vue' 

import Top from './components/top.vue' 
import top_page from './components/top_page.vue' 

import tasks from './components/tasks'
import tasks_route from './routes/tasks' 

export const router = createRouter({
  history:createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'top',
      component: Top,
      children:[
        {
          path:'/',
          component: top_page,
        },
        {
          path:'/tasks',
          component: tasks,
          children: tasks_route,
        },
      ]
    },

    //認証系
    {
      path:'/original-login',
      name:'original-login',
      component: login,
    },
    {
      path:'/original-register',
      component: register,
    },
  ]
});
