<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

// Инициализация формы
const form = useForm({
  name: '',
  description: '',
});

// Отправка формы
const submitForm = () => {
  form.post(route('projects.store'), {
    onSuccess: () => {
      form.reset(); // Очистка формы после успешного создания
    },
  });
};
</script>

<template>
  <div>
    <h1>Создание проекта</h1>
    <form @submit.prevent="submitForm">
      <div>
        <label for="name">Название проекта:</label>
        <input id="name" v-model="form.name" type="text" required />
      </div>
      <div>
        <label for="description">Описание проекта:</label>
        <textarea id="description" v-model="form.description"></textarea>
      </div>
      <button type="submit">Создать проект</button>
    </form>
  </div>
</template>

<style scoped>
/* Добавьте стили по необходимости */
</style>
