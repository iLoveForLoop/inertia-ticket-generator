<script setup>
import { ref } from 'vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { ChevronDownIcon, PlusCircleIcon, CalendarDaysIcon, QrCodeIcon, HomeIcon } from '@heroicons/vue/20/solid';

import NewNavLink from '@/Components/NewNavLink.vue';
import { Link } from '@inertiajs/vue3';

const mobileMenuOpen = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gray-500 flex overflow-hidden max-h-screen">
        <!-- Sidebar Navigation -->
        <div class="hidden md:flex md:flex-shrink-0 max-h-screen ">
            <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
                <!-- Logo/Brand -->
                <div class="flex items-center h-16 px-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">TickIt</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex-1 flex flex-col overflow-y-auto">
                    <nav class="flex-1 px-2 py-4 space-y-1">
                        <NewNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <template #icon>
                                <HomeIcon />
                            </template>
                            Dashboard
                        </NewNavLink>

                        <NewNavLink :href="route('events.create')" :active="route().current('events.create')">
                            <template #icon>
                                <PlusCircleIcon />
                            </template>
                            Create Events & Tickets
                        </NewNavLink>

                        <NewNavLink :href="route('events.index')" :active="route().current('events.index')">
                            <template #icon>
                                <CalendarDaysIcon />
                            </template>
                            Events
                        </NewNavLink>

                        <NewNavLink :href="route('scan-event')" :active="route().current('scan-event')">
                            <template #icon>
                                <QrCodeIcon />
                            </template>
                            Verify Tickets
                        </NewNavLink>
                    </nav>

                    <!-- User Profile Section -->
                    <div class="px-4 py-4 border-t border-gray-200">
                        <div class="flex items-center">
                            <!-- <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" :src="$page.props.auth.user.profile_photo_url"
                                    :alt="$page.props.auth.user.name" />
                            </div> -->
                            <div class="ml-3 bg-black">
                                <p class="text-sm font-medium text-gray-700">{{ $page.props.auth.user.name }}</p>
                                <Link class="text-xs font-medium text-indigo-600 hover:text-indigo-500">View
                                profile</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu button (hidden on desktop) -->
        <div class="md:hidden">
            <button type="button"
                class="fixed z-10 ml-4 mt-4 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                @click="mobileMenuOpen = !mobileMenuOpen">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile sidebar (hidden on desktop) -->
        <div class="md:hidden fixed inset-0 z-20" v-show="mobileMenuOpen" @click="mobileMenuOpen = false">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
            <div class="relative flex flex-col w-80 max-w-xs bg-white">
                <div class="flex items-center h-16 px-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">TickIt</span>
                    </div>
                    <button type="button"
                        class="ml-auto p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        @click="mobileMenuOpen = false">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex flex-col overflow-y-auto">
                    <nav class="flex-1 px-2 py-4 space-y-1">
                        <!-- Same navigation links as desktop -->
                    </nav>
                    <!-- Same user profile section as desktop -->
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                    <h1 class="text-lg font-semibold text-gray-900">
                        <slot name="header" />
                    </h1>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications button -->
                        <!-- <button
                            class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button> -->

                        <!-- User dropdown -->
                        <Menu as="div" class="relative">
                            <MenuButton class="flex items-center space-x-2">
                                <span class="sr-only">Open user menu</span>
                                <!-- <img class="h-8 w-8 rounded-full" :src="$page.props.auth.user.profile_photo_url"
                                    :alt="$page.props.auth.user.name" /> -->
                                <span class="hidden md:inline text-sm font-medium text-gray-700">{{
                                    $page.props.auth.user.name
                                }}</span>
                                <ChevronDownIcon class="h-4 w-4 text-gray-400" />
                            </MenuButton>
                            <transition enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <MenuItems
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <MenuItem v-slot="{ active }">
                                    <Link :href="route('profile.edit')"
                                        :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                                    Your
                                    Profile</Link>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                    <Link :href="route('logout')" method="post" as="button"
                                        :class="[active ? 'bg-gray-100' : '', 'block w-full text-left px-4 py-2 text-sm text-gray-700']">
                                    Sign out
                                    </Link>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Flash messages -->
                    <div v-if="$page.props.flash?.success" class="mb-4">
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ $page.props.flash?.success }}</span>
                        </div>
                    </div>

                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
