<template>
    <jet-form-section @submitted="updateProfile">
        <template #title>
            مشخصات پروفایل کاربری شما
        </template>

        <template #description>
            معلومات شخصی پروفایل کاربری خویش را با ویرایش فورم ذیل بروزرسانی نمایید.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-4 ">
                    <jet-label for="name" value="اسم"/>
                    <jet-input id="name" type="text" class="mt-1 form-control" v-model="form.name" autocomplete="name"/>
                    <jet-input-error :message="form.errors.name" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="last_name" value="فامیلی"/>
                    <jet-input id="last_name" type="text" class="mt-1 form-control" v-model="form.last_name"
                               autocomplete="last_name"/>
                    <jet-input-error :message="form.errors.last_name" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="position" value="نوعیت حساب کاریری"/>
                    <jet-input id="position" type="text" class="mt-1 form-control" v-model="form.position"
                               autocomplete="position"/>
                    <jet-input-error :message="form.errors.position" class="mt-2"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-4">
                    <jet-label for="boss" value="ریاست"/>
                    <jet-input id="boss" type="text" class="mt-1 form-control" v-model="form.boss"
                               autocomplete="boss"/>
                    <jet-input-error :message="form.errors.boss" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="section" value="آمریت"/>
                    <jet-input id="section" type="text" class="mt-1 form-control" v-model="form.section"
                               autocomplete="section"/>
                    <jet-input-error :message="form.errors.section" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="email" value="ایمیل آدرس"/>
                    <jet-input id="email" type="text" class="mt-1 form-control" v-model="form.email"
                               autocomplete="section"/>
                    <jet-input-error :message="form.errors.email" class="mt-2"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <jet-label for="about" value="درباره من"/>
                    <textarea id="about" class="form-control" rows="3" v-model="form.about"></textarea>
                    <jet-input-error :message="form.errors.about" class="mt-2"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful">
                ویراش موفقانه صورت گرفت.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ویرایش پروفایل
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

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    form: 'update',
                    id: this.user.id,
                    name: this.user.name,
                    last_name: this.user.last_name,
                    position: this.user.position,
                    boss: this.user.boss,
                    section: this.user.section,
                    email: this.user.email,
                    about: this.user.about,
                }),
            }
        },

        methods: {
            updateProfile() {
                this.form.post(route('profile.update'), {
                    preserveScroll: true,
                    onSuccess: () => {

                    },
                });
            },

        }
    })
</script>
