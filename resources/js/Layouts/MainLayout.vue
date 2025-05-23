<script setup>
import { ref, watch } from 'vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { ChevronDownIcon, PencilSquareIcon, CalendarDaysIcon, HomeIcon, Bars3Icon, UserCircleIcon, XMarkIcon } from '@heroicons/vue/20/solid';
import { TicketIcon, QrCodeIcon, ViewfinderCircleIcon, ChevronDoubleLeftIcon, } from '@heroicons/vue/24/outline';
import { useUIStore } from '@/stores/ui';

const ui = ref(useUIStore())

import NewNavLink from '@/Components/NewNavLink.vue';
import { Link } from '@inertiajs/vue3';

const mobileMenuOpen = ref(false);

const closeMobileMenu = () => {
    mobileMenuOpen.value = false;
};

</script>

<template>
    <div class="min-h-screen  flex overflow-hidden max-h-screen bg-slate-200 md:py-5 md:px-8">

        <!-- Sidebar start -->
        <div class="hidden md:flex md:flex-shrink-0 max-h-screen bg-slate-700 rounded-xl">
            <div :class="[ui.sidebarCollapsed ? 'w-20' : 'w-64', 'flex flex-col   transition-all duration-300']">
                <!-- Logo/Brand -->
                <div :class="['flex items-center  h-16 px-3 ', ui.sidebarCollapsed ? 'justify-center' : '']">
                    <div class="flex items-center gap-3">
                        <img src="/logo/finalogo.png" alt="TickIt Logo" class="h-[2.6em] w-[2.6em]">
                        <span v-if="!ui.sidebarCollapsed" class="text-xl font-bold text-gray-50">TickIt</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex-1 flex flex-col overflow-y-auto no-scrollbar">
                    <nav class="flex-1 px-2 py-4 space-y-1">
                        <NewNavLink :href="route('dashboard')" :active="route().current('dashboard')"
                            :isCollapsed="ui.sidebarCollapsed">
                            <template #icon>
                                <HomeIcon class="h-5 w-5" />
                            </template>

                            <!-- <Transition name="reveal"> -->
                            <span class="text-gray-400" v-if="!ui.sidebarCollapsed">
                                Dashboard</span>
                            <!-- </Transition> -->


                        </NewNavLink>

                        <NewNavLink :href="route('events.create')" :active="route().current('events.create')"
                            :isCollapsed="ui.sidebarCollapsed">
                            <template #icon>
                                <PencilSquareIcon class="h-5 w-5" />
                            </template>
                            <!-- <Transition name="reveal"> -->
                            <span class="text-gray-400" v-if="!ui.sidebarCollapsed">
                                Create&nbsp;Events&nbsp;&&nbsp;Tickets</span>
                            <!-- </Transition> -->


                        </NewNavLink>

                        <NewNavLink :href="route('events.index')" :active="route().current('events.index')"
                            :isCollapsed="ui.sidebarCollapsed">
                            <template #icon>
                                <CalendarDaysIcon class="h-5 w-5" />
                            </template>
                            <span class="text-gray-400" v-if="!ui.sidebarCollapsed">Events </span>
                            <!-- Events -->
                        </NewNavLink>

                        <NewNavLink :href="route('events.tickets')" :active="route().current('events.tickets')"
                            :isCollapsed="ui.sidebarCollapsed">
                            <template #icon>
                                <TicketIcon class="h-5 w-5" />
                            </template>
                            <span class="text-gray-400" v-if="!ui.sidebarCollapsed">Tickets </span>
                            <!-- Tickets -->
                        </NewNavLink>

                        <NewNavLink :href="route('scan-event')" :active="route().current('scan-event')"
                            :isCollapsed="ui.sidebarCollapsed">
                            <template #icon>
                                <ViewfinderCircleIcon class="h-5 w-5" />
                            </template>
                            <span class="text-gray-400" v-if="!ui.sidebarCollapsed">Verify&nbsp;Tickets </span>
                        </NewNavLink>
                    </nav>

                    <!-- User Profile Section -->
                    <div class="px-4 py-4  ">
                        <div class="flex justify-center items-center ">

                            <div class="flex items-center ">
                                <button class="text-gray-400 rounded-full hover:bg-gray-50 p-2 "
                                    @click="ui.toggleSidebar">
                                    <ChevronDoubleLeftIcon
                                        :class="[ui.sidebarCollapsed ? 'rotate-180' : '', 'h-5 w-5 transition-all duration-700']" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar end -->

        <!-- Mobile sidebar overlay and menu -->
        <transition enter-active-class="transition-opacity ease-linear duration-300" enter-from-class="opacity-0"
            enter-to-class="opacity-100" leave-active-class="transition-opacity ease-linear duration-300"
            leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="mobileMenuOpen" class="md:hidden fixed inset-0 z-30 ">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity" @click="mobileMenuOpen = false">
                </div>

                <!-- Sidebar -->
                <div class="fixed inset-y-0 left-0 flex max-w-xs w-full ">
                    <transition enter-active-class="transition ease-in-out duration-300 transform"
                        enter-from-class="-translate-x-full" enter-to-class="translate-x-0"
                        leave-active-class="transition ease-in-out duration-300 transform"
                        leave-from-class="translate-x-0" leave-to-class="-translate-x-full">
                        <div v-show="mobileMenuOpen" class="relative flex flex-col w-full max-w-xs bg-slate-800">
                            <!-- Close button -->


                            <!-- Sidebar content -->
                            <div class="flex-1 flex flex-col overflow-y-auto">
                                <!-- Logo/Brand -->
                                <div class="flex items-center h-16 px-4 border-b border-slate-200">
                                    <div class="flex items-center">
                                        <img src="/logo/finalogo.png" alt="TickIt Logo" class="h-[2.6em] w-[2.6em]">
                                        <span class="ml-2 text-xl font-bold text-slate-200">TickIt</span>
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
                                            <PencilSquareIcon class="h-5 w-5" />
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

                                    <NewNavLink :href="route('events.tickets')"
                                        :active="route().current('events.tickets')" @click="closeMobileMenu">
                                        <template #icon>
                                            <TicketIcon class="h-5 w-5" />
                                        </template>
                                        Tickets
                                    </NewNavLink>

                                    <NewNavLink :href="route('scan-event')" :active="route().current('scan-event')"
                                        @click="closeMobileMenu">
                                        <template #icon>
                                            <ViewfinderCircleIcon class="h-5 w-5" />
                                        </template>
                                        Verify Tickets
                                    </NewNavLink>
                                </nav>

                                <!-- User Profile Section -->
                                <div class="px-4 py-4 border-t border-gray-200">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-slate-200">{{ $page.props.auth.user.name
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
            <header class="">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                    <div class="md:hidden">
                        <button type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            @click="mobileMenuOpen = true">
                            <span class="sr-only">Open sidebar</span>
                            <Bars3Icon class="h-6 w-6" />
                        </button>
                    </div>
                    <div class=" text-lg  text-gray-900 w-full">
                        <slot name="header" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- User dropdown -->

                        <Menu as="div" class="relative" v-if="route().current('dashboard')">
                            <MenuButton class="hidden md:flex items-center space-x-2">
                                <span class="sr-only">Open user menu</span>
                                <!-- <img class="h-8 w-8 rounded-full" :src="$page.props.auth.user.profile_photo_url"
                                    :alt="$page.props.auth.user.name" /> -->
                                <span class="inline text-sm font-medium text-slate-700">
                                    <UserCircleIcon class="h-8 w-8" />
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
                                    Your
                                    Profile</Link>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                    <Link :href="route('logout')" method="post" as="button"
                                        :class="[active ? 'bg-gray-100' : '', 'block w-full text-left px-4 py-2 text-sm text-gray-700']">
                                    Log out
                                    </Link>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-y-auto  no-scrollbar">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2  ">


                    <slot />
                </div>
            </main>
        </div>

    </div>
</template>

<style>
.reveal-enter-active {
    @apply transition-all duration-100 ease-in-out delay-[500ms];
}

.reveal-leave-active {
    @apply transition-all duration-0 ease-in-out;
}

.reveal-enter-from,
.reveal-leave-to {
    @apply opacity-0 translate-x-2;
}

.reveal-enter-to,
.reveal-leave-from {
    @apply opacity-100 translate-x-0;
}
</style>
