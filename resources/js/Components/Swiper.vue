<template> 

  <swiper
  class=" max-w-screen-xl"
  :modules="modules"
  slides-per-view="auto"
  :space-between="5"
  navigation
  :pagination="{ clickable: true }"
  :scrollbar="{ draggable: true }"
  @swiper="onSwiper"
  @slideChange="onSlideChange"
>
  <swiper-slide v-slot="isActive" v-for="(project, index) in passedProjects" :key="project.id">
    <div class="relative overflow-hidden rounded-lg shadow-md h-full">
      <img class="object-cover w-full h-64" :src="'/project-images/'+project.image" alt="Project Image">
      <div class="absolute inset-0 bg-black opacity-40"></div>
      <div class="absolute inset-0 flex flex-col justify-end px-6 py-4">
        <h3 class="text-xl font-bold text-white mb-2">{{project.name.substr(0, 20) + '...'}}</h3>
        <p class="text-gray-300  mb-4">{{project.description.substr(0, 20) + '...'}}</p>
        <div class="flex justify-end">
          <Link class="bg-purple-700 hover:bg-purple-600 text-white px-4 py-2 rounded shadow" as="button" :href="'/projects/' + project.id">Visit</Link>
        </div>
      </div>
    </div>
  </swiper-slide>
</swiper>

</template>
<script>
  // import Swiper core and required modules
  import { Navigation, Pagination, Scrollbar, A11y } from 'swiper';

  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';
  import { Link } from '@inertiajs/vue3';


  // Import Swiper styles
  import 'swiper/css';
  import 'swiper/css/navigation';
  import 'swiper/css/pagination';
  import 'swiper/css/scrollbar';

  // Import Swiper styles
  export default {
    props: {
      passedProjects: Object    
    },

    components: {
      Link,
      Swiper,
      SwiperSlide,
    },
    setup() {
      const onSwiper = (swiper) => {
        console.log(swiper);
      };
      const onSlideChange = () => {
        console.log('slide change');
      };
      return {
        onSwiper,
        onSlideChange,
        modules: [Navigation, Pagination, Scrollbar, A11y],
      };
    },
  };
</script>
<style>

.swiper{
  
}
  .swiper-slide{
    background: rgba(255,255,255,0.9);
    max-width: 300px;
    padding: 5px;
    border-radius: 5px;
   
  }

  .swiper-pagination-bullet{
    width:20px;
    height:20px;
    background: rgba(255,255,255);
    opacity:.3
  }

  .swiper-pagination-bullet-active{
    background: rgb(168, 85, 247);
    opacity:1;
  }

  
  

  .swiper-slide-active{
    
    opacity: 1

  }


</style>