<template>
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <!-- Scanner Header -->
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">QR Code Scanner</h3>
                    <p class="mt-1 text-sm text-slate-500">Scan event tickets for verification</p>
                </div>
                <div v-if="isScanning" class="flex items-center">
                    <span class="relative flex h-3 w-3 mr-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    <span class="text-sm font-medium text-green-600">Active</span>
                </div>
            </div>
        </div>

        <!-- Scanner Viewport with Target Box -->
        <div class="relative p-6">
            <div id="scanner" class="mx-auto max-w-md rounded-xl overflow-hidden bg-slate-50 aspect-square relative">
                <!-- Target Box Overlay -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="relative w-64 h-64">
                        <!-- Border with animated corners -->
                        <div class="absolute inset-0 border-4 border-indigo-300/30 rounded-xl"></div>
                        <!-- Animated corner elements -->
                        <div class="absolute -top-1 -left-1 w-6 h-6 border-t-4 border-l-4 border-indigo-500"></div>
                        <div class="absolute -top-1 -right-1 w-6 h-6 border-t-4 border-r-4 border-indigo-500"></div>
                        <div class="absolute -bottom-1 -left-1 w-6 h-6 border-b-4 border-l-4 border-indigo-500"></div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 border-b-4 border-r-4 border-indigo-500"></div>
                        <!-- Scanning animation -->
                        <div
                            class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-indigo-400 to-transparent animate-scan">
                        </div>
                    </div>
                </div>

                <!-- Initial State -->
                <div v-if="!isScanning" class="h-full flex flex-col items-center justify-center p-6 text-center">
                    <div class="mb-4 p-3 rounded-full bg-slate-100 text-slate-400">
                        <svg class="w-8 h-8 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-slate-700">Initializing scanner</h3>
                    <p class="mt-1 text-xs text-slate-500">Please wait while we prepare the camera</p>
                </div>
            </div>
        </div>

        <!-- Scanning Instructions -->
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 rounded-b-xl">
            <h4 class="text-sm font-medium text-slate-700 mb-3">Scanning instructions</h4>
            <ul class="text-sm text-slate-600 space-y-2">
                <li class="flex items-start">
                    <span class="flex-shrink-0 mt-0.5 mr-2">
                        <span
                            class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-indigo-100 text-indigo-600">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                    </span>
                    <span>Position the QR code within the target frame</span>
                </li>
                <li class="flex items-start">
                    <span class="flex-shrink-0 mt-0.5 mr-2">
                        <span
                            class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-indigo-100 text-indigo-600">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                    </span>
                    <span>Hold steady about 6-12 inches from the camera</span>
                </li>
                <li class="flex items-start">
                    <span class="flex-shrink-0 mt-0.5 mr-2">
                        <span
                            class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-indigo-100 text-indigo-600">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                    </span>
                    <span>Ensure good lighting on the QR code</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<style>
@keyframes scan {
    0% {
        transform: translateY(0);
    }

    100% {
        transform: translateY(256px);
    }
}

.animate-scan {
    animation: scan 2s ease-in-out infinite;
}
</style>

<script setup>
import { Html5QrcodeScanner } from 'html5-qrcode';
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    event: Object
});

const scanner = ref(null);
const isScanning = ref(false);
const scanningLocked = ref(false);

onMounted(() => {
    startScanner();
});

const startScanner = () => {
    if (isScanning.value) return;

    isScanning.value = true;
    scanner.value = new Html5QrcodeScanner(
        'scanner',
        {
            fps: 10,
            qrbox: { width: 250, height: 250 }, // Matches our target box size
            aspectRatio: 1.0,
            disableFlip: false
        },
        false
    );

    scanner.value.render(
        (ticketNumber) => {
            handleScanSuccess(ticketNumber);
        },
        (error) => {
            console.error("QR scanner error:", error);
        }
    );
};

const handleScanSuccess = (ticketNumber) => {
    if (scanningLocked.value) return; // 👈 prevent overlapping scans
    scanningLocked.value = true;
    isScanning.value = false;

    router.post('/verify-ticket', {
        ticket_number: ticketNumber,
        event_id: props.event.id
    }, {
        preserveScroll: true,
        preserveState: true,
        onFinish: () => {
            // ⏳ Re-enable scanner after delay
            setTimeout(() => {
                scanningLocked.value = false;
                isScanning.value = true;
                startScanner();
            }, 2000); // You can shorten or lengthen this delay
        }
    });
};

const stopScanner = () => {
    if (scanner.value) {
        scanner.value.clear().then(() => {
            isScanning.value = false;
        }).catch(error => {
            console.error("Failed to clear scanner", error);
        });
    }
};

onBeforeUnmount(() => {
    stopScanner();
});
</script>

<style scoped>
/* Scanner container styling */
#scanner {
    min-height: 300px;
    position: relative;
}

/* Target box styling */
.target-box {
    box-shadow: 0 0 0 100vmax rgba(0, 0, 0, 0.5);
}

/* Scanning animation */
.animate-scan {
    animation: scan 2s ease-in-out infinite;
}

@keyframes scan {
    0% {
        top: 0;
        opacity: 1;
    }

    50% {
        top: 100%;
        opacity: 0.7;
    }

    100% {
        top: 0;
        opacity: 1;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {

    0%,
    100% {
        opacity: 1;
    }

    50% {
        opacity: 0.5;
    }
}
</style>
