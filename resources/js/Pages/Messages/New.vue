<script setup>
	import { Head , useForm, usePage } from '@inertiajs/vue3'
	import { ref } from 'vue';
	import FormLabelStandard from '@/Components/Forms/Labels/FormLabelStandard.vue';
	import FormInputStandard from '@/Components/Forms/Inputs/FormInputStandard.vue';
	import FormSectionHeading from '@/Components/Forms/Labels/FormSectionHeading.vue';
	import FormErrorStandard from '@/Components/Forms/Errors/FormErrorStandard.vue';
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
	import FormButtonStandard from '@/Components/Forms/Buttons/FormButtonStandard.vue';
	import Container from '@/Layouts/Container.vue';
	let recipentId = usePage().props.recipent.id;

	const form = useForm({
		'message_subject' : null,
		'message_body' : null,	
	});

	function setMessageSubject(subject){
		form.message_subject = subject;
	};

	function setMessageBody(body){
		form.message_body = body;
	};

	function messageUser(){
		form.post('/message-user/'+recipentId);
	};

</script>
<template>
	<Head :title="'Message ' +  $page.props.recipent.name" />
	<AuthenticatedLayout>
		<Container>
			<FormSectionHeading>Message {{$page.props.recipent.name}}</FormSectionHeading>
			<form @submit.prevent="messageUser" class="flex flex-col gap-3">
				<FormLabelStandard for="message_subject">Subject:</FormLabelStandard>
				<FormInputStandard type="text" name="message_subject" @inputUpdate="setMessageSubject" />
				<FormLabelStandard for="message_body">Message:</FormLabelStandard>
				<FormInputStandard type="textarea" name="message_body" @inputUpdate="setMessageBody"/>
				<FormButtonStandard>Send Message</FormButtonStandard>
			</form>
		</Container>
	</AuthenticatedLayout>
</template>
