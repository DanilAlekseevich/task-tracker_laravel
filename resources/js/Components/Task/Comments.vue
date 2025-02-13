<template>
  <div class="task-comments-container">
    <h2>Comments</h2>
    <ul class="comments-list">
      <li v-for="comment in comments" :key="comment.id" class="comment-item">
        <strong>{{ comment.user.name }}:</strong> {{ comment.content }}
      </li>
    </ul>
  </div>
</template>

<script lang="ts" setup>
import { defineProps } from 'vue';

interface User {
  id: number;
  name: string;
}

interface Comment {
  id: number;
  content: string;
  user: User
}

const props = defineProps<{
  comments: Comment[];
}>();
</script>

<style scoped>
.comments-list {
  list-style-type: none;
  padding: 0;
}

.comment-item {
  padding: 10px;
  border: 1px solid #e1e4e8;
  border-radius: 4px;
  margin-bottom: 10px;
  background-color: #ffffff;
}
</style>
