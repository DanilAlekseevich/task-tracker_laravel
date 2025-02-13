<template>
  <div class="task-description-container">
    <p class="task-description"><strong>Description:</strong> {{ task.description }}</p>
  </div>
</template>

<script lang="ts" setup>
import { defineProps } from 'vue';

interface User {
  id: number;
  name: string;
}

interface Comment {
  id: number;
  body: string;
  user: User | null; // Пользователь может быть null
}

interface Task {
  description: string;
  comments: Comment[];
}

const props = defineProps<{
  task: Task;
}>();
</script>

<style scoped>
.task-description {
  font-size: 16px;
  margin-bottom: 20px;
}
</style>
