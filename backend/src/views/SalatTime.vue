<template>
    <div class="p-5 border-b-8 border-gray-100 flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-4">Salat Time</h1>
        <div class="card flex flex-col md:flex-row gap-6">
            <!-- Calendar Field -->
            <div class="flex flex-col w-full">
                <label for="date" class="font-bold mb-1">Select Date</label>
                <Calendar
                    id="date"
                    placeholder="Select date"
                    v-model="date"
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
    <!-- Salat times -->
    <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 p-4"
    >
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>FAJR</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">04:15</p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>SUNRISE</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">05:48</p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>DHUHR</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">11:54</p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>ASR</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">15:16</p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>MAGHRIB</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">18:01</p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>ISHA'A</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">19:27</p>
            </template>
        </Card>
    </div>
</template>

<script setup>
import { ref } from "vue";

const date = ref();
const selectedCity = ref();

const cities = ref([
    { name: "New York", code: "NY" },
    { name: "Rome", code: "RM" },
    { name: "London", code: "LDN" },
    { name: "Istanbul", code: "IST" },
    { name: "Paris", code: "PRS" },
]);
</script>
