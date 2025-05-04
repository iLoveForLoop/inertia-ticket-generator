<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Welcome back</h1>
            <p class="mt-2 text-slate-600">Log in to your TickIt account</p>
        </div>

        <div v-if="status"
            class="mb-6 p-4 rounded-lg bg-green-50 border border-green-100 text-green-700 text-sm font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ status }}
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-100">
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <InputLabel for="email" value="Email address"
                        class="block text-sm font-medium text-slate-700 mb-1" />

                    <TextInput id="email" type="email"
                        class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-700 focus:ring-2 focus:ring-slate-200 transition duration-200"
                        v-model="form.email" required autofocus autocomplete="username"
                        placeholder="email@example.com" />

                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors.email" />
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <InputLabel for="password" value="Password" class="block text-sm font-medium text-slate-700" />
                        <Link v-if="canResetPassword" :href="route('password.request')"
                            class="text-sm font-medium text-indigo-500 hover:text-indigo-600 transition-colors duration-200">
                        Forgot password?
                        </Link>
                    </div>

                    <TextInput id="password" type="password"
                        class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-700 focus:ring-2 focus:ring-slate-200 transition duration-200"
                        v-model="form.password" required autocomplete="current-password" placeholder="••••••••" />

                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors.password" />
                </div>

                <div class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember"
                        class="rounded border-slate-300 text-slate-700 focus:ring-slate-700 h-4 w-4" />
                    <InputLabel for="remember" class="ms-2 text-sm text-slate-600">
                        Remember me
                    </InputLabel>
                </div>

                <div>
                    <PrimaryButton
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-slate-700 to-slate-600 hover:from-slate-800 hover:to-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all duration-200"
                        :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                        Log in
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
                            Don't have an account?
                        </span>
                    </div>
                </div>

                <div class="mt-6">
                    <Link :href="route('register')"
                        class="w-full flex justify-center py-2.5 px-4 border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all duration-200">
                    Sign up for free
                    </Link>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center text-sm text-slate-500">
            <p>By continuing, you agree to our <a href="#"
                    class="font-medium text-slate-700 hover:text-indigo-500 transition-colors duration-200">Terms of
                    Service</a> and <a href="#"
                    class="font-medium text-slate-700 hover:text-indigo-500 transition-colors duration-200">Privacy
                    Policy</a>.</p>
        </div>
    </GuestLayout>
</template>
