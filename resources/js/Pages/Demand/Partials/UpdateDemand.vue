<template>
    <jet-form-section @submitted="UpdateDemand">
        <template #title>
            ویرایش درخواست تحویلخانه
        </template>

        <template #description>
            برای ویرایش درخواست تحویلخانه درج شده فورم ذیل را به دقت پر نمایید.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-4 ">
                    <jet-label for="section" value="شعبه دخواست کننده"/>
                    <jet-input id="section" type="text" class="mt-1 form-control" disabled v-model="form.section"/>
                    <jet-input-error :message="form.errors.section" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="name" value="اسم درخواست کننده"/>
                    <jet-input id="name" type="text" class="mt-1 form-control" disabled v-model="form.name"/>
                    <jet-input-error :message="form.errors.name" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="date" value="تاریخ درخواست"/>
                    <jet-input id="date" type="date" class="mt-1 form-control" v-model="form.date"/>
                    <jet-input-error :message="form.errors.date" class="mt-2 small"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-4">
                    <jet-label for="category" value="کتگوری جنس"/>
                    <select id="category" class="form-control" data-style="btn btn-link"
                            @change="getGoods" v-model="category">
                        <option v-for="category in categories" :value="category.id" class="p-3">{{ category.name }}
                        </option>
                    </select>
                    <jet-input-error :message="form.errors.unit_id" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="good" value="جنس مورد نظر"/>
                    <select id="good" class="form-control" data-style="btn btn-link"
                            v-model="form.good_id">
                        <option v-if="goods !== null && goods['length'] !==0" v-for="good in goods" :value="good.id"
                                class="p-3">{{
                            good.name }}
                        </option>
                        <option v-else>در این کتگوری جنسی وجود ندارد</option>
                    </select>
                    <jet-input-error :message="form.errors.good_id" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="amount" value="مقدار مورد نظر"/>
                    <jet-input id="amount" type="number" min="1" class="mt-1 form-control" v-model="form.quantity"/>
                    <jet-input-error :message="form.errors.quantity" class="mt-2 small"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <jet-label value="توضیحات درخواست"/>
                        <div class="form-group bmd-form-group">
                            <textarea id="about" class="form-control" rows="3" v-model="form.description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful">
                ویرایش درخواست موفقانه صورت گرفت.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ویرایش درخواست
            </button>
        </template>
    </jet-form-section>
</template>
<script>
    import {defineComponent} from 'vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        props: ['categories', 'demand', 'category_id','user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'put',
                    id: this.demand.id,
                    section: this.user.section,
                    name: this.user.name,
                    date: this.demand.date,
                    good_id: this.demand.good_id,
                    quantity: this.demand.quantity,
                    description: this.demand.description,
                    status: this.demand.status
                }),
                goods: null,
                category: this.category_id [0].category_id
            }
        },

        methods: {
            UpdateDemand() {
                this.form.post(route('demand.update'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        // this.form.reset('section', 'name', 'date', 'good_id', 'quantity', 'description')
                    },
                });
            },
            getGoods() {
                axios.get(route('goods.get', this.category)).then((response) => {
                        this.goods = (response['data']);
                    }
                )
            },
        },
        created() {
            this.getGoods()
        }
    })
</script>
