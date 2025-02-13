<template>
    <div>
        <h1>Доски проекта: {{ project.name }}</h1>
        <button @click="showCreateBoardForm = true">Создать доску</button>

        <!-- Форма создания доски -->
        <div v-if="showCreateBoardForm">
            <input v-model="newBoardName" placeholder="Название доски"/>
            <button @click="createBoard">Создать</button>
            <button @click="showCreateBoardForm = false">Отмена</button>
        </div>

        <!-- Список досок -->
        <div v-for="board in boards" :key="board.id">
            <h2>{{ board.name }}</h2>
            <button @click="editBoard(board)">Редактировать</button>
            <button @click="deleteBoard(board)">Удалить</button>

            <!-- Форма редактирования доски -->
            <div v-if="board.editing">
                <input v-model="board.name"/>
                <button @click="updateBoard(board)">Сохранить</button>
                <button @click="cancelEdit(board)">Отмена</button>
            </div>
        </div>
    </div>

    <div v-for="column in board.columns" :key="column.id">
        <h3>{{ column.name }}</h3>
        <ul>
            <li v-for="task in column.tasks" :key="task.id">
                {{ task.title }}
            </li>
        </ul>
    </div>

    <div v-for="column in board.columns" :key="column.id">
        <h3>{{ column.name }}</h3>
        <ul>
            <li v-for="task in column.tasks" :key="task.id">
                {{ task.title }}
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import {ref} from 'vue';
import {router} from '@inertiajs/vue3';

const props = defineProps({
    project: Object,
    boards: Array,
});

const showCreateBoardForm = ref(false);
const newBoardName = ref('');

const createBoard = () => {
    router.post(route('boards.store', props.project.id), {
        name: newBoardName.value,
    }, {
        onSuccess: () => {
            showCreateBoardForm.value = false;
            newBoardName.value = '';
        },
    });
};

const editBoard = (board) => {
    board.editing = true;
};

const updateBoard = (board) => {
    router.put(route('boards.update', board.id), {
        name: board.name,
    }, {
        onSuccess: () => {
            board.editing = false;
        },
    });
};

const cancelEdit = (board) => {
    board.editing = false;
};

const deleteBoard = (board) => {
    if (confirm('Вы уверены, что хотите удалить доску?')) {
        router.delete(route('boards.destroy', board.id));
    }
};
</script>

<style scoped>
/* Добавьте стили по необходимости */
</style>
