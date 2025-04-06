<script setup>
import { Html5QrcodeScanner } from 'html5-qrcode';
import { ref, onBeforeUnmount } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    event: Object
})

const scanner = ref(null);
console.log(props.event.id)

const startScanner = () => {

    scanner.value = new Html5QrcodeScanner(
        'scanner',
        { fps: 10, qrbox: 250 },
        false
    );

    scanner.value.render((ticketNumber) => {
        router.post('/verify-ticket', {
            ticket_number: ticketNumber,
            event_id: props.event.id
        }, {
            preserveScroll: true,
            onSuccess: (response) => {
                console.log('Ticket verified!', response.props); // Access response data here
                alert(response.props.message); // Example: Show success message
            },
            onError: (errors) => {
                console.error('Verification failed:', errors);
                alert(errors.message); // Example: Show error message
            }
        });
    });
};

const stopScanner = () => {
    if (scanner.value) {
        scanner.value.clear().catch(error => {
            console.error("Failed to clear scanner", error);
        });
    }
};

onBeforeUnmount(stopScanner);
</script>

<template>
    <div>
        <div id="scanner"></div>
        <button @click="startScanner">Start Scanner</button>
        <button @click="stopScanner">Stop Scanner</button>
    </div>
</template>
