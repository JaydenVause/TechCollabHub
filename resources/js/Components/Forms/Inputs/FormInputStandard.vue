<script setup>
	defineProps(['name', 'placeholder', 'type', 'model']);
	defineEmits(['inputUpdate'])
</script>
<template>
	
		<input class="border-gray-300" :name="name" type="text" :placeholder="placeholder"  v-if="type == 'text' " @input="$emit('inputUpdate', $event.target.value)" />

	
		<textarea class="border-gray-300" :name="name" :placeholder="placeholder"  v-if="type == 'textarea'" @input="$emit('inputUpdate', $event.target.value)" ></textarea>
	
</template>