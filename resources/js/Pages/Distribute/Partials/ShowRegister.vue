<template>
    <app-layout title="تکت توزیع تحویلخانه" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <RegisterDistribute v-if="demand" :demand="demand"/>
                <div v-else class="card">
                    <div class="card-header card-header-primary">
                        <h5>ثبت تکت توزیع تحویلخانه</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <p class="alert alert-info">برای ثبت تیکت تحویلخانه از لیست درخواست تحویلخانه مورد٫ مورد نظر را
                            انتخاب نموده بروی تایید کلیک نمایید</p>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
    import {defineComponent} from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import {Head, Link} from '@inertiajs/inertia-vue3';
    import RegisterDistribute from "@/Pages/Distribute/Partials/RegisterDistribute";

    export default defineComponent({

        props:
            ['demand']
        ,

        components: {
            AppLayout,
            Head,
            Link,
            RegisterDistribute
        },
        data() {
            return {}
        }
    })
</script>
