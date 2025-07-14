<script setup>
defineProps({ tasks: Array });
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tasks</h1>
    <ul>
      <li v-for="task in tasks" :key="task.id" class="mb-2">
        <div class="p-4 bg-white shadow rounded">
          <h2 class="font-semibold">{{ task.title }}</h2>
          <p>{{ task.description }}</p>
          <p class="text-sm text-gray-500">Deadline: {{ task.deadline }}</p>
        </div>
      </li>
    </ul>
  </div>
</template>
