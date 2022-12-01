<template>
    <Head title="خوش آمدید" ></Head>

    <div class="min-vh-100">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 underline">
                داشبورد
            </Link>

            <template v-else>
                <Link :href="route('login')" class="btn btn-primary text-white p-3 mx-3">
                    ورود به سیستم
                </Link>
            </template>
        </div>

        <div class="text-white center">
          <H1 class="text-center">سیستم خریداری و موجودی اجناس</H1>
        </div>
    </div>
</template>

<style scoped>
    .min-vh-100 {
        height: 100vh !important;
        background: url('../../../public/img/bg2.jpg') bottom center;
        background-size:cover ;
        overflow: hidden;
    }

</style>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    })
</script>
