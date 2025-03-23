<template>
  <div class="change-password-container">
    <div class="change-password-box">
      <h1 class="change-password-title">Смена пароля</h1>
      <form @submit.prevent="submit" class="change-password-form">
        <!-- Текущий пароль -->
        <div class="form-group">
          <label for="current_password" class="form-label">Текущий пароль</label>
          <input
            id="current_password"
            v-model="form.current_password"
            type="password"
            class="form-input"
            required
          />
          <span v-if="errors.current_password" class="error-message">
            {{ errors.current_password }}
          </span>
        </div>

        <!-- Новый пароль -->
        <div class="form-group">
          <label for="new_password" class="form-label">Новый пароль</label>
          <input
            id="new_password"
            v-model="form.new_password"
            type="password"
            class="form-input"
            required
          />
          <span v-if="errors.new_password" class="error-message">
            {{ errors.new_password }}
          </span>
        </div>

        <!-- Подтверждение нового пароля -->
        <div class="form-group">
          <label for="new_password_confirmation" class="form-label">Подтвердите новый пароль</label>
          <input
            id="new_password_confirmation"
            v-model="form.new_password_confirmation"
            type="password"
            class="form-input"
            required
          />
          <span v-if="errors.new_password_confirmation" class="error-message">
            {{ errors.new_password_confirmation }}
          </span>
        </div>

        <!-- Кнопка отправки -->
        <div class="form-group">
          <button type="submit" class="submit-button" :disabled="form.processing">
            Сменить пароль
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
        current_password: '', // Текущий пароль
        new_password: '', // Новый пароль
        new_password_confirmation: '', // Подтверждение нового пароля
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
      this.form.post(route('password.change'), {
        onSuccess: () => {
          // Очистка формы после успешной отправки
          this.form.reset();
          // Можно добавить уведомление об успешной смене пароля
          alert('Пароль успешно изменен!');
        },
        onError: () => {
          // Обработка ошибок (например, неверный текущий пароль)
          alert('Ошибка при смене пароля. Проверьте введенные данные.');
        },
      });
    },
  },
};
</script>

<style scoped>
/* Основные стили для контейнера */
.change-password-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f7fafc;
}

/* Стили для блока формы */
.change-password-box {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

/* Заголовок формы */
.change-password-title {
  font-size: 1.5rem;
  font-weight: bold;
  color: #2d3748;
  text-align: center;
  margin-bottom: 1.5rem;
}

/* Стили для формы */
.change-password-form {
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
