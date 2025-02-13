<template>
  <div>
    <h1>Мои проекты</h1>

     <Link href="/projects/create">Создать новый проект</Link>

    <ul>
      <li v-for="project in projects" :key="project.id">
        <Link :href="`/projects/${project.id}/boards`">{{ project.name }}</Link>
          <p>{{ project.description }}</p>
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps({
  projects: Array,
});
</script>

<style scoped>
/* Добавьте стили по необходимости */
</style>
