<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            <h5>ثبت تکت توزیع تحویلخانه</h5>
        </template>

        <template #description>
            <small> برای ثبت تکت توزیع تحویلخانه در سیستم فورم ذیل را به دقت پر نمایید.</small>
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-6 ">
                    <jet-label for="user_name" value="درخواست کننده"/>
                    <jet-input id="user_name" type="text" class="mt-1 form-control" v-model="form.user_name"
                               disabled autocomplete="name"/>
                    <jet-input-error :message="form.errors.user_name" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <jet-label for="good" value="جنس مورد نظر"/>
                    <jet-input id="good" type="text" class="mt-1 form-control" v-model="form.good"
                               disabled autocomplete="name"/>
                    <jet-input-error :message="form.errors.good" class="mt-2"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-6 ">
                    <jet-label for="quantity" value="مقدار مورد نظر"/>
                    <jet-input id="quantity" type="text" class="mt-1 form-control" v-model="form.quantity"
                               disabled autocomplete="name"/>
                    <jet-input-error :message="form.errors.quantity" class="mt-2"/>
                </div>
                <div class="col-md-6 ">
                    <jet-label for="year" value="سال مالی"/>
                    <jet-input id="year" type="text" class="mt-1 form-control" v-model="form.year"
                               autocomplete="name"/>
                    <jet-input-error :message="form.errors.year" class="mt-2"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful">
                ذخیره سازی موفقانه صورت گرفت.
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

        props: ['demand'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'post',
                    id: this.demand.id,
                    good: this.demand.name,
                    quantity: this.demand.quantity,
                    description: this.demand.description,
                    name: this.demand.name,
                    user_name: this.demand.user_name,
                    user_id: this.demand.user_id,
                    year:null
                }),
            }
        },

        methods: {
            updateProfileInformation() {
                this.form.post(route('distribute.create'), {

                });
            },

        }
    })
</script>
