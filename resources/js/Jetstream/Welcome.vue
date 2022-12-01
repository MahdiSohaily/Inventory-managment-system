<template>
    <div class="container-fluid">
        <div class="row" v-if="position !== 'کاربر'">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">person</i>
                        </div>
                        <p class="card-category">حساب های کاربری </p>
                        <h3 class="card-title">{{ accounts}}
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-info">info</i>
                            <Link :href="route('profile.show')">لیست تمامی حساب های ایجاد شده...</Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">store</i>
                        </div>
                        <p class="card-category">گدام های راجستر شده</p>
                        <h3 class="card-title">{{ stocks }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">store</i>
                            <a :href="route('profile.show')">لیست گدام های موجود </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">mail</i>
                        </div>
                        <p class="card-category">درخواست ها </p>
                        <h3 class="card-title">{{ demands_count }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">filter_list</i>
                            <Link :href="route('demand')">لیست تمامی درخواست های صورت گرفته</Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">all_inbox</i>
                        </div>
                        <p class="card-category">اجناس قید تسلیم نشده</p>
                        <h3 class="card-title">245</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> هم‌اکنون
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">درخواست های اخیر</h4>
                        <p class="card-category">درخواست های که اخیرا ثبت سیتم گردیده اند</p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                            <th>شماره</th>
                            <th>درخواست کننده</th>
                            <th>شعبه مربوطه</th>
                            <th>جنس مورد نظر</th>
                            <th>تعداد</th>
                            <th>تاریخ</th>
                            </thead>
                            <tbody>
                            <tr v-for="item in totalDemand">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.section}}</td>
                                <td>{{ item.good_name }}</td>
                                <td>{{ item.quantity }}</td>
                                <td>{{ item.date }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="javascript:;">
                            <img class="img" src="../../../public/img/faces/avatar.jpg"/>
                        </a>
                    </div>
                    <div class="card-body">
                        <h6 class="card-category text-gray">
                            {{ $page.props.user.position}}
                            سیستم
                        </h6>
                        <h4 class="card-title">
                            {{ $page.props.user.name}} {{ $page.props.user.last_name}}
                        </h4>
                        <ul class="list-group  p-0">
                            <li class="list-group-item ">{{ $page.props.user.email }}</li>
                            <li class="list-group-item">{{ $page.props.user.boss }}</li>
                            <li class="list-group-item">{{ $page.props.user.section }}</li>
                            <li class="list-group-item">{{ $page.props.user.about }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {defineComponent} from 'vue'
    import {Head, Link} from '@inertiajs/inertia-vue3';
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'

    export default defineComponent({

        props: ['totalDemand', 'accounts', 'stocks', 'demands_count', 'position'],
        components: {
            JetApplicationLogo,
            Head,
            Link
        },
    })
</script>
