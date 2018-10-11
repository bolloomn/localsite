import Vue from 'vue'
import Router from 'vue-router'
import store from '../store'

import Dashboard from '../modules/admin/Dashboard'


import Sites from '../modules/admin/sites/index'
import siteForm from '../modules/admin/sites/siteForm'

import Employees from '../modules/admin/employee/Employees'
import EmployeesForm from '../modules/admin/employee/EmployeesForm'


import newsCategory from '../modules/admin/newsCategory/index'
import newsCategoryTest from '../modules/admin/newsCategory/test'
import fileCategory from '../modules/admin/fileCategory/fileCategory'

import Pages from '../modules/admin/pages/Pages'
import PagesForm from '../modules/admin/pages/PagesForm'


import LinkCategory from '../modules/admin/linkCategory/LinkCategory'
import LinkCategoryForm from '../modules/admin/linkCategory/LinkCategoryForm'

import Files from '../modules/admin/file/file';
import fileForm from '../modules/admin/file/fileForm';

import Link from '../modules/admin/Links/Link'
import LinkForm from '../modules/admin/Links/LinkForm'


import Login from '../modules/auth/Login'

//system routes
import NotFound from '../modules/system/NotFound'

Vue.use(Router)

let routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
    },

    {path: "*", component: NotFound},

    {
        path: '/',
        name: 'home',
        component: Dashboard,
        meta: {
            requiresAuth: true,
            page_title: 'Статистик',
            bread_crumbs: [
                {
                    title: 'Ерөнхий',
                    rname: 'home'
                }
            ]
        },
    },

    {
        path: '/news_category',
        name: 'newsCategory',
        component: newsCategory,
        meta: {
            requiresAuth: true,
            page_title: 'Мэдээний ангилал',
            bread_crumbs: [
                {
                    title: 'Мэдээ',
                    rname: 'home'
                }
            ]
        },
    },

    {
        path: '/news_category_test',
        name: 'newsCategoryTest',
        component: newsCategoryTest,
        meta: {
            requiresAuth: true,
            page_title: 'Мэдээний ангилал',
            bread_crumbs: [
                {
                    title: 'Мэдээ',
                    rname: 'home'
                }
            ]
        },
    },

    {
        path: '/file_category',
        name: 'fileCategory',
        component: fileCategory,
        meta: {
            requiresAuth: true,
            page_title: 'Файлын ангилал',
            bread_crumbs: [
                {
                    title: 'файлын сан',
                    rname: 'home'
                }
            ]
        },
    },

    {
        path: '/pages',
        name: 'pages',
        component: Pages,
        meta: {
            requiresAuth: true,
            page_title: 'Хуудас',
            bread_crumbs: [
                {
                    title: 'Мэдээ',
                    rname: 'home'
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: PagesForm,
                name: 'create_page',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Дэд сайтууд',
                            rname: 'sites'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: PagesForm,
                name: 'update_page',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Дэд сайтууд',
                            rname: 'sites'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },




    {
        path: '/files',
        name: 'files',
        component: Files,
        meta: {
            requiresAuth: true,
            page_title: 'Файлын сан',
            bread_crumbs: [
                {
                    title: 'Файлын сан',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: fileForm,
                name: 'create_file',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Файлын сан',
                            rname: 'files'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: fileForm,
                name: 'update_file',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Файлын сан',
                            rname: 'files'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },





    {
        path: '/sites',
        name: 'sites',
        component: Sites,
        meta: {
            requiresAuth: true,
            page_title: 'Дэд сайтууд',
            bread_crumbs: [
                {
                    title: 'ЕРӨНХИЙ',
                    rname: 'home'
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: siteForm,
                name: 'create_site',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Дэд сайтууд',
                            rname: 'sites'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: siteForm,
                name: 'update_site',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Дэд сайтууд',
                            rname: 'sites'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },
    {
        path: '/link_category',
        name: 'link_category',
        component: LinkCategory,
        meta: {
            requiresAuth: true,
            page_title: 'Холбоос ангилал',
            bread_crumbs: [
                {
                    title: 'Холбоос',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: LinkCategoryForm,
                name: 'link_category_create',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Холбоос ангилал',
                            rname: 'link_category'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: LinkCategoryForm,
                name: 'link_category_update',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Холбоос',
                            rname: 'home'
                        },
                        {
                            title: 'Холбоос ангилал',
                            rname: 'link_category'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },

    {
        path: '/link',
        name: 'link',
        component: Link,
        meta: {
            requiresAuth: true,
            page_title: 'Холбоос',
            bread_crumbs: [
                {
                    title: 'Холбоос',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: LinkForm,
                name: 'link_create',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Холбоос',
                            rname: 'link'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: LinkForm,
                name: 'link_update',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Холбоос',
                            rname: 'home'
                        },
                        {
                            title: 'Холбоос',
                            rname: 'link'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },

    {
        path: '/employees',
        name: 'employees',
        component: Employees,
        meta: {
            requiresAuth: true,
            page_title: 'Админ / ажилтан',
            bread_crumbs: [
                {
                    title: 'Ерөнхий',
                    rname: 'home'
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: EmployeesForm,
                name: 'create_employee',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Ерөнхий',
                            rname: 'home'
                        },
                        {
                            title: 'Админ',
                            rname: 'employees'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: EmployeesForm,
                name: 'update_employee',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Ерөнхий',
                            rname: 'home'
                        },
                        {
                            title: 'Админ',
                            rname: 'employees'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },


];

const router = new Router({
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return {x: 0, y: 0}
        }
    }
});

router.beforeEach((to, from, next) => {
    if (window.innerWidth < 1025) {
        store.commit('changedrawerstore', 1)
    }
    if (from.meta.notloading !== true) {
        if (to.meta.notloading !== true) {
            store.commit('changepageloader', true)
        }
    }
    if (store.getters.authToken && !store.getters.authCheck) {
        store.dispatch('fetchUser').then(response => next());
    } else if (to.matched.some(record => record.meta.requiresAuth) && !store.getters.authCheck) {
        next({
            name: 'login'
        })
    } else {
        next()
    }
});

router.afterEach((to, from, next) => {
    setTimeout(() => store.commit('changepageloader', false), 1000)
})

export default router;
