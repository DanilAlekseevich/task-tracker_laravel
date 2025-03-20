<template>
  <div>
    <h1>Создание нового пользователя</h1>
    <form @submit.prevent="submit">
      <!-- Поле для имени -->
      <div>
        <label for="name">Имя</label>
        <input
          id="name"
          v-model="form.name"
          type="text"
          required
        />
        <span v-if="errors.name" class="error">{{ errors.name }}</span>
      </div>

      <!-- Поле для email -->
      <div>
        <label for="email">Email</label>
        <input
          id="email"
          v-model="form.email"
          type="email"
          required
        />
        <span v-if="errors.email" class="error">{{ errors.email }}</span>
      </div>

      <!-- Кнопка отправки -->
      <div>
        <button type="submit" :disabled="form.processing">
          Создать пользователя
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
