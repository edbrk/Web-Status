<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue';
</script>

<template>
    <Head title="Servers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Servers</h2>
        </template>

        <div class="py-12">
            <div class=" mx-auto sm:px-6 lg:px-8">
                <div class="bg-contrast overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">Pollers Page</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
