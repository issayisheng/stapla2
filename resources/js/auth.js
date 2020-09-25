import axios from "axios";
import { attempt } from "lodash";

export default {
    namespaced: true,

    state: {
        token: null,
        user: null
    },

    getters: {
        authenticated(state) {
            return state.token && state.user;
        },

        user(state) {
            return state.user;
            // return state.token && state.user;
        }
    },

    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;
        },
        SET_USER(state, data) {
            state.user = data;
        }
    },

    actions: {
        async register({ dispatch }, credentials) {
            let response = await axios.post("/api/auth/register", credentials);

            return dispatch("attempt", response.data.token);
        },

        async login({ dispatch }, credentials) {
            let response = await axios.post("/api/auth/login", credentials);

            return dispatch("attempt", response.data.token);
        },

        async attempt({ commit, state }, token) {
            if (token) {
                commit("SET_TOKEN", token);
            }

            if (!state.token) {
                return;
            }

            try {
                let response = await axios.get("/api/auth/me");

                commit("SET_USER", response.data);
            } catch (e) {
                commit("SET_TOKEN", null);
                commit("SET_USER", null);
            }
        },

        logout({ commit }) {
            return axios.post("/api/auth/logout").then(() => {
                commit("SET_TOKEN", null);
                commit("SET_USER", null);
            });
        }
    }
};
