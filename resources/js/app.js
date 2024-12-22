import "./bootstrap";

import { createApp } from "vue";
import Scroller from "./components/Scroller.vue";

const app = createApp({});

app.component("Scroller", Scroller);
// app.component('x-layouts.app', AppLayout);

app.mount("#app");
