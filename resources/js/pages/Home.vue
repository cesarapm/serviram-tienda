<template>
  <div class="ramex-home">
    <!-- Hero Section con Carrusel -->
    <section class="hero-section">
      <div class="hero-carousel">
        <div 
          v-for="(slide, index) in heroSlides" 
          :key="index"
          :class="['hero-slide', { 'active': activeSlide === index }]"
          :style="{ backgroundImage: `url(${slide.image})` }"
        >
          <div class="hero-overlay"></div>
          <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
              <h1>{{ slide.title }}</h1>
              <p>{{ slide.subtitle }}</p>
              <div class="hero-buttons">
                <button class="btn btn-primary" @click="$router.push('/productos')">
                  Ver Catálogo
                </button>
                <button class="btn btn-outlined" @click="scrollTo('categories')">
                  Explorar
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="carousel-controls">
          <button 
            v-for="(_, index) in heroSlides" 
            :key="index"
            :class="['dot', { 'active': activeSlide === index }]"
            @click="activeSlide = index"
          ></button>
        </div>
      </div>
    </section>

    <!-- Categorías Principales -->
    <section class="categories-section" ref="categoriesRef">
      <div class="container">
        <h2 class="section-title">Nuestras Categorías</h2>
        <div class="categories-grid">
          <router-link 
            v-for="cat in mainCategories" 
            :key="cat.id"
            :to="`/productos?cat=${cat.slug}`"
            class="category-card"
          >
            <div class="category-icon">
              <i :class="cat.icon"></i>
            </div>
            <h3>{{ cat.name }}</h3>
            <p>{{ cat.count }} productos</p>
          </router-link>
        </div>
      </div>
    </section>

    <!-- Búsqueda Destacada -->
    <section class="search-section">
      <div class="container">
        <div class="search-wrapper">
          <input 
            v-model="searchQuery"
            type="text"
            placeholder="Buscar equipos profesionales..."
            @keydown.enter="search"
            class="search-input"
          />
          <button @click="search" class="search-btn">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </section>

    <!-- Productos Destacados -->
    <section class="products-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Productos Destacados</h2>
          <router-link to="/productos" class="see-all">
            Ver todo →
          </router-link>
        </div>

        <div v-if="loadingProducts" class="loading-state">
          <v-progress-circular indeterminate></v-progress-circular>
        </div>

        <div v-else-if="featuredProducts.length === 0" class="empty-state">
          <p>No hay productos disponibles en este momento</p>
        </div>

        <div v-else class="products-grid">
          <div 
            v-for="product in featuredProducts"
            :key="product.id"
            class="product-card"
            @mouseenter="hoveredProduct = product.id"
            @mouseleave="hoveredProduct = null"
          >
            <div class="product-image">
              <img 
                :src="product.galeria_imagenes?.[0] || '/images/placeholder.webp'"
                :alt="product.name"
              />
              <div v-if="hoveredProduct === product.id" class="product-overlay">
                <router-link :to="`/producto/${product.id}`" class="btn btn-primary">
                  Ver Detalles
                </router-link>
              </div>
            </div>
            <div class="product-info">
              <p class="product-brand">{{ product.brand?.nombre || 'Sin marca' }}</p>
              <h3 class="product-name">{{ product.name }}</h3>
              <p class="product-category">{{ product.category?.nombre || 'General' }}</p>
              <div class="product-footer">
                <span class="product-price">${{ formatPrice(product.price) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Por qué elegirnos -->
    <section class="benefits-section">
      <div class="container">
        <h2 class="section-title">¿Por qué elegir RAMEX KITCHEN?</h2>
        <div class="benefits-grid">
          <div v-for="(benefit, index) in benefits" :key="index" class="benefit-card">
            <div class="benefit-icon">
              <i :class="benefit.icon"></i>
            </div>
            <h3>{{ benefit.title }}</h3>
            <p>{{ benefit.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonios -->
    <section class="testimonials-section">
      <div class="container">
        <h2 class="section-title">Lo que dicen nuestros clientes</h2>
        <div class="testimonials-grid">
          <div v-for="testimonial in testimonials" :key="testimonial.id" class="testimonial-card">
            <div class="testimonial-stars">
              <i v-for="n in 5" :key="n" class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">{{ testimonial.text }}</p>
            <div class="testimonial-author">
              <div class="author-avatar">{{ testimonial.initials }}</div>
              <div class="author-info">
                <h4>{{ testimonial.name }}</h4>
                <p>{{ testimonial.company }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Final -->
    <section class="cta-section">
      <div class="container">
        <div class="cta-content">
          <h2>¿Listo para equipar tu cocina?</h2>
          <p>Explora nuestro catálogo completo de 500+ productos de las mejores marcas</p>
          <button class="btn btn-primary btn-lg" @click="$router.push('/productos')">
            Ver Catálogo Completo
          </button>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { useRouter } from 'vue-router'
import AOS from 'aos'
import 'aos/dist/aos.css'

const router = useRouter()
const categoriesRef = ref(null)

// Estado reactivo
const activeSlide = ref(0)
const hoveredProduct = ref(null)
const searchQuery = ref('')
const featuredProducts = ref([])
const loadingProducts = ref(false)

// Hero Slides
const heroSlides = ref([
  {
    title: 'RAMEX KITCHEN',
    subtitle: 'Equipo Profesional para Cocinas',
    image: '/images/portadas/portadahome.webp'
  },
  {
    title: 'Soluciones Integrales',
    subtitle: 'Equipamiento gastronómico de calidad',
    image: '/images/portadas/hero2.webp'
  }
])

// Categorías principales
const mainCategories = ref([
  { id: 1, name: 'Cocción', slug: 'coccion', icon: 'fas fa-fire', count: 45 },
  { id: 2, name: 'Refrigeración', slug: 'refrigeracion', icon: 'fas fa-snowflake', count: 38 },
  { id: 3, name: 'Preparación', slug: 'preparacion', icon: 'fas fa-utensils', count: 52 },
  { id: 4, name: 'Cafeteras', slug: 'cafeteras', icon: 'fas fa-mug-hot', count: 24 },
  { id: 5, name: 'Acero Inoxidable', slug: 'acero', icon: 'fas fa-cube', count: 30 },
  { id: 6, name: 'Accesorios', slug: 'accesorios', icon: 'fas fa-tools', count: 40 }
])

// Beneficios
const benefits = ref([
  {
    icon: 'fas fa-truck-fast',
    title: 'Envío Rápido',
    description: 'Entrega en toda la República Mexicana'
  },
  {
    icon: 'fas fa-shield-alt',
    title: 'Garantía',
    description: 'Garantía del fabricante en todos los productos'
  },
  {
    icon: 'fas fa-headset',
    title: 'Soporte 24/7',
    description: 'Asesoría técnica especializada'
  },
  {
    icon: 'fas fa-undo',
    title: 'Devoluciones',
    description: '30 días para cambios y devoluciones'
  }
])

// Testimonios
const testimonials = ref([
  {
    id: 1,
    text: 'Excelente servicio y productos de alta calidad. El equipo funcionó perfectamente desde el primer día.',
    name: 'Carlos Mendoza',
    company: 'Restaurante La Cocina',
    initials: 'CM'
  },
  {
    id: 2,
    text: 'La atención al cliente es excepcional. Me asesoraron perfectamente en la elección del equipo.',
    name: 'María González',
    company: 'Panadería Don Pan',
    initials: 'MG'
  },
  {
    id: 3,
    text: 'Servicio post-venta impecable. Cualquier duda técnica me la resuelven rápidamente.',
    name: 'Roberto Silva',
    company: 'Hotel Plaza Central',
    initials: 'RS'
  }
])

// Métodos
const scrollTo = (ref) => {
  if (ref === 'categories' && categoriesRef.value) {
    categoriesRef.value.scrollIntoView({ behavior: 'smooth' })
  }
}

const search = () => {
  if (searchQuery.value.trim()) {
    router.push(`/productos?q=${encodeURIComponent(searchQuery.value)}`)
  }
}

const formatPrice = (price) => {
  return parseFloat(price).toLocaleString('es-MX', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 2
  })
}

const fetchFeaturedProducts = async () => {
  loadingProducts.value = true
  try {
    const response = await fetch('/api/productos/destacado?limit=6')
    if (response.ok) {
      const data = await response.json()
      featuredProducts.value = data.data || []
      await nextTick()
      AOS.refresh()
    }
  } catch (error) {
    console.error('Error cargando productos:', error)
  } finally {
    loadingProducts.value = false
  }
}

// Carrusel automático
const startCarousel = () => {
  setInterval(() => {
    activeSlide.value = (activeSlide.value + 1) % heroSlides.value.length
  }, 5000)
}

onMounted(() => {
  AOS.init({ duration: 500, once: true })
  fetchFeaturedProducts()
  startCarousel()
})
</script>

<style scoped>
:root {
  --color-primary: #C84617;
  --color-dark: #383838;
  --color-gray: #BABABA;
  --color-light: #f5f5f5;
  --color-white: #ffffff;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.ramex-home {
  background: var(--color-light);
  color: var(--color-dark);
  overflow-x: hidden;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Hero Section */
.hero-section {
  margin-top: 70px;
  height: 100vh;
  position: relative;
  overflow: hidden;
}

.hero-carousel {
  position: relative;
  height: 100%;
}

.hero-slide {
  position: absolute;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  opacity: 0;
  transition: opacity 0.8s ease;
}

.hero-slide.active {
  opacity: 1;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(200, 70, 23, 0.3));
}

.hero-content {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding: 40px;
  z-index: 2;
}

.hero-text {
  max-width: 500px;
  color: white;
  text-align: left;
}

.hero-text h1 {
  font-size: clamp(2.5rem, 6vw, 4rem);
  font-weight: 800;
  margin-bottom: 20px;
  letter-spacing: -1px;
}

.hero-text p {
  font-size: 1.2rem;
  margin-bottom: 30px;
  opacity: 0.95;
  line-height: 1.6;
}

.hero-buttons {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
}

.carousel-controls {
  position: absolute;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 12px;
  z-index: 10;
}

.dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.5);
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
}

.dot.active {
  width: 30px;
  border-radius: 6px;
  background: var(--color-primary);
}

/* Categorías */
.categories-section {
  padding: 80px 0;
  background: white;
}

.categories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 20px;
  margin-top: 40px;
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
}

.category-card:hover {
  background: var(--color-primary);
  color: white;
  transform: translateY(-5px);
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

.category-card:hover .category-icon {
  background: rgba(255, 255, 255, 0.2);
}

.category-card h3 {
  font-size: 1rem;
  font-weight: 600;
}

.category-card p {
  font-size: 0.85rem;
  opacity: 0.7;
}

/* Búsqueda */
.search-section {
  padding: 40px 0;
  background: white;
  border-bottom: 1px solid var(--color-gray);
}

.search-wrapper {
  display: flex;
  gap: 0;
  max-width: 500px;
  margin: 0 auto;
}

.search-input {
  flex: 1;
  padding: 12px 20px;
  border: 1px solid var(--color-gray);
  border-radius: 4px 0 0 4px;
  font-size: 1rem;
  outline: none;
}

.search-input:focus {
  border-color: var(--color-primary);
}

.search-btn {
  padding: 12px 24px;
  background: var(--color-primary);
  color: white;
  border: none;
  border-radius: 0 4px 4px 0;
  cursor: pointer;
  transition: all 0.3s ease;
}

.search-btn:hover {
  background: #a83512;
}

/* Productos */
.products-section {
  padding: 80px 0;
  background: white;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 40px;
}

.section-title {
  font-size: 2.2rem;
  font-weight: 700;
  color: var(--color-dark);
  margin-bottom: 10px;
}

.see-all {
  color: var(--color-primary);
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
}

.see-all:hover {
  gap: 10px;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 24px;
}

.product-card {
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
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
}

.product-image img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  padding: 20px;
}

.product-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
  opacity: 1;
}

