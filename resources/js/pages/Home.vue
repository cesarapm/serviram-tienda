<template>
  <div class="ramex-home-alakarta">



    <!-- Banner de Categoría -->
    <section class="category-banner" v-if="currentCategory">
      <div class="banner-image" :style="{ backgroundImage: `url(${currentCategory.image})` }">
        <div class="banner-overlay"></div>
        <div class="banner-content">
          <span class="banner-kicker">Soluciones profesionales</span>
          <h1>{{ currentCategory.title }}</h1>
          <p>{{ currentCategory.description }}</p>
          <div class="banner-actions">
            <router-link to="/productos" class="primary-btn">Ver catálogo</router-link>
            <a href="tel:+5214442151913" class="secondary-btn">Cotizar ahora</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Propuesta Única de Valor - SEO Section -->
    <section class="usp-section py-16">
      <v-container>
        <v-row justify="center">
          <v-col cols="12" md="10">
            <h1 class="usp-h1">
              Soluciones Integrales de Equipamiento Gastronómico Industrial
            </h1>

            <h2 class="usp-h2">
              Comercialización de Marcas Líderes Internacionales
            </h2>

            <div class="usp-text">
              <p>
                Fabricación a medida en acero inoxidable, instalación profesional y respaldo técnico certificado por las marcas a través de SERVIRAM.
              </p>

              <div class="usp-features">
                <div class="feature-item">
                  <v-icon class="feature-icon">mdi-check-circle-outline</v-icon>
                  <span>Marcas líderes internacionales</span>
                </div>
                <div class="feature-item">
                  <v-icon class="feature-icon">mdi-check-circle-outline</v-icon>
                  <span>Fabricación a medida en acero inoxidable</span>
                </div>
                <div class="feature-item">
                  <v-icon class="feature-icon">mdi-check-circle-outline</v-icon>
                  <span>Instalación profesional</span>
                </div>
                <div class="feature-item">
                  <v-icon class="feature-icon">mdi-check-circle-outline</v-icon>
                  <span>Respaldo técnico certificado</span>
                </div>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <!-- Productos Destacados Section -->
    <v-container ref="productsSection" class="featured-section py-20">
      <v-row justify="center">
        <v-col cols="12" md="10" class="text-center">
          <h3 class="section-title mb-12">
            Productos Destacados
          </h3>

          <div class="products-grid">
            <div
              v-if="loadingProducts"
              class="product-card product-card--status"
            >
              <div class="product-info">
                <h4 class="product-name">Cargando productos...</h4>
              </div>
            </div>
            <div
              v-else-if="featuredProducts.length === 0"
              class="product-card product-card--status"
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
                  <p v-if="product.category" class="product-category">{{ typeof product.category === 'string' ? product.category : product.category?.nombre }}</p>
                  <div class="product-price">
                    <span class="price">${{ formatPrice(product.price) }}</span>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </v-col>
      </v-row>

      <div v-if="!loading && featuredProducts.length > 0" class="pagination-shell">
        <v-pagination
          :model-value="currentPage"
          @update:model-value="handlePageChange"
          :length="totalPages"
          :total-visible="$vuetify.display.smAndDown ? 4 : 7"
          rounded="circle"
          active-color="primary"
        />
      </div>
    </v-container>


  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const ITEMS_PER_PAGE = 4
const currentPage = ref(1)
const totalPages = ref(1)
const loadingProducts = ref(false)
const loadingFeatured = ref(false)
const loading = loadingProducts
const featuredProducts = ref([])
const productsSection = ref(null)

const currentCategory = ref({
  title: 'RAMEX KITCHEN',
  description: 'Equipo Profesional para Cocinas - Soluciones integrales de equipamiento gastronómico',
  image: 'https://via.placeholder.com/1200x300?text=RAMEX+KITCHEN'
})

const formatPrice = (price) => {
  return parseFloat(price).toLocaleString('es-MX', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 2
  })
}

const viewProduct = (productId) => {
  router.push({ name: 'ProductDetail', params: { id: productId } })
}

const handlePageChange = (page) => {
  if (page === currentPage.value) {
    return
  }

  currentPage.value = page
  fetchFeaturedProducts()

  // Scroll hacia la sección de productos
  setTimeout(() => {
    if (productsSection.value) {
      productsSection.value.$el.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }
  }, 100)
}

const fetchFeaturedProducts = async () => {
  loadingProducts.value = true
  loadingFeatured.value = true

  try {
    const requestedPage = Number(currentPage.value) || 1
    const params = new URLSearchParams()
    params.append('page', requestedPage.toString())
    params.append('per_page', ITEMS_PER_PAGE.toString())

    const response = await fetch(`/api/productos/destacado?${params}`)

    if (!response.ok) {
      throw new Error('No se pudieron cargar los productos destacados')
    }

    const payload = await response.json()
    featuredProducts.value = (payload.data ?? []).slice(0, ITEMS_PER_PAGE)
    currentPage.value = Number(payload.current_page ?? requestedPage)
    totalPages.value = Math.max(1, Number(payload.last_page ?? 1))
  } catch (error) {
    console.error('Error al cargar productos destacados:', error)
    featuredProducts.value = []
  } finally {
    loadingProducts.value = false
    loadingFeatured.value = false
  }
}

