# 📚 Guía Completa de Componentes RAMEX KITCHEN

## 🎯 Componentes Disponibles

### 1. **HeroCarousel.vue** 🎠
Carrusel automático de héroes con controles manuales.

**Ubicación**: `/resources/js/components/HeroCarousel.vue`

**Props**:
```javascript
{
  slides: Array,              // Array de slides (requerido)
  autoPlay: Boolean,          // Autoplay habilitado (default: true)
  interval: Number,           // Intervalo en ms (default: 5000)
  showControls: Boolean,      // Mostrar controles (default: true)
  showIndicators: Boolean     // Mostrar indicadores (default: true)
}
```

**Events**:
```javascript
@primary-cta      // Click en botón primario
@secondary-cta    // Click en botón secundario
@slide-change     // Cambio de slide (emite index)
```

**Ejemplo de Slide**:
```javascript
{
  title: 'RAMEX KITCHEN',
  subtitle: 'Equipo Profesional para Cocinas',
  description: 'Soluciones integrales de equipamiento gastronómico',
  image: '/images/hero-1.webp',
  cta: {
    primary: 'Ver Catálogo',
    secondary: 'Explorar'
  }
}
```

**Uso**:
```vue
<template>
  <HeroCarousel 
    :slides="heroSlides"
    :autoPlay="true"
    :interval="5000"
    @primary-cta="handleViewCatalog"
  />
</template>

<script setup>
import HeroCarousel from '@/components/HeroCarousel.vue'

const heroSlides = ref([
  {
    title: 'RAMEX KITCHEN',
    subtitle: 'Equipo Profesional para Cocinas',
    image: '/images/hero-1.webp',
    cta: { primary: 'Ver Catálogo', secondary: 'Explorar' }
  }
])

const handleViewCatalog = (slide) => {
  router.push('/productos')
}
</script>
```

---

### 2. **CategoryCard.vue** 📦
Tarjeta de categoría individual.

**Ubicación**: `/resources/js/components/CategoryCard.vue`

**Props**:
```javascript
{
  id: Number,              // ID de la categoría (requerido)
  name: String,            // Nombre (requerido)
  slug: String,            // Slug para URL (requerido)
  icon: String,            // Clase de Font Awesome (requerido)
  count: Number,           // Cantidad de productos (default: 0)
  isHighlighted: Boolean   // Destacar (default: false)
}
```

**Uso**:
```vue
<template>
  <CategoryCard 
    id="1"
    name="Cocción"
    slug="coccion"
    icon="fas fa-fire"
    count="45"
    :isHighlighted="false"
  />
</template>
```

**Grid de Categorías**:
```vue
<div class="categories-grid">
  <CategoryCard 
    v-for="cat in categories"
    :key="cat.id"
    :id="cat.id"
    :name="cat.name"
    :slug="cat.slug"
    :icon="cat.icon"
    :count="cat.count"
  />
</div>
```

---

### 3. **ProductCard.vue** 🏷️
Tarjeta de producto profesional.

**Ubicación**: `/resources/js/components/ProductCard.vue`

**Props**:
```javascript
{
  product: Object  // Objeto producto (requerido)
}
```

**Estructura esperada del producto**:
```javascript
{
  id: Number,
  name: String,
  price: Number,
  originalPrice: Number,        // Opcional (para descuentos)
  discount: Number,              // Opcional (porcentaje)
  brand: { nombre: String },
  category: { nombre: String },
  galeria_imagenes: Array,
  rating: Number,                // 1-5 estrellas
  ratingCount: Number            // Cantidad de reviews
}
```

**Events**:
```javascript
@add-to-cart    // Agregar al carrito
@toggle-like    // Agregar a favoritos
```

**Uso**:
```vue
<template>
  <ProductCard 
    :product="product"
    @add-to-cart="addToCart"
    @toggle-like="toggleLike"
  />
</template>

<script setup>
import ProductCard from '@/components/ProductCard.vue'

const product = {
  id: 1,
  name: 'Estufa Comercial 6 Quemadores',
  price: 5999.99,
  originalPrice: 7999.99,
  brand: { nombre: 'Rational' },
  category: { nombre: 'Cocción' },
  galeria_imagenes: ['/images/product-1.webp'],
  discount: 25,
  rating: 5,
  ratingCount: 48
}

const addToCart = (product) => {
  console.log('Agregar al carrito:', product)
}

const toggleLike = (product) => {
  console.log('Toggle favorito:', product)
}
</script>
```

