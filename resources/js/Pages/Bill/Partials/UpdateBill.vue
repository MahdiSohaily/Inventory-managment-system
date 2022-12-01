<template>
    <jet-form-section @submitted="RegisterBill">
        <template #title>
            ویرایش بیل خریداری
        </template>

        <template #description>
            برای ویرایش بیل خریداری فورم ذیل بروزرسانی نمایید.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-4 ">
                    <jet-label for="section" value="اسم فروشنده"/>
                    <jet-input id="section" type="text" class="mt-1 form-control" disabled="disabled"
                               v-model="form.seller"/>
                    <jet-input-error :message="form.errors.seller" class="mt-2 small"/>
                    <jet-input-error :message="form.errors.id" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="date" value="تاریخ بیل"/>
                    <jet-input id="date" type="date" class="mt-1 form-control" v-model="form.date"/>
                    <jet-input-error :message="form.errors.date" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="proc_id" value="هیئت خریداری"/>
                    <select id="proc_id" class="form-control" data-style="btn btn-link"
                            v-model="form.proc_id" required>
                        <option v-if="proc !== null && proc['length'] !==0" v-for="item in proc" :value="item.id"
                                class="p-3">{{item.type }}
                        </option>
                        <option v-else>در این کتگوری جنسی وجود ندارد</option>
                    </select>
                    <jet-input-error :message="form.errors.quantity" class="mt-2 small"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-4 ">
                    <jet-label for="good" value="جنس"/>
                    <jet-input id="good" type="text" class="mt-1 form-control" disabled="disabled"
                               v-model="form.good_name"/>
                    <jet-input-error :message="form.errors.good_name" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="quantity" value="تعداد"/>
                    <jet-input id="quantity" type="text" class="mt-1 form-control" disabled v-model="form.quantity"/>
                    <jet-input-error :message="form.errors.quantity" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="value" value="قیمت فی"/>
                    <jet-input id="value" type="number" class="mt-1 form-control" disabled v-model="form.value"/>
                    <jet-input-error :message="form.errors.value" class="mt-2 small"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <jet-label for="about" value="توضیحات"/>
                    <textarea id="about" class="form-control" rows="3" v-model="form.description"></textarea>
                    <jet-input-error :message="form.errors.description" class="mt-2"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful">
                ویرایش بیل موفقانه صورت گرفت.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ویرایش بیل
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

        props: ['bill', 'proc'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'put',
                    id: this.bill[0].id,
                    shop_id: this.bill[0].shop_id,
                    good_name: this.bill[0].good_name,
                    seller: this.bill[0].name,
                    quantity: this.bill[0].quantity,
                    value: this.bill[0].price_per,
                    proc_id: this.bill[0].proc_id,
                    date: this.bill[0].date,
                    description: this.bill[0].description,
                }),
            }
        },

        methods: {
            RegisterBill() {
                this.form.post(route('bill.update'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset('date', 'description', 'proc_id');
                        this.category_id = null;
                    },
                });
            },
        },
    })
</script>
