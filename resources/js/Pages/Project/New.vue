<script setup>

	import { ref } from 'vue';
	import FormLabelStandard from '@/Components/Forms/Labels/FormLabelStandard.vue';
	import FormInputStandard from '@/Components/Forms/Inputs/FormInputStandard.vue';
	import FormSectionHeading from '@/Components/Forms/Labels/FormSectionHeading.vue';
	import FormErrorStandard from '@/Components/Forms/Errors/FormErrorStandard.vue';
	import { usePage } from '@inertiajs/vue3';
	import BlockEditor from '@/Components/BlockEditor.vue';
	import { useForm } from '@inertiajs/vue3';

	let pageNumber = ref(0);
	let page2Clicked = ref(false);
	let maxPages = 2;
	let editor = ref(null);

	const form = useForm({
		'project_name' : null,
		'project_description': null,
		'blocks': null
	})

	// handle next page functionality
	function nextPage(event){
		event.preventDefault();
		if(page2Clicked.value == false){
			page2Clicked.value = true;
		}
		if((pageNumber.value + 1) < maxPages){
			pageNumber.value += 1;
		}
	}

	// handle previous page functionality
	function prevPage(event){
		event.preventDefault();
		if(!((pageNumber.value - 1) < 0)){
			pageNumber.value -= 1;
			
		}
	}

	// handle recieved editor
	function addEditor(passedEditor){
		console.log(passedEditor);
		editor.value = passedEditor;
	}

	//handle submit form
	function submitForm(event){
		event.preventDefault();
		editor.value.save().then((outputData) => {
			console.log(outputData)
			form.blocks = outputData.blocks;
			form.post('/create-project');
		});
	}

	function updateProjectName(newName){
		form.project_name = newName;
	}

	function updateProjectDescription(newDescription){
		form.project_description = newDescription;
	}


</script>
<template>
	{{"CSRF" + usePage().props.csrf_token}}
	<div class="bg-gray-400">
		<form class="flex flex-col max-w-[1200px] m-auto bg-white p-3 gap-3">
			{{pageNumber}}
			{{form}}
			<div  :class="pageNumber == 0 ? 'flex flex-col gap-3' : 'hidden'">
				<FormSectionHeading>Create your project</FormSectionHeading>

				<FormLabelStandard for="project_name">Project Name</FormLabelStandard>
				<FormInputStandard name="project_name" placeholder="Enter your project name" type="text"  @inputUpdate="updateProjectName" />
				<FormErrorStandard :error="form.errors.project_name" />

				<FormLabelStandard for="project_description">Project Description</FormlabelStandard> 
				<FormInputStandard type="textarea" name="project_description" placeholder="What is your project about?" @inputUpdate="updateProjectDescription"/>
				<FormErrorStandard :error="form.errors.project_description" />

			</div>
			<div :class="pageNumber == 1 ? 'flex flex-col ' : 'hidden'" id="page2">
				<FormSectionHeading>Project proposal</FormSectionHeading>
				<p class="text-sm text-gray-400">What do you want to show when people view your project?</p>
				<FormErrorStandard :error="form.errors.blocks" />
				<BlockEditor v-if="page2Clicked" @blockEditor="addEditor" />
			</div>
			<div class="flex gap-3 justify-center">
				<button @click="nextPage" class="bg-purple-600 text-white rounded px-5 py-1" v-if="!pageNumber == maxPages - 1">next</button>
				<button @click="prevPage" class="bg-purple-600 text-white rounded px-5 py-1" v-if="pageNumber != 0">back</button>
				<button @click="submitForm" class="bg-purple-600 text-white rounded px-5 py-1"  v-if="pageNumber == maxPages - 1">Submit</button>
			</div>
		</form>
	</div>
</template>