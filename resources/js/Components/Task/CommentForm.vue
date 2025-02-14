<template>
    <div class="comment-form">
        <textarea v-model="comment" placeholder="Напишите комментарий..." rows="3"></textarea>
        <button @click="submitComment">Отправить</button>
    </div>
</template>

<script lang="ts" setup>
import {ref} from 'vue';
import {router} from '@inertiajs/vue3'

const comment = ref('');

const submitComment = () => {
    if (comment.value.trim() === '') {
        return; // Не отправляем пустой комментарий
    }

    router.post(`/comment`, {content: comment.value})
    comment.value = '';
};
</script>

<style scoped>
.comment-form {
    margin-top: 20px; /* Отступ сверху */
}

textarea {
    width: 100%; /* Ширина текстового поля */
    padding: 10px; /* Отступы внутри текстового поля */
    border: 1px solid #ddd; /* Рамка текстового поля */
    border-radius: 4px; /* Скругление углов */
    resize: none; /* Запрет изменения размера */
}

button {
    margin-top: 10px; /* Отступ сверху для кнопки */
    padding: 10px 15px; /* Отступы внутри кнопки */
    background-color: #28a745; /* Цвет фона кнопки */
    color: white; /* Цвет текста */
    border: none; /* Убираем рамку */
    border-radius: 4px; /* Скругление углов */
    cursor: pointer; /* Указатель при наведении */
}

button:hover {
    background-color: #218838; /* Цвет фона при наведении */
}
</style>
