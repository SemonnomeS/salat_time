<template>
    <Navbar />
    <LayoutContainer>
        <router-view></router-view>
    </LayoutContainer>
</template>

<script setup lang="ts">
import Navbar from "./components/Navbar.vue";
import LayoutContainer from "./components/LayoutContainer.vue";
</script>

<style scoped></style>
