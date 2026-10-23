# 🚀 RAMEX KITCHEN - Implementación Vue en Home

## 📋 Resumen de Cambios

Se ha actualizado completamente la página de inicio del ecommerce de SERVIRAM con una interfaz moderna, interactiva y profesional inspirada en diseños de e-commerce líderes como Alakarta, implementando los colores y elementos del Manual de Identidad de RAMEX KITCHEN.

---

## 🎨 Colores Implementados (RAMEX KITCHEN)

- **Terracota Marrakech**: `#C84617` - Color primario principal
- **Gris Grafito**: `#383838` - Texto y elementos oscuros
- **Gris Niebla de Montaña**: `#BABABA` - Elementos secundarios
- **Blanco**: `#ffffff` - Fondos principales
- **Light Gray**: `#f5f5f5` - Fondos secundarios

---

## 📁 Archivos Creados/Modificados

### Archivos Creados:

1. **`resources/css/ramex-theme.css`** ✨
   - Sistema de colores global
   - Componentes reutilizables (botones, tarjetas, badges)
   - Animaciones y transiciones
   - Utilidades de espaciado y tipografía
   - Estilos responsivos

2. **`resources/js/components/HeroCarousel.vue`** 🎠
   - Carrusel de héroes automático
   - Controles manuales (anterior/siguiente)
   - Indicadores (dots) interactivos
   - Totalmente personalizable
   - Propiedades:
     - `slides`: Array de slides
     - `autoPlay`: Activar/desactivar autoplay
     - `interval`: Intervalo de autoplay (ms)
     - `showControls`: Mostrar controles
     - `showIndicators`: Mostrar indicadores

3. **`resources/js/components/CategoryCard.vue`** 📦
   - Tarjeta de categoría reutilizable
   - Animaciones hover
   - Icono, nombre y contador
   - Propiedades personalizables
   - Enlaces internos con Vue Router

4. **`resources/js/components/ProductCard.vue`** 🏷️
   - Tarjeta de producto profesional
   - Imagen con overlay interactivo
   - Sistema de favoritos
   - Descuentos visuales
   - Valoración de estrellas
   - Precios con descuento
   - Emits para carrito y favoritos

5. **`resources/js/pages/Home.vue`** 🏠 (Reemplazado)
   - Nueva página de inicio completamente rediseñada
   - Secciones:
     - ✅ Hero section con carrusel
     - ✅ Categorías principales (6)
     - ✅ Barra de búsqueda destacada
     - ✅ Productos destacados (6 items)
     - ✅ Por qué elegir RAMEX KITCHEN (4 beneficios)
     - ✅ Testimonios de clientes (3)
     - ✅ CTA Final

---

## 🎯 Características Principales

### 1. **Hero Section Carrusel** 🎨
```vue
- Cambio automático cada 5 segundos
- Controles de navegación manual
- Indicadores (dots) interactivos
- Botones CTA personalizables
- Fondo con overlay gradiente
- Totalmente responsive
```

### 2. **Categorías Principales** 📂
- 6 categorías principales
- Iconos Font Awesome
- Contador de productos
- Animaciones hover elegantes
- Enlaces directos a filtros

### 3. **Búsqueda Destacada** 🔍
- Input con ícono de búsqueda
- Botón de búsqueda integrado
- Envío por Enter o clic
- Enlace a `/productos?q=...`

### 4. **Productos Destacados** 🛍️
- Grid responsivo
- Carga asincrónica desde API
- Hover effects profesionales
- Información de marca y categoría
- Sistema de precios
- Integración con carrito y favoritos

### 5. **Sección de Beneficios** ✨
```
✓ Envío Rápido
✓ Garantía de Calidad
✓ Soporte 24/7
✓ Devoluciones Fáciles
```

### 6. **Testimonios** ⭐
- Tarjetas con valoración (5 estrellas)
- Información del cliente
- Avatar con iniciales
- Nombre y empresa

### 7. **CTA Final** 🎯
- Sección destacada
- Mensaje de conversión
- Botón grande a catálogo completo

---

## 🚀 Cómo Usar los Componentes

### HeroCarousel.vue

