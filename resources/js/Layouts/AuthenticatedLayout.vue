<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-800">
            <nav class="bg-gray-800 border-b border-gray-100 fixed w-full z-10">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Home
                                </NavLink>
                                <NavLink :href="route('projects.browse')" :active="route().current('projects.browse')">
                                    Browse Projects
                                </NavLink>
                                <template v-if="$page.props.auth.user">
                                    <NavLink :href="route('project.create')" :active="route().current('project.create')">
                                        Create Project
                                    </NavLink>
                                    <NavLink :href="route('inbox')" :active="route().current('inbox')">
                                        Inbox
                                    </NavLink>
                                </template>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative " >
                                <Dropdown align="right" width="48" v-if="$page.props.auth.user" >
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  text-white  bg-purple-700 hover:text-white focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>

                                <div v-else>
                                    <nav>
                                        <ul class="flex gap-3 text-lg">
                                            <li><Link class="text-white hover:underline" :href="route('dashboard')">Home</Link></li>
                                            <li><Link class="text-white hover:underline" :href="route('login')">Login</Link></li>
                                            <li><Link class="text-white hover:underline" :href="route('register')">Register</Link></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Home
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('project.create')" :active="route().current('project.create')">
                            Create Project
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('inbox')" :active="route().current('inbox')">
                                        Inbox
                                    </ResponsiveNavLink>
                        <template  v-if="$page.props.auth.user">
                        <!-- Responsive Settings Options -->
                            <div class="pt-4 pb-1 border-t border-gray-200">
                                <div class="px-4">
                                    <div class="font-medium text-base text-white">
                                        {{ $page.props.auth.user.name }}
                                    </div>
                                    <div class="font-medium text-sm text-white">{{ $page.props.auth.user.email }}</div>
                                </div>

                                <div class="mt-3 space-y-1">
                                    <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                                    <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </ResponsiveNavLink>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <ResponsiveNavLink class="text-white hover:underline" :href="route('login')">Login</ResponsiveNavLink>
                            <ResponsiveNavLink class="text-white hover:underline" :href="route('register')">Register</ResponsiveNavLink>
                        </template>
                    </div>

                    
                    
                </div>
            </nav>


                
            


            <!-- Page Content -->
            <main>
                    <div class="py-16">
                        <div v-if="$page.props.message" class="text-green-700 bg-green-200 py-4 px-3 ">
                            {{$page.props.message}}
                        </div>
                    
                        <slot />
                    </div>
                
            </main>
            <footer class="bg-gray-800 py-12 px-10">
                <div class="container mx-auto">
                  <div class="flex flex-wrap justify-between items-center">
                    <div class="w-full md:w-1/4 lg:w-1/6">
                      <h4 class="text-lg font-bold mb-4 text-gray-100">Links</h4>
                      <ul>
                        <li><Link href="/" class="text-gray-400 hover:text-white transition-colors duration-300">Home</Link></li>
                        <li><Link href="/about" class="text-gray-400 hover:text-white transition-colors duration-300">About Us</Link></li>
                        <li><Link href="/services" class="text-gray-400 hover:text-white transition-colors duration-300">Services</Link></li>
                        <li><Link href="/contact" class="text-gray-400 hover:text-white transition-colors duration-300">Contact Us</Link></li>
                      </ul>
                    </div>
                    
                    <div class="w-full md:w-1/4 lg:w-1/6">
                      <h4 class="text-lg font-bold mb-4 text-gray-100">Social Media</h4>
                      <ul>
                        <li><Link href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Facebook</Link></li>
                        <li><Link href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Twitter</Link></li>
                        <li><Link href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Instagram</Link></li>
                      </ul>
                    </div>
                </div>
                </div>
                </footer>
        </div>
    </div>
</template>
