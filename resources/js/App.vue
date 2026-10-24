<template>
  <v-app>
    <!-- Navbar -->
    <v-app-bar
      ref="navbar"
      elevation="0"
      height="100"
      class="py-0 main-navbar"
    >
      <v-container class="navbar-container">
        <div class="brand-shell">
          <router-link to="/" class="brand-logo text-decoration-none">
            <div class="brand-lockup">
              <div class="brand-mark">
                <img :src="logo" alt="Ramex kitchen Logo" />
              </div>
              <!-- <div class="brand-copy">
                <span class="brand-wordmark">ALAKARTA</span>
                <span class="brand-note">COCINAS INDUSTRIALES</span>
              </div> -->
            </div>
          </router-link>
        </div>

        <div class="search-bar">
          <input
            type="text"
            placeholder="Buscar productos"
            aria-label="Buscar productos"
          />
          <button class="search-action" type="button">
            <v-icon size="22">mdi-magnify</v-icon>
            <span>Búsqueda</span>
          </button>
        </div>

        <div class="header-actions">
          <div class="whatsapp-block">
            <div class="whatsapp-icon">
              <v-icon>mdi-whatsapp</v-icon>
            </div>
            <div class="whatsapp-copy">
              <span class="whatsapp-label">WhatsApp</span>
              <a href="tel:+5233614891">Llámanos</a>
            </div>
          </div>

          <div class="utility-icons">
            <!-- <button class="utility-button" type="button">
              <span>ES</span>
              <v-icon size="17">mdi-chevron-down</v-icon>
            </button>
            <button class="utility-icon" type="button" aria-label="Mi cuenta">
              <v-icon>mdi-account-outline</v-icon>
            </button> -->
            <button class="utility-icon cart-button" type="button" aria-label="Carrito">
              <v-icon>mdi-cart-outline</v-icon>
              <span class="cart-badge">0</span>
            </button>
          </div>
        </div>

        <!-- Mobile Menu -->
        <v-app-bar-nav-icon
          class="d-md-none mobile-nav-toggle"
          @click="drawer = !drawer"
        ></v-app-bar-nav-icon>
      </v-container>
    </v-app-bar>

    <!-- Secondary Navigation (Black Menu) -->
    <nav class="secondary-navbar">
      <!-- Primera fila: Categorías principales -->
      <div class="secondary-nav-container primary-row">
        <div class="nav-links-primary">
          <a href="#" class="nav-link">TODAS LAS MARCAS</a>
          <a href="#" class="nav-link">ACERO INOXIDABLE</a>
          
          <!-- Menú desplegable COCCIÓN -->
          <div class="nav-dropdown" :class="{ active: isMenuOpen('coccion') }">
            <button @click.prevent="toggleMenu('coccion')" class="nav-link dropdown-trigger">
              COCCIÓN 
              <v-icon size="16" :class="{ 'rotate-icon': isMenuOpen('coccion') }">mdi-chevron-down</v-icon>
            </button>
            <div v-if="isMenuOpen('coccion')" class="dropdown-menu">
              <a href="#" class="dropdown-item">Cocinas Industriales</a>
              <a href="#" class="dropdown-item">Freidoras</a>
              <a href="#" class="dropdown-item">Planchas</a>
              <a href="#" class="dropdown-item">Hornos</a>
              <a href="#" class="dropdown-item">Parrillas</a>
            </div>
          </div>
          
          <!-- Menú desplegable CAFETERAS -->
          <div class="nav-dropdown" :class="{ active: isMenuOpen('cafeteras') }">
            <button @click.prevent="toggleMenu('cafeteras')" class="nav-link dropdown-trigger">
              CAFETERAS 
              <v-icon size="16" :class="{ 'rotate-icon': isMenuOpen('cafeteras') }">mdi-chevron-down</v-icon>
            </button>
            <div v-if="isMenuOpen('cafeteras')" class="dropdown-menu">
              <a href="#" class="dropdown-item">Cafeteras Automáticas</a>
              <a href="#" class="dropdown-item">Máquinas de Espresso</a>
              <a href="#" class="dropdown-item">Cafeteras de Filtro</a>
              <a href="#" class="dropdown-item">Accesorios</a>
            </div>
          </div>
          
          <a href="#" class="nav-link">LAVADO</a>
          
          <!-- Menú desplegable PREPARACIÓN DE ALIMENTOS -->
          <div class="nav-dropdown" :class="{ active: isMenuOpen('preparacion') }">
            <button @click.prevent="toggleMenu('preparacion')" class="nav-link dropdown-trigger">
              PREPARACIÓN DE ALIMENTOS 
              <v-icon size="16" :class="{ 'rotate-icon': isMenuOpen('preparacion') }">mdi-chevron-down</v-icon>
            </button>
            <div v-if="isMenuOpen('preparacion')" class="dropdown-menu">
              <a href="#" class="dropdown-item">Cortadoras</a>
              <a href="#" class="dropdown-item">Procesadoras</a>
              <a href="#" class="dropdown-item">Mezcladores</a>
              <a href="#" class="dropdown-item">Amasadoras</a>
            </div>
          </div>
          
          <!-- Menú desplegable REFRIGERACIÓN -->
          <div class="nav-dropdown" :class="{ active: isMenuOpen('refrigeracion') }">
            <button @click.prevent="toggleMenu('refrigeracion')" class="nav-link dropdown-trigger">
              REFRIGERACIÓN 
              <v-icon size="16" :class="{ 'rotate-icon': isMenuOpen('refrigeracion') }">mdi-chevron-down</v-icon>
            </button>
            <div v-if="isMenuOpen('refrigeracion')" class="dropdown-menu">
              <a href="#" class="dropdown-item">Refrigeradores</a>
              <a href="#" class="dropdown-item">Congeladores</a>
              <a href="#" class="dropdown-item">Vitrinas</a>
              <a href="#" class="dropdown-item">Mesas Refrigeradas</a>
            </div>
          </div>
          
          <a href="#" class="nav-link">EQUIPOS PARA HELADO</a>
          
          <!-- Menú desplegable INSUMOS -->
          <div class="nav-dropdown" :class="{ active: isMenuOpen('insumos') }">
            <button @click.prevent="toggleMenu('insumos')" class="nav-link dropdown-trigger">
              INSUMOS 
              <v-icon size="16" :class="{ 'rotate-icon': isMenuOpen('insumos') }">mdi-chevron-down</v-icon>
            </button>
            <div v-if="isMenuOpen('insumos')" class="dropdown-menu">
              <a href="#" class="dropdown-item">Aceites y Grasas</a>
              <a href="#" class="dropdown-item">Condimentos</a>
              <a href="#" class="dropdown-item">Harinas</a>
              <a href="#" class="dropdown-item">Bebidas</a>
            </div>
          </div>
          
          <a href="#" class="nav-link">CAFÉ EN GRANO</a>
        </div>
      </div>
      
      <!-- Segunda fila: Enlaces secundarios (más oscura) -->
      <div class="secondary-nav-container secondary-row">
        <div class="nav-links-secondary">
          <!-- Menú desplegable MARCAS -->
          <div class="nav-dropdown" :class="{ active: isMenuOpen('marcas') }">
            <button @click.prevent="toggleMenu('marcas')" class="nav-link secondary dropdown-trigger">
              MARCAS 
              <v-icon size="14" :class="{ 'rotate-icon': isMenuOpen('marcas') }">mdi-chevron-down</v-icon>
            </button>
            <div v-if="isMenuOpen('marcas')" class="dropdown-menu secondary-dropdown">
              <a href="#" class="dropdown-item">Marca A</a>
              <a href="#" class="dropdown-item">Marca B</a>
              <a href="#" class="dropdown-item">Marca C</a>
              <a href="#" class="dropdown-item">Marca D</a>
            </div>
          </div>
          
          <a href="#" class="nav-link secondary">SOBRE NOSOTROS</a>
          
          <!-- Menú desplegable UTENSILIOS -->
          <div class="nav-dropdown" :class="{ active: isMenuOpen('utensilios') }">
            <button @click.prevent="toggleMenu('utensilios')" class="nav-link secondary dropdown-trigger">
              UTENSILIOS 
              <v-icon size="14" :class="{ 'rotate-icon': isMenuOpen('utensilios') }">mdi-chevron-down</v-icon>
            </button>
            <div v-if="isMenuOpen('utensilios')" class="dropdown-menu secondary-dropdown">
              <a href="#" class="dropdown-item">Cuchillos</a>
              <a href="#" class="dropdown-item">Tablas de Corte</a>
              <a href="#" class="dropdown-item">Ollas y Sartenes</a>
              <a href="#" class="dropdown-item">Bandejas</a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Mobile Drawer -->
    <v-navigation-drawer
      v-model="drawer"
      temporary
      location="right"
      class="drawerapp"
    >
      <v-list>
        <v-list-item
          :to="{ name: 'Home' }"
          prepend-icon="mdi-home"
          title="Inicio"
        ></v-list-item>
        <v-list-item
          :to="{ name: 'About' }"
          prepend-icon="mdi-heart-outline"
          title="Nosotros"
        ></v-list-item>
        <v-list-item
          :to="{ name: 'ProductList' }"
          prepend-icon="mdi-shopping"
          title="Colección"
        ></v-list-item>
        <v-list-item
          :to="{ name: 'Contact' }"
          prepend-icon="mdi-email-outline"
          title="Contacto"
        ></v-list-item>
        <v-list-item
          :to="{ name: 'CustomerOrders' }"
          prepend-icon="mdi-package-variant-closed"
          title="Mis pedidos"
        ></v-list-item>
        <v-list-item
          :to="{ name: 'Cart' }"
          prepend-icon="mdi-cart"
        >
          <template v-slot:title>
            Carrito
            <v-chip v-if="itemCount > 0" size="small" class="ml-2">{{ itemCount }}</v-chip>
          </template>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <!-- Contenido principal -->
    <v-main class="main-content">
      <router-view></router-view>
    </v-main>

    <!-- Botón flotante de WhatsApp -->
    <v-btn
      class="whatsapp-float"
      color="#25D366"
      size="x-large"
      icon
      elevation="8"
      href="https://wa.me/5580091558?text=Hola,%20me%20interesan%20sus%20productos"
      target="_blank"
    >
      <v-icon size="32">mdi-whatsapp</v-icon>
    </v-btn>

    <!-- Footer -->
    <v-footer class="footer">
      <v-container>
        <v-row class="py-8">
          <v-col cols="12" md="4" class="mb-6 mb-md-0">
            <div class="footer-brand mb-4">
              <div class="footer-brand-block">
                <div class="footer-mark">
                  <img :src="logo" alt="IzaguirreQu Logo" />
                </div>
                <div class="footer-brand-copy">
                  <strong>IzaguirreQu</strong>
                  <span>hecho con detalle y calma</span>
                </div>
              </div>
            </div>
            <p class="footer-desc">
              Joyería con tonos suaves, materiales nobles y una mirada contemporánea desde México.
            </p>
            <div class="social-links mt-4">
              <v-btn icon variant="text" class="footer-social" size="small" href="https://www.instagram.com/izaguirre.qu/" target="_blank">
                <v-icon>mdi-instagram</v-icon>
              </v-btn>
              <v-btn icon variant="text" class="footer-social" size="small" href="https://www.facebook.com/IzaguirreQu" target="_blank">
                <v-icon>mdi-facebook</v-icon>
              </v-btn>
            </div>
          </v-col>
          <v-col cols="12" md="4">
            <h4 class="footer-title mb-4">Explora</h4>
            <div class="footer-links">
              <router-link to="/" class="footer-link">Inicio</router-link>
              <router-link :to="{ name: 'About' }" class="footer-link">Nosotros</router-link>
              <router-link :to="{ name: 'ProductList' }" class="footer-link">Colección</router-link>
              <router-link :to="{ name: 'Contact' }" class="footer-link">Contacto</router-link>
              <router-link :to="{ name: 'CustomerOrders' }" class="footer-link">Mis pedidos</router-link>
            </div>
          </v-col>
          <!-- <v-col cols="12" md="3">
            <h4 class="footer-title mb-4">Información</h4>
            <div class="footer-links">
              <a href="#" class="footer-link">Sobre Nosotros</a>
              <a href="#" class="footer-link">Envíos y Devoluciones</a>
              <a href="#" class="footer-link">Términos y Condiciones</a>
              <a href="#" class="footer-link">Política de Privacidad</a>
            </div>
          </v-col> -->
          <v-col cols="12" md="4">
            <h4 class="footer-title mb-4">Contacto</h4>
            <div class="footer-contact">
              <div class="contact-item">
                <v-icon size="small" class="contact-icon">mdi-whatsapp</v-icon>
                <span>+52 558 009 1558</span>
              </div>
              <div class="contact-item">
                <v-icon size="small" class="contact-icon">mdi-email</v-icon>
                <span>Atencionaclientes@izaguirrequ.com</span>
              </div>
              <div class="contact-item">
                <v-icon size="small" class="contact-icon">mdi-map-marker</v-icon>
                <span>México</span>
              </div>
            </div>
          </v-col>
        </v-row>
        <v-divider class="footer-divider"></v-divider>
        <div class="text-center py-6">
          <p class="footer-copy text-body-2">
            © {{ new Date().getFullYear() }} IzaguirreQu. Todos los derechos reservados.
          </p>
        </div>
      </v-container>
    </v-footer>
  </v-app>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useCart } from './composables/useCart';

