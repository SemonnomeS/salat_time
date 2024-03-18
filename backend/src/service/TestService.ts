export const TestService = {
    getSalatTimes() {
        return {
            date: "2024-01-01",
            fajr: "06:50:00",
            sunrise: "08:33:00",
            dhuhr: "13:12:00",
            asr: "16:06:00",
            maghrib: "17:43:00",
            isha: "19:20:00",
        };
    },

    getSalatTimesData() {
        const salatTimes = this.getSalatTimes();
        const products = Array(30)
            .fill(null)
            .map(() => ({ ...salatTimes }));
        return Promise.resolve(products);
    },
};
