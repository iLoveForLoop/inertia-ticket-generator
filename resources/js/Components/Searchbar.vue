<script setup>
import { ref, watch } from 'vue'


const props = defineProps({
    search: {
        type: String,
        default: ''
    }
})


const emit = defineEmits(['search'])
const inputedText = ref(props.search);

watch(() => inputedText.value, (newData) => {
    emit('search', newData)
})

</script>

<template>
    <div class="relative w-full sm:w-64">
        <svg viewBox="0 0 24 24" aria-hidden="true"
            class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 fill-gray-400">
            <g>
                <path
                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                </path>
            </g>
        </svg>

        <input id="query" type="search" name="searchbar" placeholder="Search..." v-model="inputedText"
            class="w-full pl-10 pr-4 py-2 rounded-xl bg-gray-800 text-gray-200 placeholder-gray-400 border-none shadow focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all" />
    </div>
</template>



<style scoped>
.group {
    display: flex;
    line-height: 28px;
    align-items: center;
    position: relative;
    max-width: 190px;
}

.input {
    font-family: "Montserrat", sans-serif;
    width: 100%;
    height: 45px;
    padding-left: 2.5rem;
    box-shadow: 0 0 0 1.5px #2b2c37, 0 0 25px -17px #000;
    border: 0;
    border-radius: 12px;
    /* background-color: #16171d; */
    outline: none;
    color: #bdbecb;
    transition: all 0.25s cubic-bezier(0.19, 1, 0.22, 1);
    cursor: text;
    z-index: 0;
}

.input::placeholder {
    color: #bdbecb;
}

.input:hover {
    box-shadow: 0 0 0 2.5px #2f303d, 0px 0px 25px -15px #000;
}

.input:active {
    transform: scale(0.95);
}

.input:focus {
    box-shadow: 0 0 0 2.5px #2f303d;
}

.search-icon {
    position: absolute;
    left: 1rem;
    fill: #bdbecb;
    width: 1rem;
    height: 1rem;
    pointer-events: none;
    z-index: 1;
}
</style>
