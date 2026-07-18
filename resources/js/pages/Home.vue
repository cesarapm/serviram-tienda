<template>
  <div class="serviram-home">
    <!-- Hero Section -->
    <v-container fluid class="hero-section pa-0">
      <div class="hero-backdrop" :style="heroBackdropStyle"></div>
      <div class="hero-overlay"></div>
      
      <v-row no-gutters align="center" justify="center" class="fill-height hero-content hero-grid">
        <v-col cols="12" md="10" lg="8" class="text-center py-16 px-4">
          <div class="hero-copy-shell">
          <!-- Logo emblemático -->
          <div class="brand-emblem mb-8" data-aos="fade-in">
            <h1 class="brand-name">SERVIRAM</h1>
            <p class="brand-tagline">Equipos Profesionales para tu Cocina</p>
          </div>

          <!-- Mensaje principal -->
          <div class="hero-message mb-10" data-aos="fade-in" data-aos-delay="150">
            <h2 class="elegant-title mb-6">
              Los mejores equipos<br>
              <span class="accent-whisper">para cocinas profesionales</span>
            </h2>
            <p class="essence-text">
              Soluciones completas en equipos, refacciones y accesorios<br>
              de las marcas más confiables del mercado.
            </p>
          </div>

          <!-- CTA Principal -->
          <div class="hero-actions" data-aos="fade-in" data-aos-delay="300">
            <v-btn
              class="discover-btn px-12 py-3"
              @click="$router.push('/productos')"
              elevation="0"
            >
              <span>Ver Catálogo</span>
              <div class="btn-glow"></div>
            </v-btn>
            <div class="whisper-text mt-4">
              <small>15+ años sirviendo a restaurantes, hoteles y empresas en México</small>
            </div>
          </div>
          </div>
        </v-col>
      </v-row>
    </v-container>

    <!-- Productos Destacados Section -->
    <v-container class="featured-section py-20">
      <v-row justify="center">
        <v-col cols="12" md="10" class="text-center">
          <h3 class="section-title mb-12" data-aos="fade-in">
            Productos Destacados
          </h3>
          
          <div class="products-grid">
            <div 
              v-if="featuredLoading"
              class="product-card product-card--status"
              data-aos="fade-in"
            >
              <div class="product-info">
                <h4 class="product-name">Cargando productos...</h4>
              </div>
            </div>
            <div 
              v-else-if="featuredProducts.length === 0"
              class="product-card product-card--status"
              data-aos="fade-in"
            >
              <div class="product-info">
                <h4 class="product-name">Explora nuestro catálogo completo</h4>
                <p class="product-description">500+ productos disponibles</p>
              </div>
            </div>
            <template v-else>
              <div 
                v-for="product in featuredProducts" 
                :key="product.id" 
                class="product-card" 
                data-aos="fade-in" 
                :data-aos-delay="(product.id % 6) * 50"
              >
                <div class="product-image">
                  <v-img
                    v-if="product.galeria_imagenes && product.galeria_imagenes.length > 0"
                    :src="product.galeria_imagenes[0]"
                    :alt="product.name"
                    class="product-card__image"
                    contain
                    height="280"
                  />
                  <div v-else class="placeholder-product">
                    {{ product.name.charAt(0) }}
                  </div>
                  <div class="product-overlay">
                    <v-btn 
                      class="view-btn" 
                      variant="outlined" 
                      @click="viewProduct(product.id)"
                    >
                      Ver Detalles
                    </v-btn>
                  </div>
                </div>
                <div class="product-info">
                  <p v-if="product.brand" class="product-brand">{{ typeof product.brand === 'string' ? product.brand : product.brand?.nombre }}</p>
                  <h4 class="product-name">{{ product.name }}</h4>
                  <p class="product-category">{{ typeof product.category === 'string' ? product.category : product.category?.nombre }}</p>
                  <div class="product-price">
                    <span class="price">${{ formatearPrecio(product.price) }}</span>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </v-col>
      </v-row>

      <div v-if="!loading && totalPages > 1 && featuredProducts.length > 0" class="pagination-shell">
        <v-pagination
          v-model="currentPage"
          :length="totalPages"
          :total-visible="$vuetify.display.smAndDown ? 4 : 7"
          rounded="circle"
          active-color="primary"
        />
      </div>
    </v-container>

    <!-- Por qué elegir Serviram -->
    <v-container class="why-serviram py-20">
      <v-row justify="center">
        <v-col cols="12" md="10" class="text-center mb-12">
          <h3 class="section-title" data-aos="fade-in">
            ¿Por qué elegir SERVIRAM?
          </h3>
          <p class="section-subtitle" data-aos="fade-in" data-aos-delay="100">
            Comprometidos con tu satisfacción
          </p>
        </v-col>
      </v-row>

      <v-row justify="center">
        <v-col v-for="(benefit, index) in benefits" :key="index" cols="12" sm="6" md="3" class="mb-8">
          <div class="benefit-card" data-aos="fade-in" :data-aos-delay="index * 50">
            <div class="benefit-icon">
              <v-icon :icon="benefit.icon" size="48"></v-icon>
            </div>
            <h4 class="benefit-title">{{ benefit.title }}</h4>
            <p class="benefit-description">{{ benefit.description }}</p>
          </div>
        </v-col>
      </v-row>
    </v-container>

    <!-- Marcas de Confianza -->
    <v-container class="brands-section py-20">
      <v-row justify="center">
        <v-col cols="12" md="10" class="text-center mb-12">
          <h3 class="section-title" data-aos="fade-in">
            Marcas de Confianza
          </h3>
          <p class="section-subtitle" data-aos="fade-in" data-aos-delay="100">
            Trabajamos con las mejores marcas del mercado
          </p>
        </v-col>
      </v-row>

      <v-row justify="center" align="center">
        <v-col v-for="(brand, index) in brands" :key="index" cols="6" sm="4" md="2" class="text-center brand-item">
          <div class="brand-card" data-aos="fade-in" :data-aos-delay="index * 30">
            <img 
              v-if="brand.logo" 
              :src="brand.logo" 
              :alt="brand.name"
              class="brand-image"
            />
            <div v-else class="brand-logo">{{ brand.name }}</div>
          </div>
        </v-col>
      </v-row>
    </v-container>

    <!-- Testimonios de Clientes -->
    <v-container class="testimonials-section py-20">
      <v-row justify="center">
        <v-col cols="12" md="10" class="text-center mb-12">
          <h3 class="section-title" data-aos="fade-in">
            Lo que dicen nuestros clientes
          </h3>
          <p class="section-subtitle" data-aos="fade-in" data-aos-delay="100">
            Más de 1,000 clientes satisfechos confían en nosotros
          </p>
        </v-col>
      </v-row>

      <v-row justify="center">
        <v-col v-for="(testimonial, index) in testimonials" :key="index" cols="12" sm="6" md="4" class="mb-8">
          <div class="testimonial-card" data-aos="fade-in" :data-aos-delay="index * 50">
            <div class="testimonial-quote">
              <span class="quote-icon">"</span>
              <p class="testimonial-text">{{ testimonial.text }}</p>
              <span class="quote-icon closing">"</span>
            </div>
            
            <div class="testimonial-rating">
              <v-icon 
                v-for="star in 5" 
                :key="star" 
                icon="mdi-star" 
                size="24" 
                class="star-icon"
              ></v-icon>
            </div>

            <div class="testimonial-author">
              <div class="author-avatar" :style="{ backgroundColor: testimonial.avatarColor }">
                {{ testimonial.initials }}
              </div>
              <div class="author-info">
                <h4 class="author-name">{{ testimonial.name }}</h4>
                <p class="author-company">{{ testimonial.company }}</p>
              </div>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>

    <!-- Números que nos respaldan -->
    <v-container class="stats-section py-20">
      <v-row justify="center">
        <v-col cols="12" md="10" class="text-center mb-12">
          <h3 class="section-title" data-aos="fade-in">
            Números que nos respaldan
          </h3>
          <p class="section-subtitle" data-aos="fade-in" data-aos-delay="100">
            Años de experiencia construyendo confianza
          </p>
        </v-col>
      </v-row>

      <v-row justify="center">
        <v-col v-for="(stat, index) in stats" :key="index" cols="12" sm="6" md="3" class="mb-8">
          <div class="stat-card" data-aos="fade-in" :data-aos-delay="index * 50" :ref="el => { statsRefs[index] = el }">
            <div class="stat-number" :class="{ 'animating': animatingIndices.includes(index) }">{{ animatedNumbers[index] || stat.number }}</div>
            <h4 class="stat-label">{{ stat.label }}</h4>
            <p class="stat-description">{{ stat.description }}</p>
          </div>
        </v-col>
      </v-row>
    </v-container>

    <!-- Call to Action -->
    <v-container class="final-cta py-20">
      <v-row justify="center">
        <v-col cols="12" md="8" class="text-center">
          <div class="cta-content" data-aos="fade-in">
            <h3 class="cta-title mb-6">
              ¿Listo para mejorar tu cocina?
            </h3>
            <p class="cta-text mb-8">
              Explora nuestro catálogo completo de 500+ productos y encuentra
              exactamente lo que necesitas para tu negocio.
            </p>
            <v-btn 
              class="cta-button px-12 py-3"
              @click="$router.push('/productos')"
              elevation="0"
            >
              Ver Todos los Productos
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick, watch } from 'vue'
import { useRouter } from 'vue-router'
import AOS from 'aos'
import 'aos/dist/aos.css'

