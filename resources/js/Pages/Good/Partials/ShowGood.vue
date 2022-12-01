<template>
    <app-layout title="اجناس" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <Link class="nav-link" :href="route('good')">
                                            <i class="material-icons">fact_check</i>درج اجناس در سیستم
                                            <div class="ripple-container"></div>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#goodsList" data-toggle="tab">
                                            <i class="material-icons">list</i> اجناس موجود در سیستم
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#messages" data-toggle="tab">
                                            <i class="material-icons">analytics</i> کتگوری های موجود
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#settings" data-toggle="tab">
                                            <i class="material-icons">view_in_ar</i> واحد های موجود
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
                                        <UpdateGoods :categories="categories" :unites="unites" :good="good"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="goodsList">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">درخواست های اخیر</h4>
                                        <p class="card-category">درخواست های که اخیرا ثبت سیتم گردیده اند</p>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            <thead class="text-primary">
                                            <th>شماره</th>
                                            <th>اسم</th>
                                            <th>کتگوری</th>
                                            <th>واحد</th>
                                            <th>تعداد</th>
                                            <th>مشخصات جنس</th>
                                            <th>عملیات</th>
                                            </thead>
                                            <tbody>
                                            <tr v-for="good in goods">
                                                <td>{{ good.id }}</td>
                                                <td>{{ good.name }}</td>
                                                <td>{{ good.cat_name}}</td>
                                                <td>{{ good.unit_name}}</td>
                                                <td>{{ good.quantity}}</td>
                                                <td>{{ good.properties}}</td>
                                                <td class="td-actions text-right">
                                                    <Link :href="route('good.edit',good)"
                                                          class="btn btn-primary btn-link btn-sm"
                                                          data-original-title="Edit Task">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </Link>
                                                    <Link rel="tooltip" title=""
                                                          class="btn btn-danger btn-link btn-sm"
                                                          data-original-title="Remove" data-toggle="modal"
                                                          data-target="#myModal">
                                                        <i class="material-icons">close</i>
                                                        <div class="ripple-container"></div>
                                                    </link>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="messages">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">درخواست های اخیر</h4>
                                        <p class="card-category">درخواست های که اخیرا ثبت سیتم گردیده اند</p>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            <thead class="text-primary">
                                            <th>شماره</th>
                                            <th>اسم کتگوری</th>
                                            <th>عملیات</th>
                                            </thead>
                                            <tbody>
                                            <tr v-for="category in categories">
                                                <td>{{ category.id }}</td>
                                                <td>{{ category.name }}</td>
                                                <td class="td-actions text-right">
                                                    <Link :href="route('category.edit',category)" title=""
                                                          class="btn btn-primary btn-link btn-sm"
                                                          data-original-title="Edit Task">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </Link>
                                                    <!--:href="route('delete.profile',account)"-->
                                                    <Link rel="tooltip" title=""
                                                          class="btn btn-danger btn-link btn-sm"
                                                          data-original-title="Remove">
                                                        <i class="material-icons">close</i>
                                                        <div class="ripple-container"></div>
                                                    </link>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">درخواست های اخیر</h4>
                                        <p class="card-category">درخواست های که اخیرا ثبت سیتم گردیده اند</p>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            <thead class="text-primary">
                                            <th>شماره</th>
                                            <th>اسم واحد</th>
                                            <th>عملیات</th>
                                            </thead>
                                            <tbody>
                                            <tr v-for="unit in unites">
                                                <td>{{ unit.id }}</td>
                                                <td>{{ unit.name }}</td>
                                                <td class="td-actions text-right">
                                                    <Link :href="route('unit.edit',unit)" title=""
                                                          class="btn btn-primary btn-link btn-sm"
                                                          data-original-title="Edit Task">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </Link>
                                                    <!--:href="route('delete.profile',account)"-->
                                                    <Link rel="tooltip" title=""
                                                          class="btn btn-danger btn-link btn-sm"
                                                          data-original-title="Remove">
                                                        <i class="material-icons">close</i>
                                                        <div class="ripple-container"></div>
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
    </app-layout>
</template>
<script>
    import {defineComponent} from 'vue'
    import {Head, Link} from '@inertiajs/inertia-vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import UpdateGoods from "@/Pages/Good/Partials/UpdateGoods";

    export default defineComponent({

        props: ['sessions', 'goods', 'categories', 'unites', 'good'],

        components: {
            AppLayout,
            UpdateGoods,
            Head,
            Link,
        },
    })
</script>
