<script setup lang="ts">
import Navbar from '@/shared/Navbar.vue';
</script>

<template>
    <div class="relative">
        <Navbar />
        <div class="p-4 sm:ml-48">
            <slot />
        </div>
    </div>
</template>

<style scoped></style>
