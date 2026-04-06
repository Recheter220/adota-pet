<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Heart, Verified, ExternalLink, List } from 'lucide-vue-next';
import type { Organization } from '@/types/models/organization';

type Props = {
    organizations: Organization[];
};

defineProps<Props>();
</script>

<template>
    <div class="heading">
        <h1 class="inline text-4xl font-bold">Organizações</h1>
    </div>
    <div v-if="organizations.length">
        <div
            class="grid gap-4 p-4 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4"
        >
            <div
                v-for="organization of organizations"
                v-bind:key="organization.id"
                class="card"
            >
                <div>
                    <img
                        :src="organization.logo_path"
                        class="m-auto mb-5 max-h-50"
                    />
                    <div class="flex justify-center">
                        <Button size="icon" class="mx-2" action>
                            <Link :href="'/organizations/' + organization.slug">
                                <List class="text-blue-600"></List>
                            </Link>
                        </Button>
                        <Button size="icon" class="mx-2" action>
                            <Heart class="text-red-600"></Heart>
                        </Button>
                    </div>
                    <div class="flex justify-center my-2">
                        <Button v-if="organization.verified">
                            <span class="flex items-center"><Verified class="text-blue-500 mr-1"></Verified> Organização verificada</span>
                        </Button>
                    </div>
                </div>
                <ul class="text-sm">
                    <li>Nome: {{ organization.name }}</li>
                    <li>Apresentação: {{ organization.description }}</li>
                    <li>E-mail: {{ organization.email }}</li>
                    <li>Site:
                        <a :href="organization.website" target="_blank">
                            <span class="flex items-center text-blue-500">{{ organization.website }}<ExternalLink height="16" width="16"></ExternalLink></span>
                        </a>
                    </li>
                    <li>Contato: {{ organization.phone }}</li>
                    <li>Endereço: {{ organization.address }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div v-else>
        <p>Nenhuma organização cadastrada até o momento</p>
    </div>
</template>

<script lang="ts"></script>
