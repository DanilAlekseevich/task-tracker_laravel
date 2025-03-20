<template>
  <div>
    <h1>Смена пароля</h1>
    <form @submit.prevent="submit">
      <!-- Текущий пароль -->
      <div>
        <label for="current_password">Текущий пароль</label>
        <input
          id="current_password"
          v-model="form.current_password"
          type="password"
          required
        />
        <span v-if="errors.current_password" class="error">
          {{ errors.current_password }}
        </span>
      </div>

      <!-- Новый пароль -->
      <div>
        <label for="new_password">Новый пароль</label>
        <input
          id="new_password"
          v-model="form.new_password"
          type="password"
          required
        />
        <span v-if="errors.new_password" class="error">
          {{ errors.new_password }}
        </span>
      </div>

      <!-- Подтверждение нового пароля -->
      <div>
        <label for="new_password_confirmation">Подтвердите новый пароль</label>
        <input
          id="new_password_confirmation"
          v-model="form.new_password_confirmation"
          type="password"
          required
        />
        <span v-if="errors.new_password_confirmation" class="error">
          {{ errors.new_password_confirmation }}
        </span>
      </div>

      <!-- Кнопка отправки -->
      <div>
        <button type="submit" :disabled="form.processing">
          Сменить пароль
        </button>
      </div>
    </form>
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
/* Стили для формы */
.error {
  color: red;
  font-size: 0.875rem;
  margin-top: 0.25rem;
}

form div {
  margin-bottom: 1rem;
}

label {
  display: block;
  margin-bottom: 0.5rem;
}

input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  padding: 0.5rem 1rem;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}
</style>
