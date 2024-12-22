<script setup>
import { ref } from "vue";

const count = ref(0);

const increment = () => {
    count.value++;
};
</script>

<template>
    <div>
        <button @click="increment">
            {{ count }}
        </button>
    </div>
</template>
