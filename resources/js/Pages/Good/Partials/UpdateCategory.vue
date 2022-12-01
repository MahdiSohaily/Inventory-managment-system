<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            <h5>درج کتگوری اجناس</h5>
        </template>

        <template #description>
            <small> برای درج نمودن کتگوری اجناس در سیستم فورم ذیل را به دقت پر نمایید.</small>
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-12 ">
                    <jet-label for="cat_name" value="نام کتگوری"/>
                    <jet-input id="cat_name" type="text" class="mt-1 form-control" v-model="form.cat_name"
                               autocomplete="name"/>
                    <jet-input-error :message="form.errors.cat_name" class="mt-2"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful">
                ویرایش موفقانه صورت گرفت.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ویرایش
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

        props: ['category'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'put',
                    id: this.category.id,
                    cat_name: this.category.name,
                }),
            }
        },

        methods: {
            updateProfileInformation() {
                this.form.post(route('category.update'), {
                    preserveScroll: true,
                    onSuccess: () => {
                    },
                });
            },

        }
    })
</script>
