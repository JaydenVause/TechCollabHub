<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swiper from '@/Components/Swiper.vue';


</script>

<template>
    <Head title="Welcome" />
    <AuthenticatedLayout>
        <div>
              <section class="bg-gray-700 py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                  <div class="text-center">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                      <span class="block xl:inline text-white">Find your</span>
                      <span class="block text-purple-600 xl:inline">dream project</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-white sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                      Connect with other people that have projects they want staff for development, front-end & back-end, UX and UI design.
                    </p>
                    <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                      <div class="rounded-md shadow">
                        <Link :href="route('register')" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-700 hover:bg-purple-700 md:py-4 md:text-lg md:px-10" v-if="!$page.props.auth.user">
                          Register Now
                        </Link>
                        <Link :href="route('projects.browse')" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-700 hover:bg-purple-700 md:py-4 md:text-lg md:px-10" v-else>
                          Browse Projects
                        </Link>
                      </div>
                      <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="/about" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-purple-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                          Learn more
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            <section>
                <div class="w-full spacey">
                    <div class=" m-auto p-10">
                        <h1 class="text-2xl font-extrabold text-white">Most recent projects...</h1>
                        <Swiper :passedProjects="$page.props.most_recent_projects" />   
                    </div>
                </div>
            </section>
            <section class="bg-gray-100 py-12">
                <div class="container mx-auto px-4">
                  <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4">
                      <h2 class="text-3xl font-bold mb-4">About Our Application</h2>
                      <p class="mb-6 leading-relaxed">
                        Our application is a platform that connects individuals with various skills to people who have projects that require those skills. We aim to facilitate the process of finding the right talent for your project by providing an easy-to-use platform that allows you to search for, contact and hire skilled individuals for your projects.
                      </p>
                      <p class="mb-6 leading-relaxed">
                        Whether you are looking for developers, UX/UI designers, front-end or back-end developers, our platform can help you find the right talent for your project. We understand that finding the right talent can be a challenge, and our goal is to simplify the process by providing a platform that connects you with the right people quickly and easily.
                      </p>
                      <a href="#" class="text-blue-500 inline-block hover:text-blue-700">Learn More</a>
                    </div>
                    <div class="w-full md:w-1/2 px-4">
                      <img src="/images/aboutimage.png" alt="About" class="rounded-lg shadow-lg">
                    </div>
                  </div>
                </div>
              </section>
        </div>
        
    </AuthenticatedLayout>
    
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.spacey{
   background-color: #1f2937;
background-image: url("data:image/svg+xml,%3Csvg width='64' height='64' viewBox='0 0 64 64' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M8 16c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm0-2c3.314 0 6-2.686 6-6s-2.686-6-6-6-6 2.686-6 6 2.686 6 6 6zm33.414-6l5.95-5.95L45.95.636 40 6.586 34.05.636 32.636 2.05 38.586 8l-5.95 5.95 1.414 1.414L40 9.414l5.95 5.95 1.414-1.414L41.414 8zM40 48c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm0-2c3.314 0 6-2.686 6-6s-2.686-6-6-6-6 2.686-6 6 2.686 6 6 6zM9.414 40l5.95-5.95-1.414-1.414L8 38.586l-5.95-5.95L.636 34.05 6.586 40l-5.95 5.95 1.414 1.414L8 41.414l5.95 5.95 1.414-1.414L9.414 40z' fill='%235f6266' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
}
</style>
