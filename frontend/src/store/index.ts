import { createStore } from "vuex";
import salatTimeService from "../service/SalatTimeService";

export default createStore({
    state: {
        locations: [],
        minDate: null,
        maxDate: null,
    },
    getters: {
        locations: (state) => state.locations,
        minDate: (state) => state.minDate,
        maxDate: (state) => state.maxDate,
    },
    actions: {
        async fetchLocationsAndDateLimits({ commit }) {
            try {
                const [locationsResponse, dateLimitsResponse] =
                    await Promise.all([
                        salatTimeService.getLocations(),
                        salatTimeService.getDateLimits(),
                    ]);

                commit("setLocations", locationsResponse.data);
                commit("setMinDate", dateLimitsResponse.data.min_date);
                commit("setMaxDate", dateLimitsResponse.data.max_date);
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        },
    },
    mutations: {
        setLocations(state, locations) {
            state.locations = locations;
        },
        setMinDate(state, minDate) {
            state.minDate = new Date(minDate);
        },
        setMaxDate(state, maxDate) {
            state.maxDate = new Date(maxDate);
        },
    },
});
