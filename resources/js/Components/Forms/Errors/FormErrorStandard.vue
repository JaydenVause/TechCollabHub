<script setup>
	defineProps(['error']);
</script>
<template>
	<p class="text-red-500" v-if="error">{{error}}</p>
</template>