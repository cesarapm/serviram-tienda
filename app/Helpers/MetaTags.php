<?php

namespace App\Helpers;

class MetaTags
{
    private static array $pages = [
        // Home
        '' => [
            'title' => 'Serviram - Equipos Profesionales de Cocina | San Luis Potosí',
            'description' => 'Distribuidor de equipos profesionales para cocina en San Luis Potosí. Soluciones integrales, servicio técnico y garantía. Todos los equipos que necesitas para tu negocio gastronómico.',
            'keywords' => 'equipos de cocina profesional, maquinaria gastronómica, equipos restaurante, cocinas industriales, distribuidora de equipos, San Luis Potosí, servicios de cocina',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
        
        // Guía de productos
        'heat-press-guide' => [
            'title' => 'Guía de Equipos Profesionales | Serviram',
            'description' => 'Conoce cómo elegir y mantener los equipos de cocina profesional. Guías, consejos y mejores prácticas para tu negocio.',
            'keywords' => 'guía equipos cocina, mantenimiento equipos, consejos profesionales, equipos gastronómicos',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
        
        // Nosotros (About)
        'nosotros' => [
            'title' => 'Sobre Serviram - Soluciones en Equipos de Cocina Profesional',
            'description' => 'Serviram es tu distribuidor de confianza en equipos profesionales de cocina. Con más de 20 años de experiencia en la industria gastronómica.',
            'keywords' => 'sobre Serviram, distribuidor equipos cocina, empresa gastronómica, servicios profesionales',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
        
        // Contact
        'contact' => [
            'title' => 'Contacto Serviram - Equipos Profesionales de Cocina',
            'description' => 'Contáctanos para consultas, cotizaciones y servicio técnico. Estamos en San Luis Potosí y disponibles para ayudarte con tus necesidades.',
            'keywords' => 'contacto Serviram, cotización equipos, servicio técnico, San Luis Potosí',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
        
        // Colección de productos
        'products' => [
            'title' => 'Catálogo de Equipos Profesionales | Serviram',
            'description' => 'Explora nuestro completo catálogo de equipos profesionales para cocina. Calidad garantizada y precios competitivos.',
            'keywords' => 'catálogo equipos cocina, comprar equipos profesionales, equipos gastronómicos, maquinaria cocina',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
        
        // Policy Pages
        'privacy-policy' => [
            'title' => 'Política de Privacidad | Serviram',
            'description' => 'Lee nuestra política de privacidad para entender cómo protegemos tu información personal.',
            'keywords' => 'privacidad, protección datos, términos legales',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
        
        'refund-policy' => [
            'title' => 'Política de Reembolso | Serviram',
            'description' => 'Conoce nuestra política de reembolso y garantía de satisfacción en todos nuestros productos.',
            'keywords' => 'política reembolso, garantía, devoluciones',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
        
        'shipping-policy' => [
            'title' => 'Política de Envío | Serviram',
            'description' => 'Información sobre opciones de envío y tiempos de entrega para tus órdenes en Serviram.',
            'keywords' => 'política envío, entregas, tiempos de entrega',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
        
        'terms-of-service' => [
            'title' => 'Términos de Servicio | Serviram',
            'description' => 'Revisa nuestros términos de servicio y comprende tus derechos al comprar con nosotros.',
            'keywords' => 'términos servicio, acuerdo usuario, términos legales',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],

        'product-categories' => [
            'title' => 'Categorías de Productos | Serviram',
            'description' => 'Explora todas las categorías de equipos profesionales disponibles en Serviram.',
            'keywords' => 'categorías equipos, tipos maquinaria, equipos cocina',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
        
        // Auth Pages (no index)
        'login' => [
            'title' => 'Inicia Sesión | Serviram',
            'description' => 'Inicia sesión en tu cuenta de Serviram para acceder a tus pedidos y hacer seguimiento.',
            'keywords' => 'login, iniciar sesión, cuenta cliente',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
            'index' => false,
        ],
        
        'register' => [
            'title' => 'Crear Cuenta | Serviram',
            'description' => 'Crea una nueva cuenta en Serviram para acceder a ofertas exclusivas y seguimiento de pedidos.',
            'keywords' => 'registrarse, crear cuenta, nuevo cliente',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
            'index' => false,
        ],
        
        // Payment Pages
        'checkout/exito' => [
            'title' => 'Pedido Confirmado | Serviram',
            'description' => 'Tu pedido ha sido confirmado exitosamente. Consulta tu correo para detalles y seguimiento.',
            'keywords' => 'pedido confirmado, pago exitoso',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
            'index' => false,
        ],
        
        'checkout/pendiente' => [
            'title' => 'Pedido Pendiente | Serviram',
            'description' => 'Tu pedido está en proceso. Recibirás actualizaciones por correo electrónico.',
            'keywords' => 'pedido pendiente, pago procesando',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
            'index' => false,
        ],
        
        'checkout/error' => [
            'title' => 'Error en el Pedido | Serviram',
            'description' => 'Hubo un error procesando tu pedido. Por favor intenta nuevamente o contacta soporte.',
            'keywords' => 'error pedido, pago fallido',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
            'index' => false,
        ],
        
        // User Pages
        'mis-pedidos' => [
            'title' => 'Mis Pedidos | Serviram',
            'description' => 'Visualiza tu historial de pedidos y realiza seguimiento de tus compras.',
            'keywords' => 'mis pedidos, historial pedidos, seguimiento',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
            'index' => false,
        ],

        'cart' => [
            'title' => 'Carrito de Compra | Serviram',
            'description' => 'Revisa tu carrito de compra y procede al pago de tus equipos profesionales.',
            'keywords' => 'carrito compra, checkout, equipos profesionales',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
            'index' => false,
        ],
        
        'default' => [
            'title' => 'Serviram - Equipos Profesionales de Cocina | San Luis Potosí',
            'description' => 'Distribuidor de equipos profesionales para cocina en San Luis Potosí. Soluciones integrales, servicio técnico y garantía. Todos los equipos que necesitas para tu negocio gastronómico.',
            'keywords' => 'equipos de cocina profesional, maquinaria gastronómica, equipos restaurante, cocinas industriales, distribuidora de equipos, San Luis Potosí, servicios de cocina',
            'image' => 'https://tienda.serviram.com.mx/og-image.png',
        ],
    ];

    public static function getMeta()
    {
        $path = trim(request()->getPathInfo(), '/');
        
        // Extraer el slug principal (sin query strings)
        $slug = explode('?', $path)[0];
        
        // Manejo de rutas dinámicas como /seguimiento-pedido/:orderNumber
        if (str_starts_with($slug, 'seguimiento-pedido/')) {
            return [
                'title' => 'Seguimiento de Pedido | Serviram',
                'description' => 'Realiza el seguimiento de tu pedido en tiempo real. Obtén actualizaciones sobre tu envío.',
                'keywords' => 'seguimiento pedido, rastreo envío, estado pedido',
                'image' => 'https://tienda.serviram.com.mx/og-image.png',
                'index' => false,
            ];
        }
        
        // Buscar la página en la configuración
        $page = self::$pages[$slug] ?? self::$pages['default'];
        
        return $page;
    }

    public static function getTitle()
    {
        return self::getMeta()['title'];
    }

    public static function getDescription()
    {
        return self::getMeta()['description'];
    }

    public static function getKeywords()
    {
        return self::getMeta()['keywords'];
    }

    public static function getImage()
    {
        return self::getMeta()['image'];
    }
    
    public static function shouldIndex()
    {
        $meta = self::getMeta();
        return $meta['index'] ?? true; // Index by default unless explicitly set to false
    }
}

