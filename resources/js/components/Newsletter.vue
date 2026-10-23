<template>
  <section class="newsletter-section">
    <div class="container">
      <div class="newsletter-content">
        <div class="newsletter-text" data-aos="fade-right">
          <h2>Recibe las mejores ofertas</h2>
          <p>Suscríbete a nuestro newsletter y obtén descuentos exclusivos en equipos profesionales</p>
        </div>

        <div class="newsletter-form" data-aos="fade-left">
          <form @submit.prevent="subscribe" @keydown.enter="subscribe">
            <div class="form-group">
              <input 
                v-model="email"
                type="email" 
                placeholder="Tu correo electrónico"
                required
              />
              <button type="submit" class="btn-subscribe" :disabled="loading">
                <span v-if="!loading">Suscribirse</span>
                <span v-else>Enviando...</span>
              </button>
            </div>

            <div v-if="successMessage" class="success-message">
              <i class="fas fa-check-circle"></i> {{ successMessage }}
            </div>

            <div v-if="errorMessage" class="error-message">
              <i class="fas fa-exclamation-circle"></i> {{ errorMessage }}
            </div>

            <p class="privacy-text">
              <input type="checkbox" required />
              Acepto recibir ofertas y información de RAMEX KITCHEN
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'

const email = ref('')
const loading = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

const subscribe = async () => {
  errorMessage.value = ''
  successMessage.value = ''

  if (!email.value) {
    errorMessage.value = 'Por favor ingresa tu correo'
    return
  }

  loading.value = true

  try {
    // Simulación de envío (reemplazar con API real)
    // const response = await fetch('/api/newsletter/subscribe', {
    //   method: 'POST',
    //   headers: { 'Content-Type': 'application/json' },
    //   body: JSON.stringify({ email: email.value })
    // })

    // Por ahora, solo simulamos
    await new Promise(resolve => setTimeout(resolve, 1000))
    
    successMessage.value = '¡Gracias por suscribirte! Revisa tu correo.'
    email.value = ''
    
    setTimeout(() => {
      successMessage.value = ''
    }, 5000)
  } catch (error) {
    errorMessage.value = 'Error al suscribirse. Intenta de nuevo.'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
:root {
  --color-primary: #C84617;
  --color-dark: #383838;
  --color-gray: #BABABA;
}

.newsletter-section {
  padding: 80px 0;
  background: linear-gradient(135deg, var(--color-primary), #a83512);
  color: white;
}

.newsletter-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  align-items: center;
}

.newsletter-text h2 {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 15px;
}

.newsletter-text p {
  font-size: 1.1rem;
  opacity: 0.9;
  line-height: 1.6;
}

.newsletter-form {
  position: relative;
}

.form-group {
  display: flex;
  gap: 0;
  margin-bottom: 20px;
}

.form-group input {
  flex: 1;
  padding: 14px 20px;
  border: none;
  border-radius: 4px 0 0 4px;
  font-size: 1rem;
  outline: none;
}

.form-group input:focus {
  box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
}

.btn-subscribe {
  padding: 14px 32px;
  background: white;
  color: var(--color-primary);
  border: none;
  border-radius: 0 4px 4px 0;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-subscribe:hover:not(:disabled) {
  background: #f5f5f5;
  transform: translateX(2px);
}

.btn-subscribe:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.success-message {
  color: #d4edda;
  background: rgba(212, 237, 218, 0.2);
  padding: 12px;
  border-radius: 4px;
  margin-bottom: 15px;
  display: flex;
  gap: 10px;
  align-items: center;
  font-size: 0.95rem;
}

.error-message {
  color: #f8d7da;
  background: rgba(248, 215, 218, 0.2);
  padding: 12px;
  border-radius: 4px;
  margin-bottom: 15px;
  display: flex;
  gap: 10px;
  align-items: center;
  font-size: 0.95rem;
}

.privacy-text {
  font-size: 0.85rem;
  opacity: 0.8;
  display: flex;
  gap: 8px;
  align-items: center;
}

.privacy-text input {
  margin: 0;
  cursor: pointer;
}

@media (max-width: 768px) {
  .newsletter-section {
    padding: 60px 0;
  }

  .newsletter-content {
    grid-template-columns: 1fr;
    gap: 30px;
  }

  .newsletter-text h2 {
    font-size: 1.5rem;
  }

  .newsletter-text p {
    font-size: 1rem;
  }

  .form-group {
    flex-direction: column;
  }

  .form-group input {
    border-radius: 4px;
  }

  .btn-subscribe {
    border-radius: 4px;
    width: 100%;
  }
}
</style>
