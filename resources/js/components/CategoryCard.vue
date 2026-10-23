<template>
  <router-link 
    :to="`/productos?cat=${slug}`"
    class="category-card"
    :class="{ 'is-highlighted': isHighlighted }"
  >
    <div class="category-icon">
      <i :class="icon"></i>
    </div>
    <h3>{{ name }}</h3>
    <p>{{ count }} productos</p>
    <div class="category-badge">{{ name }}</div>
  </router-link>
</template>

<script setup>
import { defineProps } from 'vue'

defineProps({
  id: {
    type: Number,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  slug: {
    type: String,
    required: true
  },
  icon: {
    type: String,
    required: true
  },
  count: {
    type: Number,
    default: 0
  },
  isHighlighted: {
    type: Boolean,
    default: false
  }
})
</script>

<style scoped>
:root {
  --color-primary: #C84617;
  --color-dark: #383838;
  --color-gray: #BABABA;
  --color-light: #f5f5f5;
}

.category-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
  padding: 20px;
  border-radius: 12px;
  background: var(--color-light);
  text-decoration: none;
  color: inherit;
  transition: all 0.3s ease;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.category-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: var(--color-primary);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: -1;
}

.category-card:hover::before {
  opacity: 1;
}

.category-card:hover {
  color: white;
  transform: translateY(-5px);
  box-shadow: 0 12px 24px rgba(200, 70, 23, 0.15);
}

.category-card.is-highlighted {
  background: var(--color-primary);
  color: white;
}

.category-icon {
  font-size: 32px;
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: rgba(200, 70, 23, 0.1);
  transition: all 0.3s ease;
}

.category-card:hover .category-icon,
.category-card.is-highlighted .category-icon {
  background: rgba(255, 255, 255, 0.2);
}

.category-card h3 {
  font-size: 1rem;
  font-weight: 600;
  margin: 0;
}

.category-card p {
  font-size: 0.85rem;
  opacity: 0.7;
  margin: 0;
}

.category-badge {
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  opacity: 0;
  transform: scale(0.8);
  transition: all 0.3s ease;
  text-transform: uppercase;
  color: var(--color-primary);
}

.category-card:hover .category-badge,
.category-card.is-highlighted .category-badge {
  opacity: 1;
  transform: scale(1);
  color: inherit;
}
</style>
