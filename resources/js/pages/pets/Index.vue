<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Pencil, Heart, PlusCircle } from 'lucide-vue-next';
import Carousel from '@/shared/Carousel.vue';
import type { Pet } from '@/types/models/pet';

type Props = {
    pets: Pet[];
};

defineProps<Props>();
</script>

<template>
    <div class="heading">
        <h1 class="text-4xl font-bold inline">Pets</h1>
        <Link href="/pets/new" class="">
            <Button
                class="cursor-pointer rounded-xl border-2 bg-green-600 px-4 py-2 text-center text-white"
            >
                <PlusCircle
                    class="mr-1 inline"
                    height="20"
                    width="20"
                ></PlusCircle>
                <span class="inline align-middle">Novo</span>
            </Button>
        </Link>
    </div>
    <div v-if="pets.length">
        <p>Os seguintes pets estão disponíveis para adoção:</p>
        <div
            class="grid gap-4 p-4 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4"
        >
            <div v-for="pet of pets" v-bind:key="pet.id" class="card">
                <div>
                    <div class="gallery-container p-5">
                        <Carousel
                            :images="pet.gallery"
                            :autoplay="6000"
                        />
                    </div>
                    <div class="flex justify-center">
                        <Button size="icon" class="mx-2" action>
                            <Link :href="'/pets/' + pet.id + '/edit'">
                                <Pencil class="text-blue-600"></Pencil>
                            </Link>
                        </Button>
                        <Button size="icon" class="mx-2" action>
                            <Heart class="text-red-600"></Heart>
                        </Button>
                    </div>
                </div>
                <ul>
                    <li>Organização: {{ pet.organization.name }}</li>
                    <li>Nome: {{ pet.name }}</li>
                    <li>Sexo: {{ pet.gender.toUpperCase() }}</li>
                    <li>Idade: {{ pet.birthday }}</li>
                    <li>Espécie: {{ pet.species }}</li>
                    <li>Raça: {{ pet.breed }}</li>
                    <li>Cor: {{ pet.color }}</li>
                    <li class="text-justify">{{ pet.bio }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div v-else>
        <p>Nenhum pet disponível para adoção</p>
    </div>
</template>

<script lang="ts"></script>
