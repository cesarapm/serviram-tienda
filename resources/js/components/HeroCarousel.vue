<template>
  <section class="hero-carousel-wrapper">
    <div class="hero-carousel">
      <transition-group name="fade" class="carousel-inner">
        <div 
          v-for="(slide, index) in slides" 
          v-show="activeSlide === index"
          :key="`slide-${index}`"
          class="hero-slide"
          :style="{ backgroundImage: `url(${slide.image})` }"
        >
          <div class="hero-overlay"></div>
          <div class="hero-content">
            <v-container class="hero-inner">
              <v-row>
                <v-col cols="12" md="7" class="hero-text-wrapper">
                  <div class="hero-text" data-aos="fade-right">
                    <h1 class="hero-title">{{ slide.title }}</h1>
                    <p class="hero-subtitle">{{ slide.subtitle }}</p>
                    
                    <div class="hero-buttons" v-if="slide.cta">
                      <button class="btn btn-primary btn-lg" @click="$emit('primary-cta', slide)">
                        {{ slide.cta.primary }}
                      </button>
                      <button class="btn btn-outlined btn-lg" @click="$emit('secondary-cta', slide)">
                        {{ slide.cta.secondary }}
                      </button>
                    </div>

                    <p v-if="slide.description" class="hero-description">
                      {{ slide.description }}
                    </p>
                  </div>
                </v-col>
              </v-row>
            </v-container>
          </div>
        </div>
      </transition-group>

      <!-- Controles del Carrusel -->
      <div v-if="showControls" class="carousel-controls">
        <button class="control-btn prev-btn" @click="previousSlide" aria-label="Anterior">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="control-btn next-btn" @click="nextSlide" aria-label="Siguiente">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>

      <!-- Indicadores -->
      <div v-if="showIndicators" class="carousel-indicators">
        <button 
          v-for="(_, index) in slides" 
          :key="`dot-${index}`"
          :class="['indicator', { 'active': activeSlide === index }]"
          @click="activeSlide = index"
          :aria-label="`Ir a slide ${index + 1}`"
        ></button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, watch, onMounted, onUnmounted, defineProps, defineEmits } from 'vue'

const props = defineProps({
  slides: {
    type: Array,
    required: true
  },
  autoPlay: {
    type: Boolean,
    default: true
  },
  interval: {
    type: Number,
    default: 5000
  },
  showControls: {
    type: Boolean,
    default: true
  },
  showIndicators: {
    type: Boolean,
    default: true
  }
})

const emit = defineEmits(['primary-cta', 'secondary-cta', 'slide-change'])

const activeSlide = ref(0)
let autoPlayInterval = null

const nextSlide = () => {
  activeSlide.value = (activeSlide.value + 1) % props.slides.length
}

const previousSlide = () => {
  activeSlide.value = (activeSlide.value - 1 + props.slides.length) % props.slides.length
}

const startAutoPlay = () => {
  if (props.autoPlay && props.slides.length > 1) {
    autoPlayInterval = setInterval(nextSlide, props.interval)
  }
}

const stopAutoPlay = () => {
  if (autoPlayInterval) {
    clearInterval(autoPlayInterval)
  }
}

watch(() => activeSlide.value, (newSlide) => {
  emit('slide-change', newSlide)
})

onMounted(() => {
  startAutoPlay()
})

onUnmounted(() => {
  stopAutoPlay()
})

watch(() => props.autoPlay, (shouldAutoPlay) => {
  if (shouldAutoPlay) {
    startAutoPlay()
  } else {
    stopAutoPlay()
  }
})
</script>

<style scoped>
:root {
  --color-primary: #C84617;
  --color-dark: #383838;
  --color-gray: #BABABA;
  --color-white: #ffffff;
}

.hero-carousel-wrapper {
  position: relative;
  width: 100%;
  margin-top: 70px;
}

.hero-carousel {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
  background: var(--color-dark);
}

.carousel-inner {
  position: relative;
  width: 100%;
  height: 100%;
}

.hero-slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  display: flex;
  align-items: center;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(56, 56, 56, 0.5), rgba(200, 70, 23, 0.3));
  z-index: 1;
}

.hero-content {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  z-index: 2;
}

.hero-inner {
  width: 100%;
}

.hero-text-wrapper {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.hero-text {
  animation: slideInLeft 0.8s ease-out;
}

.hero-title {
  font-size: clamp(2.5rem, 6vw, 4rem);
  font-weight: 800;
  color: white;
  margin-bottom: 20px;
  letter-spacing: -1px;
}

.hero-subtitle {
  font-size: 1.3rem;
  color: rgba(255, 255, 255, 0.95);
  margin-bottom: 30px;
  line-height: 1.6;
  max-width: 500px;
}

.hero-description {
  font-size: 1rem;
  color: rgba(255, 255, 255, 0.8);
  line-height: 1.6;
  max-width: 500px;
  margin-top: 20px;
}

.hero-buttons {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
  margin-top: 30px;
}

.btn {
  padding: 12px 28px;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-primary {
  background: var(--color-primary);
  color: white;
}

.btn-primary:hover {
  background: #a83512;
  transform: translateY(-2px);
  box-shadow: 0 12px 24px rgba(200, 70, 23, 0.3);
}

.btn-outlined {
  background: transparent;
  color: white;
  border: 2px solid white;
}

.btn-outlined:hover {
  background: white;
  color: var(--color-primary);
  border-color: white;
}

.btn-lg {
  padding: 14px 32px;
  font-size: 1.1rem;
}

/* Controles */
.carousel-controls {
  position: absolute;
  top: 50%;
  width: 100%;
  display: flex;
  justify-content: space-between;
  padding: 0 20px;
  z-index: 20;
  transform: translateY(-50%);
  pointer-events: none;
}

.control-btn {
  pointer-events: all;
  background: rgba(255, 255, 255, 0.3);
  color: white;
  border: none;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  font-size: 1.2rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  backdrop-filter: blur(4px);
}

.control-btn:hover {
  background: var(--color-primary);
  transform: scale(1.1);
}

/* Indicadores */
.carousel-indicators {
  position: absolute;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 12px;
  z-index: 20;
  flex-wrap: wrap;
  justify-content: center;
}

.indicator {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.5);
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
}

.indicator.active {
  width: 30px;
  border-radius: 6px;
  background: var(--color-primary);
}

.indicator:hover {
  background: rgba(255, 255, 255, 0.8);
}

/* Animaciones */
@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.8s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-carousel {
    height: 70vh;
  }

  .hero-title {
    font-size: 2rem;
  }

  .hero-subtitle {
    font-size: 1rem;
  }

  .hero-buttons {
    flex-direction: column;
  }

  .btn,
  .btn-lg {
    width: 100%;
    justify-content: center;
  }

  .carousel-controls {
    padding: 0 12px;
  }

  .control-btn {
    width: 40px;
    height: 40px;
    font-size: 1rem;
  }
}

@media (max-width: 480px) {
  .hero-carousel {
    height: 60vh;
  }

  .hero-title {
    font-size: 1.5rem;
  }

  .hero-subtitle {
    font-size: 0.95rem;
  }

  .carousel-controls {
    padding: 0 8px;
  }

  .control-btn {
    width: 36px;
    height: 36px;
    font-size: 0.9rem;
  }

  .carousel-indicators {
    bottom: 15px;
    gap: 8px;
  }

  .indicator {
    width: 8px;
    height: 8px;
  }

  .indicator.active {
    width: 20px;
  }
}
</style>
