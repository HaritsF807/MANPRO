import { createRouter, createWebHistory } from "vue-router";

// Pages
import Dashboard from "../pages/Dashboard.vue";
import HistoryPembeli from "../pages/HistoryPembeli.vue";
import ProdukIndex from "../pages/Produk/Index.vue";
import ProdukCreate from "../pages/Produk/Create.vue";
import ProdukEdit from "../pages/Produk/Edit.vue";
import Login from "../pages/Admin/Login.vue";

const routes = [
    { path: "/", redirect: "/dashboard" },
    { path: "/dashboard", name: "dashboard", component: Dashboard },

    // Produk
    { path: "/produk", name: "produk.index", component: ProdukIndex },
    { path: "/produk/create", name: "produk.create", component: ProdukCreate },
    {
        path: "/produk/edit/:id",
        name: "produk.edit",
        component: ProdukEdit,
        props: true,
    },

    // History Pembeli
    { path: "/history", name: "history", component: HistoryPembeli },
    // Auth
    { path: "/login", name: "login", component: Login },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
