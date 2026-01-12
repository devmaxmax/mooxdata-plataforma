<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Potencia tu Pyme con Inteligencia Artificial y Business Intelligence. En MooxData transformamos datos en decisiones estratégicas. Desarrollo de Software y Agentes IA.">
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
    <meta property="og:title" content="MooxData | Inteligencia Artificial y Análisis de Datos">
    <meta property="og:description"
        content="Transformamos la información de tu Pyme en decisiones estratégicas mediante Business Intelligence y Agentes de IA autónomos.">
    <meta property="og:image" content="https://mooxdata.xyz/images/logo.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://mooxdata.xyz/">
    <meta property="twitter:title" content="MooxData | Inteligencia Artificial y Análisis de Datos">
    <meta property="twitter:description"
        content="Transformamos la información de tu Pyme en decisiones estratégicas mediante Business Intelligence y Agentes de IA autónomos.">
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
      "description": "Potencia tu Pyme con Inteligencia Artificial y Business Intelligence. En MooxData transformamos datos en decisiones estratégicas.",
      "areaServed": "Posadas, Misiones, Argentina"
    }
    </script>
    <title>MooxData | Inteligencia Artificial y Análisis de Datos</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

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
            <p>Transformamos la información de tu Pyme en decisiones estratégicas mediante Business Intelligence y
                Agentes de IA autónomos.</p>
            <a href="#contacto"><button class="btn">Potenciar mi Negocio</button></a>
        </div>
    </section>

    <section id="servicios">
        <h2 class="section-title">Nuestras Soluciones</h2>
        <div class="services-grid">
            <div class="card">
                <div class="icon-box"><i class="fa-solid fa-robot"></i></div>
                <h3>Bots y Agentes de IA</h3>
                <p>Automatiza la atención al cliente y procesos internos. Creamos agentes inteligentes que entienden,
                    aprenden y ejecutan tareas por ti 24/7.</p>
            </div>
            <div class="card">
                <div class="icon-box"><i class="fa-solid fa-chart-line"></i></div>
                <h3>Business Intelligence</h3>
                <p>Analítica de datos profunda para Pymes. Convertimos hojas de cálculo confusas en dashboards
                    interactivos y comprensibles para la toma de decisiones.</p>
            </div>
            <div class="card">
                <div class="icon-box"><i class="fa-solid fa-code"></i></div>
                <h3>Software a Medida</h3>
                <p>Desarrollo de soluciones tecnológicas específicas para resolver los cuellos de botella de tu
                    operación. Escalables y seguros.</p>
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

        </div>
    </section>

    <section id="contacto">
        <h2 class="section-title">Hablemos de Datos</h2>
        <div class="contact-wrapper">
            <div class="contact-info">
                <div class="info-item">
                    <i class="fa-solid fa-envelope"></i>
                    <p>hablemos@mooxdata.xyz</p>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-phone"></i>
                    <p>+54 9 376 4668451</p>
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
