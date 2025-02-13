    <template>
      <div class="task-card" @click="openTaskDetails">
        <h3>{{ task.title }}</h3>
        <div class="task-meta">
          <span class="priority" :class="priorityClass">{{ task.priority }}</span>
          <span class="due-date">{{ formattedDueDate }}</span>
        </div>
      </div>
    </template>

    <script setup lang="ts">
    import { router } from '@inertiajs/vue3'
    import { defineProps, computed } from 'vue';
    import { format } from 'date-fns';

    const props = defineProps({
      task: {
        type: Object,
        required: true,
      },
    });

    const openTaskDetails = () => {
        router.visit(`/tasks/${props.task.id}`);
    };

    const priorityClass = computed(() => {
      return {
        low: props.task.priority === 'low',
        medium: props.task.priority === 'medium',
        high: props.task.priority === 'high',
      };
    });

    const formattedDueDate = computed(() => {
      if (props.task.due_date) {
        return format(new Date(props.task.due_date), 'dd/MM/yyyy');
      }
      return '';
    });
    </script>

    <style scoped>
    .task-card {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: box-shadow 0.2s;
    }

    .task-card:hover {
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .task-meta {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .priority {
      padding: 2px 5px;
      border-radius: 3px;
      color: #fff;
    }

    .priority.low {
      background-color: #28a745;
    }

    .priority.medium {
      background-color: #ffc107;
    }

    .priority.high {
      background-color: #dc3545;
    }

    .due-date {
      font-size: 0.9em;
      color: #666;
    }
    </style>
