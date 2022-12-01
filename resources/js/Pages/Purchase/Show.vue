<template>
    <app-layout title="درخواست امر خریداری" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                            <i class="material-icons">fact_check</i>ثبت امر خریداری
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#goodsList" data-toggle="tab">
                                            <i class="material-icons">list</i>لیست امر های خریداری
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
                                        <UpdatePurchase v-if="purchase" :categories="categories" :proc="proc"
                                                        :purchase="purchase" :category_id="category_id"/>
                                        <RegisterPurchase v-else :categories="categories" :proc="proc"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="goodsList">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header card-header-primary">
                                                <h4 class="card-title">
                                                    <small> لیست درخواست های خریداری بدون بیل</small>
                                                </h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-primary">
                                                    <th>شماره</th>
                                                    <th>اسم جنس</th>
                                                    <th>تعداد</th>
                                                    <th>قیمت فی واحد</th>
                                                    <th>مجموع</th>
                                                    <th class="text-center">تاریخ خریداری</th>
                                                    <th class=" col-3">توضیحات</th>
                                                    <th class="">عملیات</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="purchase in purchases">
                                                        <td>{{ purchase.id }}</td>
                                                        <td>{{ purchase.name }}</td>
                                                        <td>{{ purchase.quantity }}</td>
                                                        <td>{{ purchase.price_per }}</td>
                                                        <td>{{ purchase.total }}</td>
                                                        <td>{{ purchase.date }}</td>
                                                        <td class="col-3">{{ purchase.description }}</td>
                                                        <td class="td-actions">
                                                            <Link :href="route('purchase',purchase)"
                                                                  class="btn btn-primary btn-link btn-sm"
                                                                  data-original-title="Edit Task">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </Link>
                                                            <Link rel="tooltip" title=""
                                                                  class="btn btn-danger btn-link btn-sm"
                                                                  data-original-title="لغو درخواست" data-toggle="modal"
                                                                  data-target="#myModal">
                                                                <i class="material-icons">close</i>
                                                            </link>
                                                            <Link :href="route('bill',purchase)" rel="tooltip" title=""
                                                                  class="btn btn-info btn-sm"
                                                                  data-original-title="" data-toggle="modal"
                                                                  data-target="#myModal">
                                                                <small>ثبت بیل جنس</small>
                                                                <i class="material-icons"></i>
                                                            </link>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header card-header-primary">
                                                <h4 class="card-title">
                                                    <small>
                                                        لیست درخواست های خریداری برای ثبت در گدام
                                                    </small>
                                                </h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-primary">
                                                    <th>شماره</th>
                                                    <th>اسم جنس</th>
                                                    <th>تعداد</th>
                                                    <th>قیمت فی واحد</th>
                                                    <th>مجموع</th>
                                                    <th class="text-center">تاریخ خریداری</th>
                                                    <th class=" col-3">توضیحات</th>
                                                    <th class="">عملیات</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="item in delivered_purchases">
                                                        <td>{{ item.id }}</td>
                                                        <td>{{ item.name }}</td>
                                                        <td>{{ item.quantity }}</td>
                                                        <td>{{ item.price_per }}</td>
                                                        <td>{{ item.total }}</td>
                                                        <td>{{ item.date }}</td>
                                                        <td class="col-3">{{ item.description }}</td>
                                                        <td class="td-actions">
                                                            <Link :href="route('purchase',item)"
                                                                  class="btn btn-primary btn-link btn-sm"
                                                                  data-original-title="Edit Task">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </Link>
                                                            <Link rel="tooltip" title=""
                                                                  class="btn btn-danger btn-link btn-sm"
                                                                  data-original-title="لغو درخواست" data-toggle="modal"
                                                                  data-target="#myModal">
                                                                <i class="material-icons">close</i>
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
    import RegisterPurchase from "@/Pages/Purchase/Partials/RegisterPurchase";
    import UpdatePurchase from "@/Pages/Purchase/Partials/UpdatePurchase";
    import {Head, Link} from '@inertiajs/inertia-vue3';

    export default defineComponent({

        props:
            ['categories', 'proc', 'purchases', 'purchase', 'category_id', 'delivered_purchases']
        ,

        components: {
            AppLayout,
            RegisterPurchase,
            UpdatePurchase,
            Head,
            Link
        },
        data() {
            return {}
        }
    })
</script>
