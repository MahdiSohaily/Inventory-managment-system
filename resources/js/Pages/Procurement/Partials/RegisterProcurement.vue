<template>
    <jet-form-section @submitted="RegisterDemand">
        <template #title>
            هیئت تدارکات
        </template>

        <template #description>
            هیئت تدارکات برای خریداری های مدنظر را با ویرایش فورم ذیل راجستر نمایید.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-6 ">
                    <jet-label for="name" value="نام"/>
                    <jet-input id="name" type="text" class="mt-1 form-control" v-model="form.name"/>
                    <jet-input-error :message="form.errors.name" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <jet-label for="last_name" value="فامیلی"/>
                    <jet-input id="last_name" type="text" class="mt-1 form-control" v-model="form.last_name"/>
                    <jet-input-error :message="form.errors.last_name" class="mt-2"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-6">
                    <jet-label for="position" value="وظیفه"/>
                    <jet-input id="position" type="text" class="mt-1 form-control" v-model="form.position"/>
                    <jet-input-error :message="form.errors.position" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <jet-label for="type" value="هیئت مربوطه"/>
                    <select id="type" class="form-control" data-style="btn btn-link"
                            v-model="form.type">
                        <option v-for="item in proc" :value="item.id" class="p-3">{{ item.type}} - تاریخ انقضا ({{
                            item.end}})
                        </option>
                    </select>
                    <jet-input-error :message="form.errors.type" class="mt-2"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful">
                ثبت هیئت تدارکات موفقانه صورت گرفت.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ثبت
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

        props: ['proc'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'post',
                    name: null,
                    last_name: null,
                    position: null,
                    type: null,
                }),
            }
        },

        methods: {
            RegisterDemand() {
                this.form.post(route('procurement.create'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset('name', 'last_name', 'position', 'type');
                    },
                });
            },

        }
    })
</script>