const { itemCount } = useCart();
const drawer = ref(false);
const navbar = ref(null);
const logo = '/images/logo.webp';
const openMenuKey = ref(null);

const toggleMenu = (menuKey) => {
  if (openMenuKey.value === menuKey) {
    openMenuKey.value = null;
  } else {
    openMenuKey.value = menuKey;
  }
};

const isMenuOpen = (menuKey) => {
  return openMenuKey.value === menuKey;
};

// Scroll behavior with requestAnimationFrame for smooth performance
const handleScroll = () => {
  if (!navbar.value) return;

  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const scrollDifference = Math.abs(scrollTop - lastScrollTop);

  // Only process if we've scrolled enough
  if (scrollDifference < scrollThreshold) {
    ticking = false;
    return;
  }

  // Don't hide navbar if drawer is open
  if (drawer.value) {
    navbar.value.$el.classList.remove('hidden');
    ticking = false;
    return;
  }

  // Hide/show navbar based on scroll direction
  if (scrollTop > lastScrollTop && scrollTop > 150) {
    // Scrolling down & past threshold -> hide navbar
    navbar.value.$el.classList.add('hidden');
  } else if (scrollTop < lastScrollTop || scrollTop <= 100) {
    // Scrolling up OR at top -> show navbar
    navbar.value.$el.classList.remove('hidden');
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  ticking = false;
};

const onScroll = () => {
  if (!ticking) {
    requestAnimationFrame(handleScroll);
    ticking = true;
  }
};

onMounted(() => {
  window.addEventListener('scroll', onScroll, { passive: true });
});

onUnmounted(() => {
  window.removeEventListener('scroll', onScroll);
});
</script>

<style>
/* Brand Logo */

html,
body,
* {
  font-family: var(--font-brand), serif;
  margin: 0;
  padding: 0;
  scroll-behavior: smooth;
}

header {
  font-family: var(--font-brand), serif;
  margin: 0;
  padding: 0;
  font-size: 16px;
  scroll-behavior: smooth;
}

button,
input,
.v-btn,
.v-input {
  font-family: var(--font-brand), sans-serif !important;
}

/* WhatsApp Float Button */
.whatsapp-float {
  position: fixed !important;
  bottom: 20px;
  right: 20px;
  z-index: 1000;
  box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4) !important;
  transition: all 0.3s ease !important;
}

