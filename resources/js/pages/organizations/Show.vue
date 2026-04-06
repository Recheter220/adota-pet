<script setup lang="ts">
import { Verified, ExternalLink } from 'lucide-vue-next';
import type { Organization } from '@/types/models/organization';

type Props = {
    organization: Organization;
};

defineProps<Props>();
</script>

<template>
    <div class="heading">
        <h1 class="inline text-4xl font-bold">{{ organization.name }}</h1>
    </div>
    <div
        class="m-auto"
    >
        <div class="card">
            <div>
                <img
                    :src="organization.logo_path"
                    class="m-auto mb-5 max-h-50"
                />
                <div class="my-2 flex justify-center">
                    <Button v-if="organization.verified">
                        <span class="flex items-center"
                            ><Verified class="mr-1 text-blue-500"></Verified>
                            Organização verificada</span
                        >
                    </Button>
                </div>
            </div>
            <ul class="text-sm">
                <li>Apresentação: {{ organization.description }}</li>
                <li>E-mail: {{ organization.email }}</li>
                <li class="flex items-center">
                    Site:&nbsp;
                    <a :href="organization.website" target="_blank">
                        <span class="flex items-center text-blue-500"
                            >{{ organization.website
                            }}<ExternalLink height="16" width="16"></ExternalLink
                        ></span>
                    </a>
                </li>
                <li>Contato: {{ organization.phone }}</li>
                <li>Endereço: {{ organization.address }}</li>
            </ul>
        </div>
    </div>
</template>

<script lang="ts"></script>
