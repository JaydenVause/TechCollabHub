<script setup>

	import { ref } from 'vue';
	import FormLabelStandard from '@/Components/Forms/Labels/FormLabelStandard.vue';
	import FormInputStandard from '@/Components/Forms/Inputs/FormInputStandard.vue';
	import FormSectionHeading from '@/Components/Forms/Labels/FormSectionHeading.vue';
	import FormErrorStandard from '@/Components/Forms/Errors/FormErrorStandard.vue';
	import { usePage, useForm, Head } from '@inertiajs/vue3';
	import BlockEditor from '@/Components/BlockEditor.vue';
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
	import FormButtonStandard from '@/Components/Forms/Buttons/FormButtonStandard.vue';
	import Container from '@/Layouts/Container.vue';
	import { debounce } from 'lodash';
	let pageNumber = ref(0);
	let page3Clicked = ref(false);


	let searchResults = ref([]);
	let searchTerm = ref('');
	let selectedTopic = ref('');

	let maxPages = 3;
	let editor = ref(null);

	const form = useForm({
		'project_name' : null,
		'project_description': null,
		'blocks': null,
		'project_image' : null,
		'topics': []
	})




	// handle recieved editor
	function addEditor(passedEditor){
		editor.value = passedEditor;
	}

	//handle submit form
	function submitForm(event){
		event.preventDefault();
		editor.value.save().then((outputData) => {
			
			form.blocks = outputData.blocks;
			form.post('/create-project', {
				onError: ()=>{
					if(form.errors.project_name || form.errors.project_description){
						pageNumber.value = 0;
					}else if(form.errors.topics){
						pageNumber.value = 1;
					}else if(form.errors.blocks){
						pageNumber.value = 2;
					}
				}
			});			
		});
	}

	function updateProjectName(newName){
		form.project_name = newName;
	}

	function updateProjectDescription(newDescription){
		form.project_description = newDescription;
	}

	function setPageNumber(newPageNumber, operand = null){
		if(operand == 'plus'){
			pageNumber.value += 1;
		}else if(operand == 'minus'){
			pageNumber.value -= 1;
		}else{
			pageNumber.value = newPageNumber;
		}

		if(pageNumber.value == 2){
			page3Clicked.value = true;
		}
		
	}

	function uploadFileInput(event){

		form.project_image = event.target.files[0];
	}

	

    const addTopic = (topic) => {
	    searchResults.value = null;
	    searchTerm.value = null;

      if (topic && !form.topics.some((t) => t.name === topic.name)) {
        form.topics.push({
          id: topic.id,
          name: topic.name,
        });
      }
      searchTerm.value = '';
    };

   const removeTopic = (index) => {
	  form.topics = form.topics.filter((topic, i) => i !== index);
	};

    const search = debounce(() => {
      if (searchTerm.value.length > 2) {
        axios.get(`/topics/${searchTerm.value}`).then((response) => {
          searchResults.value = response.data;
        });
      } else {
        searchResults.value = [];
      }
    }, 500);


