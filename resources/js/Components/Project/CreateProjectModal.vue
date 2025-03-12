<script setup lang="ts">
import { defineExpose, ref } from "vue";
import { useForm } from '@inertiajs/vue3'; // Импортируем useForm

const isOpen = ref(false);

// Используем useForm для управления формой
const form = useForm({
    title: '',
    description: '',
});

// Открытие модального окна
const openCreateProjectModal = () => {
    isOpen.value = true;
};

// Закрытие модального окна
const closeCreateProjectModal = () => {
    isOpen.value = false;
    form.reset(); // Очистка формы
};

// Отправка формы
const submitProject = () => {
    form.post(route('projects.store'), {
        onSuccess: () => {
            closeCreateProjectModal(); // Закрыть модальное окно после успешной отправки
        },
        onError: (errors) => {
            console.error('Ошибка при создании проекта:', errors); // Обработка ошибок
        },
    });
};

// Экспортируем метод для открытия модального окна
defineExpose({ openCreateProjectModal });
</script>

<template>
    <div class="modal-overlay" v-if="isOpen" @click.self="closeCreateProjectModal">
        <div class="modal-content">
            <button class="close-button" @click="closeCreateProjectModal">×</button>
            <h2>Создать проект</h2>
            <form @submit.prevent="submitProject" class="project-form">
                <div class="form-group">
                    <label for="projectTitle">Название проекта</label>
                    <input
                        id="projectTitle"
                        v-model="form.title"
                        placeholder="Введите название проекта"
                        required
                    />
                    <!-- Отображение ошибок -->
                    <span v-if="form.errors.title" class="error-message">{{ form.errors.title }}</span>
                </div>
                <div class="form-group">
                    <label for="projectDescription">Описание проекта</label>
                    <textarea
                        id="projectDescription"
                        v-model="form.description"
                        placeholder="Введите описание проекта"
                    ></textarea>
                    <!-- Отображение ошибок -->
                    <span v-if="form.errors.description" class="error-message">{{ form.errors.description }}</span>
                </div>
                <button type="submit" class="submit-button" :disabled="form.processing">
                    {{ form.processing ? 'Создание...' : 'Создать' }}
                </button>
            </form>
        </div>
    </div>
</template>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    position: relative;
    width: 500px;
}

.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    border: none;
    background: none;
    font-size: 20px;
    cursor: pointer;
}

.project-form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 15px;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
}

input, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
}

.submit-button {
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.submit-button:hover {
    background-color: #218838;
}

.submit-button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

.error-message {
    color: red;
    font-size: 0.875rem;
    margin-top: 5px;
}
</style>
