<script setup>
	import { Head, usePage, Link } from '@inertiajs/vue3';
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
	import Container from '@/Layouts/Container.vue';

	function formatToLocalTimeString(timeString){
		let event = new Date(timeString);

		return event.toLocaleDateString();
	}
</script>

<template>
	<Head :title="$page.props.project.name" />
	<AuthenticatedLayout>
		<Container>
			<h2 class="text-2xl font-bold mb-4">Project Title: {{$page.props.project.name}}</h2>

			<p class="text-lg  text-gray-600">Date Posted:</p>
			<div class="flex items-center mb-4 gap-3">
				
				<svg class="w-4 h-4 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 0a10 10 0 1 0 10 10A10 10 0 0 0 10 0zm1 15a1 1 0 0 1-2 0v-4a1 1 0 0 1 2 0zm-1-6a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"/></svg>
				<span class="text-sm">{{formatToLocalTimeString($page.props.project.created_at)}}</span>
			</div>

			<p class="text-gray-700 mb-6"><span class="text-gray-600 text-lg ">Project  Description:</span><br/>{{$page.props.project.description}}</p>

			<template v-for="block in JSON.parse($page.props.project.blocks)">

				<template v-if="block.type == 'paragraph'">
					<p class="text-gray-700 mb-4" v-html="block.data.text"></p>
				</template>
				<template v-if="block.type == 'header'">
					<h1 class="text-2xl font-bold mb-4" v-html="block.data.text"></h1>
				</template>
				<template v-if="block.type == 'image'" >
					<div class="flex flex-col justify-center mb-6 imageContainer">
						<img :src="block.data.file.url" class="max-w-full rounded-md shadow-lg" alt="project image" />
						<p class="text-sm" v-html="block.data.caption"></p>
					</div>
				</template>
			</template>
			<div class="flex justify-center">
				<button class="bg-purple-600 text-white rounded-md px-3 py-1 font-medium hover:bg-purple-700 transition-colors duration-300">
				  <a :href="'/message-user/' + $page.props.project.user_id" class="inline-block">
				    Message Poster
				  </a>
				</button> 
			</div>
		</Container>

	</AuthenticatedLayout>
</template>
<style>
	.imageContainer{
		max-width: 400px;
	}
</style>