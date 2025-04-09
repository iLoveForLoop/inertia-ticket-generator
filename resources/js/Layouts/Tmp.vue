<script setup>
import { ref } from 'vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { ChevronDownIcon, PlusCircleIcon, CalendarDaysIcon, QrCodeIcon, HomeIcon, XMarkIcon, Bars3Icon } from '@heroicons/vue/20/solid';
import NewNavLink from '@/Components/NewNavLink.vue';
import { Link } from '@inertiajs/vue3';

const mobileMenuOpen = ref(false);

// Close mobile menu when navigating
const closeMobileMenu = () => {
    mobileMenuOpen.value = false;
};
</script>

<template>
    <div class="min-h-screen bg-gray-100 flex overflow-hidden max-h-screen">
        <!-- Desktop Sidebar Navigation -->
        <div class="hidden md:flex md:flex-shrink-0 max-h-screen">
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
                                <HomeIcon class="h-5 w-5" />
                            </template>
                            Dashboard
                        </NewNavLink>

                        <NewNavLink :href="route('events.create')" :active="route().current('events.create')">
                            <template #icon>
                                <PlusCircleIcon class="h-5 w-5" />
                            </template>
                            Create Events & Tickets
                        </NewNavLink>

                        <NewNavLink :href="route('events.index')" :active="route().current('events.index')">
                            <template #icon>
                                <CalendarDaysIcon class="h-5 w-5" />
                            </template>
                            Events
                        </NewNavLink>

                        <NewNavLink :href="route('scan-event')" :active="route().current('scan-event')">
                            <template #icon>
                                <QrCodeIcon class="h-5 w-5" />
                            </template>
                            Verify Tickets
                        </NewNavLink>
                    </nav>

                    <!-- User Profile Section -->
                    <div class="px-4 py-4 border-t border-gray-200">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-700">{{ $page.props.auth.user.name }}</p>
                                <Link :href="route('profile.edit')"
                                    class="text-xs font-medium text-indigo-600 hover:text-indigo-500">View
                                profile</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden fixed z-20 top-4 left-4">
            <button type="button"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                @click="mobileMenuOpen = true">
                <span class="sr-only">Open sidebar</span>
                <Bars3Icon class="h-6 w-6" />
            </button>
        </div>

        <!-- Mobile sidebar overlay and menu -->
        <transition enter-active-class="transition-opacity ease-linear duration-300" enter-from-class="opacity-0"
            enter-to-class="opacity-100" leave-active-class="transition-opacity ease-linear duration-300"
            leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="mobileMenuOpen" class="md:hidden fixed inset-0 z-30">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity" @click="mobileMenuOpen = false">
                </div>

                <!-- Sidebar -->
                <div class="fixed inset-y-0 left-0 flex max-w-xs w-full">
                    <transition enter-active-class="transition ease-in-out duration-300 transform"
                        enter-from-class="-translate-x-full" enter-to-class="translate-x-0"
                        leave-active-class="transition ease-in-out duration-300 transform"
                        leave-from-class="translate-x-0" leave-to-class="-translate-x-full">
                        <div v-show="mobileMenuOpen" class="relative flex flex-col w-full max-w-xs bg-white">
                            <!-- Close button -->
                            <div class="absolute top-0 right-0 -mr-14 p-1">
                                <button type="button"
                                    class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    @click="mobileMenuOpen = false">
                                    <span class="sr-only">Close sidebar</span>
                                    <XMarkIcon class="h-6 w-6 text-white" />
                                </button>
                            </div>

                            <!-- Sidebar content -->
                            <div class="flex-1 flex flex-col overflow-y-auto">
                                <!-- Logo/Brand -->
                                <div class="flex items-center h-16 px-4 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                        <span class="ml-2 text-xl font-bold text-gray-900">TickIt</span>
                                    </div>
                                </div>

                                <!-- Navigation Links -->
                                <nav class="flex-1 px-2 py-4 space-y-1">
                                    <NewNavLink :href="route('dashboard')" :active="route().current('dashboard')"
                                        @click="closeMobileMenu">
                                        <template #icon>
                                            <HomeIcon class="h-5 w-5" />
                                        </template>
                                        Dashboard
                                    </NewNavLink>

                                    <NewNavLink :href="route('events.create')"
                                        :active="route().current('events.create')" @click="closeMobileMenu">
                                        <template #icon>
                                            <PlusCircleIcon class="h-5 w-5" />
                                        </template>
                                        Create Events & Tickets
                                    </NewNavLink>

                                    <NewNavLink :href="route('events.index')" :active="route().current('events.index')"
                                        @click="closeMobileMenu">
                                        <template #icon>
                                            <CalendarDaysIcon class="h-5 w-5" />
                                        </template>
                                        Events
                                    </NewNavLink>

                                    <NewNavLink :href="route('scan-event')" :active="route().current('scan-event')"
                                        @click="closeMobileMenu">
                                        <template #icon>
                                            <QrCodeIcon class="h-5 w-5" />
                                        </template>
                                        Verify Tickets
                                    </NewNavLink>
                                </nav>

                                <!-- User Profile Section -->
                                <div class="px-4 py-4 border-t border-gray-200">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-700">{{ $page.props.auth.user.name
                                                }}</p>
                                            <Link :href="route('profile.edit')" @click="closeMobileMenu"
                                                class="text-xs font-medium text-indigo-600 hover:text-indigo-500">View
                                            profile</Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </transition>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-blue-200 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                    <h1 class="text-lg font-semibold text-gray-900">
                        <slot name="header" />
                    </h1>

                    <div class="flex items-center space-x-4">
                        <!-- User dropdown -->
                        <Menu as="div" class="relative">
                            <MenuButton class="flex items-center space-x-2">
                                <span class="sr-only">Open user menu</span>
                                <span class="hidden md:inline text-sm font-medium text-gray-700">
                                    {{ $page.props.auth.user.name }}
                                </span>
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
                                    Your Profile</Link>
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
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
