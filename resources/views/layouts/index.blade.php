<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Potencia tu Pyme con Inteligencia Artificial, Business Intelligence y Desarrollo de Software. En MooxData transformamos datos en decisiones estratégicas.">
    <meta name="keywords"
        content="Inteligencia Artificial, Business Intelligence, Analisis de Datos, Pymes, Software a Medida, Posadas Misiones, Agentes IA, MooxData">
    <meta name="author" content="MooxData">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#00f2ff">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="https://mooxdata.xyz/">
    <link rel="icon" type="image/png" href="images/icon.png">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://mooxdata.xyz/">
    <meta property="og:title" content="MooxData | IA, BI y Desarrollo de Software">
    <meta property="og:description"
        content="Transformamos la información de tu Pyme en decisiones estratégicas mediante Business Intelligence, Agentes de IA autónomos y Desarrollo de Software.">
    <meta property="og:image" content="https://mooxdata.xyz/images/logo.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://mooxdata.xyz/">
    <meta property="twitter:title" content="MooxData | IA, BI y Desarrollo de Software">
    <meta property="twitter:description"
        content="Transformamos la información de tu Pyme en decisiones estratégicas mediante Business Intelligence, Agentes de IA autónomos y Desarrollo de Software.">
    <meta property="twitter:image" content="https://mooxdata.xyz/images/icon.png">

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "MooxData",
      "image": "https://mooxdata.xyz/images/logo.png",
      "@id": "https://mooxdata.xyz",
      "url": "https://mooxdata.xyz",
      "telephone": "+54 9 376 4668451",
      "email": "hablemos@mooxdata.xyz",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Posadas",
        "addressRegion": "Misiones",
        "addressCountry": "AR"
      },
      "description": "Potencia tu Pyme con Inteligencia Artificial, Business Intelligence, Agentes de IA autónomos y Desarrollo de Software. En MooxData transformamos datos en decisiones estratégicas.",
      "areaServed": "Posadas, Misiones, Argentina"
    }
    </script>
    <title>MooxData | Inteligencia Artificial, Análisis de Datos y Desarrollo de Software</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css?v={{ time() }}">

    <script src="https://www.google.com/recaptcha/enterprise.js?render=6Le44ScsAAAAAGTbnIxOdyPmb1_H_LTVnXjBdEub"></script>

</head>

