<template>
    <div class="modal-overlay" v-if="isOpen" @click.self="closeModal">
        <div class="modal-content">
            <button class="close-button" @click="closeModal">×</button>
            <h2>Создать задачу</h2>
            <form @submit.prevent="submitTask" class="task-form">
                <div class="form-group">
                    <label for="taskTitle">Название задачи</label>
                    <input id="taskTitle" v-model="taskTitle" placeholder="Введите название задачи" required/>
                </div>
                <div class="form-group">
                    <label for="taskDescription">Описание задачи</label>
                    <textarea id="taskDescription" v-model="taskDescription"
                              placeholder="Введите описание задачи"></textarea>
                </div>
                <div class="form-group">
                    <label for="executor">Исполнитель</label>
                    <input id="executor" v-model="selectedExecutor" @focus="fetchExecutors"
                           placeholder="Выберите исполнителя" readonly/>
                    <ul v-if="executors.length" class="dropdown-list">
                        <li v-for="executor in executors" :key="executor.id" @click="selectExecutor(executor)">
                            {{ executor.name }}
                        </li>
                    </ul>
                </div>
                <button type="submit" class="submit-button">Создать</button>
            </form>
        </div>
    </div>
</template>

<script lang="ts" setup>
import {ref, defineExpose} from 'vue';
import axios from 'axios';

const isOpen = ref(false);
const taskTitle = ref('');
const taskDescription = ref('');
const selectedExecutor = ref('');
const executors = ref([]);

const openModal = () => {
    isOpen.value = true;
};

const closeModal = () => {
    isOpen.value = false;
    resetForm();
};

const resetForm = () => {
    taskTitle.value = '';
    taskDescription.value = '';
      selectedExecutor.value = '';
  executors.value = [];
};

const fetchExecutors = async () => {
  try {
    const response = await axios.get('/api/executors');
    executors.value = response.data;
  } catch (error) {
    console.error('Ошибка при получении исполнителей:', error);
  }
};

const selectExecutor = (executor) => {
  selectedExecutor.value = executor.name;
  executors.value = []; // Скрываем список после выбора
};

const submitTask = () => {
    console.log('Создана задача:', {title: taskTitle.value, description: taskDescription.value});
    closeModal();
};

// Экспортируем метод openModal для доступа из родительского компонента
defineExpose({openModal});
</script>

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

.task-form {
    display: flex;
    flex-direction: column; /* Располагаем элементы вертикально */
}

.form-group {
    margin-bottom: 15px; /* Отступ между группами */
}

label {
    margin-bottom: 5px; /* Отступ между меткой и полем ввода */
    font-weight: bold; /* Полужирный шрифт для меток */
}

input, textarea {
    width: 100%; /* Ширина 100% для полей ввода */
    padding: 10px; /* Отступы внутри полей */
    border: 1px solid #ddd; /* Рамка для полей */
    border-radius: 4px; /* Скругление углов */
    box-sizing: border-box; /* Учитываем отступы и рамки в ширине */
}

textarea {
    resize: vertical; /* Позволяем изменять размер только по вертикали */
}

.submit-button {
    padding: 10px; /* Отступы внутри кнопки */
    background-color: #28a745; /* Цвет фона кнопки */
    color: white; /* Цвет текста */
    border: none; /* Убираем рамку */
    border-radius: 4px; /* Скругление углов */
    cursor: pointer; /* Указатель при наведении */
}

.submit-button:hover {
    background-color: #218838; /* Цвет фона при наведении */
}

.dropdown-list {
    border: 1px solid #ddd;
    background-color: white;
    position: absolute;
    z-index: 1000;
    width: 100%;
    max-height: 150px;
    overflow-y: auto;
    margin-top: 5px;
    padding: 0;
    list-style: none;
}

.dropdown-list li {
    padding: 10px;
    cursor: pointer;
}

.dropdown-list li:hover {
    background-color: #f0f0f0;
}
</style>
