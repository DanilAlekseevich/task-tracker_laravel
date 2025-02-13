<template>
    <AppLayout>
        <div>
            <h1>{{ boardName }}</h1>
            <div class="columns-container">
                <div v-for="(column, index) in columns" :key="column.id" class="column">
                    <h2>{{ column.name }}</h2>
                    <ul class="tasks">
                        <li v-for="task in column.tasks" :key="task.id" class="task-item">
                            <TaskCard :task="task"/>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import TaskCard from '../../Components/TaskCard.vue';
import AppLayout from "@/Layouts/AppLayout.vue";

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
