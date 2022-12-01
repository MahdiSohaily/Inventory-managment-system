<template>
    <app-layout title="درخواست های تحویلخانه" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                            <i class="material-icons">fact_check</i>ایجاد درخواست جدید
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#goodsList" data-toggle="tab">
                                            <i class="material-icons">list</i> درخواست های در حال انتظار
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
                                        <UpdateDemand v-if="demand" :categories="categories" :demand="demand"
                                                      :user="user" :category_id="category_id"/>
                                        <RegisterDemand v-else :categories="categories" :user="user"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="goodsList">
                                <div class="row">
                                    <div class="col-md-12">
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
                                                    <th>شعبه درخواست کننده</th>
                                                    <th>جنس مورد نظر</th>
                                                    <th>تعداد درخواستی</th>
                                                    <th>تعداد موجود</th>
                                                    <th class="text-center">توضیحات درخواست</th>
                                                    <th class="text-center">عملیات</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="demand in demands">
                                                        <td>{{ demand.id }}</td>
                                                        <td>{{ demand.name }}</td>
                                                        <td>{{ demand.section}}</td>
                                                        <td>{{ demand.good_name }}</td>
                                                        <td>{{ demand.quantity }}</td>
                                                        <td>{{ demand.good_quantity }}</td>
                                                        <td class="col-4">{{ demand.description }}</td>
                                                        <td class="td-actions text-right">
                                                            <Link :href="route('demand',demand)"
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
                                                            <Link :href="route('distribute',demand.id)"
                                                                  class="btn btn-success btn-link btn-sm"
                                                                  data-original-title="تایید درخواست"
                                                                  data-toggle="modal"
                                                                  data-target="#myModal">
                                                                <i class="material-icons">mark</i>
                                                                <div class="ripple-container">تایید</div>
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
    import RegisterDemand from "@/Pages/Demand/Partials/RegisterDemand";
    import UpdateDemand from "@/Pages/Demand/Partials/UpdateDemand";
    import {Head, Link} from '@inertiajs/inertia-vue3';

    export default defineComponent({

        props:
            ['sessions', 'demands', 'categories', 'demand', 'category_id', 'user']
        ,

        components: {
            AppLayout,
            RegisterDemand,
            UpdateDemand,
            Head,
            Link
        },
        data() {
            return {}
        }
    })
</script>