**Grid de Productos**:
```vue
<div class="products-grid">
  <ProductCard 
    v-for="product in products"
    :key="product.id"
    :product="product"
    @add-to-cart="handleAddToCart"
    @toggle-like="handleToggleLike"
  />
</div>
```

---

### 4. **BrandsCarousel.vue** 🏢
Carrusel de marcas con scroll horizontal.

**Ubicación**: `/resources/js/components/BrandsCarousel.vue`

**Props**:
```javascript
{
  brands: Array  // Array de marcas (default: ejemplo)
}
```

**Estructura de marca**:
```javascript
{
  id: Number,
  name: String,
  logo: String  // URL del logo
}
```

**Uso**:
```vue
<template>
  <BrandsCarousel :brands="brands" />
</template>

<script setup>
import BrandsCarousel from '@/components/BrandsCarousel.vue'

const brands = ref([
  { id: 1, name: 'Rational', logo: '/images/brands/rational.webp' },
  { id: 2, name: 'Unox', logo: '/images/brands/unox.webp' },
  { id: 3, name: 'Winterhalter', logo: '/images/brands/winterhalter.webp' },
])
</script>
```

---

### 5. **Newsletter.vue** 📧
Formulario de suscripción a newsletter.

**Ubicación**: `/resources/js/components/Newsletter.vue`

**Sin Props (componente autosuficiente)**

**Features**:
- Validación de email
- Mensajes de éxito/error
- Estados de carga
- Checkbox de privacidad
- Diseño responsivo

**Uso**:
```vue
<template>
  <Newsletter />
</template>

<script setup>
import Newsletter from '@/components/Newsletter.vue'
</script>
```

**Customizar endpoint**:
```javascript
// Editar el método subscribe() en Newsletter.vue
const response = await fetch('/api/newsletter/subscribe', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ email: email.value })
})
```

---

## 🎨 Componentes CSS Globales

### Botones

**Clases disponibles**:
```html
<!-- Tamaños -->
<button class="btn">Default</button>
<button class="btn btn-lg">Large</button>
<button class="btn btn-sm">Small</button>

<!-- Variantes -->
<button class="btn btn-primary">Primary</button>
<button class="btn btn-secondary">Secondary</button>
<button class="btn btn-outlined">Outlined</button>

<!-- Bloques -->
<button class="btn btn-block">Full Width</button>

<!-- Deshabilitado -->
<button class="btn" disabled>Disabled</button>
```

### Tarjetas

```html
<div class="card">
  <div class="card-body">
    Contenido de la tarjeta
  </div>
</div>
```

### Grillas

```html
<!-- 2 columnas (auto-fit) -->
<div class="grid grid-2">
  <div>Item 1</div>
  <div>Item 2</div>
</div>

<!-- 3 columnas -->
<div class="grid grid-3">
  <div>Item 1</div>
  <div>Item 2</div>
  <div>Item 3</div>
</div>

<!-- 4 columnas -->
<div class="grid grid-4">
  <div>Item 1</div>
  <div>Item 2</div>
</div>
```

### Badges

```html
<span class="badge badge-primary">Primary</span>
<span class="badge badge-secondary">Secondary</span>
<span class="badge badge-success">Success</span>
```

### Alertas

```html
<div class="alert alert-success">
  <i class="fas fa-check-circle"></i>
  Operación exitosa
</div>

<div class="alert alert-error">
  <i class="fas fa-exclamation-circle"></i>
  Error en la operación
</div>

<div class="alert alert-warning">
  Advertencia
</div>

<div class="alert alert-info">
  Información útil
</div>
```

---

## 📱 Utilidades CSS

### Espaciado

