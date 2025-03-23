<template>
  <div class="create-user-container">
    <div class="create-user-box">
      <h1 class="create-user-title">Создание нового пользователя</h1>
      <form @submit.prevent="submit" class="create-user-form">
        <!-- Поле для имени -->
        <div class="form-group">
          <label for="name" class="form-label">Имя</label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            class="form-input"
            required
          />
          <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
        </div>

        <!-- Поле для email -->
        <div class="form-group">
          <label for="email" class="form-label">Email</label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            class="form-input"
            required
          />
          <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
        </div>

        <!-- Кнопка отправки -->
        <div class="form-group">
          <button type="submit" class="submit-button" :disabled="form.processing">
            Создать пользователя
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: this.$inertia.form({
        name: '', // Имя пользователя
        email: '', // Email пользователя
      }),
    };
  },
  computed: {
    // Ошибки валидации
    errors() {
      return this.$page.props.errors;
    },
  },
  methods: {
    // Обработка отправки формы
    submit() {
      this.form.post(route('user.store'), {
        onSuccess: () => {
          // Очистка формы после успешной отправки
          this.form.reset();
          // Можно добавить уведомление об успешном создании пользователя
          alert('Пользователь успешно создан!');
        },
        onError: () => {
          // Обработка ошибок (например, неверные данные)
          alert('Ошибка при создании пользователя. Проверьте введенные данные.');
        },
      });
    },
  },
};
</script>

<style scoped>
/* Основные стили для контейнера */
.create-user-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f7fafc;
}

/* Стили для блока формы */
.create-user-box {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

/* Заголовок формы */
.create-user-title {
  font-size: 1.5rem;
  font-weight: bold;
  color: #2d3748;
  text-align: center;
  margin-bottom: 1.5rem;
}

/* Стили для формы */
.create-user-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

/* Стили для группы полей */
.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

/* Стили для метки */
.form-label {
  font-size: 0.875rem;
  color: #4a5568;
}

/* Стили для поля ввода */
.form-input {
  padding: 0.75rem;
  border: 1px solid #e2e8f0;
  border-radius: 4px;
  font-size: 1rem;
  color: #2d3748;
  transition: border-color 0.2s;
}

.form-input:focus {
  outline: none;
  border-color: #3182ce;
  box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
}

/* Стили для сообщений об ошибках */
.error-message {
  color: #e53e3e;
  font-size: 0.875rem;
  margin-top: 0.25rem;
}

/* Стили для кнопки */
.submit-button {
  padding: 0.75rem;
  background-color: #3182ce;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.2s;
}

.submit-button:hover {
  background-color: #2c5282;
}

.submit-button:disabled {
  background-color: #cbd5e0;
  cursor: not-allowed;
}
</style>
