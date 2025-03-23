<script setup lang="ts">
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Modal from './Task/Modal.vue';

const modal = ref(null);
const isDropdownOpen = ref(false); // Состояние выпадающего меню

const openTaskModal = () => {
  if (modal.value) {
    modal.value.openModal(); // Открываем модальное окно
  }
};

// Выход из системы
const logout = () => {
  router.post(route('logout'));
};

// Переход на страницу редактирования профиля
const editProfile = () => {
  router.get(route('profile.edit'));
};
</script>

<template>
  <header class="header">
    <nav class="navbar">
      <!-- Левая часть навигации -->
      <ul class="nav-list">
        <li class="nav-item"><Link href="/projects">Проекты</Link></li>
        <li class="nav-item"><Link href="/boards">Доски</Link></li>
        <li class="nav-item" @click="openTaskModal">Создать задачу</li>
        <Modal ref="modal" />
      </ul>

      <!-- Правая часть: текущий пользователь и выпадающее меню -->
      <div class="user-menu">
        <div class="user-info" @click="isDropdownOpen = !isDropdownOpen">
          <span class="user-name">{{ $page.props.auth.user.name }}</span>
          <svg
            class="dropdown-icon"
            :class="{ 'rotate-180': isDropdownOpen }"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"
            />
          </svg>
        </div>

        <!-- Выпадающее меню -->
        <div v-if="isDropdownOpen" class="dropdown-menu">
          <button class="dropdown-item" @click="editProfile">Редактировать профиль</button>
          <button class="dropdown-item" @click="logout">Выйти</button>
        </div>
      </div>
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
  color: #ffffff; /* Цвет текста */
  text-decoration: none; /* Убираем подчеркивание */
  font-weight: 500; /* Полужирный шрифт */
  transition: color 0.3s; /* Плавный переход цвета */
  cursor: pointer; /* Курсор в виде указателя */
}

.nav-item:hover {
  color: #e1f5fe; /* Цвет текста при наведении */
}

/* Стили для блока пользователя */
.user-menu {
  position: relative; /* Для позиционирования выпадающего меню */
}

.user-info {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  color: #ffffff;
  font-weight: 500;
}

.user-name {
  margin-right: 0.5rem;
}

.dropdown-icon {
  width: 1.25rem;
  height: 1.25rem;
  transition: transform 0.2s;
}

.dropdown-icon.rotate-180 {
  transform: rotate(180deg);
}

/* Стили для выпадающего меню */
.dropdown-menu {
  position: absolute;
  right: 0;
  top: 2.5rem;
  background-color: white;
  border-radius: 4px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  min-width: 150px;
  z-index: 1000;
}

.dropdown-item {
  display: block;
  width: 100%;
  padding: 0.75rem 1rem;
  text-align: left;
  color: #2d3748;
  font-size: 0.875rem;
  font-weight: 500;
  background: none;
  border: none;
  cursor: pointer;
  transition: background-color 0.2s;
}

.dropdown-item:hover {
  background-color: #f7fafc;
}
</style>
