<script>
const adjust = ref(false);
watch(() => props.isCollapsed, (collapsed) => {
    if (collapsed) {
        setTimeout(() => {
            adjust.value = true
        }, 300)
    }
})
</script>
