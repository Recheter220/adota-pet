<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import ImageUpload from '@/shared/ImageUpload.vue';

const form = useForm({
    name: '',
    species: 'dog',
    gender: 'm',
    breed: '',
    color: '',
    birthday: '',
    bio: '',
    gallery: [],
});

const submit = () => {
    form.post(`/pets`);
};
</script>

<template>
    <Head title="Cadastrar Pet" />

    <div class="mx-auto max-w-2xl p-6">
        <h1 class="mb-6 text-2xl font-bold">Cadastrar Pet</h1>

        <form
            @submit.prevent="submit"
            class="space-y-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm"
        >
            <div>
                <label class="block text-sm font-medium text-gray-700"
                    >Nome</label
                >
                <input
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2"
                    required
                />
                <div
                    v-if="$page.props.errors.name"
                    class="mt-1 text-sm text-red-500"
                >
                    {{ $page.props.errors.name }}
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Espécie</label
                    >
                    <select
                        v-model="form.species"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white p-2"
                        required
                    >
                        <option value="cat">Gato</option>
                        <option value="dog">Cachorro</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Sexo</label
                    >
                    <select
                        v-model="form.gender"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white p-2"
                    >
                        <option value="m">Macho</option>
                        <option value="f">Fêmea</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Raça</label
                    >
                    <input
                        v-model="form.breed"
                        type="text"
                        class="mt-1 block w-full rounded-md border border-gray-300 p-2"
                    />
                    <div
                        v-if="$page.props.errors.breed"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ $page.props.errors.breed }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Cor</label
                    >
                    <input
                        v-model="form.color"
                        type="text"
                        class="mt-1 block w-full rounded-md border border-gray-300 p-2"
                    />
                    <div
                        v-if="$page.props.errors.color"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ $page.props.errors.color }}
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"
                    >Nascimento</label
                >
                <input
                    v-model="form.birthday"
                    type="text"
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2"
                />
                <div
                    v-if="$page.props.errors.birthday"
                    class="mt-1 text-sm text-red-500"
                >
                    {{ $page.props.errors.birthday }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"
                    >Bio</label
                >
                <textarea
                    v-model="form.bio"
                    rows="4"
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2"
                ></textarea>
            </div>

            <div>
                <ImageUpload
                    v-model="form.gallery"
                    label="Galeria de Fotos"
                    multiple
                    :error="$page.props.errors.gallery"
                />
            </div>

            <div class="flex items-center justify-between space-x-3 pt-4">
                <button
                    type="button"
                    class="rounded-md bg-orange-400 px-4 py-2 text-white hover:bg-orange-500 disabled:opacity-50"
                >
                    <Link href="/pets"> Voltar </Link>
                </button>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 disabled:opacity-50"
                >
                    Salvar
                </button>
            </div>
        </form>
    </div>
</template>
