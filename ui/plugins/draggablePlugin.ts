import VueDraggableNext  from "vuedraggable";

export default defineNuxtPlugin(nuxtApp => {
    nuxtApp.vueApp.component("VueDraggableNext", VueDraggableNext);
})
