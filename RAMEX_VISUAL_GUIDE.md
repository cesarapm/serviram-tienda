# 🎨 Guía Visual de RAMEX KITCHEN Home

## Estructura de la Página

```
┌─────────────────────────────────────────────────┐
│          NAVBAR (Existente - No modificado)     │
├─────────────────────────────────────────────────┤
│                                                  │
│          HERO SECTION CON CARRUSEL              │
│   ┌─────────────────────────────────────────┐  │
│   │                                          │  │
│   │  RAMEX KITCHEN                          │  │
│   │  Equipo Profesional para Cocinas       │  │
│   │                                          │  │
│   │  [Ver Catálogo] [Explorar]             │  │
│   │                                          │  │
│   │            [• • ○ • •]                  │  │
│   └─────────────────────────────────────────┘  │
│                                                  │
├─────────────────────────────────────────────────┤
│                                                  │
│          CATEGORÍAS PRINCIPALES                 │
│   ┌────────┐ ┌────────┐ ┌────────┐            │
│   │  🔥    │ │  ❄️    │ │  🍴    │            │
│   │Cocción │ │Refriger│ │Prepar  │            │
│   │ 45 prd │ │ 38 prd │ │ 52 prd │            │
│   └────────┘ └────────┘ └────────┘            │
│   ┌────────┐ ┌────────┐ ┌────────┐            │
│   │  ☕    │ │  🧊    │ │  🔧    │            │
│   │Cafeter │ │ Acero  │ │Accesor │            │
│   │ 24 prd │ │ 30 prd │ │ 40 prd │            │
│   └────────┘ └────────┘ └────────┘            │
│                                                  │
├─────────────────────────────────────────────────┤
│                                                  │
│          BÚSQUEDA DESTACADA                     │
│   ┌──────────────────────────────────────────┐ │
│   │🔍 Buscar equipos profesionales...  [🔍] │ │
│   └──────────────────────────────────────────┘ │
│                                                  │
├─────────────────────────────────────────────────┤
│                                                  │
│          PRODUCTOS DESTACADOS                   │
│                                                  │
│   Productos Destacados          [Ver todo →]   │
│                                                  │
│   ┌─────────────┐  ┌─────────────┐             │
│   │   IMAGEN    │  │   IMAGEN    │             │
│   │             │  │             │             │
│   │ [Detalles]  │  │ [Detalles]  │             │
│   └─────────────┘  └─────────────┘             │
│   Marca A                    Marca B           │
│   Producto 1                 Producto 2        │
│   $1,999.99                  $2,499.99        │
│                                                  │
├─────────────────────────────────────────────────┤
│                                                  │
│          ¿POR QUÉ ELEGIR RAMEX KITCHEN?        │
│                                                  │
│   ✈️ Envío     🛡️ Garantía   💬 Soporte      │
│    Rápido      de Calidad      24/7           │
│                                                  │
│   ↩️ Devoluc.                                   │
│    Fáciles                                     │
│                                                  │
├─────────────────────────────────────────────────┤
│                                                  │
│          TESTIMONIOS DE CLIENTES                │
│                                                  │
│   ⭐⭐⭐⭐⭐              ⭐⭐⭐⭐⭐              │
│   "Excelente servicio   "La atención fue       │
│    y productos..."      excepcional..."        │
│   - Carlos M.           - María G.              │
│   Restaurante La Cocina Panadería Don Pan     │
│                                                  │
├─────────────────────────────────────────────────┤
│                                                  │
│          ¿LISTO PARA EQUIPAR TU COCINA?       │
│                                                  │
│   Explora nuestro catálogo completo            │
│   de 500+ productos de las mejores marcas     │
│                                                  │
│        [VER CATÁLOGO COMPLETO]                │
│                                                  │
└─────────────────────────────────────────────────┘
```

---

## 🎨 Paleta de Colores RAMEX KITCHEN

### Primario
```
Terracota Marrakech: #C84617
RGB: 200, 70, 23
CMYK: 0%, 65%, 89%, 22%
```
Usado en:
- Botones principales
- Enlaces
- Acentos
- Badges de descuento

### Oscuro
```
Gris Grafito: #383838
RGB: 56, 56, 56
CMYK: 0%, 0%, 0%, 78%
```
Usado en:
- Texto principal
- Títulos
- Fondos de secciones

### Secundario
```
Gris Niebla de Montaña: #BABABA
RGB: 186, 186, 186
CMYK: 0%, 0%, 0%, 27%
```
Usado en:
- Textos secundarios
- Bordes
- Elementos deshabilitados

---

## 📐 Tipografía

### Fuentes
- **Títulos**: Montserrat Bold (especificado en Manual de Identidad)
- **Cuerpo**: System UI / Instrument Sans
- **Brand**: Sanke (OTF existente)

### Tamaños
- H1: 2.5rem - 4rem (responsivo)
- H2: 2rem
- H3: 1.5rem
- H4: 1.25rem
- P: 1rem
- Small: 0.85rem

---

## 🎭 Estados de Componentes

### Botones

#### Botón Primario - Normal
```
Background: #C84617
Color: Blanco
Padding: 12px 28px
Border-radius: 4px
```

#### Botón Primario - Hover
```
Background: #a83512
Transform: translateY(-2px)
Box-shadow: 0 12px 24px rgba(200, 70, 23, 0.3)
```

