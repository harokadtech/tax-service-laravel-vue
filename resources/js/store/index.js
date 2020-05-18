import Vue  from "vue";
import Vuex from "vuex";
import { getField, updateField } from 'vuex-map-fields';


Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        // We add one empty address to
        // render the first form row.
        personalinfo: [
            {
                email: '',
                zip: '',
                street: '',
            },
        ],
    },
    getters: {
        getField,
    },
    mutations: {
        updateField,
        // We'll use this mutation to
        // dynamically add new rows.
        addPersonalRow(state) {
            state.personalinfo.push({
                email: '',
                zip: '',
                street: '',
            });
        },
    },
});
