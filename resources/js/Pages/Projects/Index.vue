<template>
    <AppLayout>
        <div>
            <h1>Доступные проекты</h1>

            <Link href="/projects/create">Создать новый проект</Link>

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

defineProps({
    projects: Array,
});
</script>

<style scoped>
/* Добавьте стили по необходимости */
</style>
