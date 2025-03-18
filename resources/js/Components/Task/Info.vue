<template>
    <div class="task-info-container">
        <div class="task-details">
            <div class="task-people">
                <p><strong>Исполнитель:</strong> {{ task.assignee.name }}</p>
                <p><strong>Постановщик:</strong> {{ task.creator.name }}</p>
            </div>
            <div class="task-time_tracking">
                <p><strong>Оценка:</strong> {{ task.estimated_hours }}</p>
                <p><strong>Зафиксированно:</strong> {{ task.logged_hours }}</p>
                <p><strong>Осталось:</strong> {{ }}</p>
            </div>

            <p><strong>Priority:</strong> <span :class="priorityClass">{{ task.priority }}</span></p>
            <p><strong>Column:</strong> {{ task.column.name }}</p>
        </div>
    </div>
</template>

<script lang="ts" setup>
import {defineProps} from 'vue';

interface User {
    id: number;
    name: string;
}

interface Column {
    id: number;
    name: string;
}

interface Task {
    creator: User;
    assignee: User;
    logged_hours: string;
    estimated_hours: string;
    priority: string;
    column: Column;
}

const props = defineProps<{
    task: Task;
}>();

const priorityClass = (priority: string) => {
    switch (priority) {
        case 'High':
            return 'priority-high';
        case 'Medium':
            return 'priority-medium';
        case 'Low':
            return 'priority-low';
        default:
            return '';
    }
};
</script>

<style scoped>
.task-info-container {
    border-left: 1px solid #e1e4e8;
    padding-left: 20px;
}

.task-details {
    margin-bottom: 20px;
    font-size: 14px;
    color: #34495e;
}

.priority-high {
    color: #e74c3c; /* Красный для высокого приоритета */
}

.priority-medium {
    color: #f39c12; /* Оранжевый для среднего приоритета */
}

.priority-low {
    color: #2ecc71; /* Зеленый для низкого приоритета */
}
</style>