<body>

    <nav>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" width="250px" alt="Mooxdata">
        </div>
        <ul class="nav-links">
            <li><a href="#servicios">Servicios</a></li>
            <li><a href="#clientes">Clientes</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
    </nav>

    <section id="inicio">
        <canvas id="networkCanvas"></canvas>
        <div class="hero-content">
            <h1>El Poder de tus Datos<br><span>Potenciado por IA</span></h1>
            <p>Transformamos la información de tu Pyme o negocio en decisiones estratégicas mediante Desarrollo de
                Software,
                Business Intelligence y Agentes de IA autónomos.</p>
            <a href="#contacto"><button class="btn">Potenciar mi Negocio</button></a>
        </div>
    </section>

    <section id="servicios">
        <h2 class="section-title">Nuestras Soluciones</h2>
        <div class="services-grid">
            <a href="#agentes-ia" style="text-decoration: none;">
                <div class="card">
                    <div class="icon-box"><i class="fa-solid fa-robot"></i></div>
                    <h3>Bots y Agentes de IA</h3>
                    <p>Automatiza la atención al cliente y procesos internos. Creamos agentes inteligentes que
                        entienden,
                        aprenden y ejecutan tareas por ti 24/7.</p>
                </div>
            </a>
            <a href="#bi" style="text-decoration: none;">
                <div class="card">
                    <div class="icon-box"><i class="fa-solid fa-chart-line"></i></div>
                    <h3>Business Intelligence</h3>
                    <p>Analítica de datos profunda para Pymes. Convertimos hojas de cálculo confusas en dashboards
                        interactivos y comprensibles para la toma de decisiones.</p>
                </div>
            </a>
            <a href="#software-medida" style="text-decoration: none;">
                <div class="card">
                    <div class="icon-box"><i class="fa-solid fa-code"></i></div>
                    <h3>Software a Medida</h3>
                    <p>Desarrollo de soluciones tecnológicas específicas para resolver los cuellos de botella de tu
                        operación. Escalables y seguros.</p>
                </div>
            </a>
        </div>
    </section>

    <section id="agentes-ia" class="agents-section">
        <div class="agents-container">
            <div class="agents-content">
                <h2 class="section-title" style="margin-left: 0; text-align: left;">Tu Empleado Más
                    Eficiente,<br>Trabajando 24/7</h2>
                <p class="subtitle">¿Sigues pensando que "usar la IA" significa escribir correos más rápido o generar
                    publicaciones? <br><strong>Eso no es estrategia. Es superficie.</strong></p>

                <p class="description">Descubre cómo un agente de IA puede transformar tu empresa, operando sin
                    interrupciones y resolviendo problemas reales:</p>

                <ul class="agents-features-list">
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <div>
                            <strong>Atención al cliente ininterrumpida</strong>
                            Asistentes virtuales que responden consultas frecuentes 24/7 de forma autónoma.
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <div>
                            <strong>Automatización de procesos</strong>
                            Flujos de trabajo inteligentes para ventas, administración y soporte.
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <div>
                            <strong>Reducción de tareas repetitivas</strong>
                            Extracción de datos, procesamiento de facturas (OCR) y calificación de leads automática.
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <div>
                            <strong>Asistencia interna al equipo</strong>
                            Bots en Slack o Teams que resuelven dudas de tu equipo al instante basados en tu base de
                            conocimientos.
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <div>
                            <strong>Escalabilidad sin límites</strong>
                            Crece sin aumentar tu equipo operativo, implementando sistemas multiagente como miembros
                            adicionales.
                        </div>
                    </li>
                </ul>
                <a href="#contacto"><button class="btn">Implementar un Agente</button></a>
            </div>
            <div class="agents-image">
                <div class="floating-icons">
                    <i class="fa-solid fa-robot float-1"></i>
                    <i class="fa-solid fa-bolt float-2"></i>
                    <i class="fa-solid fa-chart-pie float-3"></i>
                    <i class="fa-solid fa-clock float-4"></i>
                </div>
                <img src="{{ asset('images/ai_agent_worker.png') }}" alt="Agentes de IA trabajando 24/7">
            </div>
        </div>
    </section>

    <section id="bi" class="bi-section">
        <div class="bi-container">
            <h2 class="section-title">Convierte tus Datos en Decisiones Estratégicas</h2>
            <p class="bi-subtitle">Unificá y visualizá la información de tu empresa para tomar mejores decisiones en
                tiempo real.</p>

            <div class="bi-features-grid">
                <div class="bi-feature-card">
                    <div class="bi-icon"><i class="fa-solid fa-cubes"></i></div>
                    <h4>Configuración a Medida</h4>
                    <p class="highlight-text">Definí tu mercado y KPIs</p>
                    <p>Configuramos tus métricas clave, competidores y fuentes de datos para asegurar comparaciones
                        reales y precisas.</p>
                </div>
                <div class="bi-feature-card">
                    <div class="bi-icon"><i class="fa-solid fa-cloud-arrow-down"></i></div>
                    <h4>Captura de Datos</h4>
                    <p class="highlight-text">Extraemos información automáticamente</p>
                    <p>Monitoreamos y conectamos tus sistemas para centralizar la información y mantenerla actualizada
                        en tiempo real.</p>
                </div>
                <div class="bi-feature-card">
                    <div class="bi-icon"><i class="fa-solid fa-brain"></i></div>
                    <h4>Motor Inteligente</h4>
                    <p class="highlight-text">Transformamos datos en acción</p>
                    <p>Organizamos y procesamos la información para que puedas comparar, analizar tendencias y tomar
                        decisiones rápidas.</p>
                </div>
                <div class="bi-feature-card">
                    <div class="bi-icon"><i class="fa-solid fa-bell-concierge"></i></div>
                    <h4>Alertas & Decisión</h4>
                    <p class="highlight-text">Activamos decisiones a tiempo</p>
                    <p>Paneles interactivos y alertas automáticas para detectar oportunidades, proteger tus márgenes y
                        optimizar procesos.</p>
                </div>
            </div>

            <div class="bi-dashboard-image">
                <img src="{{ asset('images/bi_dashboard.png') }}" alt="Dashboard de Business Intelligence"
                    style="border-radius: 20px; box-shadow: 0 10px 50px rgba(0, 242, 255, 0.2); border: 1px solid rgba(0, 242, 255, 0.3); max-width: 100%;">
            </div>
        </div>
    </section>

    <section id="software-medida" class="software-section">
        <div class="software-container">
            <div class="software-header">
                <div class="software-text">
                    <h2 class="section-title" style="margin-left: 0; text-align: left;">Desarrollo a tu Medida</h2>
                    <p class="description">
                        En MooxData diseñamos, desarrollamos e integranos soluciones digitales que resuelven problemas
                        reales y hacen crecer tu empresa. Desde aplicaciones móviles y plataformas web hasta sistemas de
                        gestión a medida: lo que tu negocio necesita, hecho con calidad y sin demoras.
                    </p>
                    <p class="highlight-text">
                        Y porque la innovación es parte de nuestro ADN, trabajamos junto a tu empresa para identificar
                        cuándo la Inteligencia Artificial puede aportar valor y la incorporamos en el desarrollo como un
                        diferencial estratégico.
                    </p>
                </div>
                <div class="software-image-top">
                    <img src="{{ asset('images/software_dev.png') }}" alt="Desarrollo de Software a Medida">
                </div>
            </div>

            <div class="software-features-grid">
                <div class="sw-feature-card">
                    <div class="sw-icon"><i class="fa-solid fa-stopwatch"></i></div>
                    <h4>Velocidad y Agilidad</h4>
                    <p>Entregas rápidas y procesos ágiles adaptados a los tiempos de tu negocio.</p>
                </div>
                <div class="sw-feature-card">
                    <div class="sw-icon"><i class="fa-solid fa-globe"></i></div>
                    <h4>Talento con Visión Global</h4>
                    <p>Equipos expertos locales con experiencia internacional en tecnologías modernas.</p>
                </div>
                <div class="sw-feature-card">
                    <div class="sw-icon"><i class="fa-solid fa-laptop-code"></i></div>
                    <h4>Soluciones a Medida</h4>
                    <p>Sistemas completamente adaptados a tu industria y flujos de trabajo específicos.</p>
                </div>
                <div class="sw-feature-card">
                    <div class="sw-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h4>Calidad y Seguridad</h4>
                    <p>Arquitectura robusta, código limpio y seguridad garantizada en cada entrega.</p>
                </div>
                <div class="sw-feature-card">
                    <div class="sw-icon"><i class="fa-solid fa-handshake"></i></div>
                    <h4>Socios a Largo Plazo</h4>
                    <p>Acompañamiento estratégico continuo, mantenimiento y soporte evolutivo.</p>
                </div>
                <div class="sw-feature-card">
                    <div class="sw-icon"><i class="fa-solid fa-microchip"></i></div>
                    <h4>AI con Propósito</h4>
                    <p>Innovación real y uso de Inteligencia Artificial cuando verdaderamente aporta valor.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="clientes">
        <h2 class="section-title">Confían en Nosotros</h2>
        <p style="text-align: center; color: #aaa;">Empresas que ya están optimizando su futuro.</p>
        <div class="clients-container">
            <div class="client-logo">
                <img src="{{ asset('images/alvarenga_srl.png') }}" width="260px" alt="Alvarenga SRL">
            </div>
            <div class="client-logo">
                <img src="{{ asset('images/result_burra.jpg') }}" width="180px" alt="Burra Comida Mexicana">
            </div>


        </div>
    </section>

    <section id="contacto">
        <h2 class="section-title">Hablemos de Soluciones</h2>
        <div class="contact-wrapper">
            <div class="contact-info">
                <div class="info-item">
                    <i class="fa-solid fa-envelope"></i>
                    <p>hablemos@mooxdata.xyz</p>
                </div>
                <div class="info-item">
                    <i class="fa-brands fa-instagram"></i>
                    <p><a href="https://www.instagram.com/mooxdata_ia" target="_blank">mooxdata_ia</a></p>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>Posadas Misiones, Argentina</p>
                </div>
            </div>
            <div class="contact-form">
                <form id="contactForm" onsubmit="event.preventDefault();">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Nombre de tu empresa" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Tu correo electrónico" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="5" placeholder="¿Qué desafío de datos quieres resolver?" required></textarea>
                    </div>
                    <button class="btn" onclick="onClick(event)" style="width: 100%;">Enviar Consulta</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 MooxData. Todos los derechos reservados.</p>
    </footer>

    <div class="chat-toggle-btn" id="chatToggleBtn">
        <i class="fa-solid fa-comments"></i>
    </div>

    <div class="chat-window" id="chatWindow">
        <div class="chat-header">
            <span>Asistente MooxData</span>
            <i class="fa-solid fa-xmark close-chat" id="closeChatBtn"></i>
        </div>
        <div class="chat-body" id="chatBody">
            <div class="message bot-message">
                ¡Hola! Soy el asistente virtual de MooxData. ¿En qué puedo ayudarte hoy a potenciar tu negocio?
            </div>
        </div>
        <div class="chat-footer">
            <input type="text" id="chatInput" placeholder="Escribe un mensaje...">
            <button class="send-btn" id="sendBtn"><i class="fa-solid fa-paper-plane"></i></button>
        </div>
    </div>

    <script>
        const getChat = "{{ route('index.getChat') }}";
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('js/chat.js') }}"></script>
    <script src="{{ asset('js/correo.js') }}"></script>
    <script src="{{ asset('js/particulas.js') }}"></script>
    <script>
        function onClick(e) {
            e.preventDefault();
            grecaptcha.enterprise.ready(async () => {
                const token = await grecaptcha.enterprise.execute('6Le44ScsAAAAAGTbnIxOdyPmb1_H_LTVnXjBdEub', {
                    action: 'LOGIN'
                });
                onSubmit(token);
            });
        }
    </script>

</body>

</html>
