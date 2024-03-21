<template>
    <div class="p-5 border-b-8 border-gray-100 flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-4">Salat Time</h1>
        <div class="card flex flex-col md:flex-row gap-6">
            <!-- Calendar Field -->
            <div class="flex flex-col w-full">
                <label for="date" class="font-bold mb-1">Select Date</label>
                <Calendar
                    id="date"
                    :minDate="minDate"
                    :maxDate="maxDate"
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
                    v-model="selectedLocation"
                    :options="locations"
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
                <p class="m-0 text-green-700 font-bold text-xl">
                    {{ salatTimes?.fajr }}
                </p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>SUNRISE</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">
                    {{ salatTimes?.sunrise }}
                </p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>DHUHR</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">
                    {{ salatTimes?.dhuhr }}
                </p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>ASR</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">
                    {{ salatTimes?.asr }}
                </p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>MAGHRIB</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">
                    {{ salatTimes?.maghrib }}
                </p>
            </template>
        </Card>
        <Card style="max-width: 20rem" class="bg-gray-50">
            <template #title>ISHA'A</template>
            <template #content>
                <p class="m-0 text-green-700 font-bold text-xl">
                    {{ salatTimes?.isha }}
                </p>
            </template>
        </Card>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, computed } from "vue";
import { useStore } from "vuex";
import salatTimeService from "../service/SalatTimeService";

const store = useStore();

const date = ref();
const selectedLocation = ref();
const salatTimes = ref(null);

// Computed properties to access store values
const locations = computed(() => store.getters.locations);
const minDate = computed(() => store.getters.minDate);
const maxDate = computed(() => store.getters.maxDate);

// Fetch locations and date limits when the component is mounted
onMounted(async () => {
    // Dispatch the action to fetch locations and date limits
    await store.dispatch("fetchLocationsAndDateLimits");
});

// Define a method to fetch salat times when date or location changes
const fetchSalatTimes = async () => {
    if (date.value && selectedLocation.value) {
        try {
            const response = await salatTimeService.getSalatTime(
                date.value,
                selectedLocation.value.name
            );
            salatTimes.value = response.data;
        } catch (error) {
            console.error("Error fetching salat times:", error);
        }
    }
};

// Watch for changes in date or location and fetch salat times accordingly
watch([date, selectedLocation], fetchSalatTimes, { immediate: true });
</script>
