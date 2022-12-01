<template>
    <jet-form-section @submitted="RegisterGood">
        <template #title>
            <h5> مشخصات جنس مورد نظر</h5>
        </template>

        <template #description>
            <small> برای درج نمودن جنس در سیستم فورم ذیل را به دقت پر نمایید.</small>
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-12 ">
                    <jet-label for="name" value="نام جنس"/>
                    <jet-input id="name" type="text" class="mt-1 form-control" v-model="form.name" autocomplete="name"/>
                    <jet-input-error :message="form.errors.name" class="mt-2"/>
                </div>
                <div class="col-md-12">
                    <jet-label for="category" value="کتگوری مربوطه"/>
                    <select id="category" class="form-control" v-model="form.category_id">
                        <option v-for="category in categories" :value="category.id" class="p-3">{{ category.name }}
                        </option>
                    </select>
                    <jet-input-error :message="form.errors.category_id" class="mt-2"/>
                </div>
                <div class="col-md-12">
                    <jet-label for="unit" value="واحد مربوطه"/>
                    <select id="unit" class="form-control" data-style="btn btn-link"
                            v-model="form.unit_id">
                        <option v-for="unit in units" :value="unit.id" class="p-3">{{ unit.name }}</option>
                    </select>
                    <jet-input-error :message="form.errors.unit_id" class="mt-2"/>
                </div>
            </div>
            <div class="row pb-2 border-danger">
                <div class="col-md-12">
                    <jet-label for="about" value="مشخصات جنس"/>
                    <textarea id="about" class="form-control" rows="3" v-model="form.properties"></textarea>
                    <jet-input-error :message="form.errors.properties" class="mt-2"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful">
                ذخیره سازی جنس مورد نظر موفقانه صورت گرفت.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ایجاد
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

        props: ['categories', 'unites'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'post',
                    name: null,
                    category_id: null,
                    unit_id: null,
                    properties: null
                }),
                categories: this.categories,
                units: this.unites,
            }
        },

        methods: {
            RegisterGood() {
                this.form.post(route('good.create'), {
                    errorBag: 'goods',
                    preserveScroll: true,
                    onSuccess: () => {
                    },
                });
            },
        },
    })
</script>