.whatsapp-float:hover {
  transform: scale(1.1);
  box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6) !important;
}

@media (max-width: 600px) {
  .whatsapp-float {
    bottom: 80px;
    right: 16px;
  }
}

.brand-logo {
  display: flex;
  align-items: center;
  color: #6b5b47;

}

/* Navbar hide animation */
.main-navbar {
  background: rgba(250, 247, 244, 0.92) !important;
  border-bottom: 1px solid rgba(184, 151, 120, 0.18);
  backdrop-filter: blur(18px);
  box-shadow: 0 10px 35px rgba(140, 116, 95, 0.08);
  transition: transform 0.3s ease-in-out !important;
  will-change: transform;
  position: relative !important;
  z-index: 10;
}

.navbar-container {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  gap: 16px;
  padding: 12px 20px !important;
}

.main-navbar.hidden {
  transform: translateY(-100%) !important;
}

.drawerapp {
  background: linear-gradient(180deg, #f9f7f4 0%, #efe8e0 100%) !important;
  font-family: var(--font-brand), serif;
  padding-top: 100px;

}

.brand-lockup {
  display: flex;
  align-items: center;
  gap: 14px;
}

.brand-shell {
  display: flex;
  align-items: center;
  min-width: 0;
  flex: 1 1 0;
}

.brand-logo {
  display: inline-flex;
  align-items: center;
  width: fit-content;
}

.brand-mark,
.footer-mark {
  width: auto;
  height: auto;
  max-width: 180px;
  max-height: 56px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 10%;
  margin: auto;
  color: #fffaf4;
  font-size: 1rem;
  letter-spacing: 0.12em;
  box-shadow: none;
  object-fit: contain;
  overflow: visible;
}

.brand-mark img,
.footer-mark img {
  width: 100%;
  height: auto;
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.brand-copy,
.footer-brand-copy {
  display: flex;
  flex-direction: column;
  padding-top: 10px;
}

.brand-wordmark {
  color: #6b5b47;
  font-size: 1.45rem;
  letter-spacing: 0.06em;
  line-height: 1;
}

.brand-note {
  color: #9a866f;
  font-size: 0.72rem;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  margin-top: 0.3rem;
}

.search-bar {
  display: flex;
  align-items: center;
  justify-content: center;
  flex: 1 1 420px;
  max-width: 620px;
  min-width: 220px;
  margin: 0 auto;
  border: 1px solid rgba(102, 83, 67, 0.12);
  border-radius: 18px;
  background: rgba(255, 255, 255, 0.7);
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(96, 75, 59, 0.06);
}

.search-bar input {
  flex: 1;
  min-width: 0;
  border: none;
  outline: none;
  background: transparent;
  color: #473a30;
  font-size: 0.96rem;
  padding: 0 18px;
  height: 52px;
}

.search-bar input::placeholder {
  color: #8f7b68;
}

.search-action {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  height: 52px;
  padding: 0 20px;
  border: none;
  background: linear-gradient(135deg, #6a4c38 0%, #b57a4a 100%);
  color: #fff;
  font-weight: 700;
  font-size: 0.82rem;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  cursor: pointer;
  transition: transform 0.2s ease, filter 0.2s ease;
}

.search-action:hover {
  transform: translateY(-1px);
  filter: brightness(1.02);
}

.header-actions {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 20px;
  flex: 0 0 auto;
}

.whatsapp-block {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 8px 12px;
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.52);
  border: 1px solid rgba(102, 83, 67, 0.08);
}

.whatsapp-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: rgba(37, 211, 102, 0.12);
  color: #1ca84e;
}

.whatsapp-copy {
  display: flex;
  flex-direction: column;
  line-height: 1.2;
}

.whatsapp-label {
  color: #7a6858;
  font-size: 0.7rem;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

.whatsapp-copy a {
  color: #5f4737;
  font-size: 0.82rem;
  font-weight: 700;
  text-decoration: none;
}

.utility-icons {
  display: flex;
  align-items: center;
  gap: 10px;
}

.utility-button,
.utility-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  min-width: 42px;
  height: 42px;
  border: 1px solid rgba(102, 83, 67, 0.12);
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.52);
  color: #5f4737;
  cursor: pointer;
  transition: all 0.2s ease;
}

