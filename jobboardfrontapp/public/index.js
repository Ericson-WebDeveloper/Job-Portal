import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Login from '@/views/Login'
import SignUp from '@/views/SignUp'
import EmployeerSignUp from '@/views/EmployeerSignUp'
import Companies from '@/views/Companies'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/signin',
    name: 'Login',
    component: Login
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp
  },
  {
    path: '/employeer',
    name: 'Employeer',
    component: EmployeerSignUp
  },
  {
    path: '/companies',
    name: 'Companies',
    component: Companies
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },

  {
    path: '/user',
    // name: 'User-Index',
    component: () => import('../views/user/index.vue'),
    redirect: '/user/dashboard',
    children: [
      {
        path: 'dashboard',
        name: 'User-Dashboard',
        component: () => import('../views/user/DashBoard.vue')
      },
      {
        path: 'profile',
        name: 'User-Profile',
        component: () => import('../views/user/Profile.vue')
      },
      {
        path: 'application',
        name: 'User-Application',
        component: () => import('../views/user/Application.vue')
      },
    ]
  },
  {
    path: '/admin',
    // name: 'User-Index',
    component: () => import('../views/admin/index.vue'),
    redirect: '/admin/dashboard',
    children: [
      {
        path: 'dashboard',
        name: 'Admin-Dashboard',
        component: () => import('../views/admin/DashBoard.vue')
      },
      {
        path: 'profile',
        name: 'Admin-Profile',
        component: () => import('../views/admin/Profile.vue')
      },
      {
        path: 'users',
        name: 'User-List',
        component: () => import('../views/admin/Users.vue')
      },
      {
        path: 'users/:userid',
        name: 'User-View',
        component: () => import('../views/admin/User-View.vue')
      },
      {
        path: 'employeer',
        name: 'Employeer-List',
        component: () => import('../views/admin/Employeer.vue')
      }
    ]
  },
  {
    path: '/employeer-user',
    component: () => import('../views/employeer/index.vue'),
    redirect: '/employeer-user/dashboard',
    children: [
      {
        path: 'dashboard',
        name: 'Employeer-Dashboard',
        component: () => import('../views/employeer/DashBoard.vue')
      },
      {
        path: 'profile',
        name: 'Employeer-Profile',
        component: () => import('../views/employeer/Profile.vue')
      },
      {
        path: 'jobs',
        name: 'Employeer-Jobs',
        component: () => import('../views/employeer/Job.vue')
      },
      {
        path: 'company',
        name: 'Employeer-Company',
        component: () => import('../views/employeer/Company.vue')
      },
    ]
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router








