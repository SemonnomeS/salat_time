import axios from "axios";
import moment from "moment";

const BASE_URL = import.meta.env.VITE_API_BASE_URL;

export default {
    getLocations() {
        return axios.get(`${BASE_URL}locations`);
    },

    getDateLimits() {
        return axios.get(`${BASE_URL}date-limits`);
    },

    getSalatTime(date, location) {
        return axios.get(`${BASE_URL}salat-time`, {
            params: {
                date: moment(date).format("YYYY-MM-DD"),
                location: location,
            },
        });
    },

    getMonthlySalatTime(date, location) {
        return axios.get(`${BASE_URL}monthly-salat-time`, {
            params: {
                date: moment(date).format("YYYY-MM-DD"),
                location: location,
            },
        });
    },

    getMRamadanSalatTime(date, location) {
        return axios.get(`${BASE_URL}ramadan-salat-time`, {
            params: {
                date: moment(date).format("YYYY-MM-DD"),
                location: location,
            },
        });
    },
};
