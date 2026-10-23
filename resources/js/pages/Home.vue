<template>
  <div class="ramex-home-alakarta">
    <!-- Noticia Bar -->
    <div class="notice-bar">
      <p>Contacta a un agente, sólo da click aquí. Llámanos al (33) 3614 1891</p>
      <i class="fas fa-times" @click="noticeVisible = false"></i>
    </div>

    <!-- Navbar Mejorado -->
    <nav class="navbar-top">
      <div class="navbar-container">
        <div class="navbar-brand">
          <router-link to="/" class="logo">
            <span>RAMEX KITCHEN</span>
          </router-link>
        </div>

        <div class="navbar-search">
          <input 
            v-model="searchQuery"
            type="text"
            placeholder="Buscar productos"
            @keydown.enter="search"
          />
          <button @click="search" class="search-btn">
            <i class="fas fa-search"></i> Búsqueda
          </button>
        </div>

        <div class="navbar-right">
          <div class="contact-info">
            <i class="fab fa-whatsapp"></i>
            <div>
              <p>WhatsApp</p>
              <a href="tel:+5233614891">Llámanos</a>
            </div>
          </div>
          <div class="navbar-icons">
            <a href="#" title="Idioma"><i class="fas fa-globe"></i> ES</a>
            <a href="#" title="Mi cuenta"><i class="fas fa-user"></i></a>
            <a href="#" title="Carrito"><i class="fas fa-shopping-cart"></i></a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Menú de Navegación Oscuro -->
    <nav class="navbar-menu">
      <div class="navbar-container">
        <ul class="menu-list">
          <li v-for="item in menuItems" :key="item.id">
            <router-link :to="item.path">{{ item.name }}</router-link>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Banner de Categoría -->
    <section class="category-banner" v-if="currentCategory">
      <div class="banner-image" :style="{ backgroundImage: `url(${currentCategory.image})` }">
        <div class="banner-overlay"></div>
        <div class="banner-content">
          <h1>{{ currentCategory.title }}</h1>
          <p>{{ currentCategory.description }}</p>
        </div>
      </div>
    </section>

    <!-- Contenedor Filtros + Productos -->
    <div class="products-container">
      <div class="navbar-container">
        <div class="products-wrapper">
          <!-- Sidebar Filtros -->
          <aside class="products-sidebar">
            <div class="filter-group">
              <h3>PRECIO</h3>
              <div class="price-filter">
                <input v-model="priceMin" type="number" placeholder="Min" />
                <span>-</span>
                <input v-model="priceMax" type="number" placeholder="Max" />
              </div>
              <p class="price-note">El precio más alto es $999,999,999.00</p>
            </div>

            <div class="filter-group">
              <h3>MARCA</h3>
              <div class="brand-filter">
                <label v-for="brand in brands" :key="brand.id">
                  <input type="checkbox" :value="brand.id" v-model="selectedBrands" />
                  {{ brand.name }}
                </label>
              </div>
            </div>
          </aside>

          <!-- Grid de Productos -->
          <main class="products-main">
            <div class="products-header">
              <div class="products-count">
                <strong>{{ featuredProducts.length }}</strong> Productos
              </div>
              <div class="products-sort">
                <label>Ordenar por:</label>
                <select v-model="sortBy">
                  <option value="az">Alfabéticamente, A-Z</option>
                  <option value="za">Alfabéticamente, Z-A</option>
                  <option value="price-asc">Precio, menor a mayor</option>
                  <option value="price-desc">Precio, mayor a menor</option>
                </select>
              </div>
            </div>

            <div v-if="loadingProducts" class="loading">
              <v-progress-circular indeterminate></v-progress-circular>
            </div>

            <div v-else-if="featuredProducts.length === 0" class="empty-state">
              <p>No hay productos disponibles</p>
            </div>

            <div v-else class="products-grid-alakarta">
              <div v-for="product in featuredProducts" :key="product.id" class="product-card-alakarta">
                <div class="product-image">
                  <img 
                    :src="product.galeria_imagenes?.[0] || 'https://via.placeholder.com/200?text=No+Imagen'"
                    :alt="product.name"
                  />
                </div>
                <div class="product-info">
                  <p class="product-brand">{{ product.brand?.nombre || 'Sin marca' }}</p>
                  <h4 class="product-name">{{ product.name }}</h4>
                  <p class="product-price">${{ formatPrice(product.price) }}</p>
                  <router-link :to="`/producto/${product.id}`" class="product-link">
                    Ver detalles →
                  </router-link>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const noticeVisible = ref(true)
const activeSlide = ref(0)
const searchQuery = ref('')
const sortBy = ref('az')
const priceMin = ref('')
const priceMax = ref('')
const selectedBrands = ref([])
const loadingProducts = ref(false)
const featuredProducts = ref([])

