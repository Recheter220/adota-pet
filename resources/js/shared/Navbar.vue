<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <aside
        class="fixed top-0 left-0 z-40 h-full w-48 -translate-x-full transition-transform sm:translate-x-0"
    >
        <div
            class="border-default h-full overflow-y-auto border-e border-e-neutral-300 bg-neutral-100 px-3 py-4"
        >
            <h2 class="text-2xl text-orange-400 text-center">AdotaPet</h2>
            <nav class="mt-6">
                <ul class="">
                    <li class="">
                        <Link
                            href="/"
                            class="m-0 block rounded-md p-2 text-blue-400 hover:bg-neutral-200"
                            >Home
                        </Link>
                    </li>
                    <li class="">
                        <Link
                            href="/pets"
                            class="m-0 block rounded-md p-2 text-blue-400 hover:bg-neutral-200"
                            >Pets
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script lang="ts"></script>

<style lang="scss" scoped></style>
