<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight, Image, Trash2 } from 'lucide-vue-next';
import { ref, computed, onMounted, onUnmounted } from 'vue';
import type { PetGallery } from '../types/models/pet-gallery';

const props = defineProps<{
    images: PetGallery[];
    showDelete?: boolean;
    autoplay?: number;
}>();

const currentIndex = ref(0);
const direction = ref('next');
let interval: ReturnType<typeof setInterval> | null = null;

const currentImage = computed(() => props.images[currentIndex.value]);

const next = () => {
    direction.value = 'next';
    currentIndex.value = (currentIndex.value + 1) % props.images.length;

    if (interval) {
        clearInterval(interval);
        interval = setInterval(next, props.autoplay);
    }
};

const prev = () => {
    direction.value = 'prev';
    currentIndex.value = (currentIndex.value - 1 + props.images.length) % props.images.length;

    if (interval) {
        clearInterval(interval);
    }
};

onMounted(() => {
    if (props.autoplay && props.images.length > 1) {
        interval = setInterval(next, props.autoplay);
    }
});

onUnmounted(() => {
    if (interval) {
        clearInterval(interval);
    }
});


const handleDelete = () => {
    if (!confirm('Tem certeza de que deseja remover esta imagem?')) {
        return;
    }

    const imageId = currentImage.value.id;
    // Placeholder route for deleting pet gallery images
    router.delete(`/pet-gallery/${imageId}`, {
        preserveScroll: true,
        onSuccess: () => {
            if (currentIndex.value >= props.images.length - 1) {
                currentIndex.value = Math.max(0, props.images.length - 2);
            }
        }
    });
};
</script>

<template>
    <div v-if="images.length > 0" class="relative group overflow-hidden rounded-xl bg-gray-100 aspect-square shadow-inner">
        <!-- Main Image with Slide Transition -->
        <Transition :name="direction === 'next' ? 'slide-next' : 'slide-prev'">
            <img
                :key="currentImage.id"
                :src="currentImage.url"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500"
                :alt="'Pet image ' + (currentIndex + 1)"
            />
        </Transition>

        <!-- Navigation Buttons (Circular) -->
        <div v-if="images.length > 1" class="absolute inset-0 flex items-center justify-between p-4 group-hover:opacity-100 transition-opacity pointer-events-none">
            <button
                @click="prev"
                class="p-2 rounded-full bg-white/90 hover:bg-white text-gray-800 shadow-md transition-all active:scale-95 pointer-events-auto"
                type="button"
            >
                <ChevronLeft></ChevronLeft>
            </button>
            <button
                @click="next"
                class="p-2 rounded-full bg-white/90 hover:bg-white text-gray-800 shadow-md transition-all active:scale-95 pointer-events-auto"
                type="button"
            >
                <ChevronRight></ChevronRight>
            </button>
        </div>

        <!-- Delete Button -->
        <button
            v-if="showDelete"
            @click="handleDelete"
            class="absolute top-4 right-4 p-2 rounded-full bg-red-500 hover:bg-red-600 text-white shadow-lg opacity-0 group-hover:opacity-100 transition-all hover:scale-110 active:scale-95"
            type="button"
            title="Apagar imagem"
        >
            <Trash2></Trash2>
        </button>

        <!-- Indicators -->
        <div v-if="images.length > 1" class="absolute bottom-4 left-0 right-0 flex justify-center gap-1.5 pointer-events-none">
            <div
                v-for="(_, index) in images"
                :key="index"
                class="h-1.5 rounded-full transition-all duration-300"
                :class="index === currentIndex ? 'bg-white w-4' : 'bg-white/40 w-1.5'"
            ></div>
        </div>
    </div>

    <!-- Empty State -->
    <div v-else class="aspect-square bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400">
        <Image></Image>
        <span class="text-sm font-medium">Nenhuma imagem disponível</span>
    </div>
</template>

<style scoped>
/* Slide Next Animation (Right to Left) */
.slide-next-enter-active,
.slide-next-leave-active,
.slide-prev-enter-active,
.slide-prev-leave-active {
    transition: transform 0.3s ease-in-out;
}

.slide-next-enter-from {
    transform: translateX(100%);
}
.slide-next-leave-to {
    transform: translateX(-100%);
}

/* Slide Prev Animation (Left to Right) */
.slide-prev-enter-from {
    transform: translateX(-100%);
}
.slide-prev-leave-to {
    transform: translateX(100%);
}
</style>