.utility-button {
  padding: 0 12px;
  font-weight: 700;
  letter-spacing: 0.08em;
  font-size: 0.76rem;
}

.utility-button:hover,
.utility-icon:hover {
  background: rgba(186, 143, 100, 0.08);
  border-color: rgba(110, 82, 63, 0.18);
}

.cart-button {
  position: relative;
}

.cart-badge {
  position: absolute;
  top: -6px;
  right: -4px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 18px;
  height: 18px;
  border-radius: 999px;
  font-size: 0.66rem;
  font-weight: 700;
  color: #fff;
  background: #c0572a;
  border: 2px solid #fff;
}

.mobile-nav-toggle {
  color: #5f4737 !important;
}

@media (min-width: 600px) and (max-width: 959px) {
  .navbar-container {
    gap: 12px;
    padding: 10px 16px !important;
  }

  .brand-mark,
  .footer-mark {
    max-width: 150px;
    max-height: 45px;
  }

  .search-bar {
    height: 44px;
  }

  .search-bar input,
  .search-action {
    height: 44px;
  }
}

@media (max-width: 960px) {
  .header-actions {
    display: none;
  }

  .navbar-container {
    gap: 12px;
  }

  .search-bar {
    min-width: 0;
    max-width: none;
    flex: 1 1 auto;
  }
}