const router = useRouter()
const heroCoverImage = '/images/portadas/portadahome.webp'
const heroBackdropStyle = {
  backgroundImage: `linear-gradient(135deg, rgba(11, 48, 102, 0.76), rgba(30, 90, 160, 0.58)), url(${heroCoverImage})`
}

// Refs for animation
const animatedNumbers = ref([])
const statsRefs = ref([])
const animatingIndices = ref([])
const observedStats = new Set()

// Benefits data
const benefits = ref([
  {
    icon: 'mdi-truck-fast',
    title: 'Envío Gratis',
    description: 'Envío gratuito en compras mayores a $1,500 en toda la República Mexicana'
  },
  {
    icon: 'mdi-shield-check',
    title: 'Garantía de Calidad',
    description: 'Todos nuestros productos cuentan con garantía del fabricante'
  },
  {
    icon: 'mdi-headset',
    title: 'Soporte 24/7',
    description: 'Asesoría técnica especializada disponible todos los días'
  },
  {
    icon: 'mdi-undo',
    title: 'Devoluciones Fáciles',
    description: '30 días para cambios y devoluciones sin complicaciones'
  }
])

// Brands data
const brands = ref([
  { name: 'Rational', logo: '/images/brands/rational.webp' },
  { name: 'Unox', logo: '/images/brands/unox.webp' },
  { name: 'Winterhalter', logo: '/images/brands/winterhalter.webp' },
  { name: 'Euroquip', logo: '/images/brands/vario.webp' },
  { name: 'MIGSA', logo: '/images/brands/migsa.webp' },
 
])

