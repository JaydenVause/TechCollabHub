

 <template>
  <AuthenticatedLayout>
  <div class="flex flex-col items-center justify-center h-screen ">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-white">Contact Us</h1>

    <div class="bg-white rounded-lg shadow-md p-6 w-full lg:w-2/3 xl:w-1/2">
      <form @submit.prevent="submitForm">
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="name">
            Name
          </label>
          <input
            v-model.trim="form.name"
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="name"
            type="text"
            required
            autocomplete="name"
          />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="email">
            Email
          </label>
          <input
            v-model.trim="form.email"
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="email"
            type="email"
            required
            autocomplete="email"
          />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="message">
            Message
          </label>
          <textarea
            v-model.trim="form.message"
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="message"
            rows="5"
            required
          ></textarea>
        </div>

        <div class="flex justify-center">
          <button
            class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit"
            @click="submitForm"
          >
           Send
          </button>
        </div>
      </form>
    </div>
  </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { reactive, toRefs } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
  name: '',
  email: '',
  message: '',
})


function submitForm(){

}
 
</script>
