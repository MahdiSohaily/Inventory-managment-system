<template>
    <jet-form-section @submitted="RegisterProc">
        <template #title>
            هیئت تدارکات
        </template>

        <template #description>
            هیئت تدارکات برای خریداری های مدنظر را با ویرایش فورم ذیل راجستر نمایید.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-4">
                    <jet-label for="type" value="  نوعیت هیئت"/>
                    <select id="type" class="form-control" data-style="btn btn-link"
                            v-model="form.type">
                        <option value="خریداری" class="p-3">خریداری</option>
                        <option value="معاینه" class="p-3">معاینه</option>
                    </select>
                    <jet-input-error :message="form.errors.type" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="start" value="تاریخ آغاز فعالیت"/>
                    <jet-input id="start" type="date" class="mt-1 form-control" v-model="form.start"/>
                    <jet-input-error :message="form.errors.start" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="end" value="تاریخ ختم فعالیت"/>
                    <jet-input id="end" type="date" class="mt-1 form-control" v-model="form.end"/>
                    <jet-input-error :message="form.errors.end" class="mt-2"/>
                </div>
            </div>
            <div class="row text-center">
                <p class="text-center">
                    <jet-input-error :message="form.errors.create" class="mt-2"/>
                </p>
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

        props: ['updateProc'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'put',
                    id: this.updateProc.id,
                    type: this.updateProc.type,
                    start: this.updateProc.start,
                    end: this.updateProc.end
                }),
            }
        },

        methods: {
            RegisterProc() {
                this.form.post(route('proc.update'), {
                    preserveScroll: true,
                    onSuccess: () => {
                    },
                });
            },

        }
    })
</script>
