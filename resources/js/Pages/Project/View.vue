<script setup>
	import { usePage } from '@inertiajs/vue3';

	function formatToLocalTimeString(timeString){
		let event = new Date(timeString);

		return event.toLocaleDateString();
	}
</script>

<template>
	<div>
		<label class="font-bold" for="project_name">Project Name:</label>
		<p name="project_name">{{$page.props.project.name}}</p>

		<label class="font-bold" for="date_posted">Date Posted:</label>
		<p name="date_posted">{{formatToLocalTimeString($page.props.project.created_at)}}</p>

		<label class="font-bold" for="project_description">Project Description:</label>
		<p name="project_description">{{$page.props.project.description}}</p>

		<template v-for="block in JSON.parse($page.props.project.blocks)">
			<template v-if="block.type == 'paragraph'">
				<p>{{block.data.text}}</p>
			</template>
			<template> v-if="block.type == 'header'">
				<h1>{{block.data.text}}</h1>
			</template>
			<template v-if="block.type == 'image'">
				<img :src="  block.data.file.url" alt="project image" />
			</template>
		</template>
	</div>
</template>