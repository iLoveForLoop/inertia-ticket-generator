<script setup>

import { CalendarDaysIcon, ClockIcon, TicketIcon, CheckCircleIcon } from '@heroicons/vue/24/outline';


const props = defineProps({
    title: String,
    value: [String, Number],
    icon: {
        type: String,
        default: 'calendar'
    },
    color: {
        type: String,
        default: 'blue'
    }
});

const icons = {
    calendar: CalendarDaysIcon,
    clock: ClockIcon,
    ticket: TicketIcon,
    'check-circle': CheckCircleIcon
};

const iconColors = {
    blue: 'text-blue-500',
    green: 'text-green-500',
    purple: 'text-purple-500',
    indigo: 'text-indigo-500'
};
</script>

<template>
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0" :class="iconColors[color]">
                    <component :is="icons[icon]" class="h-6 w-6" />
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            {{ title }}
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900">
                                {{ value }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</template>
