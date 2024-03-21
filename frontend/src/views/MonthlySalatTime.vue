<template>
    <div class="p-5 border-b-8 border-gray-100 flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-4">Monthly Salat Time</h1>
        <div class="card flex flex-col md:flex-row gap-6">
            <!-- Calendar Field -->
            <div class="flex flex-col w-full">
                <label for="date" class="font-bold mb-1">Select Month</label>
                <Calendar
                    id="date"
                    placeholder="Select month"
                    v-model="date"
                    view="month"
                    dateFormat="mm/yy"
                    class="h-12"
                />
            </div>
            <!-- Dropdown Field -->
            <div class="flex flex-col w-full">
                <label for="city" class="font-bold mb-1">Select City</label>
                <Dropdown
                    id="city"
                    v-model="selectedCity"
                    :options="cities"
                    optionLabel="name"
                    placeholder="Select a City"
                    class="md:w-14rem h-12"
                />
            </div>
        </div>
    </div>

    <!-- Monthly Salat Time -->
    <div class="p-3">
        <DataTable
            :value="times"
            ref="dt"
            scrollable
            scrollHeight="400px"
            tableStyle="min-width: 50rem"
        >
            <template #header>
                <div style="text-align: right">
                    <button
                        class="bg-green-900 hover:bg-green-700 text-white py-2 px-4 rounded"
                        @click="exportCSV($event)"
                    >
                        Download
                        <InputIcon class="pi pi-external-link ml-2">
                        </InputIcon>
                    </button>
                </div>
            </template>
            <Column field="date" header="Date"></Column>
            <Column field="fajr" header="Fajr"></Column>
            <Column field="sunrise" header="Sunrise"></Column>
            <Column field="dhuhr" header="Dhuhr"></Column>
            <Column field="asr" header="Asr"></Column>
            <Column field="maghrib" header="Maghrib"></Column>
            <Column field="isha" header="Isha"></Column>
        </DataTable>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { TestService } from "../service/TestService";

const date = ref();
const selectedCity = ref();

const cities = ref([
    { name: "New York", code: "NY" },
    { name: "Rome", code: "RM" },
    { name: "London", code: "LDN" },
    { name: "Istanbul", code: "IST" },
    { name: "Paris", code: "PRS" },
]);

onMounted(() => {
    TestService.getSalatTimesData().then((data) => (times.value = data));
});

const dt = ref();
const times = ref();
const exportCSV = () => {
    dt.value.exportCSV();
};
</script>
