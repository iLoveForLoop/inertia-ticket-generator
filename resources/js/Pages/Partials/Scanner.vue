<template>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Scanner Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">QR Code Scanner</h3>
            <p class="mt-1 text-sm text-gray-500">Point your camera at a ticket QR code to verify</p>
        </div>

        <!-- Scanner Viewport with Target Box -->
        <div class="relative p-4">
            <div id="scanner" class="mx-auto max-w-md rounded-lg overflow-hidden bg-gray-100 aspect-square relative">
                <!-- Target Box Overlay -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="relative w-64 h-64">
                        <!-- Border with animated corners -->
                        <div class="absolute inset-0 border-4 border-blue-400/50 rounded-lg"></div>
                        <!-- Animated corner elements -->
                        <div class="absolute -top-1 -left-1 w-6 h-6 border-t-4 border-l-4 border-blue-500"></div>
                        <div class="absolute -top-1 -right-1 w-6 h-6 border-t-4 border-r-4 border-blue-500"></div>
                        <div class="absolute -bottom-1 -left-1 w-6 h-6 border-b-4 border-l-4 border-blue-500"></div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 border-b-4 border-r-4 border-blue-500"></div>
                        <!-- Scanning animation -->
                        <div class="absolute top-0 left-0 right-0 h-1 bg-blue-400 animate-scan"></div>
                    </div>
                </div>

                <!-- Initial State -->
                <div v-if="!isScanning" class="h-full flex items-center justify-center">
                    <div class="text-center p-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400 animate-pulse" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Initializing scanner...</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scanning Status -->
        <div v-if="isScanning" class="px-6 py-3 bg-blue-50 border-t border-blue-100 text-center">
            <p class="text-sm font-medium text-blue-800">
                Scanning for QR codes...
            </p>
        </div>

        <!-- Scanning Instructions -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl">
            <h4 class="text-sm font-medium text-gray-900 mb-2">Scanning Instructions</h4>
            <ul class="text-sm text-gray-600 space-y-1">
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Position the QR code within the target area</span>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Hold steady about 6-12 inches from the camera</span>
                </li>
                <li class="flex items-start">
                    <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Ensure good lighting on the QR code</span>
                </li>
            </ul>
        </div>
    </div>
</template>

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
