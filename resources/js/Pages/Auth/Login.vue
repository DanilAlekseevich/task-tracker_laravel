<template>
  <div>
    <h1>Вход в систему</h1>
    <form @submit.prevent="submit">
      <div>
        <label for="email">Email</label>
        <input id="email" v-model="form.email" type="email" required />
        <span v-if="errors.email">{{ errors.email }}</span>
      </div>
      <div>
        <label for="password">Пароль</label>
        <input id="password" v-model="form.password" type="password" required />
        <span v-if="errors.password">{{ errors.password }}</span>
      </div>
      <button type="submit">Войти</button>
    </form>
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
/* Добавь стили по необходимости */
</style>