onMounted(() => {
  fetchFeaturedProducts()
})
</script>

<style scoped>

.ramex-home-alakarta {
  background: linear-gradient(180deg, #fffdfb 0%, #f9f5f2 100%);
  color: var(--color-dark);
}

/* Banner */
.category-banner {
  padding: 28px 0 18px;
}

.banner-image {
  position: relative;
  max-width: 1280px;
  height: 360px;
  margin: 0 auto;
  padding: 0 20px;
  background-size: cover;
  background-position: center;
  border-radius: 28px;
  overflow: hidden;
  box-shadow: var(--shadow-soft);
}

.banner-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, rgba(10, 10, 12, 0.74) 0%, rgba(10, 10, 12, 0.52) 35%, rgba(10, 10, 12, 0.18) 100%);
}

.banner-content {
  position: relative;
  z-index: 2;
  color: white;
  max-width: 620px;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 0 60px;
}

.banner-kicker {
  display: inline-block;
  align-self: flex-start;
  background: rgba(255, 255, 255, 0.14);
  border: 1px solid rgba(255, 255, 255, 0.18);
  padding: 8px 14px;
  border-radius: 999px;
  font-size: 0.72rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  margin-bottom: 18px;
}

.banner-content h1 {
  font-size: clamp(2rem, 4vw, 4rem);
  margin-bottom: 12px;
  font-weight: 800;
  line-height: 1.05;
  letter-spacing: -0.04em;
}

.banner-content p {
  font-size: 1rem;
  line-height: 1.65;
  opacity: 0.97;
  max-width: 540px;
}

.banner-actions {
  display: flex;
  gap: 14px;
  margin-top: 22px;
  flex-wrap: wrap;
}

.primary-btn,
.secondary-btn {
  text-decoration: none;
  border-radius: 999px;
  padding: 14px 24px;
  font-weight: 700;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.primary-btn {
  background: linear-gradient(135deg, var(--color-primary) 0%, #d97d4d 100%);
  color: white;
  box-shadow: 0 18px 28px rgba(201, 92, 34, 0.25);
}

.secondary-btn {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.24);
  color: white;
}

.primary-btn:hover,
.secondary-btn:hover {
  transform: translateY(-1px);
}

/* Featured Section */
.featured-section {
  background: transparent;
  padding: 60px 0;
}

.section-title {
  font-size: 2.4rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -0.02em;
  color: var(--color-dark);
  margin-bottom: 48px;
}

/* Products Grid */
.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 28px;
  margin-top: 32px;
}

.product-card {
  background: white;
  border: 1px solid #e5e5e7;
  border-radius: 16px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
  display: flex;
  flex-direction: column;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  cursor: pointer;
}

.product-card:hover {
  transform: translateY(-6px);
  border-color: #d97d4d;
  box-shadow: 0 12px 24px rgba(201, 92, 34, 0.15);
}

.product-card--status {
  background: white;
  border: 2px dashed #e5e5e7;
  min-height: 350px;
  display: flex;
  align-items: center;
  justify-content: center;
  grid-column: 1 / -1;
  cursor: default;
}

.product-card--status:hover {
  transform: none;
  border-color: #e5e5e7;
}

.product-image {
  position: relative;
  height: 280px;
  background: #f5f5f7;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 16px;
  border-bottom: 1px solid #e5e5e7;
}

