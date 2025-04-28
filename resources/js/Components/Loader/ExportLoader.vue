<style scoped>
.container {
    width: fit-content;
    gap: 10px;
}

.folder {
    width: min-content;
    margin: auto;
    animation: float 2s infinite linear;
    /* scaled down by 35% from original (i.e., 65% size) */
    transform: scale(0.65);
}

.folder .top {
    background-color: #FF8F56;
    width: 39px;
    /* 60px * 0.65 */
    height: 8px;
    /* 12px * 0.65 ≈ 8px */
    border-top-right-radius: 10px;
}

.folder .bottom {
    background-color: #FFCE63;
    width: 65px;
    /* 100px * 0.65 */
    height: 46px;
    /* 70px * 0.65 ≈ 46px */
    box-shadow: 3px 3px 0 0 #283149;
    /* 5px * 0.65 ≈ 3px */
    border-top-right-radius: 8px;
}

.container .title {
    font-size: .9em;
    color: #283149;
    text-align: center;
    margin-top: 15px;
}

@keyframes float {
    0% {
        transform: translateY(0px) scale(0.65);
    }

    50% {
        transform: translateY(-25px) scale(0.65);
    }

    100% {
        transform: translateY(0px) scale(0.65);
    }
}
</style>

<template>
    <div
        class="fixed inset-0 bg-gray-500 opacity-75 dark:bg-gray-900 flex flex-col items-center justify-center z-50 gap-5">
        <div class="container">
            <div class="folder">
                <div class="top"></div>
                <div class="bottom"></div>
            </div>
            <div class="text-gray-50">Getting files ready...</div>
        </div>
    </div>
</template>