// Testimonials data
const testimonials = ref([
  {
    text: 'Excelente servicio y productos de calidad. El equipo que compré para mi restaurante ha funcionado perfectamente durante más de un año.',
    name: 'Carlos Mendoza',
    company: 'Restaurante La Cocina',
    initials: 'CM',
    avatarColor: '#1e5aa0'
  },
  {
    text: 'La atención al cliente es excepcional. Me ayudaron a elegir el equipo perfecto para mi panadería y el precio fue muy competitivo.',
    name: 'María González',
    company: 'Panadería Don Pan',
    initials: 'MG',
    avatarColor: '#4caf50'
  },
  {
    text: 'Rápida entrega y excelente post-venta. Cuando tuve una duda técnica, me resolvieron todo por WhatsApp en minutos.',
    name: 'Roberto Silva',
    company: 'Hotel Plaza Central',
    initials: 'RS',
    avatarColor: '#2196f3'
  }
])

// Stats data
const stats = ref([
  {
    number: '15+',
    label: 'Años de Experiencia',
    description: 'Especialistas en equipos industriales'
  },
  {
    number: '1,000+',
    label: 'Clientes Satisfechos',
    description: 'Restaurantes, hoteles y empresas'
  },
  {
    number: '500+',
    label: 'Productos Disponibles',
    description: 'Las mejores marcas del mercado'
  },
  {
    number: '24/7',
    label: 'Soporte Técnico',
    description: 'Asesoría especializada siempre disponible'
  }
])

const featuredProducts = ref([])
const featuredLoading = ref(false)
const currentPage = ref(1)
const totalPages = ref(1)
const loading = ref(false)

const viewProduct = (id) => {
  router.push(`/producto/${id}`)
}

const initAos = () => {
  AOS.init({
    duration: 500,
    easing: 'ease-out-cubic',
    once: true,
    offset: 50
  })
}

const refreshAos = async () => {
  await nextTick()
  AOS.refresh()
}