.product-card__image {
  width: 100% !important;
  height: 100% !important;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.product-image:hover .product-card__image {
  transform: scale(1.08);
}

.placeholder-product {
  width: 100%;
  height: 100%;
  background: #f5f5f7;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3.5rem;
  font-weight: 800;
  color: #d1d1d6;
}

.product-overlay {
  position: absolute;
  inset: 0;
  background: rgba(10, 10, 12, 0.72);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.product-image:hover .product-overlay {
  opacity: 1;
}

.view-btn {
  color: white !important;
  border-color: rgba(255, 255, 255, 0.7) !important;
  font-weight: 600;
  font-size: 0.9rem;
  padding: 10px 20px !important;
}

.view-btn:hover {
  background: rgba(255, 255, 255, 0.2) !important;
  border-color: white !important;
}

.product-info {
  padding: 16px;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.product-brand {
  font-size: 0.7rem;
  color: #999;
  font-weight: 600;
  margin-bottom: 8px;
  text-transform: uppercase;
  letter-spacing: 0.06em;
}

.product-name {
  font-size: 0.95rem;
  font-weight: 600;
  margin-bottom: 12px;
  line-height: 1.4;
  color: #1d1d1f;
  min-height: auto;
  flex-grow: 1;
}

.product-category {
  font-size: 0.75rem;
  color: #999;
  margin-bottom: 12px;
  font-style: normal;
}

.product-description {
  font-size: 0.85rem;
  color: #999;
  line-height: 1.4;
  margin-bottom: 12px;
}

.product-price {
  margin-top: auto;
  display: flex;
  align-items: baseline;
  gap: 8px;
  padding-top: 12px;
  border-top: 1px solid #f5f5f7;
}

.price {
  font-size: 1.5rem;
  font-weight: 800;
  color: #1d1d1f;
}

/* Responsive */
@media (max-width: 768px) {
  .products-grid {
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 16px;
  }

  .section-title {
    font-size: 1.8rem;
  }

  .banner-content {
    padding: 0 30px;
  }

  .banner-image {
    height: 260px;
  }
}

@media (max-width: 600px) {
  .products-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .product-image {
    height: 160px;
  }

  .banner-image {
    height: 220px;
    border-radius: 18px;
  }

  .banner-content {
    padding: 0 20px;
  }

  .section-title {
    font-size: 1.4rem;
    margin-bottom: 24px;
  }
}

/* USP Section - SEO con Estilos Premium */
.usp-section {
  background: linear-gradient(135deg, #f9f5f2 0%, #fffdfb 50%, #f9f5f2 100%);
  border-top: 1px solid rgba(217, 125, 77, 0.2);
  border-bottom: 1px solid rgba(217, 125, 77, 0.2);
  position: relative;
  overflow: hidden;
}

/* Elementos decorativos de fondo */
.usp-section::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -10%;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(217, 125, 77, 0.08) 0%, transparent 70%);
  border-radius: 50%;
  pointer-events: none;
}

.usp-section::after {
  content: '';
  position: absolute;
  bottom: -50%;
  left: -5%;
  width: 350px;
  height: 350px;
  background: radial-gradient(circle, rgba(217, 125, 77, 0.06) 0%, transparent 70%);
  border-radius: 50%;
  pointer-events: none;
}

.usp-h1 {
  font-size: clamp(1.8rem, 5vw, 2.8rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.03em;
  color: #0a0a0c;
  margin-bottom: 12px;
  text-align: center;
  position: relative;
  z-index: 1;
  animation: slideUp 0.8s ease-out;
}

.usp-h1::before {
  content: '';
  display: block;
  width: 60px;
  height: 4px;
  background: linear-gradient(90deg, transparent, #d97d4d, transparent);
  margin: 16px auto 0;
}

.usp-h2 {
  font-size: clamp(1.2rem, 4vw, 1.8rem);
  font-weight: 700;
  line-height: 1.25;
  letter-spacing: -0.02em;
  background: linear-gradient(135deg, #d97d4d 0%, #c96b39 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 28px;
  text-align: center;
  position: relative;
  z-index: 1;
  animation: slideUp 0.8s ease-out 0.1s both;
}

.usp-text {
  text-align: center;
  margin-bottom: 32px;
  position: relative;
  z-index: 1;
  animation: slideUp 0.8s ease-out 0.2s both;
}

.usp-text p {
  font-size: clamp(0.95rem, 2vw, 1.1rem);
  line-height: 1.8;
  color: #424245;
  margin-bottom: 24px;
  position: relative;
}

.usp-text strong {
  color: #d97d4d;
  font-weight: 700;
}

.usp-features {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 24px;
  max-width: 1000px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.feature-item {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: 18px 20px;
  font-size: 0.95rem;
  color: #424245;
  line-height: 1.5;
  background: rgba(255, 255, 255, 0.5);
  border: 1px solid rgba(217, 125, 77, 0.2);
  border-radius: 14px;
  transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
  cursor: default;
  animation: slideUp 0.8s ease-out forwards;
  opacity: 0;
}

.feature-item:nth-child(1) { animation-delay: 0.3s; }
.feature-item:nth-child(2) { animation-delay: 0.35s; }
.feature-item:nth-child(3) { animation-delay: 0.4s; }
.feature-item:nth-child(4) { animation-delay: 0.45s; }

.feature-item:hover {
  background: rgba(217, 125, 77, 0.08);
  border-color: #d97d4d;
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(217, 125, 77, 0.15);
}

.feature-icon {
  color: #d97d4d;
  font-size: 1.4rem;
  flex-shrink: 0;
  margin-top: 2px;
  transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.feature-item:hover .feature-icon {
  transform: scale(1.2) rotate(10deg);
}

/* Animaciones */
@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive */
@media (max-width: 768px) {
  .usp-section {
    padding: 40px 16px !important;
  }

  .usp-section::before,
  .usp-section::after {
    width: 250px;
    height: 250px;
  }

  .usp-h1 {
    font-size: 1.5rem;
    margin-bottom: 10px;
  }

  .usp-h1::before {
    width: 40px;
    height: 3px;
    margin: 12px auto 0;
  }

  .usp-h2 {
    font-size: 1.1rem;
    margin-bottom: 20px;
  }

  .usp-text p {
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 16px;
  }

  .usp-features {
    grid-template-columns: 1fr;
    gap: 12px;
  }

  .feature-item {
    padding: 14px 16px;
    font-size: 0.9rem;
  }

  .feature-icon {
    font-size: 1.2rem;
  }
}

@media (max-width: 480px) {
  .usp-section {
    padding: 28px 12px !important;
  }

  .usp-h1 {
    font-size: 1.3rem;
  }

  .usp-h2 {
    font-size: 0.95rem;
  }

  .feature-item {
    padding: 12px 12px;
  }
}
</style>
