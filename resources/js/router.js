import VueRouter from 'vue-router';
/*
import MultiStepForm from "./components/MultiStepForm";
*/
import App from "./components/App";


export default new VueRouter({
    routes : [
        {
            path: "/",
            component : App
        }
    ],
    mode: "history"
})
