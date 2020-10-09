import Vue from "vue";
import Vuex from "vuex";
import auth from "./auth";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        authed: {
            login: false,
            user: []
        }
    },

    getters: {
        isLoggedIn(state) {
            return state.authed.login;
        }
    },

    mutations: {
        LOGIN(state, status) {
            state.authed.login = status;
            state.authed.user = [];
        },

        AUTH_USER(state, user) {
            state.authed.user = user;
        }
    },

    actions: {},

    modules: {
        auth
    }
});