.product-info {
  padding: 16px;
}

.product-brand {
  font-size: 0.85rem;
  color: var(--color-primary);
  font-weight: 600;
  margin-bottom: 4px;
}

.product-name {
  font-size: 1rem;
  font-weight: 600;
  color: var(--color-dark);
  margin-bottom: 4px;
  line-height: 1.3;
}

.product-category {
  font-size: 0.85rem;
  color: var(--color-gray);
  margin-bottom: 12px;
}

.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.product-price {
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--color-primary);
}

/* Beneficios */
.benefits-section {
  padding: 80px 0;
  background: linear-gradient(135deg, var(--color-light), white);
}

.benefits-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 30px;
  margin-top: 40px;
}

.benefit-card {
  text-align: center;
  padding: 20px;
}

.benefit-icon {
  font-size: 2.5rem;
  color: var(--color-primary);
  margin-bottom: 15px;
}

.benefit-card h3 {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 10px;
  color: var(--color-dark);
}

.benefit-card p {
  color: var(--color-gray);
  line-height: 1.6;
}

/* Testimonios */
.testimonials-section {
  padding: 80px 0;
  background: white;
}

.testimonials-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 30px;
  margin-top: 40px;
}

.testimonial-card {
  background: var(--color-light);
  padding: 24px;
  border-radius: 8px;
  border-left: 4px solid var(--color-primary);
}

