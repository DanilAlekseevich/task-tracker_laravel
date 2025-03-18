<script setup lang="ts">
import { defineExpose, ref, defineProps } from "vue";
import { useForm } from '@inertiajs/vue3';
import {Board} from "@/types/types";

const props = defineProps<{
    board: Board
}>();

const isOpen = ref(false);

const form = useForm({
    name: props.board.name,
    description: props.board.description,
});

const openEditBoardModal = () => {
    isOpen.value = true;
};

const closeEditBoardModal = () => {
    isOpen.value = false;
    form.reset();
};

const submitBoard = () => {
    form.put(route('boards.update', props.board.id), {
        onSuccess: () => {
            closeEditBoardModal();
        },
        onError: (errors) => {
            console.error('Ошибка при обновлении доски:', errors);
        },
    });
};

defineExpose({ openEditBoardModal });
</script>

<template>
    <div class="modal-overlay" v-if="isOpen" @click.self="closeEditBoardModal">
        <div class="modal-content">
            <button class="close-button" @click="closeEditBoardModal">×</button>
            <h2>Редактировать доску</h2>
            <form @submit.prevent="submitBoard" class="board-form">
                <div class="form-group">
                    <label for="boardName">Название доски</label>
                    <input
                        id="boardName"
                        v-model="form.name"
                        placeholder="Введите название доски"
                        required
                    />
                    <span v-if="form.errors.name" class="error-message">{{ form.errors.name }}</span>
                </div>
                <div class="form-group">
                    <label for="boardDescription">Описание доски</label>
                    <textarea
                        id="boardDescription"
                        v-model="form.description"
                        placeholder="Введите описание доски"
                    ></textarea>
                    <span v-if="form.errors.description" class="error-message">{{ form.errors.description }}</span>
                </div>
                <button type="submit" class="submit-button" :disabled="form.processing">
                    {{ form.processing ? 'Сохранение...' : 'Сохранить' }}
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

.board-form {
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

