<template>
    <jet-form-section @submitted="RegisterUnit">
        <template #title>
            <h5>درج واحد قیاس اجناس</h5>
        </template>

        <template #description>
            <small> برای درج نمودن واحد اجناس در سیستم فورم ذیل را به دقت پر نمایید.</small>
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-12 ">
                    <jet-label for="unit_name" value="نام واحد"/>
                    <jet-input id="unit_name" type="text" class="mt-1 form-control" v-model="form.unit_name" autocomplete="name"/>
                    <jet-input-error :message="form.errors.unit_name" class="mt-2"/>
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

        props: [''],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'post',
                    name: null,
                    unit_name: null,
                }),
            }
        },

        methods: {
            RegisterUnit() {
                this.form.post(route('Unit.create'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset('unit_name')
                    },
                });
            },

        }
    })
</script>
