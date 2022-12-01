<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            <h5>ویرایش کتگوری اجناس</h5>
        </template>

        <template #description>
            <small> برای ویرایش نمودن کتگوری اجناس در سیستم فورم ذیل را به دقت پر نمایید.</small>
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-6">
                    <jet-label for="category" value="مسئول گدام"/>
                    <select id="category" class="form-control" data-style="btn btn-link" v-model="form.user_id">
                        <option v-for="user in users" :value="user.id" class="p-3">{{ user.name }} - {{ user.position}}
                        </option>
                    </select>
                    <jet-input-error :message="form.errors.user_id" class="mt-2 small"/>
                </div>
                <div class="col-md-6">
                    <jet-label for="cat_name" value="نام گدام"/>
                    <jet-input id="cat_name" type="text" class="mt-1 form-control" v-model="form.name"
                               autocomplete="name"/>
                    <jet-input-error :message="form.errors.name" class="mt-2"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-6">
                    <jet-label for="category_type" value="کتگوری مربوطه"/>
                    <select id="category_type" class="form-control" data-style="btn btn-link"
                            v-model="form.category_id">
                        <option v-for="category in categories" :value="category.id" class="p-3">{{ category.name }}
                        </option>
                    </select>
                    <jet-input-error :message="form.errors.user_id" class="mt-2 small"/>
                </div>
                <div class="col-md-6">
                    <jet-label for="about" value="توضیحات"/>
                    <textarea id="about" class="form-control" rows="3" v-model="form.description"></textarea>
                    <jet-input-error :message="form.errors.description" class="mt-2"/>
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

        props: ['users', 'categories','stock'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'put',
                    id: this.stock.id,
                    name: this.stock.name,
                    category_id: this.stock.category_id,
                    user_id: this.stock.user_id,
                    description: this.stock.description,
                }),
            }
        },

        methods: {
            updateProfileInformation() {
                this.form.post(route('stock.update'), {
                    preserveScroll: true,
                    onSuccess: () => {},
                });
            },

        }
    })
</script>
