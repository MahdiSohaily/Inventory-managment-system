<template>
    <app-layout title="داشبورد" position="position">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                داشبورد
            </h2>
        </template>

        <div class="content">
            <welcome :total-demand="totalDemand" :accounts="accounts" :stocks="stocks" :position="position"/>
        </div>
    </app-layout>
</template>

<script>
    import {defineComponent} from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        props: ['accounts', 'totalDemand','stocks','position'],
        components: {
            AppLayout,
            Welcome,
        },
    })
</script>
