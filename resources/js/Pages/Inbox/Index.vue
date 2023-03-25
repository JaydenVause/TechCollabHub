<script setup>
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
	import Container from '@/Layouts/Container.vue';
	import {Link} from '@inertiajs/vue3';

 function formatDate(dateString) {
  const options = {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: 'numeric',
    minute: 'numeric',
    hour12: true
  };
  const date = new Date(dateString);
  return date.toLocaleDateString(undefined, options);
}
</script>
<template>
	<AuthenticatedLayout>
	  <Container>
	    <div class="message-list">
	      <template v-for="message in $page.props.messages" v-if="$page.props.messages.length > 0">
	        <div class="message">
	          <div class="message-header">
	            <Link class="message-from" :href="'/messages/'+message.chat_id">{{ message.subject }}</Link>
	            <span class="message-date">{{ formatDate(message.last_message) }}</span>
	          </div>
	          <div class="message-body">{{ message.message_body }}</div>
	        </div>
	      </template>
        <div v-else>
          <p class="text-2xl">Your inbox is empty...</p>
        </div>
	    </div>
	  </Container>
	</AuthenticatedLayout>
</template>

<style>
  .message-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .message {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
  }

  .message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    text-decoration: underline;
  }

  .message-from {
    font-weight: bold;
    
  }

  .message-date {
    font-size: 14px;
    color: #666;
  }

  .message-body {
    white-space: pre-wrap;
  }
</style>