const currentCategory = ref({
  title: 'RAMEX KITCHEN',
  description: 'Equipo Profesional para Cocinas - Soluciones integrales de equipamiento gastronómico',
  image: 'https://via.placeholder.com/1200x300?text=RAMEX+KITCHEN'
})

const menuItems = ref([
  { id: 1, name: 'TODAS LAS MARCAS', path: '/productos' },
  { id: 2, name: 'ACERO INOXIDABLE', path: '/productos?cat=acero' },
  { id: 3, name: 'COCCIONES', path: '/productos?cat=coccion' },
  { id: 4, name: 'CAFETERAS', path: '/productos?cat=cafeteras' },
  { id: 5, name: 'LAVADO', path: '/productos?cat=lavado' },
  { id: 6, name: 'PREPARACIÓN DE ALIMENTOS', path: '/productos?cat=preparacion' },
  { id: 7, name: 'REFRIGERACIÓN', path: '/productos?cat=refrigeracion' },
  { id: 8, name: 'EQUIPOS PARA HELADO', path: '/productos?cat=helado' },
  { id: 9, name: 'INSUMOS', path: '/productos?cat=insumos' },
  { id: 10, name: 'MARCAS', path: '/marcas' },
  { id: 11, name: 'SOBRE NOSOTROS', path: '/nosotros' },
])

const brands = ref([
  { id: 1, name: 'Rational' },
  { id: 2, name: 'Unox' },
  { id: 3, name: 'Winterhalter' },
  { id: 4, name: 'Euroquip' },
  { id: 5, name: 'MIGSA' },
])

const formatPrice = (price) => {
  return parseFloat(price).toLocaleString('es-MX', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 2
  })
}

const search = () => {
  if (searchQuery.value.trim()) {
    router.push(`/productos?q=${encodeURIComponent(searchQuery.value)}`)
  }
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
:root {
  --color-primary: #C84617;
  --color-dark: #383838;
  --color-gray: #BABABA;
  --color-light: #f5f5f5;
  --color-black: #1a1a1a;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.ramex-home-alakarta {
  background: white;
  color: var(--color-dark);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Notice Bar */
.notice-bar {
  background: var(--color-black);
  color: white;
  padding: 12px 0;
  text-align: center;
  font-size: 0.9rem;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
}

.notice-bar p {
  margin: 0;
}

.notice-bar i {
  cursor: pointer;
  opacity: 0.7;
}

/* Navbar Top */
.navbar-top {
  background: white;
  border-bottom: 1px solid var(--color-light);
  padding: 15px 0;
}

.navbar-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 40px;
}

.navbar-brand {
  flex-shrink: 0;
}

.navbar-brand .logo {
  display: flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
  color: var(--color-dark);
  font-weight: 700;
  font-size: 1.2rem;
}

.navbar-brand img {
  height: 40px;
  width: auto;
}

.navbar-search {
  flex: 1;
  display: flex;
  gap: 0;
}

.navbar-search input {
  flex: 1;
  padding: 10px 15px;
  border: 1px solid var(--color-gray);
  border-radius: 0;
  font-size: 0.95rem;
}

.search-btn {
  padding: 10px 20px;
  background: #D4A574;
  color: white;
  border: none;
  cursor: pointer;
  font-weight: 600;
  transition: background 0.3s;
}

.search-btn:hover {
  background: #c99559;
}

.navbar-right {
  display: flex;
  gap: 30px;
  align-items: center;
  flex-shrink: 0;
}

.contact-info {
  display: flex;
  gap: 10px;
  align-items: center;
  font-size: 0.9rem;
}

.contact-info i {
  font-size: 1.5rem;
  color: var(--color-primary);
}

.contact-info p {
  margin: 0;
  font-size: 0.8rem;
}

.contact-info a {
  color: var(--color-primary);
  text-decoration: none;
  font-weight: 600;
}

.navbar-icons {
  display: flex;
  gap: 20px;
}

.navbar-icons a {
  display: flex;
  align-items: center;
  gap: 5px;
  color: var(--color-dark);
  text-decoration: none;
  font-size: 0.95rem;
  transition: color 0.3s;
}

.navbar-icons a:hover {
  color: var(--color-primary);
}

/* Menu Oscuro */
.navbar-menu {
  background: var(--color-black);
  padding: 0;
}

.navbar-menu .navbar-container {
  gap: 0;
}

.menu-list {
  display: flex;
  list-style: none;
  gap: 0;
  width: 100%;
  flex-wrap: wrap;
}

.menu-list li {
  flex: 0 1 auto;
}

.menu-list a {
  display: block;
  padding: 15px 18px;
  color: white;
  text-decoration: none;
  font-size: 0.85rem;
  font-weight: 600;
  white-space: nowrap;
  transition: background 0.3s, color 0.3s;
}

.menu-list a:hover {
  background: var(--color-primary);
  color: white;
}

/* Banner */
.category-banner {
  height: 300px;
  overflow: hidden;
  margin-bottom: 40px;
}

.banner-image {
  position: relative;
  height: 100%;
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding-left: 60px;
}

.banner-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
}

