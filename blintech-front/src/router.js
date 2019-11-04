import Vue from "vue";
import Router from "vue-router";
import Login from "@/components/Login";
import Home from "@/components/Home";
import Reception from "@/components/registrar_auto/Reception";
import Delivereds from "@/components/delivereds/Delivereds";
import DeliveredDetail from "@/components/delivereds/DeliveredDetail";
import Tracing from "@/components/tracings/Tracing";
import Records from "@/components/registrar_auto/Records";
import TracingDetail from "@/components/tracings/TracingDetail";
import Comment from "@/components/tracings/Comment";
import ReceptionDetail from "@/components/registrar_auto/ReceptionDetail";
import FinalizeTracing from "@/components/tracings/FinalizeTracing";
import Found from "@/components/Page404";
import Pruebas from "@/components/pruebas";
import Customer from "@/components/users/Customer";

Vue.use(Router);

const router = new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [{
            path: "/login",
            name: "Login",
            component: Login,
        }, {
            path: "/home",
            name: "Home",
            component: Home,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/reception",
            name: "Reception",
            component: Reception,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/reception-detail/:id",
            name: "Reception-Detail",
            component: ReceptionDetail,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/records",
            name: "Records",
            component: Records,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/tracing",
            name: "Tracing",
            component: Tracing,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/tracing-detail/:id",
            name: "Tracing-Detail",
            component: TracingDetail,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/finalize-trancing/:id",
            name: "Finalize-Tracing",
            component: FinalizeTracing,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/comment/:id",
            name: "Comment",
            component: Comment,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/delivereds",
            name: "Delivereds",
            component: Delivereds,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/delivered-detail/:id",
            name: "Delivered-Detail",
            component: DeliveredDetail,
            meta: {
                autentificate: true
            }
        },
        {
            path: "*",
            name: "Found",
            component: Found,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/customers",
            name: "Customers",
            component: Customer,
            meta: {
                autentificate: true
            }
        },
        {
            path: "/pruebas",
            name: "Pruebas",
            component: Pruebas,
            meta: {
                autentificate: true
            }
        },
    ]
});
router.beforeEach((to, from, next) => {
    let autorization = to.matched.some(record => record.meta.autentificate)
    let token = localStorage.getItem('token');
    if (autorization) {
        if (token) {
            next();
        } else {
            next('login');
        }
    } else {
        next();
    }
});

export default router;