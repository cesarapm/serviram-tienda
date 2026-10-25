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
            <a href="tel:+5233614891" class="secondary-btn">Cotizar ahora</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Productos Destacados Section -->
    <v-container class="featured-section py-20">
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
    </v-container>


  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const loadingProducts = ref(false)
const featuredProducts = ref([])

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

const fetchProducts = async () => {
  loadingProducts.value = true
  try {
    const response = await fetch('/api/productos/destacado?limit=12')
    if (response.ok) {
      const data = await response.json()
      featuredProducts.value = data.data || []
    }
  } catch (error) {
    console.error('Error cargando productos:', error)
  } finally {
    loadingProducts.value = false
  }
}

onMounted(() => {
  fetchProducts()
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
</style>
