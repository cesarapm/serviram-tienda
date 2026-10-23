# 🚀 GUÍA RÁPIDA - RAMEX KITCHEN Home

## ¿Qué se implementó?

Se rediseñó completamente la página de inicio del ecommerce con **Vue 3**, aplicando los colores y elementos del **Manual de Identidad RAMEX KITCHEN** (#C84617 Terracota Marrakech como color principal).

---

## 📁 Archivos Principales Creados

### Componentes Vue
```
resources/js/components/
├── HeroCarousel.vue      (Carrusel de héroes - 398 líneas)
├── CategoryCard.vue      (Tarjeta de categoría - 161 líneas)
├── ProductCard.vue       (Tarjeta de producto - 244 líneas)
├── BrandsCarousel.vue    (Carrusel de marcas - 244 líneas)
└── Newsletter.vue        (Formulario newsletter - 197 líneas)
```

### Página
```
resources/js/pages/
└── Home.vue              (Nueva página inicio - 542 líneas)
```

### Estilos
```
resources/css/
└── ramex-theme.css       (Sistema de colores y estilos globales - 530 líneas)
```

### Documentación
```
├── RAMEX_KITCHEN_IMPLEMENTATION.md    (Guía completa)
├── RAMEX_VISUAL_GUIDE.md              (Guía visual y diseño)
├── COMPONENTS_GUIDE.md                (Referencia de componentes)
├── IMPLEMENTATION_SUMMARY.md          (Resumen técnico)
└── QUICK_START.md                     (Este archivo)
```

---

## 🎨 7 Secciones en la Home

### 1. **Hero Carrusel** 🎠
- Cambio automático cada 5 segundos
- Controles manuales (flechas)
- Indicadores clickeables (dots)
- CTA personalizables

### 2. **Categorías Principales** 📂
- 6 categorías con iconos
- Contadores de productos
- Animaciones hover

### 3. **Búsqueda Destacada** 🔍
- Barra de búsqueda con ícono
- Envío por Enter o clic

### 4. **Productos Destacados** 🛍️
- Grid responsivo
- Información de marca y precio
- Hover overlay con botones

### 5. **Por qué Elegir RAMEX** ✨
- 4 beneficios principales
- Tarjetas elegantes

### 6. **Testimonios** ⭐
- 3 testimonios con ratings
- Avatar con iniciales

### 7. **CTA Final** 🎯
- Sección destacada
- Botón a catálogo completo

---

## 🎨 Colores RAMEX KITCHEN

```css
--color-primary: #C84617    ← Terracota Marrakech (botones, acentos)
--color-dark: #383838       ← Gris Grafito (texto oscuro)
--color-gray: #BABABA       ← Gris Niebla (elementos secundarios)
--color-light: #f5f5f5      ← Gris claro (fondos)
--color-white: #ffffff      ← Blanco (fondos principales)
```

---

## 🚀 Empezar

### 1. Instalar dependencias (si es necesario)
```bash
npm install
```

### 2. Iniciar servidor de desarrollo
```bash
npm run dev
```

### 3. Ver en el navegador
```
http://localhost:5173
```

### 4. Build para producción
```bash
npm run build
```

---

## 📖 Documentación Disponible

### Para Empezar
- **QUICK_START.md** ← Estás aquí
- **RAMEX_KITCHEN_IMPLEMENTATION.md** - Guía completa de implementación

### Para Entender el Diseño
- **RAMEX_VISUAL_GUIDE.md** - Estructura visual y paleta de colores
- **COMPONENTS_GUIDE.md** - Referencia detallada de cada componente

### Para Mantenimiento
- **IMPLEMENTATION_SUMMARY.md** - Resumen técnico completo

---

## 🔧 Cómo Personalizar

### Cambiar Colores Primarios
Edita `/resources/css/ramex-theme.css`:
```css
:root {
  --color-primary: #C84617;    /* Cambiar aquí */
  --color-dark: #383838;
  --color-gray: #BABABA;
}
```

### Agregar Categorías
En `Home.vue`, edita el array:
```javascript
const mainCategories = ref([
  { id: 1, name: 'Nueva', slug: 'nueva', icon: 'fas fa-icon', count: 50 }
])
```

### Agregar Beneficios
En `Home.vue`, agrega a:
```javascript
const benefits = ref([
  // Beneficios existentes...
  { icon: 'fas fa-nuevo', title: 'Nuevo', description: 'Descripción' }
])
```

### Cambiar Imágenes del Carrusel
En `Home.vue`:
```javascript
const heroSlides = ref([
  {
    title: 'Tu título',
    subtitle: 'Tu subtítulo',
    image: '/images/tu-imagen.webp'  // ← Cambiar aquí
  }
])
```

---

## 📦 Componentes Reutilizables

### HeroCarousel
```vue
<HeroCarousel 
  :slides="slides"
  @primary-cta="handleCTA"
/>
```

### ProductCard
```vue
<ProductCard 
  :product="product"
  @add-to-cart="addCart"
/>
```

### CategoryCard
```vue
<CategoryCard 
  id="1"
  name="Cocción"
  slug="coccion"
  icon="fas fa-fire"
  count="45"
/>
```

### BrandsCarousel
```vue
<BrandsCarousel :brands="brands" />
```

### Newsletter
```vue
<Newsletter />
```

---

## 🔌 Integración con API

La página carga productos desde:
```
GET /api/productos/destacado?limit=6
```

Response esperado:
```json
{
  "data": [
    {
      "id": 1,
      "name": "Producto",
      "price": 999.99,
      "brand": { "nombre": "Marca" },
      "category": { "nombre": "Categoría" },
      "galeria_imagenes": ["url1.webp"]
    }
  ]
}
```

---

## 📱 Responsividad

- ✅ Mobile (< 480px): 1 columna
- ✅ Tablet (768px): 2 columnas
- ✅ Desktop (1200px+): 3+ columnas
- ✅ Totalmente adaptable

---

## 🎯 Próximos Pasos

### Para Agregar Más Funcionalidad
1. **Crear más componentes** reutilizables
2. **Agregar más secciones** (testimonios, FAQ, etc)
3. **Integrar sistemas** de filtros y búsqueda
4. **Implementar carrito** completamente

### Para Mejorar Performance
1. Usar code-splitting con dynamic imports
2. Lazy load de imágenes
3. Optimizar bundle size
4. Minificar CSS y JS

---

## ⚠️ Solucionar Problemas

### Las imágenes no cargan
- Coloca las imágenes en `/public/images/`
- Verifica que las rutas sean correctas

### Los estilos no se ven
- Ejecuta: `npm run build`
- Limpia el caché del navegador

### El carrusel no funciona
- Verifica que el array `heroSlides` no esté vacío
- Revisa la consola del navegador

### Productos no aparecen
- Verifica que el endpoint `/api/productos/destacado` esté disponible
- Revisa la consola del navegador por errores

---

## 💡 Tips Útiles

### Agregar animaciones AOS
```vue
<div data-aos="fade-in" data-aos-delay="100">
  Contenido
</div>
```

### Usar botones con estilos global
```html
<button class="btn btn-primary">Primario</button>
<button class="btn btn-secondary">Secundario</button>
<button class="btn btn-outlined">Outlined</button>
```

### Grid responsivo
```html
<div class="grid grid-3">
  <div>Item 1</div>
  <div>Item 2</div>
  <div>Item 3</div>
</div>
```

### Espaciado utilities
```html
<div class="mt-3 mb-2 pt-2">Contenido</div>
```

---

## 📞 Soporte

Para más información, consulta:
1. **RAMEX_KITCHEN_IMPLEMENTATION.md** - Guía completa
2. **COMPONENTS_GUIDE.md** - Referencia de componentes
3. **RAMEX_VISUAL_GUIDE.md** - Diseño visual
4. Vue Docs: https://vuejs.org
5. Vuetify Docs: https://vuetifyjs.com

---

## ✅ Checklist

- [x] Página Home rediseñada
- [x] 6 componentes reutilizables creados
- [x] Colores RAMEX KITCHEN implementados
- [x] Responsive design completo
- [x] Animaciones y efectos
- [x] Integración con API
- [x] Documentación completa
- [x] Build sin errores

---

**¡Estás listo para comenzar! 🎉**

Para empezar: `npm run dev`

---

*Última actualización: Octubre 2026*
*RAMEX KITCHEN - Quick Start Guide*
