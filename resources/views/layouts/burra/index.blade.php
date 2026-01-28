<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="google" content="notranslate">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="version" content="nd.v24">
    <meta name="robots" content="noindex,nofollow">


    <title>BURRA COMIDA MEXICANA</title>

    <link href="{{ asset('burra/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800&display=swap" rel="stylesheet">

    <link href="{{ asset('burra/css/freelancer.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <link rel="stylesheet" href="{{ asset('burra/css/sweetalert2.min.css') }}">
    <link href="{{ asset('burra/css/style.css') }}" rel="stylesheet">



    <style>

    </style>

</head>

<body id="page-top" style="">

    <script>
        window.BurraConfig = {
            route_pedido: "{{ route('burra.pedido') }}",
            csrf_token: "{{ csrf_token() }}",
            productos: @json($productsJson),
            categorias: @json($categoriesJson),
            telefono: '{{ $telefono ?? '5493764999618' }}',
            variedades_en_lista: true
        };
        // Legacy global variables support (during refactor transition)
        var g_pedido = {
            "productos": [],
            preguntas: []
        };
        var g_telefono = window.BurraConfig.telefono;
        var g_variedades_en_lista = window.BurraConfig.variedades_en_lista;
        var g_productos = window.BurraConfig.productos;
        var g_categorias = window.BurraConfig.categorias;
        var g_zonas_envios = [];
        var g_pedido_zona_envio_ignorar_monto = -1;
        var g_stock = {};
        var g_control_mostrar_stock_disponible = true;
        var g_viendo_resumen = false;
        var g_viendo_buscador = false;
        var g_impuesto_subtotal_global = 0;
        var g_impuesto_subtotal_global_original = g_impuesto_subtotal_global;
    </script>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav"
        style="background-color:#AA282C!important;">

        <div class="container" style="min-height:50px;">


            <div class="titulo-catalogo">
                <a id="link_logo" class="iframe" href="#"><img src="{{ asset('burra/images/logo.jpeg') }}"
                        style="border-radius: 50%;height: 50px;width: 50px;"></a>&nbsp;
                <a id="link_titulo" style="font-size:17px;white-space: pre-wrap;" class="navbar-brand js-scroll-trigger"
                    style="vertical-align: middle" href="#">BURRA COMIDA MEXICANA</a>
            </div>



        </div>

    </nav>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="sidenav-closebtn" onclick="closeNav()">&times;</a>
        <div id="sidenav_categorias">
        </div>
    </div>






                                <div id="popup_control_horario" style="display:none;  border-radius: .5rem;">
                                    <center>
                                        <div style="text-align:center;">
                                            Estamos cerrados </div>
                                    </center>
                                </div>

                                <div id="popup_monto_minimo" style="display:none;  border-radius: .5rem;">
                                    <center>
                                        <div style="text-align:center;">
                                            El monto mínimo para realizar un pedido es de $ </div>
                                    </center>
                                </div>

                                <div id="popup_inicial" style="display:none;  border-radius: .5rem;">
                                    <center>
                                        <div style="text-align:center;">
                                        </div>
                                    </center>
                                </div>

                                <div id="pregunta_vaciar_pedido" style="display:none;  border-radius: .5rem;">
                                    <center>
                                        <h5 class="mb-3" style="">¿Vaciar carrito?</h5>
                                        <button class="btn my-btn-primary"
                                            onclick="
				
				// Quito el resumen
				g_viendo_resumen=true;
				mostrar_resumen_pedido();

				g_pedido.productos=[];
				calcular_total();
				
				$.fancybox.close();

				">Si</button>
                                        <button class="btn my-btn-auxiliar" onclick="$.fancybox.close();">No</button>
                                    </center>
                                </div>

                                <div id="preguntas_pedido" style="display: none; border-radius: .5rem;"
                                    class="">


                                    <div style='text-align:center;font-size:18px;margin-bottom:20px;'>COMPLETA LAS
                                        SIGUIENTES <BR> PREGUNTAS PARA
                                        QUE <BR> PREPAREMOS TU PEDIDO</div>
                                    <h5 class="mb-3" style="">
                                    </h5>


                                    <form onSubmit="finalizar_pedido(); return false;">

                                        <p>
                                            <label id='pregunta_1_label'>Nombre y Apellido(*)</label> <input
                                                type="text" value="" id="pregunta_1_respuesta"
                                                name="pr_preg1" class="form-control" required placeholder="">
                                        </p>

                                        <p>
                                            <label id='pregunta_2_label'>Dirección(*)</label> <input type="text"
                                                value="" id="pregunta_2_respuesta" name="pr_preg2"
                                                class="form-control" required placeholder="">
                                        </p>

                                        <p>
                                            <label id='pregunta_3_label'>¿Algun dato adicional sobre el pedido o su
                                                dirección?:*</label>

                                            <textarea class="form-control" required placeholder="" name="pr_preg3" id="pregunta_3_respuesta" cols="30"
                                                rows="5"></textarea>
                                        </p>

                                        <p>
                                            <label id='pregunta_4_label'>Forma de pago(*):</label>
                                            <select id="pregunta_4_respuesta" name="pr_preg4" class="form-control"
                                                required placeholder="">
                                                <option value="">Seleccione</option>
                                                <option value="efectivo">Efectivo</option>
                                                <option value="billetera">Billetera Virtual</option>
                                                <option value="tarjeta">Tarjeta Débito / Crédito</option>
                                            </select>
                                        </p>








                                        <p style='text-align:center;font-size:18px;'>GRACIAS POR ELEGIRNOS <BR> HORARIO
                                            DE ATENCIÓN <BR> Miercoles
                                            a Domingo de 20:00 a 23:50hs</p>
                                        <div id="preguntas_resumen" style="display:none;" class="preguntas-resumen">
                                        </div>

                                        <p class="mb-0 text-center">
                                            <input value="Enviar Pedido" type="submit" class="btn my-btn-primary">
                                        </p>

                                    </form>

                                </div>

                                <div id="pregunta_variedades" style="display: none; border-radius: .5rem;"
                                    class="pregunta-variedades-box">

                                    <h5 class="mb-3" class="titulo-ventana" id="pregunta_variedades_titulo">
                                        Elija una opción </h5>
                                    <span id="pregunta_variedades_opciones"></span>

                                </div>

                                <form id="form_pedido" action="https://pidorapido.com/create.order.v15.php"
                                    target="_top" method="POST" style="display:none;margin-top:100px;">
                                    <input id="form_alias" name="alias" value="burracomidamexicana">
                                    <input id="form_url" name="url">
                                    <input name="email" value="">
                                    <input id="isdesktop" name="isdesktop" value="">
                                    <input name="webhook" value="">
                                    <textarea id="form_order_json" name="order_json"></textarea>
                                    <textarea id="form_order_text" name="order_text"></textarea>
                                </form>

                                <div class="slider-container">
                                    <div id="carouselExampleControls" class="carousel slide " data-ride="carousel"
                                        data-interval="3000" style="margin-top: -12px;">

                                        <div class="carousel-inner">

                                            <div class="carousel-item  active">
                                                <img src="https://yourfiles.cloud/uploads/868a1f341ed053b47d8c03170436d940/Banner%20Horizontal%20Minimalista%20Joyer%C3%ADa%20%282%29.gif"
                                                    class="d-block w-100" alt="...">
                                            </div>

                                        </div>


                                    </div>
                                </div>

                                <div class="container"
                                    style="max-width: 600px;background-color: #FFFFFF !important; padding-top: 10px;">

                                    <div class="row" id="productos">



                                        <!--
    <div class="col-md-12 helper_resumen">
     <a href="javascript://" style="" onclick="mostrar_resumen_pedido();" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
    -->

                                        <div class="helper_resumen resumen_titulo col-md-12"
                                            style="
					margin-top: 10px;
					margin-bottom: 10px;
					font-weight: 900;
					font-size: 20px;
					display: none;
					">

                                            <a href="javascript://" onclick="vaciar_pedido();" class="btn btn-link"
                                                id="boton_vaciar"
                                                style="position:absolute; right:5px; margin-top: -5px;"><i
                                                    class="fas fa-trash"></i> </a>

                                            <a href="javascript://" onclick="mostrar_resumen_pedido();"
                                                class="btn btn-link"
                                                style="position:absolute; left:5px; margin-top: -5px;"><i
                                                    class="fas fa-arrow-left"></i></a>

                                            <center>
                                                Tu pedido </center>
                                        </div>

                                        <div class="helper_buscador resumen_titulo col-md-12"
                                            style="
					margin-top: 10px;
					margin-bottom: 10px;
					font-weight: 900;
					font-size: 20px;
					display: none;
					">

                                            <a href="javascript://" onclick="mostrar_buscador();"
                                                class="btn btn-link"
                                                style="position:absolute; left:5px; margin-top: -5px;"><i
                                                    class="fas fa-arrow-left"></i></a>

                                            <a href="javascript://" onclick="copiar_busqueda();" class="btn btn-link"
                                                style="position:absolute;left: 34px;margin-top: -5px;"><i
                                                    class="fas fa-copy"></i></a>

                                            <input type="search" value="" id="input_buscador" name="buscador"
                                                class="form-control float-right"
                                                style="margin-top:-4px;width: calc(100% - 62px);"
                                                placeholder="Texto a buscar" onkeyup="buscar();">

                                        </div>

                                        @foreach ($categories as $category)
                                            <div class="col-md-12 category-wrapper">
                                                <div class="row">
                                                    <div class="col-md-12 categoria"
                                                        data-categoria="{{ $category->id }}"
                                                        id="categoria_{{ $category->id }}"
                                                        onclick="mostrar_categoria('{{ $category->id }}');">

                                                        <div class="categoria-titulo-box">
                                                            <div class="categoria-titulo "
                                                                onclick="mostrar_categoria('{{ $category->id }}');">
                                                                <a href="javascript://"
                                                                    onclick="mostrar_categoria('{{ $category->id }}');">
                                                                    @if ($category->image)
                                                                        <img src="{{ asset('burra/images/' . $category->image) }}"
                                                                            class="categoria-titulo-icono">
                                                                    @endif
                                                                    {{ $category->name }}
                                                                </a>
                                                            </div>

                                                            <div class="categoria-titulo-open-close-icon-container">
                                                                <i
                                                                    class="fas fa-angle-down icono_{{ $category->id }} categoria_icono"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @foreach ($products->where('category_id', $category->id) as $product)
                                                        <div class="col-md-12 producto"
                                                            data-categoria="{{ $category->id }}"
                                                            data-subcategoria="{{ $product->id }}"
                                                            id="producto_{{ $product->id }}" style="display:none;">
                                                            <div class="producto_fila producto-box"
                                                                id="fila_{{ $product->id }}">
                                                                <div style="display:flex; justify-content: space-between; cursor:pointer; display: flow-root; min-height:50px;"
                                                                    onclick="agregar_al_pedido('{{ $product->id }}');">
                                                                    <div class="producto-box-main">
                                                                        <div
                                                                            style="display:flex; flex-direction: column;">
                                                                            <div
                                                                                style="display:flex; justify-content: space-between;">
                                                                                <div style="display:flex;">
                                                                                    <div>
                                                                                        <div id="producto_titulo_{{ $product->id }}"
                                                                                            class="producto-titulo">
                                                                                            {{ $product->name }}</div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="precio-box"
                                                                                    style="font-weight:900;">
                                                                                    <div
                                                                                        style="display: flex; flex-direction: column; text-align: right;">
                                                                                        <div
                                                                                            style="white-space: nowrap;">
                                                                                            <span
                                                                                                class="producto_descuento"
                                                                                                style="font-size: 0.75rem; margin-right: 5px; vertical-align: middle;"></span>
                                                                                            <span
                                                                                                style="vertical-align: middle;">${{ number_format($product->price, 0, ',', '.') }}</span>
                                                                                        </div>
                                                                                        <span
                                                                                            class="producto_descuento_porcentaje"
                                                                                            style="font-size: 0.75rem; text-decoration: line-through; text-align: right; margin-top:0px;"></span>
                                                                                        <span
                                                                                            id="cantidad_{{ $product->id }}"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div>
                                                                                <div class='producto-descripcion'>
                                                                                    {{ $product->description }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class='separador-producto-de-variedad'
                                                                    style="display: none;">
                                                                    <hr>
                                                                </div>

                                                                <div class="producto_cantidades"
                                                                    id="cantidades_{{ $product->id }}"
                                                                    style="display:none; font-weight: bold;"></div>

                                                                <div class="helper_variedades_agregar clearfix"
                                                                    style="display: none; padding:7px; padding-top:0px;">
                                                                    <button
                                                                        class='btn float-right add-new-option producto-agregar-opcion'
                                                                        onclick="agregar_al_pedido('{{ $product->id }}');">Agregar
                                                                        otra
                                                                        opción</button>
                                                                </div>

                                                                <div class="helper_aclaracion clearfix producto-aclaracion"
                                                                    style="display: none;">
                                                                    <form onsubmit="return false;">
                                                                        <textarea type="text" value="" id="aclaracion_{{ $product->id }}" name="aclaracion_{{ $product->id }}"
                                                                            class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                                                    </form>
                                                                </div>

                                                                <div class="separador-productos"></div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>

                                </div>


                                <!-- https://wa.me/5493764865939 -->
                                <a href="https://wa.me/5493764999618" class="whatsapp-floating-button"
                                    target="_blank"><img src="{{ asset('burra/images/whatsapp-icon.svg') }}"
                                        width="70"></a>



                                <div class="footer-con-logo-contenedor">
                                    <img src="{{ asset('burra/images/logo.jpeg') }}" class="footer-logo">
                                </div>

                                <footer class="footer text-center">
                                    <div class="container">
                                        <div class="row">

                                            <!-- Footer About Text -->
                                            <div class="col-lg-12">
                                                <p class="lead mb-0">

                                                <div>


                                                    BURRA COMIDA MEXICANA<BR> Lunes y Martes cerrado<BR>Miercoles a
                                                    Domingo de 20:00 a
                                                    23:50<br>Jujuy 1874, Posadas Misiones
                                                    <br><span class="fab fa-instagram">&nbsp;</span><a
                                                        href="https://www.instagram.com/XXXXXXXXXXXX"
                                                        target=_blank>@burra.comidamexicana</a </div>

                                                    <div class="helper_footer_padding"
                                                        style="height: 70px; display: none;"></div>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                </footer>


                                <div class="footer-enviar-pedido" style="display:none;pointer-events: none;"
                                    id="footer_enviar">

                                    <a href="javascript://" onclick="clickEnviarPedido()"
                                        class="btn animated my-btn-auxiliar" id="boton_enviar"
                                        style="pointer-events: auto;">Enviar pedido</a>

                                </div>

                                <div class="popup_instagram">
                                    <div class="popup_instagram_titulo">Navegador no soportado</div>
                                    <div class="popup_instagram_texto">Copia el link y pégalo en tu navegador para
                                        poder realizar tu pedido</div>

                                    <div class="popup_instagram_link">
                                        <input type="text" readonly
                                            value="https://mooxdata.xyz/app/burracomidamexicana"
                                            id="input_instagram_link"
                                            style="width: calc(100% - 50px);margin-right: 10px;" />
                                        <button class="btn" onclick="copiar_link_instagram();">Copiar</button>
                                    </div>

                                </div>

                                <div class="navbar-footer-container">
                                    <div style="" class="navbar-footer">


                                        <button type="button" style="display:none;" onclick="openNav()"
                                            class="btn my-btn-primary animated fadeIn" id="mobile-nav-toggle">
                                            <i class="fa fa-bars"></i>
                                        </button>

                                        <button class="btn my-btn-primary" id="boton_buscador"
                                            style="HCHdisplay:none;" type="button" onclick="mostrar_buscador();">
                                            <i id="icono_buscador" class="fas fa-search"></i>
                                        </button>

                                        <button class="btn helper_changuito my-btn-primary" type="button"
                                            onclick="mostrar_resumen_pedido();">
                                            <i id="icono_resumen_pedido" class="fas fa-shopping-bag fa-2x"></i>
                                            <div class="badge hchbadge-primary pedido_productos_cantidad_total">0</div>
                                        </button>

                                        <!-- <div style="background-color:#AA282C!important; padding-left: 10px; z-index:999999;"></div> -->


                                    </div>
                                </div>

                                <div class="navbar-footer-brand-container">
                                </div>


                                <!-- Bootstrap core JavaScript -->
                                <script src="{{ asset('burra/js/jquery.min.js') }}"></script>
                                <script src="{{ asset('burra/js/bootstrap.bundle.min.js') }}"></script>

                                <!-- Plugin JavaScript -->
                                <script src="{{ asset('burra/js/jquery.easing.min.js') }}"></script>

                                <!-- Custom scripts for this template -->
                                <script src="{{ asset('burra/js/freelancer.min.js') }}"></script>


                                <script src="{{ asset('burra/js/jquery.fancybox.min.js') }}"></script>

                                <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
                                <script src="{{ asset('burra/js/sweetalert2.min.js') }}"></script>



                                <script src="{{ asset('burra/js/lazyload.js') }}"></script>


                                <script src="{{ asset('burra/js/app.js') }}"></script>

</body>

</html>
