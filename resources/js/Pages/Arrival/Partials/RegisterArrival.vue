<template>
    <jet-form-section @submitted="RegisterBill">
        <template #title>
            ثبت راپور رسیدات اجناس
        </template>

        <template #description>
            برای ثبت راپور رسیدات اجناس فورم ذیل بروزرسانی نمایید.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-4 ">
                    <jet-label for="section" value="جنس"/>
                    <jet-input id="section" type="text" class="mt-1 form-control" disabled="disabled"
                               v-model="form.good_name"/>
                    <jet-input-error :message="form.errors.id" class="mt-2 small"/>
                    <jet-input-error :message="form.errors.good_name" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="quantity" value="تعداد"/>
                    <jet-input id="quantity" type="number" class="mt-1 form-control" v-model="form.quantity" disabled/>
                    <jet-input-error :message="form.errors.quantity" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="stock_id" value="هویت تسلیم گیرنده"/>
                    <select id="stock_id" class="form-control" data-style="btn btn-link"
                            v-model="form.stock_id" required>
                        <option v-if="stocks !== null && stocks['length'] !==0" v-for="item in stocks" :value="item.id"
                                class="p-3">
                            {{ item.user_name}} {{ item.last_name}} ({{item.name }})
                        </option>
                        <option v-else>در این کتگوری جنسی وجود ندارد</option>
                    </select>
                    <jet-input-error :message="form.errors.stock_id" class="mt-2 small"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-4 ">
                    <jet-label for="date" value="تاریخ"/>
                    <jet-input id="date" type="date" class="mt-1 form-control"
                               v-model="form.date"/>
                    <jet-input-error :message="form.errors.date" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="model_number" value="مدل نمبر"/>
                    <jet-input id="model_number" type="text" class="mt-1 form-control" v-model="form.model_number"/>
                    <jet-input-error :message="form.errors.model_number" class="mt-2 small"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful">
                ثبت راپور رسیدات اجناس موفقانه صورت گرفت.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ثبت راپور رسیدات اجناس
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

        props: ['stocks', 'item'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'post',
                    id: this.item.id,
                    bill_id: this.item.bill_id,
                    good_id: this.item.good_id,
                    good_name: this.item.name,
                    quantity: this.item.quantity,
                    stock_id: null,
                    date: null,
                    model_number: null
                }),
            }
        },

        methods: {
            RegisterBill() {
                this.form.post(route('arrival.create'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset('date', 'model_number', 'stock_id');
                        this.category_id = null;
                    },
                });
            },
        },
    })
</script>