```vue
<template>
  <HeroCarousel 
    :slides="heroSlides"
    :autoPlay="true"
    :interval="5000"
    :showControls="true"
    :showIndicators="true"
    @primary-cta="handlePrimaryCTA"
    @secondary-cta="handleSecondaryCTA"
    @slide-change="handleSlideChange"
  />
</template>

<script setup>
import HeroCarousel from '@/components/HeroCarousel.vue'

const heroSlides = [
  {
    title: 'RAMEX KITCHEN',
    subtitle: 'Equipo Profesional para Cocinas',
    description: 'Soluciones integrales de equipamiento gastronómico',
    image: '/images/hero-1.webp',
    cta: {
      primary: 'Ver Catálogo',
      secondary: 'Explorar'
    }
  },
  // ... más slides
]

const handlePrimaryCTA = (slide) => {
  // Manejar CTA primaria
}
</script>
```

### ProductCard.vue

```vue
<template>
  <ProductCard 
    :product="product"
    @add-to-cart="handleAddToCart"
    @toggle-like="handleToggleLike"
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

const handleAddToCart = (product) => {
  // Agregar al carrito
}
</script>
```

### CategoryCard.vue

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

---

## 📱 Responsividad

El diseño es totalmente responsivo:

- **Desktop** (1200px+): Grid de 3-4 columnas
- **Tablet** (768px-1199px): Grid de 2 columnas
- **Mobile** (< 768px): Grid de 1-2 columnas

---

## 🎨 Personalización

### Cambiar Colores RAMEX KITCHEN

Edita `/resources/css/ramex-theme.css`:

```css
:root {
  --color-primary: #C84617;    /* Terracota Marrakech */
  --color-dark: #383838;        /* Gris Grafito */
  --color-gray: #BABABA;        /* Gris Niebla */
  --color-light: #f5f5f5;
  --color-white: #ffffff;
}
```

### Agregar Más Beneficios

En `Home.vue`:

```javascript
const benefits = ref([
  // ... beneficios existentes
  {
    icon: 'fas fa-check-circle',
    title: 'Nuevo Beneficio',
    description: 'Descripción del beneficio'
  }
])
```

### Agregar Más Testimonios

En `Home.vue`:

```javascript
const testimonials = ref([
  // ... testimonios existentes
  {
    id: 4,
    text: 'Nuevo testimonio...',
    name: 'Nombre Cliente',
    company: 'Empresa',
    initials: 'NC'
  }
])
```

---

## 🔄 Integración con API

### Productos Destacados

La página carga automáticamente desde el endpoint:
```
GET /api/productos/destacado?limit=6
```

Respuesta esperada:
```json
{
  "data": [
    {
      "id": 1,
      "name": "Producto",
      "price": 999.99,
      "brand": { "nombre": "Marca" },
      "category": { "nombre": "Categoría" },
      "galeria_imagenes": ["url1.webp", "url2.webp"]
    }
  ]
}
```

---

## 🔧 Mejoras Futuras Sugeridas

1. **Carrusel de Marcas**: Mostrar logos de marcas partner
2. **Newsletter**: Formulario de suscripción
3. **Blog/Noticias**: Sección con últimos artículos
4. **Envíos en Vivo**: Mostra

r envíos en tiempo real
5. **Comparador**: Comparar productos lado a lado
6. **Reviews**: Sistema de valoraciones completo
7. **Wishlist**: Lista de deseos persistente
8. **Analytics**: Seguimiento de conversiones

---

## 📊 Performance

- ✅ Imágenes optimizadas (WebP)
- ✅ Lazy loading en productos
- ✅ CSS compilado y minificado
- ✅ Vue 3 Composition API (más eficiente)
- ✅ AOS (Animate On Scroll) para animaciones

---

## 🐛 Troubleshooting

### Los estilos no se aplican
- Asegúrate que `ramex-theme.css` esté importado en `app.css`
- Ejecuta: `npm run build`

### Las imágenes no cargan
- Verifica que las rutas sean correctas
- Coloca imágenes en `/public/images/`

### Componentes no se cargan
- Verifica que estén importados correctamente en Home.vue
- Recarga la página en el navegador

---

## 📞 Soporte

Para cualquier pregunta sobre la implementación, consulta:
- Vue 3 Docs: https://vuejs.org
- Vuetify Docs: https://vuetifyjs.com
- Font Awesome: https://fontawesome.com

---

**Última actualización**: Octubre 2026
**Desarrollado con**: Vue 3, Vuetify 3, Tailwind CSS, Font Awesome
**Compatible con**: Laravel 11, Vite 7