@media (max-width: 600px) {
  .brand-lockup {
    gap: 8px;
  }

  .brand-mark,
  .footer-mark {
    width: auto;
    height: auto;
    max-width: 120px;
    max-height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .brand-wordmark {
    font-size: 1.05rem;
  }

  .brand-note {
    font-size: 0.58rem;
  }

  .v-toolbar__content {
    padding: 8px 16px !important;
  }

  .navbar-container {
    flex-wrap: nowrap !important;
    gap: 8px;
    padding: 8px 12px !important;
  }

  .v-app-bar-title {
    flex: 0 1 auto !important;
    max-width: calc(100% - 60px) !important;
    overflow: hidden;
  }

  .brand-logo {
    display: block;
    width: 100%;
  }

  .nav-links {
    display: none !important;
  }

  .search-bar {
    height: 40px;
  }

  .search-bar input,
  .search-action {
    height: 40px;
  }

  .search-action span {
    display: none;
  }
}

.brand-icon {
  font-size: 32px;
  line-height: 1;
}

.brand-text {
  display: flex;
  flex-direction: column;
  line-height: 1;
}

.brand-name {
  color: white;
  font-size: 18px;
  font-weight: 900;
  letter-spacing: 2px;
}

.brand-subtitle {
  color: rgba(255, 255, 255, 0.7);
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 3px;
}

.nav-link {
  color: #6b5b47 !important;
  font-weight: 600;
  letter-spacing: 0.08em;
  margin: 0 4px;
  border-radius: 999px !important;
  padding-inline: 1rem !important;
}

.nav-link:hover {
  background: rgba(184, 151, 120, 0.12) !important;
}

.nav-cart,
.mobile-nav-toggle {
  color: #6b5b47 !important;
}

/* Secondary Navigation (Black Menu) */
.secondary-navbar {
  background: transparent;
  border: none;
  width: 100%;
  position: relative;
  z-index: 9;
  margin-top: 0;
}

.primary-row {
  background: #3a3a3a;
  padding: 0 !important;
}

.secondary-row {
  background: #1a1a1a;
  padding: 0 !important;
  border-top: 1px solid #0a0a0a;
}

.secondary-nav-container {
  max-width: 100%;
  padding: 0 !important;
  display: flex;
  align-items: center;
  justify-content: flex-start;
}

.nav-links-primary {
  display: flex;
  flex-wrap: wrap;
  gap: 0;
  align-items: center;
  padding: 14px 20px;
  width: 100%;
}

.nav-dropdown {
  position: relative;
  display: inline-block;
}

.nav-link {
  color: #ffffff !important;
  font-weight: 500;
  letter-spacing: 0.05em;
  margin: 0;
  padding: 14px 16px;
  border-radius: 0 !important;
  font-size: 0.9rem;
  text-decoration: none;
  transition: background 0.2s ease, color 0.2s ease;
  white-space: nowrap;
  display: flex;
  align-items: center;
  gap: 8px;
  background: transparent;
}

.nav-link:hover {
  background: rgba(255, 255, 255, 0.15) !important;
  color: #ffd700 !important;
}

.nav-links-primary .nav-link,
.nav-links-secondary .nav-link {
  color: #ffffff !important;
  font-weight: 500;
  letter-spacing: 0.05em;
  margin: 0;
  border-radius: 0 !important;
  text-decoration: none;
  transition: background 0.2s ease, color 0.2s ease;
  white-space: nowrap;
}

.nav-links-primary .nav-link:hover,
.nav-links-secondary .nav-link:hover {
  background: rgba(255, 255, 255, 0.15) !important;
  color: #ffd700 !important;
}

.nav-links-secondary {
  display: flex;
  flex-wrap: wrap;
  gap: 0;
  align-items: center;
  padding: 12px 20px;
  width: 100%;
}

.nav-link.secondary {
  padding: 12px 16px;
  font-size: 0.85rem;
  font-weight: 600;
}

.nav-link.dropdown-trigger {
  cursor: pointer;
  border: none;
  background: transparent;
  font-family: inherit;
}

/* Dropdown Menu Styles */
.nav-dropdown {
  position: relative;
  display: inline-block;
}

.nav-dropdown.active .dropdown-trigger {
  background: rgba(255, 255, 255, 0.2) !important;
  color: #ffd700 !important;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  background: #2a2a2a;
  border: 1px solid #404040;
  border-top: none;
  min-width: 220px;
  z-index: 100;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
  animation: slideDown 0.2s ease-out;
}

.dropdown-menu.secondary-dropdown {
  background: #0a0a0a;
  border-color: #1a1a1a;
}

.dropdown-item {
  display: block;
  padding: 12px 16px;
  color: #ffffff;
  text-decoration: none;
  font-size: 0.85rem;
  transition: all 0.2s ease;
  white-space: nowrap;
  font-weight: 400;
}

.dropdown-item:hover {
  background: rgba(255, 215, 0, 0.1);
  color: #ffd700;
  padding-left: 20px;
}

.dropdown-item:first-child {
  border-top: none;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.rotate-icon {
  transform: rotate(180deg) !important;
  transition: transform 0.2s ease;
}

@media (max-width: 960px) {
  .nav-links-primary,
  .nav-links-secondary {
    gap: 8px;
    padding: 12px 16px;
  }

  .nav-link {
    padding: 10px 12px;
    font-size: 0.8rem;
  }

  .nav-link.secondary {
    padding: 10px 12px;
  }
}

@media (max-width: 768px) {
  .nav-links-primary {
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 12px 16px;
    flex-wrap: nowrap;
  }

  .nav-link {
    padding: 10px 10px;
    font-size: 0.75rem;
    flex-shrink: 0;
  }
}

@media (max-width: 600px) {
  .secondary-navbar {
    display: none;
  }
}

/* Footer */
.footer {
  color: #6b5b47;
  background:
    radial-gradient(circle at top left, rgba(217, 200, 181, 0.4), transparent 30%),
    linear-gradient(180deg, #f5f1ec 0%, #ebe4dc 100%) !important;
  border-top: 1px solid rgba(184, 151, 120, 0.18);
}

.footer-brand {
  display: flex;
  align-items: center;
}

.footer-brand-block {
  display: flex;
  align-items: center;
  gap: 14px;
}

.brand-icon-footer {
  font-size: 40px;
}

.footer-brand-text {
  display: flex;
  flex-direction: column;
  line-height: 1.2;
}

.footer-brand-name {
  font-size: 20px;
  font-weight: 900;
  letter-spacing: 2px;
  color: #6b5b47;
}

.footer-brand-subtitle {
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 3px;
  color: #9a866f;
}

.footer-desc {
  font-size: 14px;
  line-height: 1.6;
  max-width: 300px;
  color: #8b7762;
}

.footer-title {
  color: #6b5b47;
  font-size: 16px;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
}

.footer-links {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.footer-link {
  color: #8b7762;
  text-decoration: none;
  font-size: 14px;
  transition: color 0.3s ease;
}

.footer-link:hover {
  color: #6b5b47;
}

.footer-contact {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.contact-item {
  display: flex;
  align-items: center;
  gap: 12px;
  color: #8b7762;
  font-size: 14px;
}

.social-links {
  display: flex;
  gap: 8px;
}

.footer-social {
  color: #8c745f !important;
  background: rgba(255, 255, 255, 0.6) !important;
}

.footer-social:hover {
  background: rgba(184, 151, 120, 0.16) !important;
}

.contact-icon {
  color: #8c745f !important;
}

.footer-divider {
  border-color: rgba(140, 116, 95, 0.16) !important;
}

.footer-copy {
  color: #9a866f;
}
</style>
