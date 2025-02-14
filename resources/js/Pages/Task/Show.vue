<template>
    <AppLayout>
        <div class="task-container">
            <h1 class="task-title">{{ task.title }}</h1>
            <div class="task-content">
                <TaskDescription class="task-description" :task="task"/>
                <TaskInfo class="task-info" :task="task"/>
            </div>
            <TaskComments :comments="task.comments"/>
            <CommentForm />
        </div>
    </AppLayout>
</template>

<script lang="ts" setup>
import {defineProps} from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import TaskDescription from '../../Components/Task/Description.vue';
import TaskInfo from '../../Components/Task/Info.vue';
import TaskComments from '../../Components/Task/Comments.vue';
import CommentForm from '../../Components/Task/CommentForm.vue';

interface User {
    id: number;
    name: string;
}

interface Column {
    id: number;
    name: string;
}

interface Label {
    id: number;
    name: string;
}

interface Comment {
    id: number;
    content: string;
    user: User | null; // Пользователь может быть null
}

interface Activity {
    id: number;
    description: string;
    created_at: string;
}

interface Task {
    id: number;
    title: string;
    description: string;
    due_date: string;
    priority: string;
    column: Column;
    creator: User;
    assignee: User;
    comments: Comment[];
    labels: Label[];
    activities: Activity[];
}

const props = defineProps<{
    task: Task;
}>();
</script>

<style scoped>
.task-container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #e1e4e8;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.task-title {
    font-size: 24px;
    margin-bottom: 10px;
    color: #2c3e50;
}

.task-content {
    display: flex; /* Используем flex для размещения описания и информации в одной строке */
}

.task-description {
    flex: 0 0 70%; /* 70% ширины для описания задачи */
    margin-right: 20px; /* Отступ между описанием и информацией */
}

.task-info {
    flex: 0 0 30%; /* 30% ширины для информации о задаче */
}

.task-comments {
    margin-top: 20px; /* Отступ сверху для комментариев */
}
</style>