.testimonial-stars {
  color: var(--color-primary);
  margin-bottom: 12px;
}

.testimonial-text {
  font-style: italic;
  color: var(--color-dark);
  margin-bottom: 16px;
  line-height: 1.6;
}

.testimonial-author {
  display: flex;
  gap: 12px;
  align-items: center;
}

.author-avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: var(--color-primary);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 0.9rem;
}

.author-info h4 {
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--color-dark);
  margin-bottom: 2px;
}

.author-info p {
  font-size: 0.85rem;
  color: var(--color-gray);
}

/* CTA */
.cta-section {
  background: linear-gradient(135deg, var(--color-primary), #a83512);
  color: white;
  padding: 80px 0;
  text-align: center;
}

.cta-content h2 {
  font-size: 2.5rem;
  margin-bottom: 15px;
}

.cta-content p {
  font-size: 1.1rem;
  margin-bottom: 30px;
  opacity: 0.9;
}

/* Botones */
.btn {
  padding: 12px 28px;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
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
  transform: translateY(-2px);
}

.btn-outlined {
  background: transparent;
  color: white;
  border: 2px solid white;
}

.btn-outlined:hover {
  background: white;
  color: var(--color-primary);
}

.btn-lg {
  padding: 16px 48px;
  font-size: 1.1rem;
}

/* Loading */
.loading-state {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 300px;
}

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: var(--color-gray);
  font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-text {
    max-width: 100%;
  }

  .hero-buttons {
    flex-direction: column;
  }

  .btn {
    width: 100%;
  }

  .section-title {
    font-size: 1.8rem;
  }

  .categories-grid {
    grid-template-columns: repeat(3, 1fr);
  }

  .products-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .section-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
  }

  .cta-content h2 {
    font-size: 1.8rem;
  }
}

@media (max-width: 480px) {
  .hero-content {
    padding: 20px;
  }

  .hero-text h1 {
    font-size: 1.8rem;
  }

  .hero-text p {
    font-size: 1rem;
  }

  .categories-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .products-grid {
    grid-template-columns: 1fr;
  }

  .search-wrapper {
    flex-direction: column;
  }

  .search-input,
  .search-btn {
    border-radius: 4px;
  }
}
</style>
