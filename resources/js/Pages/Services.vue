<template>
<AuthenticatedLayout>
      <div class="p-10">
        <div class="container mx-auto pt-[100px]">
          <h1 class="text-4xl font-bold mb-6 text-white">Our Services</h1>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <ServiceCard
              title="Find Projects"
              description="Our platform connects professionals to projects posted by people looking for help. Browse the latest projects and find your next opportunity to showcase your skills."
              icon="search"
            />
            <ServiceCard
              title="Create Projects"
              description="Looking for professionals to help you bring your project to life? Post your project on our platform and get the support you need from experts in technology, design, and more."
              icon="create"
            />
            <ServiceCard
              title="Collaborate with Others"
              description="Connect with other professionals on our platform to collaborate on projects, share ideas, and build your network. Our community is full of talented and motivated individuals looking to make an impact in their fields."
              icon="people"
            />
            <ServiceCard
              title="Get Feedback"
              description="Need feedback on your work? Share your project with our community and get constructive feedback from experts in your field. Our community is passionate about helping others grow and succeed."
              icon="feedback"
            />
            <ServiceCard
              title="Grow Your Skills"
              description="Our platform offers a variety of resources to help you grow your skills and stay up-to-date on the latest trends in technology and design. From online courses to mentorship opportunities, we have everything you need to succeed."
              icon="skills"
            />
            <ServiceCard
              title="Find Jobs"
              description="Our platform is the perfect place to find your next job opportunity. With access to a diverse range of projects and professionals, you're sure to find a job that matches your skills and interests."
              icon="jobs"
            />
          </div>
        </div>
      </div>
  </AuthenticatedLayout>
</template>

<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
  import ServiceCard from '@/Components/ServiceCard.vue';
</script>