</script>
<template>
	<Head title="Create Project" />
	<AuthenticatedLayout>
		
		<Container>			
			<form class="flex flex-col max-w-[1200px] m-auto bg-white p-3 gap-3">
				<div  :class="pageNumber == 0 ? 'flex flex-col gap-3' : 'hidden'">
					<FormSectionHeading>Create your project</FormSectionHeading>

					<FormLabelStandard for="project_name">Project Name</FormLabelStandard>
					<FormInputStandard name="project_name" placeholder="Enter your project name" type="text"  @inputUpdate="updateProjectName" />
					<FormErrorStandard :error="form.errors.project_name" />

					<FormLabelStandard for="project_description">Project Description</FormlabelStandard> 
					<FormInputStandard type="textarea" name="project_description" placeholder="What is your project about?" @inputUpdate="updateProjectDescription"/>
					<FormErrorStandard :error="form.errors.project_description" />

					<FormLabelStandard for="project_image">Upload a picture for your project</FormLabelStandard>
					<input type="file" name="project_image" @change="uploadFileInput" />
					<FormErrorStandard :error="form.errors.project_image" />
				</div>

				
			      <div :class="pageNumber == 1 ? 'flex flex-col' : 'hidden'">

				      <div class="topics">
					    <label>Topics for project</label>
					    <div class="search-wrapper">
					      <input class="search-input" type="text" v-model="searchTerm" @input="search" placeholder="Search topics..." />
					      <ul class="search-results" v-if="searchResults && searchResults.length">
					        <li v-for="topic in searchResults" :key="topic.id" @click="addTopic(topic)">
					          {{ topic.name }}
					        </li>
					      </ul>
					    </div>
					    <FormErrorStandard :error="form.errors.topics" />
					    <div class="topic-list" v-if="form.topics.length">
					      <div v-for="(topic, index) in form.topics" :key="index" class="topic-item">
					        <span>{{ topic.name }}</span>
					        <button class="delete-button" @click.prevent="removeTopic(index)">Delete</button>
					      </div>
					    </div>
					  </div>
				  </div>
				

				<div :class="pageNumber == 2 ? 'flex flex-col ' : 'hidden'" id="page3">
					<FormSectionHeading>Project proposal</FormSectionHeading>
					<p class="text-sm text-gray-400">What do you want to show when people view your project?</p>
					<FormErrorStandard :error="form.errors.blocks" />
					<BlockEditor v-if="page3Clicked == true" @blockEditor="addEditor" />
				</div>

				<div class="flex gap-3 justify-center">
					
					<FormButtonStandard @click.prevent="setPageNumber( 1, 'minus')" v-if="pageNumber != 0">back</FormButtonStandard>
					<FormButtonStandard @click.prevent="setPageNumber(1, 'plus')" v-if="pageNumber != maxPages - 1">next</FormButtonStandard>
					<FormButtonStandard @click="submitForm" v-if="pageNumber == maxPages - 1">Submit</FormButtonStandard>
				</div>
			</form>
		</Container>
	</AuthenticatedLayout>
</template>
<style>
	h1{
		font-size: 2em;
	}

	h2{
		font-size: 1.5em;
	}

	h3{
		font-size: 1.3em;
	}

	h4{
		font-size: 1.2em;
	}

	h5{
		font-size: 1.1em;
	}

	h6{
		font-size: 1em;
	}


	.topics {
	  display: flex;
	  flex-direction: column;
	  align-items: flex-start;
	  margin: 1rem 0;
	}

	label {
	  font-size: 1rem;
	  font-weight: bold;
	  margin-bottom: 0.5rem;
	}

	.search-wrapper {
	  position: relative;
	  width: 100%;
	}

	.search-input {
	  width: 100%;
	  padding: 0.5rem;
	  border: 1px solid #ccc;
	  border-radius: 0.25rem;
	}

	.search-results {
	  position: absolute;
	  top: 100%;
	  left: 0;
	  z-index: 1;
	  width: 100%;
	  background-color: #fff;
	  border: 1px solid #ccc;
	  border-radius: 0.25rem;
	  list-style: none;
	  padding: 0;
	  margin: 0;
	  max-height: 10rem;
	  overflow-y: auto;
	}

	.search-results li {
	  padding: 0.5rem;
	  cursor: pointer;
	}

	.search-results li:hover {
	  background-color: #f1f1f1;
	}

	.topic-list {
	  display: flex;
	  flex-wrap: wrap;
	  margin-top: 0.5rem;
	}

	.topic-item {
	  display: flex;
	  align-items: center;
	  background-color: #f1f1f1;
	  border-radius: 0.25rem;
	  margin-right: 0.5rem;
	  margin-bottom: 0.5rem;
	  padding: 0.25rem 0.5rem;
	}

	.topic-item span {
	  margin-right: 0.5rem;
	}

	.delete-button {
	  border: none;
	  background-color: transparent;
	  cursor: pointer;
	  color: #f00;
	}


</style>