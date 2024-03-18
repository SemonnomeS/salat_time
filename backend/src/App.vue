<template>
    <div class="flex flex-col h-screen">
        <Navbar />
        <LayoutContainer class="flex-grow">
            <router-view></router-view>
        </LayoutContainer>
    </div>
</template>

<script setup lang="ts">
import Navbar from "./components/Navbar.vue";
import LayoutContainer from "./components/LayoutContainer.vue";
</script>

<style scoped></style>
