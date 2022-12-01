<template>
    <app-layout title="تکت توزیع تحویلخانه" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">
                            <small> لیست اجناس جمع قید شده</small>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                            <th>شماره</th>
                            <th>درخواست کننده</th>
                            <th>جنس</th>
                            <th>مقدار</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                            </thead>
                            <tbody>
                            <tr v-for="stock in deposits" v-bind="key">
                                <td>{{ stock.id }}</td>
                                <td>{{ stock.user_name }}</td>
                                <td>{{ stock.name}}</td>
                                <td>{{ stock.quantity}}</td>
                                <td>{{ stock.date }}</td>
                                <td class="td-actions">
                                    <Link :href="route('stock',stock)"
                                          class="btn btn-primary btn-link btn-sm"
                                          data-original-title="Edit Task">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </Link>
                                    <Link rel="tooltip" title=""
                                          class="btn btn-danger btn-link btn-sm"
                                          data-original-title="لغو درخواست" data-toggle="modal"
                                          data-target="#myModal">
                                        <i class="material-icons">mark</i>
                                        <div class="ripple-container">لغو</div>
                                    </link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
    import {defineComponent} from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import RegisterStock from "@/Pages/Stock/Partials/RegisterStock";
    import UpdateStock from "@/Pages/Stock/Partials/UpdateStock";
    import {Head, Link} from '@inertiajs/inertia-vue3';

    export default defineComponent({

        props:
            ['deposits']
        ,

        components: {
            AppLayout,
            RegisterStock,
            UpdateStock,
            Head,
            Link
        },
        data() {
            return {}
        }
    })
</script>