const formatearPrecio = (precio) => {
  const numero = parseFloat(precio)
  if (isNaN(numero)) return '0'
  
  if (numero % 1 === 0) {
    return numero.toString()
  }
  
  return numero.toFixed(2).replace(/\.?0+$/, '')
}

const extractNumberFromStat = (statNumber) => {
  // Extrae el número del string (ej: "15+" -> 15, "1,000+" -> 1000)
  const cleaned = statNumber.toString().replace(/[^\d]/g, '')
  return parseInt(cleaned) || 0
}

const animateNumber = (startValue, endValue, duration = 2000) => {
  return new Promise((resolve) => {
    let startTime = null
    const animate = (currentTime) => {
      if (!startTime) startTime = currentTime
      const elapsed = currentTime - startTime
      const progress = Math.min(elapsed / duration, 1)
      
      const currentValue = Math.floor(progress * (endValue - startValue) + startValue)
      resolve(currentValue)
      
      if (progress < 1) {
        requestAnimationFrame(animate)
      }
    }
    requestAnimationFrame(animate)
  })
}

const animateStatNumbers = async (index) => {
  if (observedStats.has(index)) return
  observedStats.add(index)
  
  const stat = stats.value[index]
  const endValue = extractNumberFromStat(stat.number)
  const duration = 2000
  const steps = 60
  const stepDuration = duration / steps
  
  // Marcar como animando
  if (!animatingIndices.value.includes(index)) {
    animatingIndices.value.push(index)
  }
  
  for (let step = 0; step <= steps; step++) {
    const progress = step / steps
    const currentValue = Math.floor(progress * endValue)
    
    if (animatedNumbers.value[index] === undefined) {
      animatedNumbers.value[index] = currentValue
    } else {
      animatedNumbers.value[index] = currentValue
    }
    
    await new Promise(resolve => setTimeout(resolve, stepDuration))
  }
  
  // Mostrar el valor final con formato original
  animatedNumbers.value[index] = stat.number
  
  // Remover del índice de animando después de un pequeño delay
  setTimeout(() => {
    animatingIndices.value = animatingIndices.value.filter(i => i !== index)
  }, 300)
}

const fetchFeaturedProducts = async () => {
  loading.value = true
  featuredLoading.value = true

  try {
    const params = new URLSearchParams()
    params.append('page', currentPage.value)

    const response = await fetch(`/api/productos/destacado?${params}`)

    if (!response.ok) {
      throw new Error('No se pudieron cargar los productos destacados')
    }

    const payload = await response.json()
    featuredProducts.value = payload.data ?? []
    currentPage.value = payload.current_page ?? 1
    totalPages.value = payload.last_page ?? 1
    
    await refreshAos()
  } catch (error) {
    console.error('Error al cargar productos destacados:', error)
    featuredProducts.value = []
  } finally {
    loading.value = false
    featuredLoading.value = false
  }
}

watch(currentPage, () => {
  fetchFeaturedProducts()
})

onMounted(() => {
  initAos()
  fetchFeaturedProducts()
  
  // Setup Intersection Observer para stats
  const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px'
  }
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        // Encontrar el índice del stat-card
        const index = statsRefs.value.indexOf(entry.target)
        if (index !== -1) {
          animateStatNumbers(index)
        }
      }
    })
  }, observerOptions)
  
  // Observar todos los stat-cards después de que se rendericen
  nextTick(() => {
    statsRefs.value.forEach((el) => {
      if (el) observer.observe(el)
    })
  })
})
</script>

<style scoped>
.serviram-home {
  background: linear-gradient(135deg, #f5f7fa 0%, #eef2f7 100%);
  color: #2c2c2c;
  overflow-x: hidden;
}

/* Hero Section */
.hero-section {
  margin-top: 70px;
  min-height: 120vh;
  position: relative;
  display: flex;
  align-items: center;
  background: linear-gradient(135deg, #0b3066 0%, #1e5aa0 100%);
}

.hero-backdrop {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #1e5aa0;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  transform: scale(1.03);
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: 
    radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.08) 0%, transparent 38%),
    radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.06) 0%, transparent 34%),
    linear-gradient(180deg, rgba(11, 48, 102, 0.2) 0%, rgba(11, 48, 102, 0.5) 100%);
}

.hero-content {
  position: relative;
  z-index: 2;
}

