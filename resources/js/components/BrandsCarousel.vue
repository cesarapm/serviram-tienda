<template>
  <section class="brands-carousel-section">
    <div class="container">
      <div class="section-header" data-aos="fade-in">
        <h2 class="section-title">Marcas de Confianza</h2>
        <p class="section-subtitle">Trabajamos con los mejores del mercado</p>
      </div>

      <div class="brands-carousel" v-if="brands.length > 0">
        <div class="carousel-track" :style="{ transform: `translateX(${carouselOffset}px)` }">
          <div 
            v-for="brand in brands" 
            :key="brand.id"
            class="brand-item"
            data-aos="fade-in"
          >
            <div class="brand-logo-wrapper">
              <img 
                :src="brand.logo"
                :alt="brand.name"
                class="brand-logo"
              />
              <div class="brand-hover">
                <p class="brand-name">{{ brand.name }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="carousel-controls-bottom">
        <button @click="scrollLeft" class="scroll-btn" aria-label="Scroll izquierda">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button @click="scrollRight" class="scroll-btn" aria-label="Scroll derecha">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, defineProps } from 'vue'

defineProps({
  brands: {
    type: Array,
    default: () => [
      { id: 1, name: 'Rational', logo: '/images/brands/rational.webp' },
      { id: 2, name: 'Unox', logo: '/images/brands/unox.webp' },
      { id: 3, name: 'Winterhalter', logo: '/images/brands/winterhalter.webp' },
      { id: 4, name: 'Euroquip', logo: '/images/brands/vario.webp' },
      { id: 5, name: 'MIGSA', logo: '/images/brands/migsa.webp' },
    ]
  }
})

const carouselOffset = ref(0)
const scrollAmount = 300

const scrollLeft = () => {
  carouselOffset.value = Math.min(carouselOffset.value + scrollAmount, 0)
}

const scrollRight = () => {
  carouselOffset.value = carouselOffset.value - scrollAmount
}
</script>

<style scoped>
:root {
  --color-primary: #C84617;
  --color-dark: #383838;
  --color-gray: #BABABA;
  --color-light: #f5f5f5;
}

.brands-carousel-section {
  padding: 80px 0;
  background: white;
  border-top: 1px solid var(--color-light);
}

.section-header {
  text-align: center;
  margin-bottom: 50px;
}

.section-title {
  font-size: 2rem;
  font-weight: 700;
  color: var(--color-dark);
  margin-bottom: 10px;
}

.section-subtitle {
  font-size: 1rem;
  color: var(--color-gray);
}

.brands-carousel {
  position: relative;
  overflow: hidden;
  margin-bottom: 30px;
}

.carousel-track {
  display: flex;
  gap: 40px;
  transition: transform 0.4s ease-out;
  padding: 20px 0;
}

.brand-item {
  flex: 0 0 200px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.brand-logo-wrapper {
  position: relative;
  width: 100%;
  height: 150px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--color-light);
  border-radius: 8px;
  overflow: hidden;
  transition: all 0.3s ease;
  cursor: pointer;
}

.brand-logo-wrapper:hover {
  background: var(--color-primary);
  box-shadow: 0 8px 24px rgba(200, 70, 23, 0.15);
  transform: translateY(-4px);
}

.brand-logo {
  max-width: 90%;
  max-height: 90%;
  object-fit: contain;
  transition: all 0.3s ease;
}

.brand-logo-wrapper:hover .brand-logo {
  filter: brightness(0) invert(1);
}

.brand-hover {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.brand-logo-wrapper:hover .brand-hover {
  opacity: 1;
}

.brand-name {
  color: white;
  font-weight: 600;
  text-align: center;
  font-size: 1rem;
}

.carousel-controls-bottom {
  display: flex;
  justify-content: center;
  gap: 15px;
}

.scroll-btn {
  background: var(--color-primary);
  color: white;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.scroll-btn:hover {
  background: #a83512;
  transform: scale(1.1);
}

.scroll-btn:active {
  transform: scale(0.95);
}

@media (max-width: 768px) {
  .brands-carousel-section {
    padding: 60px 0;
  }

  .section-title {
    font-size: 1.5rem;
  }

  .brand-item {
    flex: 0 0 150px;
  }

  .brand-logo-wrapper {
    height: 120px;
  }

  .carousel-track {
    gap: 20px;
  }
}

@media (max-width: 480px) {
  .brands-carousel-section {
    padding: 40px 0;
  }

  .section-title {
    font-size: 1.3rem;
  }

  .brand-item {
    flex: 0 0 120px;
  }

  .brand-logo-wrapper {
    height: 100px;
  }

  .carousel-track {
    gap: 15px;
  }

  .scroll-btn {
    width: 36px;
    height: 36px;
  }
}
</style>
