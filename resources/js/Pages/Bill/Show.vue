<template>
    <app-layout title="بیل خریداری" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                            <i class="material-icons">fact_check</i>ثبت بیل خریداری
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#goodsList" data-toggle="tab">
                                            <i class="material-icons">list</i>لیست بیل های خریداری
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
                                        <RegisterBill v-if="purchase" :purchase="purchase" :proc="proc"/>
                                        <div class="alert alert-info" v-else>
                                            برای ثبت نمودن بیل خریداری باید اول به لیست
                                            خریداری ها مراجعه نموده
                                            سپس بروی گزینه ثبت بیل در خریداری مورد نظر خود کلیک نمایید
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="goodsList">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header card-header-primary">
                                                <h4 class="card-title">
                                                    <small>
                                                        لیست بیل های خریداری ثبت نشده در گدام
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
                                                    <tr v-for="item in bills">
                                                        <td>{{ item.id }}</td>
                                                        <td>{{ item.good_name }}</td>
                                                        <td>{{ item.quantity }}</td>
                                                        <td>{{ item.price_per }}</td>
                                                        <td>{{ item.total }}</td>
                                                        <td>{{ item.date }}</td>
                                                        <td class="col-3">{{ item.description }}</td>
                                                        <td class="td-actions">
                                                            <Link :href="route('bill.edit',item)"
                                                                  rel="tooltip" title=""
                                                                  class="btn btn-primary btn-link btn-sm"
                                                                  data-original-title="ویرایش" data-toggle="modal"
                                                                  data-target="#myModal">
                                                                <i class="material-icons">edit</i>
                                                            </Link>
                                                            <i @click="removeItem(item.id)"
                                                               rel="tooltip" title=""
                                                               class="btn btn-danger btn-link btn-sm"
                                                               data-original-title="حذف" data-toggle="modal"
                                                               data-target="#myModal">
                                                                <i class="material-icons">close</i>
                                                            </i>
                                                            <Link :href="route('arrival',item.id)" rel="tooltip" title=""
                                                                  class="btn btn-info btn-sm"
                                                                  data-original-title="" data-toggle="modal"
                                                                  data-target="#myModal">
                                                                <small>ثبت جنس در گدام</small>
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
                                                        لیست بیل های خریداری ثبت شده درگدام
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
                                                    <tr v-for="item in unbills">
                                                        <td>{{ item.id }}</td>
                                                        <td>{{ item.good_name }}</td>
                                                        <td>{{ item.quantity }}</td>
                                                        <td>{{ item.price_per }}</td>
                                                        <td>{{ item.total }}</td>
                                                        <td>{{ item.date }}</td>
                                                        <td class="col-3">{{ item.description }}</td>
                                                        <td class="td-actions">
                                                            <Link :href="route('bill.edit',item)"
                                                                  rel="tooltip" title=""
                                                                  class="btn btn-primary btn-link btn-sm"
                                                                  data-original-title="ویرایش" data-toggle="modal"
                                                                  data-target="#myModal">
                                                                <i class="material-icons">edit</i>
                                                            </Link>
                                                            <i @click="removeItem(item.id)"
                                                               rel="tooltip" title=""
                                                               class="btn btn-danger btn-link btn-sm"
                                                               data-original-title="حذف" data-toggle="modal"
                                                               data-target="#myModal">
                                                                <i class="material-icons">close</i>
                                                            </i>
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
    import AppLayout from '@/Layouts/AppLayout.vue';
    import RegisterBill from "@/Pages/Bill/Partials/RegisterBill";
    import {Head, Link} from '@inertiajs/inertia-vue3';

    export default defineComponent({

        props:
            ['purchase', 'proc', 'bills','unbills']
        ,

        components: {
            AppLayout,
            RegisterBill,
            Head,
            Link
        },
        data() {
            return {}
        },
        methods: {
            removeItem(id) {
                axios.get(route('bills.get', id)).then((response) => {
                        alert("ریکارد مورد نظر موفقانه حذف شد.");
                        location.reload();
                    }
                )
            }
        }
    })
</script>
