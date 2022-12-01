<template>
    <jet-form-section @submitted="RegisterDemand">
        <template #title>
            ثبت درخواست تحویلخانه
        </template>

        <template #description>
            برای ثبت درخواست تحویلخانه فورم ذیل را به دقت پر نمایید.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-4 ">
                    <jet-label for="section" value="شعبه دخواست کننده"/>
                    <jet-input id="section" type="text" class="mt-1 form-control" disabled="disabled"
                               v-model="form.section"/>
                    <jet-input-error :message="form.errors.section" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="name" value="اسم درخواست کننده"/>
                    <jet-input id="name" type="text" class="mt-1 form-control" disabled="disabled" v-model="form.name"/>
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
                            @change="getGoods" v-model="category_id">
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
                ثبت درخواست موفقانه صورت گرفت.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ثبت درخواست
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

        props: ['categories', 'user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'post',
                    section: this.user.section,
                    name: this.user.name,
                    date: null,
                    good_id: null,
                    quantity: null,
                    description: null
                }),
                goods: null,
                category_id: null,
            }
        },

        methods: {
            RegisterDemand() {
                this.form.post(route('demand.create'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset('section', 'name', 'date', 'good_id', 'quantity', 'description');
                        this.category_id = null;
                    },
                });
            },
            UpdateDemand() {
                alert("Updated")
            },
            getGoods() {
                axios.get(route('goods.get', this.category_id)).then((response) => {
                        this.goods = (response['data']);
                    }
                )
            }
        },
    })
</script>
