<script setup>
defineProps({ tasks: Array });
</script>

<template>
  <div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-gray-800">My Tasks</h1>
      <a href="/tasks/create" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        + New Task
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="task in tasks"
        :key="task.id"
        class="bg-white shadow-lg rounded-xl p-5 border border-gray-200"
      >
        <div class="flex justify-between items-start mb-2">
          <h2 class="text-xl font-semibold text-gray-700">{{ task.title }}</h2>
          <span
            class="text-xs px-2 py-1 rounded-full"
            :class="task.status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'"
          >
            {{ task.status || 'Pending' }}
          </span>
        </div>
        <p class="text-gray-600 mb-3">
          {{ task.description || 'No description provided.' }}
        </p>
        <p class="text-sm text-gray-500 mb-2">
          Deadline: <strong>{{ task.deadline }}</strong>
        </p>

        <div class="flex justify-end space-x-2">
          <a
            :href="`/tasks/${task.id}/edit`"
            class="text-sm px-3 py-1 rounded bg-indigo-500 text-white hover:bg-indigo-600"
          >
            Edit
          </a>
          <form
            :action="`/tasks/${task.id}`"
            method="POST"
            @submit.prevent="confirmDelete(task.id)"
          >
            <input type="hidden" name="_method" value="DELETE" />
            <button
              type="submit"
              class="text-sm px-3 py-1 rounded bg-red-500 text-white hover:bg-red-600"
            >
              Delete
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    confirmDelete(id) {
      if (confirm("Are you sure you want to delete this task?")) {
        // Let form proceed
        this.$el.querySelector(`form[action="/tasks/${id}"]`).submit();
      }
    },
  },
};
</script>
