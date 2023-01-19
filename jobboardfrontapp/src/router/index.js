import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Login from '@/views/Login'
import SignUp from '@/views/SignUp'
import AccountVerify from '@/views/AccountVerify'
import EmployeerSignUp from '@/views/EmployeerSignUp'
import ResetPassword from '@/views/ResetPassword'
import PasswordUpdate from '@/views/PasswordUpdate'
import Companies from '@/views/Companies';
import Company from '@/views/Company';
import Job from '@/views/Job';

//import auth from '@/middleware/auth';
import store from '@/store/index'
import auth from '../middleware/auth';
import user from '../middleware/user';
import admin from '../middleware/admin';
import employeer from '../middleware/employeer';
import guest from '../middleware/guest';
import subcriptions from '../middleware/subcriptions';
const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/signin',
    name: 'Login',
    component: Login,
    meta: {
      middleware: [guest]
    },
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp,
    meta: {
      middleware: [guest]
    },
  },
  {
    path: '/reset-password',
    name: 'Reset-Password',
    component: ResetPassword,
    meta: {
      middleware: [guest]
    },
  },
  {
    path: '/update-password/:email/:token',
    name: 'Update-Password',
    component: PasswordUpdate,
    meta: {
      middleware: [guest]
    },
  },
  {
    path: '/verify-account/:email/:token',
    name: 'Account-Verify',
    component: AccountVerify,
    meta: {
      middleware: [guest]
    },
  },
  {
    path: '/employeer',
    name: 'Employeer',
    component: EmployeerSignUp,
    meta: {
      middleware: [guest]
    },
  },
  {
    path: '/companies',
    name: 'Companies',
    component: Companies
  },
  {
    path: '/company/:company',
    name: 'Company',
    component: Company
  },
  {
    path: '/job/:job',
    name: 'Job',
    component: Job
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
    path: '/search-job/:key/',
    name: 'searchjob',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/SearchJob.vue')
  },
  {
    path: '/vacancy-jobs',
    name: 'vacancyjob',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/VacancyJob.vue')
  },

  {
    path: '/user',
    // name: 'User-Index',
    component: () => import('../views/user/index.vue'),
    redirect: '/user/dashboard',
    meta: {
      middleware: [auth, user]
    },
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
    // meta: {
    //   middleware: [auth, admin]
    // },
    children: [
      {
        path: 'dashboard',
        name: 'Admin-Dashboard',
        meta: {
          middleware: [auth, admin]
        },
        component: () => import('../views/admin/DashBoard.vue')
      },
      {
        path: 'profile',
        name: 'Admin-Profile',
        meta: {
          middleware: [auth, admin]
        },
        component: () => import('../views/admin/Profile.vue')
      },
      {
        path: 'users',
        name: 'User-List',
        meta: {
          middleware: [auth, admin]
        },
        component: () => import('../views/admin/Users.vue')
      },
      {
        path: 'users/:email',
        name: 'User-View',
        meta: {
          middleware: [auth, admin]
        },
        component: () => import('../views/admin/User-View.vue')
      },
      {
        path: 'employeer',
        name: 'Employeer-List',
        meta: {
          middleware: [auth, admin]
        },
        component: () => import('../views/admin/Employeer.vue')
      }
    ]
  },
  {
    path: '/employeer-user',
    // path: '/employeer-user/dashboard',
    redirect: '/employeer-user/dashboard',
    component: () => import('../views/employeer/index.vue'),
    // meta: {
    //   middleware: [auth, employeer, subcriptions]
    // },
    children: [
      {
        path: 'dashboard',
        // path: '/',
        name: 'Employeer-Dashboard',
        meta: {
          middleware: [auth, employeer, subcriptions]
        },
        component: () => import('../views/employeer/DashBoard.vue')
      },
      {
        path: 'profile',
        name: 'Employeer-Profile',
        meta: {
          middleware: [auth, employeer, subcriptions]
        },
        component: () => import('../views/employeer/Profile.vue')
      },
      {
        path: 'jobs',
        name: 'Employeer-Jobs',
        meta: {
          middleware: [auth, employeer, subcriptions]
        },
        component: () => import('../views/employeer/Job.vue')
      },
      {
        path: 'aplications/:job_id',
        name: 'Job-Application-List',
        meta: {
          middleware: [auth, employeer, subcriptions]
        },
        component: () => import('../views/employeer/ApplicationList.vue')
      },
      {
        path: 'user-check-profile/:email',
        name: 'User-Profile-Check',
        meta: {
          middleware: [auth, employeer, subcriptions]
        },
        component: () => import('../views/admin/User-View.vue')
      },
      {
        path: 'company',
        name: 'Employeer-Company',
        meta: {
          middleware: [auth, employeer, subcriptions]
        },
        component: () => import('../views/employeer/Company.vue')
      },
      {
        path: 'subcriptions',
        name: 'Employeer-Subcription',
        meta: {
          middleware: [auth, employeer, subcriptions]
        },
        component: () => import('../views/employeer/Subcription.vue')
      },
      
    ],
    
  },

  {
    path: '/employeer-user',
    component: () => import('../views/employeer/index.vue'),
    redirect: '/employeer-user/dashboard',
    // meta: {
    //   middleware: [auth, employeer]
    // },
    children: [
      {
        path: 'payment-paypal/success',
        name: 'Paypal-Success',
        meta: {
          middleware: [auth, employeer]
        },
        component: () => import('../views/employeer/paypal/SuccessPayment.vue')
      },
      {
        path: 'payment-paypal/failedorcancel',
        name: 'Paypal-Cancel',
        meta: {
          middleware: [auth, employeer]
        },
        component: () => import('../views/employeer/paypal/FailedPayment.vue')
      },

    ]
  },

  

  {
    path: '/:pathMatch(.*)*',
    component: () => import('../views/NotFoundPage.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

// function middlewarePipeline (context, middleware, index){
//   const nextMiddleware = middleware[index]
//   if(!nextMiddleware){
//       return context.next 
//   }
//   return (...parameters) => {
//       context.next(...parameters);
//       const nextPipeline = middlewarePipeline(
//           context, middleware, index + 1
//       )
//       nextMiddleware({ ...context, next: nextPipeline });
//   }
// }

router.beforeEach(async (to,from,next) => {
  
  // if(!to.meta.middleware) {
  //   return next()
  // }

  // if(!from.name) {
  //   if(store.state.auth.loggedin) {
  //     await store.dispatch('auth/GET_USER');
  //     let roles = store.getters['user/GET_ROLES'].map((role) => role.name);
  //     if(roles.includes('employeer')) {
  //       await store.dispatch('payment/GET_SUBCRIPTION');
  //     }
  //   }
  // }
  
  store.commit("Loading", true);
  if(to.meta.middleware) {
    const context = {
      next, to, from, store, router
    }
    let middlewares = to.meta.middleware;

    middlewares?.forEach((middleware, index) => {
      // console.log(middlewares[index + 1], middlewares[index + 1], `middleware ${index + 1}`);
      let nextMiddle = middlewares[index + 1] != undefined ? true : false;
      // console.log(middlewares[index + 1] !== "undefined", "checking undefined");
      // return middleware({...context, nextMiddle});
      let nextPage = middleware({...context, nextMiddle});
      if(!nextMiddle) {
        return nextPage;
      }
    });
    // return middlewares[0]({
    //   ...context, next: middlewarePipeline(context, middlewares, 1)
    // });
    store.commit("Loading", false);
  } else {
    next();
    store.commit("Loading", false);
  }
  
});

export default router








