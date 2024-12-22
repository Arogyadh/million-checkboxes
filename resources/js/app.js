import "./bootstrap";

import { createApp } from "vue";
import Scroller from "./components/Scroller.vue";
import 'vue-virtual-scroller/dist/vue-virtual-scroller.css'

const app = createApp({});

app.component("Scroller", Scroller);
// app.component('x-layouts.app', AppLayout);

app.mount("#app");