```html
<!-- Margin Top -->
<div class="mt-1">8px</div>
<div class="mt-2">16px</div>
<div class="mt-3">24px</div>
<div class="mt-4">32px</div>

<!-- Margin Bottom -->
<div class="mb-1">8px</div>
<div class="mb-2">16px</div>
<div class="mb-3">24px</div>
<div class="mb-4">32px</div>

<!-- Padding Top/Bottom -->
<div class="pt-2">16px top</div>
<div class="pb-2">16px bottom</div>
```

### Texto

```html
<div class="text-center">Centrado</div>
<div class="text-left">Izquierda</div>
<div class="text-right">Derecha</div>
<div class="text-uppercase">MAYÚSCULAS</div>
<div class="text-lowercase">minúsculas</div>
<div class="font-bold">Negrita</div>
<div class="font-semibold">Semi-bold</div>
<div class="text-muted">Texto apagado</div>
<div class="text-primary">Texto primario</div>
<div class="text-dark">Texto oscuro</div>
```

### Display

```html
<div class="hidden">Oculto</div>
<div class="visible">Visible</div>
<div class="flex">Flex</div>
<div class="flex-center">Flex centrado</div>
<div class="flex-between">Flex espaciado</div>
<div class="block">Bloque</div>
<div class="inline-block">Inline-block</div>
```

---

## 🔄 Patrón de Integración en Home.vue

```vue
<template>
  <div class="home">
    <!-- Hero Carrusel -->
    <HeroCarousel 
      :slides="heroSlides"
      @primary-cta="handlePrimaryCTA"
    />

    <!-- Categorías -->
    <section class="section">
      <div class="container">
        <h2 class="section-title">Categorías</h2>
        <div class="grid grid-3">
          <CategoryCard 
            v-for="cat in categories"
            :key="cat.id"
            v-bind="cat"
          />
        </div>
      </div>
    </section>

    <!-- Productos -->
    <section class="section">
      <div class="container">
        <h2 class="section-title">Destacados</h2>
        <div class="grid grid-3">
          <ProductCard 
            v-for="product in products"
            :key="product.id"
            :product="product"
            @add-to-cart="addToCart"
          />
        </div>
      </div>
    </section>

    <!-- Marcas -->
    <BrandsCarousel :brands="brands" />

    <!-- Newsletter -->
    <Newsletter />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import HeroCarousel from '@/components/HeroCarousel.vue'
import CategoryCard from '@/components/CategoryCard.vue'
import ProductCard from '@/components/ProductCard.vue'
import BrandsCarousel from '@/components/BrandsCarousel.vue'
import Newsletter from '@/components/Newsletter.vue'

const heroSlides = ref([/* ... */])
const categories = ref([/* ... */])
const products = ref([/* ... */])
const brands = ref([/* ... */])

const handlePrimaryCTA = () => { /* ... */ }
const addToCart = () => { /* ... */ }
</script>
```

---

## 🎓 Mejores Prácticas

### 1. **Reutilización de Componentes**
- Usa CategoryCard dentro de un grid, no uno por uno
- ProductCard es perfecto para listas y grillas
- HeroCarousel para cualquier carrusel

### 2. **Props y Emits**
- Siempre define props requeridas vs opcionales
- Usa emits para eventos personalizados
- Documenta qué datos espera cada componente

### 3. **Estilos Scoped**
- Todos los componentes usan `scoped`
- Las clases globales van en `ramex-theme.css`
- Usa CSS variables para mantener consistencia

### 4. **Accesibilidad**
- Botones con `aria-label`
- Inputs con `placeholder` y `required`
- Iconos con `aria-label` si no hay texto

### 5. **Responsividad**
- Mobile first approach
- Media queries en: 480px, 768px, 1024px, 1200px
- Testea en múltiples dispositivos

---

## 🚀 Próximas Mejoras

**Componentes para crear**:
1. `RatingStars.vue` - Sistema de valoración
2. `SearchBar.vue` - Búsqueda avanzada
3. `Filters.vue` - Panel de filtros
4. `ImageGallery.vue` - Galería de imágenes
5. `ReviewSection.vue` - Sección de reseñas
6. `RelatedProducts.vue` - Productos relacionados
7. `FAQ.vue` - Preguntas frecuentes
8. `ContactForm.vue` - Formulario de contacto

---

*Documento generado: Octubre 2026*
*RAMEX KITCHEN - Guía de Componentes*
