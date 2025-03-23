<template>
  <div class="login-container">
    <div class="login-box">
      <h1 class="login-title">Вход в систему</h1>
      <form @submit.prevent="submit" class="login-form">
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
        <div class="form-group">
          <label for="password" class="form-label">Пароль</label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            class="form-input"
            required
          />
          <span v-if="errors.password" class="error-message">{{ errors.password }}</span>
        </div>
        <button type="submit" class="submit-button">Войти</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
      }),
    };
  },
  computed: {
    errors() {
      return this.$page.props.errors;
    },
  },
  methods: {
    submit() {
      this.form.post(route('login'), {
        onSuccess: () => {
          this.form.reset();
        },
      });
    },
  },
};
</script>

<style scoped>
/* Основные стили для контейнера */
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f7fafc;
}

/* Стили для блока формы */
.login-box {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

/* Заголовок формы */
.login-title {
  font-size: 1.5rem;
  font-weight: bold;
  color: #2d3748;
  text-align: center;
  margin-bottom: 1.5rem;
}

/* Стили для формы */
.login-form {
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
