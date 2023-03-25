<template>
  <div class="bg-white rounded-lg overflow-hidden shadow-lg">
    
    <div class="p-6">
      <h3 class="font-semibold text-lg mb-2">{{ title }}</h3>
      <p class="text-gray-700 text-base">{{ description }}</p>
      <div class="mt-4 flex justify-between items-center">
        
        
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  props: ['title', 'description'],
  methods: {
    onButtonClick() {
      // implement your own logic to handle contact button click
    }
  }
})
</script>
