import { createApp } from "vue";
import store from "./store";
import router from "./router";
import "./style.css";
import App from "./App.vue";

import PrimeVue from "primevue/config";
import Calendar from "primevue/calendar";
import Dropdown from "primevue/dropdown";
import Card from "primevue/card";

import "primevue/resources/themes/aura-light-green/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";

const app = createApp(App);

app.use(store);
app.use(router);
app.use(PrimeVue);
app.component("Calendar", Calendar);
app.component("Dropdown", Dropdown);
app.component("Card", Card);
app.mount("#app");