.banner-content {
  position: relative;
  z-index: 2;
  color: white;
  max-width: 600px;
}

.banner-content h1 {
  font-size: 2.5rem;
  margin-bottom: 15px;
  font-weight: 700;
}

.banner-content p {
  font-size: 1rem;
  line-height: 1.6;
  opacity: 0.95;
}

/* Productos */
.products-container {
  padding: 0 0 60px 0;
  background: white;
}

.products-wrapper {
  display: grid;
  grid-template-columns: 250px 1fr;
  gap: 40px;
}

.products-sidebar {
  background: var(--color-light);
  padding: 20px;
  border-radius: 4px;
  height: fit-content;
  top: 20px;
  position: sticky;
}

.filter-group {
  margin-bottom: 30px;
  padding-bottom: 20px;
  border-bottom: 1px solid var(--color-gray);
}

.filter-group:last-child {
  border-bottom: none;
}

.filter-group h3 {
  font-size: 0.95rem;
  font-weight: 700;
  margin-bottom: 15px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.price-filter {
  display: flex;
  gap: 10px;
  align-items: center;
}

.price-filter input {
  flex: 1;
  padding: 8px;
  border: 1px solid var(--color-gray);
  border-radius: 3px;
  font-size: 0.9rem;
}

.price-note {
  font-size: 0.8rem;
  color: var(--color-gray);
  margin-top: 10px;
}

.brand-filter label {
  display: flex;
  gap: 8px;
  margin-bottom: 10px;
  cursor: pointer;
  font-size: 0.95rem;
  align-items: center;
}

.brand-filter input {
  cursor: pointer;
}

/* Header Productos */
.products-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  padding-bottom: 20px;
  border-bottom: 1px solid var(--color-light);
}

.products-count {
  font-size: 0.95rem;
}

.products-count strong {
  font-weight: 700;
  color: var(--color-dark);
}

.products-sort {
  display: flex;
  gap: 15px;
  align-items: center;
}

.products-sort label {
  font-size: 0.95rem;
  font-weight: 600;
}

.products-sort select {
  padding: 8px 12px;
  border: 1px solid var(--color-gray);
  border-radius: 3px;
  background: white;
  cursor: pointer;
  font-size: 0.9rem;
}

/* Grid Alakarta */
.products-grid-alakarta {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 20px;
}

.product-card-alakarta {
  background: white;
  border: 1px solid var(--color-light);
  border-radius: 4px;
  overflow: hidden;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
}

.product-card-alakarta:hover {
  border-color: var(--color-primary);
  box-shadow: 0 4px 12px rgba(200, 70, 23, 0.1);
}

.product-image {
  height: 200px;
  background: var(--color-light);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.product-image img {
  max-width: 90%;
  max-height: 90%;
  object-fit: contain;
}

.product-info {
  padding: 15px;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.product-brand {
  font-size: 0.8rem;
  color: var(--color-primary);
  font-weight: 600;
  margin-bottom: 5px;
  text-transform: uppercase;
}

.product-name {
  font-size: 0.95rem;
  font-weight: 600;
  margin-bottom: 10px;
  line-height: 1.3;
  color: var(--color-dark);
}

.product-price {
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: 10px;
}

.product-link {
  color: var(--color-primary);
  text-decoration: none;
  font-size: 0.9rem;
  font-weight: 600;
  margin-top: auto;
  transition: all 0.3s;
}

.product-link:hover {
  gap: 8px;
}

.loading {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 300px;
}

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: var(--color-gray);
}

/* Responsive */
@media (max-width: 768px) {
  .navbar-container {
    gap: 15px;
    flex-wrap: wrap;
  }

  .navbar-search {
    order: 3;
    width: 100%;
  }

  .navbar-right {
    gap: 15px;
  }

  .contact-info {
    display: none;
  }

  .menu-list {
    gap: 0;
  }

  .menu-list a {
    padding: 12px 10px;
    font-size: 0.75rem;
  }

  .banner-content h1 {
    font-size: 1.8rem;
  }

  .products-wrapper {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .products-sidebar {
    order: 2;
  }

  .products-main {
    order: 1;
  }

  .products-grid-alakarta {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .notice-bar {
    display: none;
  }

  .navbar-search input,
  .search-btn {
    font-size: 0.85rem;
    padding: 8px 10px;
  }

  .banner-content h1 {
    font-size: 1.3rem;
  }

  .banner-content p {
    font-size: 0.9rem;
  }

  .products-grid-alakarta {
    grid-template-columns: 1fr;
  }
}
</style>
