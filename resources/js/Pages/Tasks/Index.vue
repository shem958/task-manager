-<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Tasks</h1>
    <ul>
      <li v-for="task in tasks" :key="task.id">
        {{ task.title }} — {{ task.status ?? 'Pending' }}
      </li>
    </ul>
  </div>
</template>

<script setup>
defineProps({ tasks: Array });
</script>