.hero-grid {
  width: min(1200px, calc(100% - 2rem));
  margin: 0 auto;
}

.hero-copy-shell {
  max-width: 760px;
  margin: 0 auto;
  padding: clamp(2rem, 4vw, 3rem);
  border-radius: 32px;
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.06));
  border: 1px solid rgba(255, 255, 255, 0.16);
  box-shadow: 0 24px 60px rgba(11, 48, 102, 0.3);
  backdrop-filter: blur(10px);
}

.brand-emblem {
  position: relative;
}

.brand-name {
  font-family: var(--font-brand, sans-serif);
  font-size: clamp(3rem, 8vw, 5rem);
  font-weight: 700;
  color: #ffffff;
  letter-spacing: 0.08em;
  margin: 0;
  text-shadow: 0 4px 12px rgba(11, 48, 102, 0.3);
}

.brand-tagline {
  font-size: 1.1rem;
  color: rgba(255, 255, 255, 0.9);
  margin: 0.5rem 0 0 0;
  font-weight: 500;
  letter-spacing: 0.02em;
}

.elegant-title {
  font-family: var(--font-brand, sans-serif);
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 600;
  line-height: 1.4;
  color: #ffffff;
  letter-spacing: -0.02em;
}

.accent-whisper {
  color: #64b5f6;
  font-style: italic;
  font-weight: 500;
}

.essence-text {
  font-family: var(--font-brand, sans-serif);
  font-size: 1.2rem;
  line-height: 1.7;
  color: rgba(255, 255, 255, 0.95);
  max-width: 700px;
  margin: 0 auto;
  font-weight: 400;
}

