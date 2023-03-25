<script setup>
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
	import Container from '@/Layouts/Container.vue';
  import FormErrorStandard from '@/Components/Forms/Errors/FormErrorStandard.vue';
	import {Link, usePage, useForm} from '@inertiajs/vue3';
  import { ref } from 'vue';
  let  form = useForm({
      message_body: 'asdsad'
  });

  const messageList = ref(null);

  function scrollToBottom() {
    // scroll to the bottom of the container
    messageList.value.scrollTop = messageList.value.scrollHeight;
  }

  // call the scrollToBottom function after a new message is added
 

  function sendMessage(){
    form.post('/message-user/'+usePage().props.otherUserId);
  }

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
    <Container class="message-box">
      <div class="message-header">
        <h1>Conversation with {{ $page.props.otherUserName }}</h1>
        <Link href="/inbox" class="back-button">Back to Inbox</Link>
      </div>
      <div class="message-list" ref="messageList">
        <div v-for="message in $page.props.messages" :key="message.id"
             :class="message.user_id === $page.props.otherUserId ? 'message message-left' : 'message message-right' ">
          <div class="message-header">            
            <div class="message-from">{{ message.user_name }}</div>
            <div class="message-date">{{ formatDate(message.created_at) }}</div>
          </div>
          <div class="message-body">{{ message.message_body }}</div>
        </div>
      </div>
      <div class="message-reply">
        
          <FormErrorStandard :error="form.errors.message_body" />
        
        <form @submit.prevent="sendMessage">
          <textarea v-model="form.message_body" rows="3" placeholder="Type your message here..." required></textarea>
          <button type="submit" class="send-button">Send</button>
        </form>
      </div>

    </Container>

  </AuthenticatedLayout>
</template>
<style scoped>
  .message-box{
   
  }
  /* Styles for mobile */
 

    .message-from {
      font-size: 16px;
    }

    .message-date {
      font-size: 12px;
      color:white;
    }

    .message-list {
      display: flex;
      flex-direction: column-reverse;
      gap: 16px;
      padding: 16px;
      max-height:500px;
      overflow: auto;
    }

    .message {
      border-radius: 8px;
      padding: 12px;
      max-width: 90%;
      box-shadow: none;
    }

    .message-left {
      background-color : #3f3e40;
      align-self: flex-start;
      color: white;
    }

    .message-right {
      background-color: #8c1ced;
      color: #fff;
      align-self: flex-end;
    }

    .back-button {
      font-size: 14px;
      padding: 10px 12px;
      border-radius: 8px;
    }


  /* Styles for desktop */
  @media only screen and (min-width: 768px) {
    .message-header {
      
    }

    .message-from {
      font-size: 20px;
    }

    .message-date {
      font-size: 14px;
      color:white
    }

    .message-list {
      gap: 24px;
      padding: 24px;
    }

    .message {
      border-radius: 12px;
      padding: 16px;
      max-width: 80%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .message-left {
      background-color : #3f3e40;
      align-self: flex-start;
      color: white;
    }

    .message-right {
      background-color: #8c1ced;
      color: #fff;
      align-self: flex-end;
    }

    .back-button {
      font-size: 16px;
      padding: 12px 16px;
      border-radius: 12px;
    }
  }

 @media (max-width: 767px) {
  .message-reply {
    margin-left: 0;
    margin-right: 0;
    width: 100%;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #fff;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
    z-index: 1;
    padding: 16px;
  }
  
  .message-reply form {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .message-reply textarea {
  flex: 1;
  margin-right: 8px;
  height: 100px;

  border: 1px solid #ccc;
  border-radius: 12px;
  padding: 8px 16px;
  font-size: 16px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

  
  .message-reply button {
    background-color: #8c1ced;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 12px;
    padding: 8px 16px;
    font-size: 16px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease-in-out;
  }
  
  .message-reply button:hover {
    background-color: #6c1cac;
  }
}


@media screen and (min-width: 768px) {
  

  .message-reply form {
    display: flex;
    flex-direction: row;
    align-items: center;
    flex-grow: 1;
    margin-right: 16px;
  }

  .message-reply textarea {
    flex-grow: 1;
    padding: 12px;
    border-radius: 12px;
    
    font-size: 16px;
    resize: none;
    margin-right: 8px;
  }

  .message-reply .send-button {
    border-radius: 12px;
    border: none;
    padding: 12px 16px;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
    font-size: 16px;
    display: inline-block;
    color: #fff;
    background-color: #8c1ced;
  }

  .message-reply .send-button:hover {
    background-color: #6b13c6;
  }
}

</style>
