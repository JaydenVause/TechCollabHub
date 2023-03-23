<script setup>
	defineProps(['for']);
</script>
<template>
	<label class="text-black" :for="for"><slot/></label>
</template>