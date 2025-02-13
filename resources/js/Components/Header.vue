<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

</script>
<template>
  <header class="header">
    <nav class="navbar">
      <ul class="nav-list">
        <li class="nav-item"><Link href="/projects">Проекты</Link></li>
        <li class="nav-item"><Link href="/about">Доски</Link></li>
        <li class="nav-item"><Link href="/task">Создать задачу</Link></li>
      </ul>
    </nav>
  </header>
</template>

<style scoped>
.header {
  background-color: #018dff; /* Темно-синий фон */
  padding: 1rem 2rem; /* Отступы сверху и снизу, слева и справа */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Тень для эффекта поднятия */
}

.navbar {
  display: flex; /* Используем Flexbox для выравнивания */
  justify-content: space-between; /* Распределяем элементы по ширине */
  align-items: center; /* Центрируем элементы по вертикали */
}

.nav-list {
  list-style: none; /* Убираем маркеры списка */
  display: flex; /* Используем Flexbox для списка */
  margin: 0; /* Убираем отступы */
  padding: 0; /* Убираем внутренние отступы */
}

.nav-item {
  margin: 0 1.5rem; /* Отступы между элементами навигации */
}

.nav-item a {
  color: #ffffff; /* Цвет текста */
  text-decoration: none; /* Убираем подчеркивание */
  font-weight: 500; /* Полужирный шрифт */
  transition: color 0.3s; /* Плавный переход цвета */
}

.nav-item a:hover {
  color: #E1F5FE; /* Цвет текста при наведении */
}
</style>
