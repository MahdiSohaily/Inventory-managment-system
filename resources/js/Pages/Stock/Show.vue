<template>
    <app-layout title="لیست امر تحویلخانه ها" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                            <i class="material-icons">fact_check</i>ثبت گدام جدید
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#goodsList" data-toggle="tab">
                                            <i class="material-icons">list</i> لیست گدام های موجود
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="row">
                                    <div class="col-md-12">
                                        <update-stock v-if="stock" :users="users" :categories="categories"
                                         :stock="stock"/>
                                        <Register-Stock v-else :users="users" :categories="categories"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="goodsList">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header card-header-primary">
                                                <h4 class="card-title">
                                                    <small>گدام های راجستر شده در سیستم</small>
                                                </h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-primary">
                                                    <th>شماره</th>
                                                    <th>معتمد</th>
                                                    <th>وظیفه</th>
                                                    <th>گدام</th>
                                                    <th>کتگوری</th>
                                                    <th class="text-center">توضیحات</th>
                                                    <th class="text-center">عملیات</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="stock in stocks" v-bind="key">
                                                        <td>{{ stock.id }}</td>
                                                        <td>{{ stock.user_name }}</td>
                                                        <td>{{ stock.position}}</td>
                                                        <td>{{ stock.name}}</td>
                                                        <td>{{ stock.cat_name }}</td>
                                                        <td class="col-4">{{ stock.description }}</td>
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
                            </div>
                        </div>
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
            ['categories', 'users', 'stocks','stock']
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
