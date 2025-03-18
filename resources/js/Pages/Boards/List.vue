<template>
    <AppLayout>
        <div>
            <div class="header-container">
                <button class="create-board-button" @click="openModal">Создать доску</button>
                <CreateBoardModal ref="modal" :project-id="2"/>
            </div>

            <div v-for="(board, index) in boards" :key="board.id" class="board-container">
                <h2>
                    <Link class="board-name" :href="`/boards/${board.id}/columns`">{{ board.name }}</Link>
                </h2>
                <div class="board-actions">
                    <button class="edit-button" @click="openEditModal(index)">Редактировать</button>
                    <EditBoardModal :ref="(el) => setEditModalRef(el, index)" :board="board"/>
                    <button class="delete-button">Удалить</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import {Link} from '@inertiajs/vue3'
import AppLayout from "@/Layouts/AppLayout.vue";
import {defineProps, ref} from 'vue';
import CreateBoardModal from "@/Components/Board/CreateBoardModal.vue";
import EditBoardModal from "@/Components/Board/EditBoardModal.vue";
import {Board} from "@/types/types";

const modal = ref(null);
const editModal = ref([]);

const openModal = () => {
    if (modal.value) {
        modal.value.openCreateBoardModal();
    }
};

const setEditModalRef = (el, index) => {
    editModal.value[index] = el; // Сохраняем ссылку на модальное окно
};
const openEditModal = (index) => {
    if (editModal.value[index]) {
        editModal.value[index].openEditBoardModal(); // Открываем конкретное модальное окно
    }
};

const props = defineProps<{
    boards: Board[];
}>();
</script>

<style scoped>
.header-container {
    display: flex; /* Используем Flexbox для выравнивания */
    justify-content: space-between; /* Распределяем элементы по ширине */
    align-items: center; /* Центрируем элементы по вертикали */
    margin-bottom: 1rem; /* Отступ снизу для разделения с остальным контентом */
}

.create-board-button {
    padding: 0.5rem 1rem; /* Отступы для кнопки */
    background-color: #01e2ff; /* Цвет фона кнопки */
    color: white; /* Цвет текста */
    border: none; /* Убираем рамку */
    border-radius: 4px; /* Скругление углов */
    cursor: pointer; /* Указатель при наведении */
    transition: background-color 0.3s; /* Плавный переход цвета фона */
}

.create-board-button:hover {
    background-color: #00bcd4; /* Цвет фона при наведении */
}

.board-container {
    display: flex; /* Используем Flexbox для выравнивания */
    justify-content: space-between; /* Распределяем элементы по ширине */
    align-items: center; /* Центрируем элементы по вертикали */
    margin-bottom: 1rem; /* Отступ снизу для разделения с остальным контентом */
}

.board-actions {
    display: flex; /* Используем Flexbox для кнопок */
    gap: 0.5rem; /* Отступы между кнопками */
}

.edit-button, .delete-button {
    padding: 0.5rem 0.75rem; /* Отступы для кнопок */
    background-color: #4CAF50; /* Цвет фона для кнопки редактирования */
    color: white; /* Цвет текста */
    border: none; /* Убираем рамку */
    border-radius: 4px; /* Скругление углов */
    cursor: pointer; /* Указатель при наведении */
    transition: background-color 0.3s; /* Плавный переход цвета фона */
}

.edit-button:hover {
    background-color: #45a049; /* Цвет фона при наведении для кнопки редактирования */
}

.delete-button {
    background-color: #f44336; /* Цвет фона для кнопки удаления */
}

.delete-button:hover {
    background-color: #e53935; /* Цвет фона при наведении для кнопки удаления */
}
</style>
