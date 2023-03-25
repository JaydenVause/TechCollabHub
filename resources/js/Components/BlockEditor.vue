<script setup>
	import EditorJS from '@editorjs/editorjs';
	import header from '@editorjs/header';
	import ImageTool from '@editorjs/image';
	import { usePage } from '@inertiajs/vue3';

	const emit = defineEmits(['blockEditor']);

	

	function createFormElement(){
	  let editorPage = document.querySelector('#page3');
	  let editorEl = document.createElement('div');
	  let p = document.createElement('p');

	  p.textContent = "Write about your project";
	  editorEl.appendChild(p);
	  editorEl.setAttribute('id', 'editorJs');
	  editorEl.classList.add('bg-white');
	  editorEl.classList.add('border-[1px]');
	  editorEl.classList.add('border-gray-300');
	  editorEl.classList.add('border-solid');
	  editorEl.classList.add('rounded');
	  editorEl.classList.add('p-3');

	  editorPage.appendChild(editorEl); 

	  // placeholder text for block editor
	  editorEl.addEventListener('focusin', () => {
	      editorEl.removeChild(p);
	    }, { once: true });

	  let editor = new EditorJS({
	    holder: editorEl,
	    tools: {
	    	header: {
	    		class: header,
	    		shortcut: 'CMD+SHIFT+H'
	    	},
	    	image: {
	    		class: ImageTool,
	    		shortcut: 'CMD+SHIFT+I',
	    		config: {
	    			endpoints: {
	    				byFile: '/project-image',
	    			},
	    			additionalRequestHeaders: {
	                    "X-CSRF-TOKEN": usePage().props.csrf_token
	                },
	    		}
	    	}
	    }
	    // your EditorJs configuration options
	  });

	  emit('blockEditor', editor)

	};

	createFormElement();



</script>


<template>


</template>