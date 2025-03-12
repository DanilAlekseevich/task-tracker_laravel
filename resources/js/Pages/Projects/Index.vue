<template>
    <AppLayout>
        <div >
            <div class="header-container">
                <h1>Доступные проекты</h1>

                <button class="create-project-button" @click="openCreateProjectModal">Создать проект</button>
                <CreateProjectModal ref="modal" />
            </div>

            <ul>
                <li v-for="project in projects" :key="project.id">
                    <Link :href="`/projects/${project.id}/boards`">{{ project.name }}</Link>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link} from '@inertiajs/vue3';
import {ref} from "vue";
import CreateProjectModal from "@/Components/Project/CreateProjectModal.vue";

defineProps({
    projects: Array,
});

const modal = ref(null);

const openCreateProjectModal = () => {
  if (modal.value) {
    modal.value.openCreateProjectModal(); // Теперь это должно работать
  }
};
</script>

<style scoped>
.header-container {
    display: flex; /* Используем Flexbox для выравнивания */
    justify-content: space-between; /* Распределяем элементы по ширине */
    align-items: center; /* Центрируем элементы по вертикали */
    margin-bottom: 1rem; /* Отступ снизу для разделения с остальным контентом */
}

.create-project-button {
    padding: 0.5rem 1rem; /* Отступы для кнопки */
    background-color: #01e2ff; /* Цвет фона кнопки */
    color: white; /* Цвет текста */
    border: none; /* Убираем рамку */
    border-radius: 4px; /* Скругление углов */
    cursor: pointer; /* Указатель при наведении */
    transition: background-color 0.3s; /* Плавный переход цвета фона */
}

.create-project-button:hover {
    background-color: #00bcd4; /* Цвет фона при наведении */
}
</style>