#### Botón Outlined - Normal
```
Background: Transparente
Border: 2px Blanco
Color: Blanco
```

#### Botón Outlined - Hover
```
Background: Blanco
Color: #C84617
Border: 2px Blanco
```

### Tarjetas de Producto

#### Normal
```
Box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08)
Background: Blanco
Border-radius: 8px
```

#### Hover
```
Box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15)
Transform: translateY(-4px)
```

#### Overlay (Al pasar mouse)
```
Background: rgba(0, 0, 0, 0.6)
Opacity: 1 (fade-in)
Display: Botones CTA
```

---

## 🎬 Animaciones

### Fade In
```
Duración: 0.6s
Easing: ease-out
Desde: opacity 0, translateY(20px)
Hacia: opacity 1, translateY(0)
```

### Slide In Left
```
Duración: 0.6s
Easing: ease-out
Desde: opacity 0, translateX(-30px)
Hacia: opacity 1, translateX(0)
```

### Slide In Right
```
Duración: 0.6s
Easing: ease-out
Desde: opacity 0, translateX(30px)
Hacia: opacity 1, translateX(0)
```

### Hover Effects
```
Card: translateY(-4px) en 0.3s
Button: Cambio de color en 0.3s
Icon: scale(1.1) en 0.3s
```

---

## 📊 Grillas Responsivas

### Desktop (1200px+)
- Hero: Full width
- Categorías: 6 columnas (1 fila)
- Productos: 3 columnas
- Beneficios: 4 columnas
- Testimonios: 3 columnas

### Tablet (768px - 1199px)
- Hero: Full width
- Categorías: 3 columnas (2 filas)
- Productos: 2 columnas
- Beneficios: 2 columnas
- Testimonios: 2 columnas

### Mobile (< 768px)
- Hero: Full width (altura 70vh)
- Categorías: 2 columnas (3 filas)
- Productos: 1 columna
- Beneficios: 1 columna (stack)
- Testimonios: 1 columna (scroll)

---

## 🔍 Puntos de Quiebre Media Queries

```javascript
// Breakpoints
Mobile: 480px
Tablet: 768px
Desktop: 1024px
Wide: 1200px
Ultra: 1400px
```

---

## 🎯 Elementos Interactivos

### Carrusel de Hero
- **Autoplay**: 5 segundos
- **Controles**: Flechas (anterior/siguiente)
- **Indicadores**: Dots clickeables
- **Transición**: 0.8s ease

### Categorías
- **Hover**: Cambio a color primario + elevation
- **Active**: Subrayado en color primario

### Producto
- **Hover**: Overlay oscuro + botones CTA
- **Like**: Ícono de corazón toggle
- **Carrito**: Agregar con feedback visual

### Búsqueda
- **Focus**: Border cambio a color primario
- **Enter**: Envío de búsqueda

---

## 🔗 Navegación Interna

### Enlaces
- Categorías → `/productos?cat={slug}`
- Ver Todo → `/productos`
- Producto → `/producto/{id}`
- Búsqueda → `/productos?q={query}`

### Router Links
```vue
<router-link to="/productos?cat=coccion">
<router-link to="/producto/1">
<router-link to="/productos">
```

---

## 📡 Endpoints API Consumidos

### Productos Destacados
```
GET /api/productos/destacado?limit=6

Response:
{
  "data": [
    {
      "id": 1,
      "name": "Estufa Comercial",
      "price": 5999.99,
      "galeria_imagenes": ["url1.webp"],
      "brand": { "nombre": "Rational" },
      "category": { "nombre": "Cocción" }
    }
  ]
}
```

---

## 🎓 Casos de Uso

### 1. Editar Categorías
```javascript
// En Home.vue
const mainCategories = ref([
  { id: 1, name: 'Nueva Categoría', slug: 'nueva', icon: 'fas fa-icon', count: 50 }
])
```

### 2. Agregar Beneficios
```javascript
const benefits = ref([
  { icon: 'fas fa-nuevo', title: 'Nuevo', description: 'Descripción' }
])
```

### 3. Cambiar Intervalo del Carrusel
```javascript
// En HeroCarousel.vue
const interval = ref(3000) // 3 segundos en lugar de 5
```

### 4. Personalizar Botones
```vue
<v-btn @click="miAccion" class="btn btn-primary btn-lg">
  Texto
</v-btn>
```

---

## 📋 Checklist de Implementación

- ✅ Home.vue reescrito
- ✅ Componentes reutilizables creados (HeroCarousel, CategoryCard, ProductCard)
- ✅ CSS global (ramex-theme.css)
- ✅ Colores RAMEX KITCHEN implementados
- ✅ Animaciones AOS integradas
- ✅ Responsividad total
- ✅ Accesibilidad (ARIA labels)
- ✅ Build sin errores
- ✅ Documentación completa

---

## 🚀 Próximos Pasos Sugeridos

1. **Agregar imágenes hero**: Coloca en `/public/images/portadas/`
2. **Carrusel de marcas**: Usa el componente reutilizable
3. **Newsletter**: Formulario de suscripción
4. **Sección de blog**: Últimos artículos
5. **FAQ**: Preguntas frecuentes
6. **Mapa de contacto**: Ubicación de la tienda
7. **Chat en vivo**: WhatsApp o chat widget
8. **Certificaciones**: Mostrar sellos de confianza

---

*Documento generado: Octubre 2026*
*Para SERVIRAM - RAMEX KITCHEN*