.discover-btn {
  background: linear-gradient(135deg, #1e5aa0, #2e7ab5) !important;
  color: #ffffff !important;
  font-family: var(--font-brand, sans-serif);
  font-weight: 600;
  font-size: 1rem;
  letter-spacing: 0.02em;
  position: relative;
  overflow: hidden;
  border-radius: 32px !important;
  transition: all 0.3s ease;
  box-shadow: 0 4px 20px rgba(30, 90, 160, 0.4);
}

.discover-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 30px rgba(30, 90, 160, 0.5);
  background: linear-gradient(135deg, #2e7ab5, #1e5aa0) !important;
}

.btn-glow {
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.discover-btn:hover .btn-glow {
  left: 100%;
}

.whisper-text {
  color: rgba(255, 255, 255, 0.85);
  font-family: var(--font-brand, sans-serif);
  font-style: italic;
  font-size: 0.9rem;
  font-weight: 400;
}

/* Featured Products Section */
.featured-section {
  background: #fbfcfd;
  position: relative;
  overflow: hidden;
}

.why-serviram {
  background: linear-gradient(135deg, #f5f7fa 0%, #eef2f7 100%);
}

.brands-section {
  background: #ffffff;
}

.stats-section {
  background: linear-gradient(135deg, #0b3066 0%, #1e5aa0 100%);
}

.section-title {
  font-family: var(--font-brand, sans-serif);
  font-size: clamp(2rem, 5vw, 3rem);
  font-weight: 600;
  color: #0b3066;
  text-align: center;
  position: relative;
  margin-bottom: 2rem;
}

.stats-section .section-title {
  color: #ffffff;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: -12px;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, transparent, #1e5aa0, transparent);
}

.stats-section .section-title::after {
  background: linear-gradient(90deg, transparent, #64b5f6, transparent);
}

.section-subtitle {
  font-size: 1.1rem;
  color: #666;
  text-align: center;
}

.stats-section .section-subtitle {
  color: rgba(255, 255, 255, 0.9);
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
  margin-top: 3rem;
}

.product-card {
  background: #ffffff;
  border: 1px solid rgba(30, 90, 160, 0.1);
  border-radius: 16px;
  transition: all 0.3s ease;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(30, 90, 160, 0.08);
}

.product-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 40px rgba(30, 90, 160, 0.15);
  border-color: rgba(30, 90, 160, 0.2);
}

.product-image {
  position: relative;
  height: 360px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1.25rem;
  background: linear-gradient(135deg, #f0f4f8 0%, #e8eef6 100%);
}

.placeholder-product {
  width: min(100%, 240px);
  height: 100%;
  max-height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
  font-family: var(--font-brand, sans-serif);
  font-size: 4rem;
  font-weight: 600;
  transition: transform 0.3s ease;
  border-radius: 18px;
  background: linear-gradient(135deg, #1e5aa0, #2e7ab5);
  box-shadow: 0 18px 36px rgba(30, 90, 160, 0.2);
}

.product-overlay {
  position: absolute;
  inset: 1.25rem;
  background: rgba(11, 48, 102, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  border-radius: 18px;
  backdrop-filter: blur(4px);
}

.product-card:hover .product-overlay {
  opacity: 1;
}

.view-btn {
  border-color: #ffffff !important;
  color: #ffffff !important;
  font-family: var(--font-brand, sans-serif);
  font-weight: 600;
  background: rgba(255, 255, 255, 0.1) !important;
  backdrop-filter: blur(10px);
  border-radius: 24px !important;
}

.view-btn:hover {
  background: #ffffff !important;
  color: #0b3066 !important;
}

.product-info {
  padding: 1.5rem;
}

.product-card--status {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 220px;
}

.product-brand {
  font-family: var(--font-brand, sans-serif);
  font-size: 0.85rem;
  color: #1e5aa0;
  margin-bottom: 0.5rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.product-name {
  font-family: var(--font-brand, sans-serif);
  font-size: 1.2rem;
  font-weight: 600;
  color: #0b3066;
  margin-bottom: 0.5rem;
  line-height: 1.3;
}

.product-category {
  font-family: var(--font-brand, sans-serif);
  font-size: 0.9rem;
  color: #666;
  margin-bottom: 1rem;
  font-weight: 400;
}

.product-description {
  font-size: 0.95rem;
  line-height: 1.5;
  color: #888;
  margin-bottom: 1rem;
}

.product-price {
  display: flex;
  align-items: baseline;
  gap: 0.5rem;
}

.price {
  font-family: var(--font-brand, sans-serif);
  font-size: 1.8rem;
  font-weight: 700;
  color: #1e5aa0;
}

/* Benefits Section */
.benefit-card {
  background: #ffffff;
  padding: 2rem 1.5rem;
  border-radius: 16px;
  text-align: center;
  transition: all 0.3s ease;
  box-shadow: 0 4px 16px rgba(30, 90, 160, 0.08);
  border: 1px solid rgba(30, 90, 160, 0.08);
}

.benefit-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 32px rgba(30, 90, 160, 0.15);
  border-color: rgba(30, 90, 160, 0.16);
}

.benefit-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #0b3066, #1e5aa0);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.5rem;
  color: #ffffff;
  font-size: 2rem;
}

.benefit-title {
  font-family: var(--font-brand, sans-serif);
  font-size: 1.2rem;
  font-weight: 600;
  color: #0b3066;
  margin-bottom: 0.75rem;
}

.benefit-description {
  font-size: 0.95rem;
  color: #666;
  line-height: 1.6;
}

/* Brands Section */
.brand-item {
  padding: 1rem;
}

.brand-card {
  background: #ffffff;
  padding: 2rem;
  border-radius: 12px;
  text-align: center;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(30, 90, 160, 0.08);
  border: 1px solid rgba(30, 90, 160, 0.08);
  min-height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.brand-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(30, 90, 160, 0.12);
  border-color: rgba(30, 90, 160, 0.2);
}

.brand-logo {
  font-family: var(--font-brand, sans-serif);
  font-size: 1.1rem;
  font-weight: 700;
  color: #0b3066;
  letter-spacing: 0.02em;
}

.brand-image {
  max-width: 100%;
  max-height: 80px;
  height: auto;
  object-fit: contain;
  filter: grayscale(100%);
  transition: filter 0.3s ease, transform 0.3s ease;
}

.brand-card:hover .brand-image {
  filter: grayscale(0%);
  transform: scale(1.1);
}

/* Testimonials Section */
.testimonials-section {
  background: linear-gradient(135deg, #f5f7fa 0%, #eef2f7 100%);
}

.testimonial-card {
  background: #ffffff;
  padding: 2rem;
  border-radius: 16px;
  text-align: center;
  transition: all 0.3s ease;
  box-shadow: 0 4px 16px rgba(30, 90, 160, 0.08);
  border: 1px solid rgba(30, 90, 160, 0.08);
  display: flex;
  flex-direction: column;
  height: 100%;
}

.testimonial-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 32px rgba(30, 90, 160, 0.15);
  border-color: rgba(30, 90, 160, 0.16);
}

.testimonial-quote {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 1.5rem;
  position: relative;
}

.quote-icon {
  font-family: var(--font-brand, sans-serif);
  font-size: 4rem;
  font-weight: 700;
  color: #1e5aa0;
  line-height: 1;
  opacity: 0.3;
}

.quote-icon.closing {
  transform: scaleX(-1) scaleY(-1);
  align-self: flex-end;
}

.testimonial-text {
  font-family: var(--font-brand, sans-serif);
  font-size: 1rem;
  font-style: italic;
  color: #666;
  line-height: 1.6;
  margin: 0.5rem 0;
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}

.testimonial-rating {
  display: flex;
  justify-content: center;
  gap: 0.25rem;
  margin-bottom: 1.5rem;
}

.star-icon {
  color: #ffc107 !important;
}

.testimonial-author {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding-top: 1.5rem;
  border-top: 1px solid rgba(30, 90, 160, 0.1);
}

.author-avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
  font-family: var(--font-brand, sans-serif);
  font-weight: 700;
  font-size: 1.2rem;
  flex-shrink: 0;
}

.author-info {
  text-align: left;
}

.author-name {
  font-family: var(--font-brand, sans-serif);
  font-size: 1rem;
  font-weight: 600;
  color: #0b3066;
  margin: 0;
}

.author-company {
  font-size: 0.85rem;
  color: #999;
  margin: 0.25rem 0 0 0;
}

/* Stats Section */
.stat-card {
  background: rgba(255, 255, 255, 0.12);
  padding: 2.5rem 1.5rem;
  border-radius: 16px;
  text-align: center;
  border: 1px solid rgba(255, 255, 255, 0.16);
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
}

.stat-card:hover {
  background: rgba(255, 255, 255, 0.16);
  border-color: rgba(255, 255, 255, 0.32);
  transform: translateY(-8px);
}

.stat-number {
  font-family: var(--font-brand, sans-serif);
  font-size: clamp(2.5rem, 6vw, 4rem);
  font-weight: 700;
  color: #64b5f6;
  line-height: 1;
  margin-bottom: 0.75rem;
  transition: text-shadow 0.1s ease, transform 0.1s ease;
}

.stat-number.animating {
  animation: numberPulse 0.3s ease-out;
  text-shadow: 0 0 20px rgba(100, 181, 246, 0.6);
}

@keyframes numberPulse {
  0% {
    transform: scale(1);
    text-shadow: 0 0 10px rgba(100, 181, 246, 0.3);
  }
  50% {
    transform: scale(1.08);
    text-shadow: 0 0 30px rgba(100, 181, 246, 0.8);
  }
  100% {
    transform: scale(1);
    text-shadow: 0 0 10px rgba(100, 181, 246, 0.3);
  }
}

.stat-label {
  font-family: var(--font-brand, sans-serif);
  font-size: 1.2rem;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 0.5rem;
}

.stat-description {
  font-size: 0.95rem;
  color: rgba(255, 255, 255, 0.85);
  line-height: 1.5;
}

/* Final CTA */
.final-cta {
  background: linear-gradient(135deg, #0b3066 0%, #1e5aa0 100%);
}

.cta-content {
  padding: 3rem 2rem;
  text-align: center;
}

.cta-title {
  font-family: var(--font-brand, sans-serif);
  font-size: clamp(2rem, 5vw, 3rem);
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 1rem;
}

.cta-text {
  font-size: 1.1rem;
  color: rgba(255, 255, 255, 0.95);
  line-height: 1.7;
  max-width: 600px;
  margin: 0 auto 1.5rem;
}

.cta-button {
  background: linear-gradient(135deg, #ffffff, #f0f4f8) !important;
  color: #0b3066 !important;
  font-family: var(--font-brand, sans-serif);
  font-weight: 600;
  font-size: 1rem;
  letter-spacing: 0.02em;
  border-radius: 32px !important;
  transition: all 0.3s ease;
  box-shadow: 0 4px 20px rgba(255, 255, 255, 0.2);
}

.cta-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 30px rgba(255, 255, 255, 0.3);
}

.pagination-shell {
  display: flex;
  justify-content: center;
  margin-top: 3rem;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-section {
    min-height: 80vh;
  }
  
  .products-grid {
    grid-template-columns: 1fr;
  }
  
  .benefit-card,
  .stat-card,
  .brand-card {
    padding: 1.5rem;
  }
}
</style>
