<template>
<AuthenticatedLayout>
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center">
      <h1 class="text-4xl font-bold mb-6 text-white">About Our Application</h1>
      <p class="text-lg text-white mb-8">
        Our application is a platform for users to post new projects they are working on and need people to help out with. Whether you're a software developer, designer, marketer, or anything in between, you can find exciting new projects to work on and collaborate with other users from around the world.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Find Exciting Projects</h2>
        <p class="text-gray-600 mb-4">
          With our application, you can easily browse through a variety of projects and find something that interests you. Whether you want to work on a new mobile app, build a website, or create a new piece of hardware, you can find projects that fit your skills and interests.
        </p>
        <p class="text-gray-600 mb-4">
          Each project comes with detailed information about what it entails, the skills required, and the time commitment. You can also see who else is working on the project and message them to ask questions or collaborate.
        </p>
        <p class="text-gray-600">
          Once you find a project that you want to work on, you can easily apply and start collaborating with the project owner and other team members.
        </p>
      </div>

      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Collaborate with Others</h2>
        <p class="text-gray-600 mb-4">
          Our application is all about bringing people together to work on exciting new projects. When you join a project, you'll be able to collaborate with other users from around the world who share your passion for the project.
        </p>
        <p class="text-gray-600 mb-4">
          You can use our built-in messaging system to communicate with other team members, share files, and stay up-to-date on the project's progress. You can also schedule meetings and assign tasks to keep everyone on track.
        </p>
        <p class="text-gray-600">
          Whether you're a seasoned professional or just starting out, you can learn from others, share your expertise, and work together to create something truly amazing.
        </p>
      </div>

      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Get Noticed by Employers</h2>
        <p class="text-gray-600 mb-4">
          Working on projects through our application is a great way to build your portfolio, showcase your skills, and get noticed by potential employers. You'll be able to add completed projects to your profile and share them with others.
        </p>
        <p class="text-gray-600 mb-4">
          Employers are always on the lookout for talented individuals who can work on real-world projects. By collaborating with others and creating something tangible, you'll be able to demonstrate your abilities and stand out from the crowd.
        </p>
      </div>
    </div>
     </div>
  </AuthenticatedLayout>
</template>

<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
</script>