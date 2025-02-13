<script setup lang="ts">
import Header from '../Components/Header.vue';
</script>

<template>
    <div class="layout-container">
        <Header />
        <main>
            <slot />
        </main>
    </div>
</template>

<style scoped>
.layout-container {
    max-width: 1200px; /* Максимальная ширина контейнера */
    margin: 0 auto; /* Центрирование контейнера */
    padding: 10px; /* Отступы внутри контейнера */
}

main {
    padding: 20px; /* Отступы для основного содержимого */
    background-color: #f9f9f9; /* Цвет фона для основного содержимого */
    border-radius: 8px; /* Закругленные углы */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Тень для основного содержимого */
}
</style>
