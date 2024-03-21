import { createRouter, createWebHistory } from "vue-router";
import SalatTime from "../views/SalatTime.vue";
import MonthlySalatTime from "../views/MonthlySalatTime.vue";
import RamadanTimetable from "../views/RamadanTimetable.vue";

const routes = [
    {
        path: "/salat-time",
        name: "salat-time",
        component: SalatTime,
    },
    {
        path: "/monthly-salat-time",
        name: "monthly-salat-time",
        component: MonthlySalatTime,
    },
    {
        path: "/ramadan-timetable",
        name: "ramadan-timetable",
        component: RamadanTimetable,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
