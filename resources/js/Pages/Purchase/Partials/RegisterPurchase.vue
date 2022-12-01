<template>
    <jet-form-section @submitted="RegisterDemand">
        <template #title>
            ثبت درخواست امر خریداری
        </template>

        <template #description>
            برای ثبت درخواست امر خریداری فورم ذیل را به دقت پر نمایید.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-4">
                    <jet-label for="category" value="کتگوری جنس"/>
                    <select id="category" class="form-control" data-style="btn btn-link"
                            @change="getGoods" v-model="category_id" required>
                        <option v-for="category in categories" :value="category.id" class="p-3">{{ category.name }}
                        </option>
                    </select>
                    <jet-input-error :message="form.errors.unit_id" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="good" value="جنس مورد نظر"/>
                    <select id="good" class="form-control" data-style="btn btn-link"
                            v-model="form.good_id" required>
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
                    <jet-input id="amount" type="number" min="1" class="mt-1 form-control" required
                               v-model="form.quantity"/>
                    <jet-input-error :message="form.errors.quantity" class="mt-2 small"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-3">
                    <jet-label for="seller_one" value="فروشنده اول"></jet-label>
                    <jet-input id="seller_one" type="text" class="mt-1 form-control" required
                               v-model="form.seller_one"/>
                    <jet-input-error :message="form.errors.seller_one" class="mt-2 small"/>
                </div>
                <div class="col-md-1">
                    <jet-label for="price_one" value="قیمت فی"></jet-label>
                    <jet-input id="price_one" required type="number"  class="mt-1 form-control"
                               v-model="form.price_one"/>
                    <jet-input-error :message="form.errors.price_one" class="mt-2 small"/>
                </div>
                <div class="col-md-3">
                    <jet-label for="seller_two" value="فروشنده دوم"></jet-label>
                    <jet-input id="seller_two" required type="text" class="mt-1 form-control"
                               v-model="form.seller_two"/>
                    <jet-input-error :message="form.errors.seller_two" class="mt-2 small"/>
                </div>
                <div class="col-md-1">
                    <jet-label for="price_two" value="قیمت فی"></jet-label>
                    <jet-input id="price_two" required type="number" min="0" class="mt-1 form-control"
                               v-model="form.price_two"/>
                    <jet-input-error :message="form.errors.price_two" class="mt-2 small"/>
                </div>
                <div class="col-md-3">
                    <jet-label for="seller_three" value="فروشنده سوم"></jet-label>
                    <jet-input id="seller_three" required type="text" class="mt-1 form-control"
                               v-model="form.seller_three"/>
                    <jet-input-error :message="form.errors.seller_three" class="mt-2 small"/>
                </div>
                <div class="col-md-1">
                    <jet-label for="price_three" value="قیمت فی"></jet-label>
                    <jet-input id="price_three" required type="number" min="0" class="mt-1 form-control"
                               v-model="form.price_three"/>
                    <jet-input-error :message="form.errors.price_three" class="mt-2 small"/>
                </div>
            </div>
            <div class="row pb-5">
                <div class="col-md-4">
                    <jet-label for="prepared" value="ترتیب کننده"/>
                    <jet-input id="prepared" required type="text" class="mt-1 form-control" v-model="form.prepared"/>
                    <jet-input-error :message="form.errors.prepared" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="manzori" value="تاریخ منظوری"/>
                    <jet-input id="manzori" required type="date" class="mt-1 form-control" v-model="form.manzori"/>
                    <jet-input-error :message="form.errors.manzori" class="mt-2 small"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="date" value="تاریخ صدور"></jet-label>
                    <jet-input id="date" required type="date" class="mt-1 form-control" v-model="form.date"/>
                    <jet-input-error :message="form.errors.date" class="mt-2 small"/>
                </div>
            </div>
            <div class="alert mb-5 alert-info">
                <span class="text-center">سایر توضیحات مالی خریداری</span>
            </div>
            <div class="row pb-2">
                <div class="col-md-3">
                    <jet-label for="sokok" value="سکوک"/>
                    <jet-input required id="sokok" type="number" min="0" class="mt-1 form-control"
                               v-model="form.sokok"/>
                    <jet-input-error :message="form.errors.sokok" class="mt-2 small"/>
                </div>
                <div class="col-md-3">
                    <jet-label for="tax" value="مالیه"/>
                    <jet-input id="tax" required type="number" min="0" class="mt-1 form-control" v-model="form.tax"/>
                    <jet-input-error :message="form.errors.tax" class="mt-2 small"/>
                </div>
                <div class="col-md-3">
                    <jet-label for="kasrat" value="سایر کسرات"/>
                    <jet-input required id="kasrat" type="number" min="0" class="mt-1 form-control"
                               v-model="form.kasrat"/>
                    <jet-input-error :message="form.errors.kasrat" class="mt-2 small"/>
                </div>
                <div class="col-md-3">
                    <jet-label for="payment" value="مبلغ قابل تادیه"/>
                    <jet-input required id="payment" type="number" min="0" class="mt-1 form-control"
                               v-model="form.payment"/>
                    <jet-input-error :message="form.errors.payment" class="mt-2 small"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
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
                <div class="col-md-3">
                    <jet-label for="boss" value="ٰرئیس تهیه"/>
                    <jet-input required id="boss" type="text" min="1" class="mt-1 form-control"
                               v-model="form.boss"/>
                    <jet-input-error :message="form.errors.boss" class="mt-2 small"/>
                </div>
                <div class="col-md-3">
                    <jet-label for="amer" value="آمر خریداری"/>
                    <jet-input required id="amer" type="text" min="1" class="mt-1 form-control"
                               v-model="form.amer"/>
                    <jet-input-error :message="form.errors.amer" class="mt-2 small"/>
                </div>
                <div class="col-md-3">
                    <jet-label for="category" value="حالت خریدی"/>
                    <select id="status" class="form-control" data-style="btn btn-link" v-model="form.status" required>
                        <option value="0" class="p-3">خریداری</option>
                        <option value="1" class="p-3">اعطا ف س ۵</option>
                    </select>
                    <jet-input-error :message="form.errors.unit_id" class="mt-2 small"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-12">
                    <jet-label for="about" value="شرح راجع به مدیریت کنترول"/>
                    <textarea id="about" class="form-control" rows="3" v-model="form.description"></textarea>
                    <jet-input-error :message="form.errors.description" class="mt-2"/>
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

        props: ['categories', 'proc'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'post',
                    seller_one: null,
                    seller_two: null,
                    seller_three: null,
                    price_one: null,
                    price_two: null,
                    price_three: null,
                    good_id: null,
                    quantity: null,
                    date: null,
                    proc_id: null,
                    status: 0,
                    description: null,
                    sokok: 0,
                    tax: 0,
                    taminat: 0,
                    kasrat: 0,
                    payment: null,
                    prepared: null,
                    manzori: null,
                    amer: null,
                    boss: null,
                }),
                goods: null,
                category_id: null,
            }
        },

        methods: {
            RegisterDemand() {
                this.form.post(route('purchase.create'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset('seller_one', 'seller_two', 'seller_three', 'price_one', 'price_two', 'price_three',
                        'good_id','quantity','date','proc_id','status','description','sokok','tax','taminat','kasrat',
                        'payment','prepared','manzori','amer','boss');
                        this.category_id = null;
                    },
                });
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
