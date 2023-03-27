<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head><meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"></Head>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-800">
        <div>
            <Link href="/">
                <ApplicationLogo class="text-3xl"/>
            </Link>
        </div>

        <div class="p-3">
                <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg rounded"
                >
                    <slot />
                </div>
        </div>
    </div>
</template>
