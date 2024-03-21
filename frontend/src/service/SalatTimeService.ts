import axios from "axios";

const BASE_URL = import.meta.env.VITE_API_BASE_URL;

export default {
    getLocations() {
        return axios.get(`${BASE_URL}locations`);
    },

    getDateLimits() {
        return axios.get(`${BASE_URL}date_limits`);
    },

    getSalatTime(date, location) {
        return axios.get(`${BASE_URL}salat-time`, {
            params: {
                date: date,
                location: location,
            },
        });
    },
};
