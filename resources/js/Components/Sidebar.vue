<template>
    <aside class="w-64 h-screen bg-contrast text-white">
      <div class="flex flex-col justify-between h-full">
        <!-- Top Section -->
        <div>
          <!-- Branding or Logo -->
          <div class="px-4 py-5">
            <!-- Replace with your logo or brand -->
            <h1 class="text-3xl font-bold">Web-Status</h1>
          </div>

          <!-- Search Bar -->
          <div class="px-4 py-2">
            <input type="search" placeholder="Search..."
                   class="w-full p-2 bg-gray-800 text-white placeholder-gray-400 border border-gray-700 rounded-md focus:ring-2 focus:ring-indigo-600">
          </div>

          <!-- Navigation Links -->
          <nav class="mt-5 px-2">
                <a href="/admin/dashboard" :class="navLinkClasses('/admin/dashboard')">
                    <font-awesome-icon :icon="['fas', 'house']" class="mr-2"></font-awesome-icon>
                    Dashboard
                </a>
                <a href="/admin/servers" :class="navLinkClasses('/admin/servers')">
                    <font-awesome-icon :icon="['fas', 'server']" class="mr-2"></font-awesome-icon>
                    Servers
                </a>
                <a href="/admin/pollers" :class="navLinkClasses('/admin/pollers')">
                    <font-awesome-icon :icon="['fas', 'location-dot']" class="mr-2"></font-awesome-icon>
                    Pollers
                </a>
                    <!-- Add more navigation links here, following the same pattern -->
         </nav>
        </div>

        <!-- Bottom Section (optional) -->
        <div class="px-4 py-5">
          <!-- User Account, Settings or Logout -->
        </div>
      </div>
    </aside>
  </template>

<script setup>
import { usePage } from '@inertiajs/vue3';
const page = usePage();
console.log(page.url);

function navLinkClasses(path) {
    return [
        'flex items-center px-4 py-2 mt-2 text-sm font-semibold group',
        { 'border-l-4 border-blue-500': page.url.startsWith(path), 'group-hover:text-blue-500': !page.url.startsWith(path) }
    ];
}
</script>
