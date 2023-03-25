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
	<Head title="Browse Projects" />
	<AuthenticatedLayout>
		       <div class="container mx-auto py-8">
				  <h1 class="text-4xl font-bold mb-8 text-white">Browse Projects</h1>
				  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
				    <div v-for="project in $page.props.projects" :key="project.id" class="bg-white rounded-lg overflow-hidden shadow-md">
				      <img :src="'/project-images/' + project.image" :alt="project.name" class="w-full h-48 object-cover">
				      <div class="p-6">
				        <h2 class="text-xl font-bold mb-2">{{ project.name }}</h2>
				        <p class="text-gray-700 text-base">{{ project.description }}</p>
				        <p class="text-gray-500 text-sm mt-2">{{ new Date(project.created_at).toLocaleDateString() }}</p>
				      </div>
				      <div class="bg-gray-100 p-4 text-gray-600">
				        <div v-for="block in project.blocks" :key="block.id">
				          <component :is="block.type" :data="block.data"></component>
				        </div>
				      </div>
				      <div class="p-4 bg-purple-500 text-white">
				        <a :href="'/projects/' + project.id" class="inline-block px-4 py-2 bg-white text-purple-500 font-bold rounded-full uppercase tracking-wide shadow-md hover:shadow-lg hover:bg-purple-500 hover:text-white transition duration-300 ease-in-out">View Project</a>
				      </div>
				    </div>
				  </div>
				</div>


	</AuthenticatedLayout>
</template>
<style>
	.shadow-xl {
	  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 6px 6px rgba(0, 0, 0, 0.23);
	}
</style>