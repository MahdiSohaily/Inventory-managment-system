<template>
    <app-layout title="لیست هیئت تدارکات" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <Link class="nav-link" :href="route('procurement')" data-toggle="tab">
                                            <i class="material-icons">add_reaction</i>راجستر نمودن اعضای هیئت تدارکات
                                            <div class="ripple-container"></div>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <Link class="nav-link" :href="route('procurement')" data-toggle="tab">
                                            <i class="material-icons">add_reaction</i>راجستر نمودن هیئت تدارکات
                                            <div class="ripple-container"></div>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#procList" data-toggle="tab">
                                            <i class="material-icons">groups</i> لیست هیئت های راجستر شده
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#memberList" data-toggle="tab">
                                            <i class="material-icons">groups</i> لیست اعضایی هیئت های راجستر شده
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane " id="proc">
                                <div class="row">
                                    <div class="col-md-12">
                                        <RegisterProc/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="proc_members">
                                <div class="row">
                                    <div class="col-md-12">
                                        <UpdateProcurement :proc="proc" :person="person"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="procList">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header card-header-primary">
                                                <h4 class="card-title">لیست اعضای هیئت خریداری</h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-primary">
                                                    <th>شماره</th>
                                                    <th>اسم</th>
                                                    <th>فامیلی</th>
                                                    <th>وظیفه</th>
                                                    <th>هیئت مربوطه</th>
                                                    <th>تاریخ شروع</th>
                                                    <th>تاریخ ختم</th>
                                                    <th>عملیات</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="purchase in purchases">
                                                        <td>{{ purchase.id }}</td>
                                                        <td>{{ purchase.name }}</td>
                                                        <td>{{ purchase.last_name }}</td>
                                                        <td>{{ purchase.position }}</td>
                                                        <td>{{ purchase.type }}</td>
                                                        <td>{{ purchase.start }}</td>
                                                        <td>{{ purchase.end }}</td>
                                                        <td class="td-actions text-right">
                                                            <Link :href="route('procurement',purchase)" title=""
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header card-header-primary">
                                                <h4 class="card-title">لیست اعضای هیئت معاینه</h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-primary">
                                                    <th>شماره</th>
                                                    <th>اسم</th>
                                                    <th>فامیلی</th>
                                                    <th>وظیفه</th>
                                                    <th>هیئت مربوطه</th>
                                                    <th>تاریخ شروع</th>
                                                    <th>تاریخ ختم</th>
                                                    <th>عملیات</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="check in checks">
                                                        <td>{{ check.id }}</td>
                                                        <td>{{ check.name }}</td>
                                                        <td>{{ check.last_name }}</td>
                                                        <td>{{ check.position }}</td>
                                                        <td>{{ check.type }}</td>
                                                        <td>{{ check.start }}</td>
                                                        <td>{{ check.end }}</td>
                                                        <td class="td-actions text-right">
                                                            <Link :href="route('procurement',check)" title=""
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
                            <div class="tab-pane" id="memberList">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header card-header-primary">
                                                <h4 class="card-title">لیست اعضای هیئت خریداری</h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-primary">
                                                    <th>شماره</th>
                                                    <th>اسم</th>
                                                    <th>فامیلی</th>
                                                    <th>وظیفه</th>
                                                    <th>هیئت مربوطه</th>
                                                    <th>عملیات</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="purchase in purchases">
                                                        <td>{{ purchase.id }}</td>
                                                        <td>{{ purchase.name }}</td>
                                                        <td>{{ purchase.last_name }}</td>
                                                        <td>{{ purchase.position }}</td>
                                                        <td>{{ purchase.type }}</td>
                                                        <td class="td-actions text-right">
                                                            <Link :href="route('procurement',purchase)" title=""
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header card-header-primary">
                                                <h4 class="card-title">لیست اعضای هیئت معاینه</h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-primary">
                                                    <th>شماره</th>
                                                    <th>اسم</th>
                                                    <th>فامیلی</th>
                                                    <th>وظیفه</th>
                                                    <th>هیئت مربوطه</th>
                                                    <th>عملیات</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="check in checks">
                                                        <td>{{ check.id }}</td>
                                                        <td>{{ check.name }}</td>
                                                        <td>{{ check.last_name }}</td>
                                                        <td>{{ check.position }}</td>
                                                        <td>{{ check.type }}</td>
                                                        <td class="td-actions text-right">
                                                            <Link :href="route('procurement',check)" title=""
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
            </div>
        </div>
    </app-layout>
</template>
<script>
    import {defineComponent} from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue';
    import UpdateProcurement from "@/Pages/Procurement/Partials/UpdateProcurement";
    import RegisterProc from "@/Pages/Procurement/Partials/RegisterProc";
    import UpdateProc from "@/Pages/Procurement/Partials/UpdateProc";
    import {Head, Link} from '@inertiajs/inertia-vue3';

    export default defineComponent({

        props:
            ['sessions', 'purchases', 'checks', 'proc', 'person']
        ,

        components: {
            AppLayout,
            UpdateProcurement,
            RegisterProc,
            UpdateProc,
            Head,
            Link
        },
    })
</script>
