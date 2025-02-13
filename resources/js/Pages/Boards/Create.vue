<template>
  <div>
    <h1>Создание доски</h1>

    <form @submit.prevent="submitForm">
      <div>
        <label for="name">Название доски:</label>
        <input type="text" v-model="board.name" id="name" required />
      </div>

      <button type="submit">Создать доску</button>
    </form>

    <div v-if="error" class="error">{{ error }}</div>
  </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

// Инициализация формы
const form = useForm({
  name: '',
  project_id: '',
});

const submitForm = () => {
  form.post(route('boards.store'), {
    onSuccess: () => {
      form.reset(); // Очистка формы после успешного создания
    },
  });
};
</script>

<style scoped>
/* Добавьте стили по необходимости */
.error {
  color: red;
}
</style>
