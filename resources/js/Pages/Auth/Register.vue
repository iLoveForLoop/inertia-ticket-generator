<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Create your account</h1>
            <p class="mt-2 text-slate-600">Join TickIt to start managing your events</p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-100">
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <InputLabel for="name" value="Full name" class="block text-sm font-medium text-slate-700 mb-1" />

                    <TextInput id="name" type="text"
                        class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-700 focus:ring-2 focus:ring-slate-200 transition duration-200"
                        v-model="form.name" required autofocus autocomplete="name" placeholder="John Doe" />

                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="email" value="Email address"
                        class="block text-sm font-medium text-slate-700 mb-1" />

                    <TextInput id="email" type="email"
                        class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-700 focus:ring-2 focus:ring-slate-200 transition duration-200"
                        v-model="form.email" required autocomplete="email" placeholder="you@example.com" />

                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="password" value="Password" class="block text-sm font-medium text-slate-700 mb-1" />

                    <TextInput id="password" type="password"
                        class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-700 focus:ring-2 focus:ring-slate-200 transition duration-200"
                        v-model="form.password" required autocomplete="new-password" placeholder="••••••••" />

                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel for="password_confirmation" value="Confirm password"
                        class="block text-sm font-medium text-slate-700 mb-1" />

                    <TextInput id="password_confirmation" type="password"
                        class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-700 focus:ring-2 focus:ring-slate-200 transition duration-200"
                        v-model="form.password_confirmation" required autocomplete="new-password"
                        placeholder="••••••••" />

                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors.password_confirmation" />
                </div>

                <div>
                    <PrimaryButton
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-slate-700 to-slate-600 hover:from-slate-800 hover:to-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all duration-200"
                        :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                        Create account
                    </PrimaryButton>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-slate-500">
                            Already have an account?
                        </span>
                    </div>
                </div>

                <div class="mt-6">
                    <Link :href="route('login')"
                        class="w-full flex justify-center py-2.5 px-4 border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all duration-200">
                    Log in instead
                    </Link>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center text-sm text-slate-500">
            <p>By registering, you agree to our <a href="#"
                    class="font-medium text-slate-700 hover:text-indigo-500 transition-colors duration-200">Terms of
                    Service</a> and <a href="#"
                    class="font-medium text-slate-700 hover:text-indigo-500 transition-colors duration-200">Privacy
                    Policy</a>.</p>
        </div>
    </GuestLayout>
</template>
