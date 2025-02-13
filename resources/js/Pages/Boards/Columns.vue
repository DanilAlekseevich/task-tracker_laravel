<template>
  <div>
    <h1>Колонки для доски: {{ boardName }}</h1>
    <div class="columns-container">
      <div v-for="(column, index) in columns" :key="column.id" class="column">
        <h2>{{ column.name }}</h2>
        <ul :ref="(el) => setColumnRef(el, index)" class="tasks">
          <li v-for="task in column.tasks" :key="task.id" class="task-item">
            <TaskCard :task="task" />
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useSortable } from '@vueuse/integrations/useSortable';
import TaskCard from '../../Components/TaskCard.vue';
import axios from 'axios';

// Определяем props
const props = defineProps({
  columns: {
    type: Array as () => Array<{ id: number; name: string; tasks: Array<any> }>,
    required: true,
  },
  boardName: {
    type: String,
    required: true,
  },
  boardId: {
    type: Number,
    required: true,
  },
});

// Создаем массив ref для каждой колонки
const columnRefs = ref<HTMLElement[]>([]);

// Функция для установки ref
const setColumnRef = (el: HTMLElement, index: number) => {
  if (el) {
    columnRefs.value[index] = el;
  }
};

// Применяем useSortable для каждой колонки после монтирования
onMounted(() => {
  columnRefs.value.forEach((el, index) => {
    if (el) {
      useSortable(el, {
        onUpdate: (event) => {
          const { oldIndex, newIndex } = event;
          console.log('Task moved from index:', oldIndex, 'to index:', newIndex);

          // Обновляем данные в columns
          const movedTask = props.columns[index].tasks.splice(oldIndex, 1)[0];
          props.columns[index].tasks.splice(newIndex, 0, movedTask);

          // Отправляем запрос на сервер для обновления позиции задачи
          updateTaskPosition(movedTask.id, props.columns[index].id, newIndex);
        },
      });
    }
  });
});

// Функция для обновления позиции задачи на сервере
const updateTaskPosition = async (taskId: number, columnId: number, newIndex: number) => {
  try {
    const response = await axios.post('/api/tasks/update-position', {
      task_id: taskId,
      column_id: columnId,
      order: newIndex,
    });

    if (response.data.success) {
      console.log('Task position updated successfully');
    } else {
      console.error('Failed to update task position');
    }
  } catch (error) {
    console.error('Error updating task position:', error);
  }
};
</script>

<style scoped>
.columns-container {
  display: flex;
  gap: 20px;
}

.column {
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  width: 250px;
}

.column h2 {
  margin: 0 0 10px;
}

.tasks {
  margin-top: 10px;
  list-style: none;
  padding: 0;
}

.task-item {
  margin-bottom: 10px;
}
</style>
