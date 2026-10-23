<template>
  <div class="product-card" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
    <div class="product-image">
      <img 
        :src="productImage"
        :alt="product.name"
        class="product-img"
      />
      <div v-if="isHovered" class="product-overlay">
        <router-link :to="`/producto/${product.id}`" class="btn btn-primary">
          Ver Detalles
        </router-link>
        <button class="btn btn-secondary" @click="addToCart">
          Agregar al Carrito
        </button>
      </div>
      <div v-if="product.discount" class="discount-badge">
        -{{ product.discount }}%
      </div>
    </div>
    <div class="product-info">
      <p class="product-brand">{{ brandName }}</p>
      <h3 class="product-name">{{ product.name }}</h3>
      <p class="product-category">{{ categoryName }}</p>
      
      <div class="product-rating" v-if="product.rating">
        <div class="stars">
          <i v-for="n in 5" :key="n" :class="['fas fa-star', { 'filled': n <= product.rating }]"></i>
        </div>
        <span class="rating-count">({{ product.ratingCount || 0 }})</span>
      </div>

      <div class="product-footer">
        <div class="product-prices">
          <span v-if="product.originalPrice" class="original-price">${{ formatPrice(product.originalPrice) }}</span>
          <span class="product-price">${{ formatPrice(product.price) }}</span>
        </div>
        <button class="btn-icon" :class="{ 'is-liked': isLiked }" @click="toggleLike" title="Agregar a favoritos">
          <i class="fas fa-heart"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, defineProps, defineEmits } from 'vue'

const props = defineProps({
  product: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['add-to-cart', 'toggle-like'])

const isHovered = ref(false)
const isLiked = ref(false)

const productImage = computed(() => {
  return props.product.galeria_imagenes?.[0] || '/images/placeholder.webp'
})

const brandName = computed(() => {
  return typeof props.product.brand === 'string' 
    ? props.product.brand 
    : props.product.brand?.nombre || 'Sin marca'
})

const categoryName = computed(() => {
  return typeof props.product.category === 'string' 
    ? props.product.category 
    : props.product.category?.nombre || 'General'
})

const formatPrice = (price) => {
  return parseFloat(price).toLocaleString('es-MX', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 2
  })
}

const addToCart = () => {
  emit('add-to-cart', props.product)
}

const toggleLike = () => {
  isLiked.value = !isLiked.value
  emit('toggle-like', props.product)
}
</script>

<style scoped>
:root {
  --color-primary: #C84617;
  --color-dark: #383838;
  --color-gray: #BABABA;
  --color-light: #f5f5f5;
  --color-white: #ffffff;
}

.product-card {
  background: var(--color-white);
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.product-card:hover {
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
  transform: translateY(-4px);
}

.product-image {
  position: relative;
  height: 250px;
  overflow: hidden;
  background: var(--color-light);
  flex-shrink: 0;
}

.product-img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  padding: 20px;
  transition: transform 0.3s ease;
}

.product-card:hover .product-img {
  transform: scale(1.05);
}

.product-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 12px;
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 10;
}

.product-card:hover .product-overlay {
  opacity: 1;
}

.discount-badge {
  position: absolute;
  top: 12px;
  right: 12px;
  background: var(--color-primary);
  color: white;
  padding: 6px 12px;
  border-radius: 4px;
  font-weight: 600;
  font-size: 0.85rem;
  z-index: 5;
}

.product-info {
  padding: 16px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.product-brand {
  font-size: 0.85rem;
  color: var(--color-primary);
  font-weight: 600;
  margin-bottom: 4px;
  margin: 0;
}

.product-name {
  font-size: 1rem;
  font-weight: 600;
  color: var(--color-dark);
  margin-bottom: 4px;
  line-height: 1.3;
  margin: 0 0 4px 0;
}

.product-category {
  font-size: 0.85rem;
  color: var(--color-gray);
  margin-bottom: 8px;
  margin: 0 0 8px 0;
}

.product-rating {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 12px;
  font-size: 0.85rem;
}

.stars {
  display: flex;
  gap: 2px;
}

.stars i {
  color: var(--color-light);
  font-size: 0.75rem;
}

.stars i.filled {
  color: #FFC107;
}

.rating-count {
  color: var(--color-gray);
  font-size: 0.8rem;
}

.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: auto;
  padding-top: 12px;
  border-top: 1px solid var(--color-light);
}

.product-prices {
  display: flex;
  gap: 8px;
  align-items: baseline;
}

.original-price {
  font-size: 0.85rem;
  color: var(--color-gray);
  text-decoration: line-through;
}

.product-price {
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--color-primary);
}

.btn {
  padding: 10px 16px;
  border: none;
  border-radius: 4px;
  font-size: 0.9rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-block;
}

.btn-primary {
  background: var(--color-primary);
  color: white;
}

.btn-primary:hover {
  background: #a83512;
}

.btn-secondary {
  background: white;
  color: var(--color-primary);
  border: 2px solid var(--color-primary);
}

.btn-secondary:hover {
  background: var(--color-primary);
  color: white;
}

.btn-icon {
  background: none;
  border: none;
  cursor: pointer;
  color: var(--color-gray);
  font-size: 1.2rem;
  transition: all 0.3s ease;
  padding: 0;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-icon:hover {
  color: var(--color-primary);
  transform: scale(1.15);
}

.btn-icon.is-liked {
  color: var(--color-primary);
}

.btn-icon.is-liked i {
  font-weight: 900;
}

@media (max-width: 768px) {
  .product-image {
    height: 200px;
  }

  .product-overlay {
    flex-direction: row;
    gap: 6px;
  }

  .btn {
    padding: 8px 12px;
    font-size: 0.85rem;
  }
}
</style>
