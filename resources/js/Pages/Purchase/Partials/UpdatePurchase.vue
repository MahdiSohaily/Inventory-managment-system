<template>
    <jet-form-section @submitted="UpdatePurchase">
        <template #title>
            ویرایش درخواست امر خریداری
        </template>

        <template #description>
            برای ویرایش درخواست امر خریداری فورم ذیل را به دقت پر نمایید.
        </template>

        <template #form>
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
                    <jet-input id="price_one" required type="number" class="mt-1 form-control"
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

        props: ['categories', 'proc', 'purchase', 'category_id'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'put',
                    id: this.purchase[0].id,
                    seller_one: this.purchase[0].name,
                    seller_two: this.purchase[1].name,
                    seller_three: this.purchase[2].name,
                    shop_one: this.purchase[0].shop_id,
                    shop_two: this.purchase[1].shop_id,
                    shop_three: this.purchase[2].shop_id,
                    price_one: this.purchase[0].price_per,
                    price_two: this.purchase[1].price_per,
                    price_three: this.purchase[2].price_per,
                    good_id: this.purchase[0].good_id,
                    quantity: this.purchase[0].quantity,
                    date: this.purchase[0].date,
                    proc_id: this.purchase[0].proc_id,
                    status: this.purchase[0].status,
                    description: this.purchase[0].description,
                    sokok: this.purchase[0].sokok,
                    tax: this.purchase[0].tax,
                    taminat: this.purchase[0].taminat,
                    kasrat: this.purchase[0].kasrat,
                    payment: this.purchase[0].payment,
                    prepared: this.purchase[0].prepared,
                    manzori: this.purchase[0].manzori,
                    amer: this.purchase[0].amer,
                    boss: this.purchase[0].boss,
                }),
                goods: null,
                category: this.category_id [0].category_id
            }
        },

        methods: {
            UpdatePurchase() {
                this.form.post(route('purchase.update'), {
                    preserveScroll: true,
                    onSuccess: () => {
                    },
                });
            },
            getGoods() {
                axios.get(route('goods.get', this.category_id [0].category_id)).then((response) => {
                        this.goods = (response['data']);
                    }
                )
            }
        },
        created() {
            this.getGoods()
        }
    })
</script>
