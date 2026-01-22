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

<!--	<link rel="shortcut icon" type="image/ico" href="favicon.ico"> -->
	<title>BURRA COMIDA MEXICANA</title>

	<!-- Custom fonts for this theme -->
	<link href="https://pidorapido.com/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800&display=swap" rel="stylesheet">
	
	<!-- Theme CSS -->
	<link href="https://pidorapido.com/css/freelancer.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />


	<!-- <link rel="stylesheet" href="/vendor/swal/sweetalert2.min.css"> -->
	<link rel="stylesheet" href="https://pidorapido.com/vendor/swal11/sweetalert2.min.css">
	


	<style>
	body {
		padding-top: 110px;
		background-color:#FFFFFF !important;		color:#AA282C !important	}
	@media (max-width: 980px) {
		body {
			padding-top: 90px;
		}
	}

	.producto
	{
		padding-right: unset;
    	padding-left: unset;
	}

	#mainNav .navbar-brand {
		color: #E59396 !important;
	}

	.producto-box
	{
		padding-left: 15px;
		padding-right: 15px;
		padding-top: 10px;
	}

	.producto-box-main{
		display: flex;
		flex-direction: column;
		width: 100%;
	}

	.producto-box-auxiliar{
	}

	.producto-box-auxiliar.imagen-chica{
		width: 50%;
	}

	.producto-titulo
	{
	}

	.producto-pedido
	{
		background-color: #AA282C;
		color: #FFFFFF;
		padding-top: 20px;
		padding-bottom: 30px;
		padding-left: 17px;
    	padding-right: 17px;
	}

	.producto-pedido .producto_cantidades
	{
		padding: 7px;
	}

	.producto-pedido .producto-descripcion
	{
		color: #FFFFFF !important;	
	}

	.producto-descripcion
	{
		color: #606060;
		margin-top: 20px;
		font-size: 80%;
    	font-weight: 400;
		margin-bottom: 15px;
	}

	.producto-aclaracion
	{
		padding-top: 0px;
		padding-bottom: 0px;
	}

	.botonera-productos-qty{
		border: 1px solid #FFFFFF;
    	border-radius: 8px;
	}

	.botonera-productos-qty-less{
		background-color: #AA282C;
    	color: #FFFFFF;
		border: 0px;
	}

	.botonera-productos-qty-middle{
		color: #AA282C;
    	background-color: #FFFFFF;
		border: 0px;
	}

	.botonera-productos-qty-more{
		background-color: #AA282C;
    	color: #FFFFFF;
		border: 0px;
	}

	.producto-agregar-opcion{
		background-color: #AA282C;
    	color: #FFFFFF;
		border: 1px solid #FFFFFF;
    	border-radius: 8px;
		font-size: 80%;
	}
	.producto-agregar-opcion:hover{
		background-color: #AA282C;
    	color: #FFFFFF;
		border: 1px solid #FFFFFF;
    	border-radius: 8px;
		font-size: 80%;
	}

	.fancybox-close-small
	{
		color: #AA282C !important;
	}

	.fancybox-content{
		background-color: #FFFFFF;
	}

	body.tienehover.producto_fila:hover
	{
		background-color: #AA282C !important		border-radius: .5rem;
	}

	.producto_descuento
	{
		color:#AA282C !important	}

	.producto-pedido .producto_descuento
	{
		color: #FFFFFF !important;
	}

	.producto_descuento_porcentaje
	{
		color:#AA282C !important	}

	.producto-pedido .producto_descuento_porcentaje
	{
		color: #FFFFFF !important;
	}

	.separador-menu
	{
		width: 100%;
		background-color: #606060;
		height: 1px;
		opacity: 30%;
		margin-bottom: 15px;
    	margin-top: 15px;
	}

	.separador-productos
	{
		width: 100%;
		background-color: #606060;
		height: 1px;
		opacity: 10%;
		margin-bottom: 15px;
    	margin-top: 15px;
	}

	.separador-producto-de-variedad hr
	{
		margin-bottom: 7px;
		margin-top: 7px;
		margin-left: 8px;
		margin-right: 8px;
		border: solid 0.5px #FFFFFF;
	}

	* {
			touch-action: manipulation;
	}

	.categoria {
		padding-left: unset;
		padding-right: unset;		
		padding-top: 15px;
		padding-bottom: 15px;
		border-bottom: 1px solid #606060;
	}

	.categoria.sticky-active {
			}

	.categoria.imagen-fondo {
		padding-top: 35px;
		padding-bottom: 35px;
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
	}

	.separador-categorias {
		width: 100%;
		background-color: #FFFFFF;
		height: 1px;
		opacity: 30%;
		margin-top: 10px;
	}
	
	.categoria-titulo
	{		
		font-weight:900;
		padding-left: 15px;
    	padding-right: 15px;
		font-size: 18px;
	}

	.categoria-titulo a
	{
		text-decoration: none;
		color: #AA282C;
	}

	.categoria-titulo.imagen-fondo a
	{
		text-decoration: none;
		color: #FFFFFF;
		text-shadow: -1px 0 2px #E59396, 0 1px 2px #E59396, 1px 0 2px #E59396, 0 -1px 2px #E59396;
	}

	.texto-shadow
	{
		text-decoration: none;
		color: #FFFFFF;
		text-shadow: -1px 0 2px #E59396, 0 1px 2px #E59396, 1px 0 2px #E59396, 0 -1px 2px #E59396;
	}

	.categoria-titulo-icono {
		border-radius: 50%;
		height: 70px;
		width: 70px;
		margin-right:15px; 
		border-style: solid; 
		border-color: #AA282C;
	}
	.categoria-titulo-box
	{
		display: flex;
		justify-content: space-between;
	}

	.categoria-titulo-open-close-icon-container {
		margin-right: 15px;
		display: flex;
		justify-content: center;
		flex-direction: column;
		cursor: pointer;
	}


	.subcategoria{
		padding-left: unset;
		padding-right: unset;	
		padding-top: 15px;
		padding-bottom: 15px;
		color:#AA282C !important;
		background-color: #FFFFFF;
	}

	.subcategoria.sticky-active {
			}

	.subcategoria-titulo
	{
		padding-left: 30px;
    	padding-right: 15px;
	}

	.subcategoria-titulo a
	{
		text-decoration: none;
		color:#AA282C !important	}

	.resumen_titulo
	{

	}

	.resumen_titulo A
	{
		color:#AA282C !important		text-decoration: none;
		font-size: 90%;
		
	}

	.my-btn-primary
	{
		color: #E59396;
		background-color: #AA282C;
		border-color: #AA282C;
		border-radius: 15px;
	}
	.my-btn-primary:hover
	{
		color: #FFFFFF;
		background-color: #FC181F;
		border-color: #FC181F;
	}

	.btn-variedad
	{
		color: #E59396;
		background-color: #AA282C;
		border-color: #AA282C;
		border-radius: 15px;
		margin-bottom: 10px;
	}
	.btn-variedad:hover
	{
		color: #FFFFFF;
		background-color: #FC181F;
		border-color: #FC181F;
	}

	.btn-link
	{
		color: #AA282C;
	}
	.btn-link:hover
	{
		color: #AA282C;
	}

	a {
		color: #FC181F;
		text-decoration: none;
		background-color: transparent;
	}

	.my-btn-auxiliar
	{
		color: #FFFFFF;
		background-color: #FC181F;
		border-color: #FC181F;
		border-radius: 15px;
		padding-left: 15px;
    	padding-right: 15px;
	}
	.my-btn-auxiliar:hover
	{
		color: #FFFFFF;
		background-color: #FC181F;
		border-color: #FC181F;
		font-weight: bold;
	}


	.sidenav {
		height: 100%;
		width: 0;
		position: fixed;
		top: 0;
		right: 0;
		background-color:#FFFFFF !important;		overflow-x: hidden;
		transition: 0.5s;
		padding-top: 60px;
		z-index: 1000000;
	}

	.producto-imagen.chica {
		margin-right: 15px;
	}

	.sidenav-item {
		padding: 8px 8px 8px 32px;
		text-decoration: none;
		color: #AA282C;
		display: block;
		transition: 0.3s;
	}

	.sidenav-closebtn {
		position: absolute;
		top: 0;
		right: 25px;
		font-size: 36px;
		margin-left: 50px;
		color: #AA282C;
	}

	.titulo-ventana
	{
	}

	.preguntas-resumen{
		background-color: #FFFFFF;
		padding: 15px;
		border-radius: 10px; 
		margin-bottom: 15px;
	}

	.footer-enviar-pedido
	{
		position: fixed;
		padding-top: 15px;
		padding-bottom: 15px;
		left: 0;
		bottom: 73px;
		width: 100%;
		text-align: center;
		display:flex;
		justify-content: center;
		z-index: 150;
	}

	.footer {
		padding-top:2rem; 
		padding-bottom: 0px;
		color: #E59396;
		background-color:#AA282C!important;		min-height: 300px;
	}

	.footer-con-logo-contenedor{
		background-color:#AA282C!important;		display: flex;
		justify-content: center;
	}
	.footer-logo{
		border-radius: 50%;
		height: 80px;
		width: 80px;
		margin-top: -40px;
		z-index: 50;
	}

	.footer a {
		color: #E59396;
	}

	.navbar-footer-container {
		background-color:#AA282C!important;		position: fixed;
		padding-top: 15px;
		padding-bottom: 15px;
		left: 0;
		bottom: 12px;
		width: 100%;
		display: flex;
		justify-content: center;
		z-index: 60;
	}

	.navbar-footer {		
		display: flex;
		justify-content: space-around;
		max-width: 600px;
		width: 100%;
	}

	.navbar-footer-brand-container {
		background-color: white;
		color: #5f5d5d;
		position: fixed;
		font-size: 8px;
		left: 0;
		bottom: 0;
		width: 100%;
		display: flex;
		justify-content: center;
		z-index: 100;
	}

	.navbar-footer-brand-container a {
		color: #5f5d5d;
	}

	.pregunta-variedades-box
	{
		
	}

	.botonera-productos-qty-middle{
		border: 1px solid #AA282C;
	}

	.swal2-input
	{
		background-color: white;
		margin-left: 30%;
		margin-right: 30%;
		text-align: center;
	}

	.titulo-catalogo{
		display: flex;
    	align-items: center;
	}

	.whatsapp-floating-button
	{
		position: fixed; 
		right: 20px; 
		bottom: 100px; 
		z-index:100;
	}

    /* max width 1200 centered and width 100%*/
    .slider-container{
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
    }




    .popup_instagram{
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
            z-index: 999999;
            color: black;
            display: none;
        }

        .popup_instagram_cerrar{
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .popup_instagram_titulo{
            font-weight: 900;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .popup_instagram_texto{
            margin-bottom: 10px;
        }

        .popup_instagram_link{
            display: flex;
            justify-content: space-between;
        }

        .popup_instagram_link input{
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .popup_instagram_link button{
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f0f0f0;
            cursor: pointer;
        }




	</style>

</head>

<body id="page-top" style="">

	<script>

		var g_telefono = '5493764865939';
		var g_variedades_en_lista = true;

	</script>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav" style="background-color:#AA282C!important;">

		<div class="container" style="min-height:50px;">

			
				<div class="titulo-catalogo">										
					<a id="link_logo" class="iframe" href="https://pidorapido.com/"><img src="https://yourfiles.cloud/uploads/da5d4cdf2db9869901d6d88e8bf7cf77/WhatsApp%20Image%202025-12-22%20at%2020.00.13%20-%20Nadia%20Maximowicz.jpeg" style="border-radius: 50%;height: 50px;width: 50px;"></a>&nbsp;
					<a id="link_titulo" style="font-size:17px;white-space: pre-wrap;" class="navbar-brand js-scroll-trigger" style="vertical-align: middle" href="https://pidorapido.com/">BURRA COMIDA MEXICANA</a>
				</div>


			
		</div>

	</nav>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="sidenav-closebtn" onclick="closeNav()">&times;</a>
		<div id="sidenav_categorias">
		</div>
	</div>

	<script>
	// Variable que guarda el pedido actual
	var g_pedido = {"productos":[]};

	var g_viendo_resumen = false;
	var g_viendo_buscador = false;

    var g_impuesto_subtotal_global = 0;
    var g_impuesto_subtotal_global_original = g_impuesto_subtotal_global;

	function mostrar_resumen_pedido()
	{
		if (g_viendo_buscador) mostrar_buscador();

		ver_todas_las_categorias();

		if (!g_viendo_resumen)
		{

			$('.producto-imagen').hide();
			$('.categoria').hide();
			$('.subcategoria').hide();
			$('.producto').hide();

			$('.helper_resumen').show();
			$('.producto-imagen-carrito').show();

			g_pedido.productos.forEach(function(producto, index, mi_array) {
						$('#producto_' + producto.id).show();
					}
				);

			$('#icono_resumen_pedido').removeClass("fa-shopping-bag");
			$('#icono_resumen_pedido').addClass("fa-arrow-left");
			//$('#icono_resumen_pedido').addClass("fa-arrow-left");

			$('.pedido_productos_cantidad_total').hide();
			
			//location.href="#";
			
			location.href="#mipedido";

			// Me muevo para arriba
			// $("html, body").animate({ scrollTop: 10 }, "slow");
			$(window).scrollTop(0);

			// history.pushState("tupedido", "", "#tupedido");

			g_viendo_resumen = true;

		}else{

			//$('.footer').show();

			$('.producto-imagen').show();
			$('.categoria').show();
			$('.subcategoria').show();
			$('.producto').show();
			
			$('.helper_resumen').hide();
			$('.producto-imagen-carrito').hide();

			$('#icono_resumen_pedido').addClass("fa-shopping-bag");
			$('#icono_resumen_pedido').removeClass("fa-arrow-left");
			//$('#icono_resumen_pedido').removeClass("fa-arrow-left");
			$('.pedido_productos_cantidad_total').show();

			// cierro todas las categorias
			$('.categoria-titulo ').click();

			//location.href="#listado";

			//history.state="listado";
			//history.back();
			// history.pushState("listado", "", "#");

			// Me muevo arriba de todo
			// $("html, body").animate({ scrollTop: 10 }, "slow");
			$(window).scrollTop(0);

			g_viendo_resumen = false;
		}
	}

	function quitar_acentos(p_palabra)
	{
		p_palabra = p_palabra.replace(/á/g, "a");
		p_palabra = p_palabra.replace(/é/g, "e");
		p_palabra = p_palabra.replace(/í/g, "i");
		p_palabra = p_palabra.replace(/ó/g, "o");
		p_palabra = p_palabra.replace(/ú/g, "u");
		p_palabra = p_palabra.replace(/ü/g, "u");
		return p_palabra;
	}

	function buscar()
	{
		v_palabra = $("#input_buscador").val().toLowerCase();
		v_palabra = quitar_acentos(v_palabra);

		// console.log("Buscando",v_palabra);

		if (v_palabra.length < 0 )
		{
			console.log("Aun no llega al limite de caracteres");
			return false;
		}

		g_productos.forEach(
				function(producto, index, mi_array)
				{
					v_mostrar_producto = false;

					// console.log(producto.nombre.indexOf(v_palabra), producto.id, producto.nombre, v_mostrar_producto , producto.descripcion);

					if (quitar_acentos(producto.nombre.toLowerCase()).indexOf(v_palabra)>=0) v_mostrar_producto = true;
					if (quitar_acentos(producto.descripcion.toLowerCase()).indexOf(v_palabra)>=0) v_mostrar_producto = true;

					if (v_palabra=="") v_mostrar_producto = false;

					if (v_mostrar_producto)
					{
						$('#producto_' + producto.id).show();
					}else{
						$('#producto_' + producto.id).hide();
					}

					// console.log(producto.id, producto.nombre, v_mostrar_producto , producto.descripcion);

				}
			);
	}

	function mostrar_buscador()
	{
		if (g_viendo_resumen) mostrar_resumen_pedido();

		ver_todas_las_categorias();

		if (!g_viendo_buscador)
		{

			$('.producto-imagen').hide();
			$('.categoria').hide();
			$('.subcategoria').hide();
			$('.producto').hide();

			$('.helper_buscador').show();
			$('.producto-imagen-carrito').show();

			// $('#icono_resumen_pedido').removeClass("fa-shopping-cart");
			// $('#icono_resumen_pedido').addClass("fa-list");
			//$('#icono_resumen_pedido').addClass("fa-arrow-left");

			// $('.pedido_productos_cantidad_total').hide();
			
			//location.href="#";
			
			// location.href="#buscador";

			// Me muevo para arriba
			// $("html, body").animate({ scrollTop: 10 }, "slow");
			$(window).scrollTop(0);

			// history.pushState("tupedido", "", "#tupedido");
			
			$("#input_buscador").focus();
			$("#input_buscador").select();

			buscar();

			g_viendo_buscador = true;

		}else{

			//$('.footer').show();

			$('.producto-imagen').show();
			$('.categoria').show();
			$('.subcategoria').show();
			$('.producto').show();
			
			$('.helper_buscador').hide();
			$('.producto-imagen-carrito').hide();

			// cierro todas las categorias
			$('.categoria-titulo ').click();

			// $('#icono_resumen_pedido').addClass("fa-shopping-cart");
			// $('#icono_resumen_pedido').removeClass("fa-list");
			//$('#icono_resumen_pedido').removeClass("fa-arrow-left");
			// $('.pedido_productos_cantidad_total').show();

			//location.href="#listado";

			//history.state="listado";
			//history.back();
			// history.pushState("listado", "", "#");

			// Me muevo arriba de todo
			// $("html, body").animate({ scrollTop: 10 }, "slow");
			$(window).scrollTop(0);

			g_viendo_buscador = false;
		}
	}


	function copiar_busqueda()
	{
		var mibusqueda = $("#input_buscador").val().trim();

		if(mibusqueda!=''){

			var url_a_copiar = "https://pidorapido.com/burracomidamexicana/"+ g_telefono +"/?q=" + encodeURIComponent(mibusqueda);


			copyTextToClipboard(url_a_copiar);

			mostrar_aviso('El link para compartir ha sido copiado');

		}else{

		}

	}

	function copyTextToClipboard(text) {
		var textArea = document.createElement("textarea");

		//
		// *** This styling is an extra step which is likely not required. ***
		//
		// Why is it here? To ensure:
		// 1. the element is able to have focus and selection.
		// 2. if the element was to flash render it has minimal visual impact.
		// 3. less flakyness with selection and copying which **might** occur if
		//    the textarea element is not visible.
		//
		// The likelihood is the element won't even render, not even a
		// flash, so some of these are just precautions. However in
		// Internet Explorer the element is visible whilst the popup
		// box asking the user for permission for the web page to
		// copy to the clipboard.
		//

		// Place in the top-left corner of screen regardless of scroll position.
		textArea.style.position = 'fixed';
		textArea.style.top = 0;
		textArea.style.left = 0;

		// Ensure it has a small width and height. Setting to 1px / 1em
		// doesn't work as this gives a negative w/h on some browsers.
		textArea.style.width = '2em';
		textArea.style.height = '2em';

		// We don't need padding, reducing the size if it does flash render.
		textArea.style.padding = 0;

		// Clean up any borders.
		textArea.style.border = 'none';
		textArea.style.outline = 'none';
		textArea.style.boxShadow = 'none';

		// Avoid flash of the white box if rendered for any reason.
		textArea.style.background = 'transparent';


		textArea.value = text;

		document.body.appendChild(textArea);
		textArea.focus();
		textArea.select();

		try {
			var successful = document.execCommand('copy');
			var msg = successful ? 'successful' : 'unsuccessful';
			// console.log('Copying text command was ' + msg);
		} catch (err) {
			// console.log('Oops, unable to copy');
		}

		document.body.removeChild(textArea);
		}


	function mostrar_categoria(p_categoria)
	{
		if($('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').hasClass("fa-angle-down")){

			abrir_categoria(p_categoria);
			
		}else{

			cerrar_categoria(p_categoria);

		}
	}

	function abrir_categoria(p_categoria)
	{
		// console.log('abro cat ', p_categoria);
		$('.producto[data-categoria="' + p_categoria + '"]').show();
		$('.subcategoria[data-categoria="' + p_categoria + '"]').show();

		$('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').removeClass("fa-angle-down");
		$('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').addClass("fa-angle-up");
		
		// Activar sticky
		$('.categoria[data-categoria="' + p_categoria + '"]').addClass('sticky-active');

		$('.subcategoria[data-categoria="' + p_categoria + '"]').each( (idx, elem) => 
		{			
			cerrar_subcategoria($(elem).data('subcategoria'));
		});

	}

	function cerrar_categoria(p_categoria)
	{
		// console.log('cierro cat ', p_categoria);

		$('.producto[data-categoria="' + p_categoria + '"]').hide();
		$('.subcategoria[data-categoria="' + p_categoria + '"]').hide();

		$('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').removeClass("fa-angle-up");
		$('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').addClass("fa-angle-down");
		
		// Desactivar sticky
		$('.categoria[data-categoria="' + p_categoria + '"]').removeClass('sticky-active');

		// $('.icono_' + p_categoria).removeClass("fa-angle-up");
		// $('.icono_' + p_categoria).addClass("fa-angle-down");

		$('.subcategoria[data-categoria="' + p_categoria + '"]').each( (idx, elem) => 
		{
			// console.log('subcat', $(elem).data('subcategoria'));
			cerrar_subcategoria($(elem).data('subcategoria'));
		});
	}

	function cerrar_subcategoria(p_subcategoria)
	{
		$('.producto[data-subcategoria="' + p_subcategoria + '"]').hide();

		

		$('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').removeClass("fa-angle-up");
		$('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').addClass("fa-angle-down");
		
		// Desactivar sticky
		$('.subcategoria[data-subcategoria="' + p_subcategoria + '"]').removeClass('sticky-active');
		$('.subcategoria[data-subcategoria="' + p_subcategoria + '"]').css('top', '');
	}

	function abrir_subcategoria(p_subcategoria)
	{
		$('.producto[data-subcategoria="' + p_subcategoria + '"]').show();
		$('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').removeClass("fa-angle-down");
		$('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').addClass("fa-angle-up");
		
		// Activar sticky
		$('.subcategoria[data-subcategoria="' + p_subcategoria + '"]').addClass('sticky-active');
		ajustarStickySubcategorias();
	}

	function mostrar_subcategoria(p_subcategoria)
	{
		// $('.producto[data-subcategoria="' + p_subcategoria + '"]').toggle();
		// $('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').toggleClass("fa-angle-down fa-angle-up");
		
		if($('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').hasClass("fa-angle-down")){
			abrir_subcategoria(p_subcategoria);
		}else{
			cerrar_subcategoria(p_subcategoria);
		}
	}

	function ver_todas_las_categorias()
	{
		$('.producto').show();
		$('.subcategoria').show();
		$('.categoria-titulo .categoria_icono').removeClass("fa-angle-down");
		$('.categoria-titulo .categoria_icono').addClass("fa-angle-up");
	}

	function quitar_del_pedido(p_id
	, p_variedad
	, p_variedad2=null
	, p_variedad3=null
	, p_variedad4=null
	, p_variedad5=null
	, p_variedad6=null
	, p_variedad7=null
	, p_variedad8=null
	, p_variedad9=null
	, p_variedad10=null
	, p_variedad11=null
	, p_variedad12=null
	){
		p_variedad2 = (p_variedad2=="undefined") ? undefined : p_variedad2;
		p_variedad3 = (p_variedad3=="undefined") ? undefined : p_variedad3;
		p_variedad4 = (p_variedad4=="undefined") ? undefined : p_variedad4;
		p_variedad5 = (p_variedad5=="undefined") ? undefined : p_variedad5;
		p_variedad6 = (p_variedad6=="undefined") ? undefined : p_variedad6;
		p_variedad7 = (p_variedad7=="undefined") ? undefined : p_variedad7;
		p_variedad8 = (p_variedad8=="undefined") ? undefined : p_variedad8;
		p_variedad9 = (p_variedad9=="undefined") ? undefined : p_variedad9;
		p_variedad10 = (p_variedad10=="undefined") ? undefined : p_variedad10;
		p_variedad11 = (p_variedad11=="undefined") ? undefined : p_variedad11;
		p_variedad12 = (p_variedad12=="undefined") ? undefined : p_variedad12;

		// Busco el producto por id y variedad
		g_pedido.productos.forEach(function(producto, index, mi_array) {
					if (p_id==producto.id 
					&& p_variedad==producto.variedad
					&& p_variedad2==producto.variedad2
					&& p_variedad3==producto.variedad3
					&& p_variedad4==producto.variedad4
					&& p_variedad5==producto.variedad5
					&& p_variedad6==producto.variedad6
					&& p_variedad7==producto.variedad7
					&& p_variedad8==producto.variedad8
					&& p_variedad9==producto.variedad9
					&& p_variedad10==producto.variedad10
					&& p_variedad11==producto.variedad11
					&& p_variedad12==producto.variedad12
					){
						//console.log(producto);
						// producto.cantidad--;


						var nueva_cantidad = parseFloat(producto.cantidad) - parseFloat(producto.step);

						if(nueva_cantidad < producto.minimo){
							producto.cantidad = 0;

							if(!no_calcular)
							{
							// 	Swal.fire({
							// 		text: 'Debe pedir al menos ' + producto.minimo,
							// 		icon: 'error'
							// 	});
							}

						}else{
							producto.cantidad = nueva_cantidad;

						}

						
						if (producto.cantidad=="0")
						{
							mi_array.splice(index, 1);
						}
					}
				}
		);

		calcular_total();
	}

	function dame_producto(p_id)
	{
		g_productos.forEach(function(producto) {
					if (producto.id==p_id)
					{
						producto_seleccionado = JSON.parse(JSON.stringify(producto));
						return;
					}
				}
			);

		return producto_seleccionado;
	}

	var variedades_actuales = [];

	function agregar_al_pedido(p_id
	, p_variedad
	, p_variedad_2 = null
	, p_variedad_3 = null
	, p_variedad_4 = null
	, p_variedad_5 = null
	, p_variedad_6 = null
	, p_variedad_7 = null
	, p_variedad_8 = null
	, p_variedad_9 = null
	, p_variedad_10 = null
	, p_variedad_11 = null
	, p_variedad_12 = null
	){
		if (!g_telefono) {
			console.log('NO tiene teléfono, el producto no puede ser pedido');
			return false;

		}

		var variedades_seleccionadas_final = variedades_seleccionadas;
		variedades_seleccionadas = [];

		producto = dame_producto(p_id);

		p_variedad_2 = (p_variedad_2 == "undefined") ? undefined : p_variedad_2;
		p_variedad_3 = (p_variedad_3 == "undefined") ? undefined : p_variedad_3;
		p_variedad_4 = (p_variedad_4 == "undefined") ? undefined : p_variedad_4;
		p_variedad_5 = (p_variedad_5 == "undefined") ? undefined : p_variedad_5;
		p_variedad_6 = (p_variedad_6 == "undefined") ? undefined : p_variedad_6;
		p_variedad_7 = (p_variedad_7 == "undefined") ? undefined : p_variedad_7;
		p_variedad_8 = (p_variedad_8 == "undefined") ? undefined : p_variedad_8;
		p_variedad_9 = (p_variedad_9 == "undefined") ? undefined : p_variedad_9;
		p_variedad_10 = (p_variedad_10 == "undefined") ? undefined : p_variedad_10;
		p_variedad_11 = (p_variedad_11 == "undefined") ? undefined : p_variedad_11;
		p_variedad_12 = (p_variedad_12 == "undefined") ? undefined : p_variedad_12;

		// Si es el primer click para agregar un producto, inicializo los adicionales (ingredientes, toppings)
		if(p_variedad==undefined || p_variedad==null)
		{
			console.log("Inicializo los ingredientes");
			suma_de_adicionales = 0;
		}


		// console.log('Producto Agregado', producto);
		
		// console.log(producto.variedades.length);
		// console.log(p_variedad);
		// console.log(p_variedad_2);

		if (producto.variedades && producto.variedades.length>0 && p_variedad==undefined)
		{
			var variedades_array = producto.variedades;

			var variedades_html = dame_html_variantes(variedades_array, p_id, 0, "$", false);

			// Si le puso un titulo a la variedad, uso ese
			if(producto.variedades[0].variedadtitulo){

				$("#pregunta_variedades_titulo").html(producto.variedades[0].variedadtitulo);

			}else{

				if(producto.variedades[0].variedadestilo=="HASTA"){
					$("#pregunta_variedades_titulo").html("Elija hasta " + producto.variedades[0].variedadtotal);

				}else if(producto.variedades[0].variedadestilo=="HASTA COMPLETAR"){

					if(producto.variedades[0].variedadtotal==-1){
						$("#pregunta_variedades_titulo").html("Elija");

					}else{
						$("#pregunta_variedades_titulo").html("Elija " + producto.variedades[0].variedadtotal);

					}

				}else{
					$("#pregunta_variedades_titulo").html('Elija una opción');

				}

			}

			$("#pregunta_variedades_opciones").html(variedades_html);

			$.fancybox.open({
				src  : "#pregunta_variedades",
				opts : {
					beforeShow: function(){
						$("body").css({'overflow-y':'hidden'});
					},
					afterClose: function(){
						$("body").css({'overflow-y':'visible'});
					}
				}
			});
		
		}else{

			//console.log("agregando", producto, p_variedad)

			//delete producto.variedades; //para que no viaje

			if (p_variedad==undefined)
			{
				//delete producto.variedad;
			}else{
				producto.variedad = p_variedad;

				// Busco el precio de esta variedad
				producto.variedades.forEach(function(variedad) {
					if (variedad.nombre==p_variedad)
					{
						producto.precio = variedad.precio;
						producto.minimo = variedad.minimo;
						producto.maximo = variedad.maximo;
						producto.step = variedad.step;
					}
				});
			}


			if (p_variedad_2==undefined)
			{
				//delete producto.variedad;
			}else{
				producto.variedad2 = p_variedad_2;
			}

			if (p_variedad_3==undefined)
			{
				//delete producto.variedad;
			}else{
				producto.variedad3 = p_variedad_3;
			}

			if (p_variedad_4==undefined)
			{
				//delete producto.variedad;
			}else{
				producto.variedad4 = p_variedad_4;
			}

			if (p_variedad_5==undefined){
			}else{
				producto.variedad5 = p_variedad_5;
			}

			if (p_variedad_6==undefined){
			}else{
				producto.variedad6 = p_variedad_6;
			}

			if (p_variedad_7==undefined){
			}else{
				producto.variedad7 = p_variedad_7;
			}

			if (p_variedad_8==undefined){
			}else{
				producto.variedad8 = p_variedad_8;
			}

			if (p_variedad_9==undefined){
			}else{
				producto.variedad9 = p_variedad_9;
			}

			if (p_variedad_10==undefined){
			}else{
				producto.variedad10 = p_variedad_10;
			}

			if (p_variedad_11==undefined){
			}else{
				producto.variedad11 = p_variedad_11;
			}

			if (p_variedad_12==undefined){
			}else{
				producto.variedad12 = p_variedad_12;
			}


			var variedades_producto = dame_variedades_seleccionadas(producto);
			// console.log('variedades_producto', variedades_producto);
			var id_producto_stock = dame_producto_id_stock(producto, variedades_producto);
			// console.log('agregar producto', id_producto_stock);
			var stock_producto = dame_stock(id_producto_stock);
			// console.log('stock_producto', stock_producto);
			// console.log('producto', producto);	
			if(stock_producto)
			{
				producto.id_stock = stock_producto.id;
				
				if(stock_producto.stock < producto.maximo)
				{
					console.log('El stock es inferior al máximo a pedir. Lo cambio');
					producto.maximo = stock_producto.stock;
				}
			}

			
			
			// Intento emprolijar el pedido agrupando
			// Busco, dentro del PEDIDO, si hay un producto igual
			agrupado = false;
			g_pedido.productos.forEach(function(producto_para_agrupar) {
							if (producto_para_agrupar.id==producto.id 
								&& producto_para_agrupar.variedad==producto.variedad
								&& producto_para_agrupar.variedad2==producto.variedad2
								&& producto_para_agrupar.variedad3==producto.variedad3
								&& producto_para_agrupar.variedad4==producto.variedad4
								&& producto_para_agrupar.variedad5==producto.variedad5
								&& producto_para_agrupar.variedad6==producto.variedad6
								&& producto_para_agrupar.variedad7==producto.variedad7
								&& producto_para_agrupar.variedad8==producto.variedad8
								&& producto_para_agrupar.variedad9==producto.variedad9
								&& producto_para_agrupar.variedad10==producto.variedad10
								&& producto_para_agrupar.variedad11==producto.variedad11
								&& producto_para_agrupar.variedad12==producto.variedad12
							){
								agrupado = true;

								// console.log('Step', producto.step);

								// console.log('producto para agrupar', producto_para_agrupar);
								

								var nueva_cantidad = parseFloat(producto_para_agrupar.cantidad) + parseFloat(producto.step);

								if(nueva_cantidad > parseFloat(producto.maximo)){
									producto_para_agrupar.cantidad = producto.maximo;

									if(!no_calcular)
									{
										mostrar_aviso_error('No puede agregar más de ' + producto.maximo);
									}

								}else{
									producto_para_agrupar.cantidad = nueva_cantidad;

									var my_event = new CustomEvent('add_to_cart'
									, { 
										detail: {
											producto: producto_para_agrupar
										}
									});
									document.body.dispatchEvent(my_event);


								}

							}
						}
				);

			// Si no pude agrupar agrego el producto en crudo (sino no lo agrego. Le sumé la cantidad antes.)
			if (!agrupado)
			{
				// console.log('Step', producto.step);

				if(parseFloat(producto.step) > parseFloat(producto.maximo)){
					producto.cantidad = producto.maximo;

					// Esto es muy raro que suceda

				}else{
					producto.cantidad = parseFloat(producto.minimo);

				}
				

				producto.adicionales = suma_de_adicionales;

				var my_event = new CustomEvent('add_to_cart'
				, { 
					detail: {
						producto: producto
					}
				});
				document.body.dispatchEvent(my_event);

				g_pedido.productos.push( producto );
			}

			$.fancybox.close();

		}

		calcular_total();
		
	}

	var variedades_seleccionadas = [];
	var suma_de_adicionales = 0;

	function pre_agregar_al_pedido(prod_id, variedad_nombre, monto_a_sumar = 0)
	{
		var miprod = dame_producto(prod_id, variedad_nombre);

		// Agrego la variedad elegida en un listado
		variedades_seleccionadas.push(variedad_nombre);
		suma_de_adicionales = suma_de_adicionales + monto_a_sumar;

		// console.log('Estoy viendo la varidad Nº' + variedades_seleccionadas.length);

		// Busco si hay una variedad después
		var variedad_siguiente = null;
		var variedad_siguiente_nro = variedades_seleccionadas.length + 1;

		// Busco el objeto que tiene la variedad que seleccioné actualmente
		var varidad_actual_idx = 0;
		
		
		for (var idxvar = 0; idxvar<miprod.variedades.length; idxvar++) 
		{
			if(miprod.variedades[idxvar].nombre==variedad_nombre)
			{
				varidad_actual_idx = idxvar;
			}
		}
		
		if(miprod.variedades[varidad_actual_idx]['variedades' + variedad_siguiente_nro])
		{
			variedad_siguiente = miprod.variedades[varidad_actual_idx]['variedades' + variedad_siguiente_nro];
		}

		// console.log('Siguiente Variedad', variedad_siguiente);


		if(variedad_siguiente){
		
			$.fancybox.close();

			// Las siguientes variedades vienen concatenadas por comas, 
			// Lse separo y le pongo el estilo y total
			var variedades_sig_arr = variedad_siguiente.split(',');	
			var variedades_sig_arr_con_estilos = [];

			$(variedades_sig_arr).each( (ii, vari) => 
			{
				var conestilo = {
					nombre: vari,
					variedadestilo: miprod.variedades[varidad_actual_idx]['variedad' + variedad_siguiente_nro + 'estilo'],
					variedadtotal: miprod.variedades[varidad_actual_idx]['variedad' + variedad_siguiente_nro + 'total'],
					variedadtitulo: miprod.variedades[varidad_actual_idx]['variedad' + variedad_siguiente_nro + 'titulo']
				};
				variedades_sig_arr_con_estilos.push(conestilo);
			});

			var variedades_html = dame_html_variantes(variedades_sig_arr_con_estilos, prod_id, variedad_siguiente_nro, "$", false);

			// Si quiere definir un titulo, lo uso, sino pongo un título por defecto
			if(variedades_sig_arr_con_estilos[0].variedadtitulo){

				$("#pregunta_variedades_titulo").html(variedades_sig_arr_con_estilos[0].variedadtitulo);
				
			}else{

				if(variedades_sig_arr_con_estilos[0].variedadestilo=="HASTA"){
					$("#pregunta_variedades_titulo").html("Elija hasta " + variedades_sig_arr_con_estilos[0].variedadtotal);

				}else if(variedades_sig_arr_con_estilos[0].variedadestilo=="HASTA COMPLETAR"){
				
					if(variedades_sig_arr_con_estilos[0].variedadtotal==-1){
						$("#pregunta_variedades_titulo").html("Elija");

					}else{
						$("#pregunta_variedades_titulo").html("Elija " + variedades_sig_arr_con_estilos[0].variedadtotal);

					}

				}else{
					$("#pregunta_variedades_titulo").html('Elija la opción Nº' + variedad_siguiente_nro);

				}

			}
			
			$("#pregunta_variedades_opciones").html(variedades_html);

			$.fancybox.open({
				src  : "#pregunta_variedades"
			});
			
		}else{

			switch(variedades_seleccionadas.length)
			{
				case 1:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0]);
					break;
				case 2:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1]);
					break;
				case 3:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2]);
					break;
				case 4:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3]);
					break;
				case 5:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4]);
					break;
				case 6:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5]);
					break;
				case 7:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6]);
					break;
				case 8:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7]);
					break;
				case 9:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7], variedades_seleccionadas[8]);
					break;
				case 10:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7], variedades_seleccionadas[8], variedades_seleccionadas[9]);
					break;
				case 11:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7], variedades_seleccionadas[8], variedades_seleccionadas[9], variedades_seleccionadas[10]);
					break;
				case 12:
					agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7], variedades_seleccionadas[8], variedades_seleccionadas[9], variedades_seleccionadas[10], variedades_seleccionadas[11]);
					break;

			}

			

		}

	}


	function vaciar_pedido()
	{
		$.fancybox.open({
			src  : '#pregunta_vaciar_pedido',
		});
	}

	var pedido = "";
	var url_pedido = "";
	var no_calcular = false;

	function calcular_total()
	{
		if(!no_calcular) {

            g_pedido.additional_info = {
                "user_agent": navigator.userAgent,
                "language": navigator.language,
                "platform": navigator.platform,
            }

			//Guardo la fecha de actualizacion del carrito
			g_pedido.ultima_actualizacion = new Date().getTime();

			//Guardo el pedido por si se cierra el navegador
			localStorage.setItem( 'pedido-burracomidamexicana', JSON.stringify(g_pedido) );

			total = 0;
			total_cantidad_de_productos = 0;
			total_cantidad_de_articulos = 0;

			var total_adicionales = 0;

			// console.log(g_pedido);

			$(".producto_fila").removeClass("producto-pedido");
			$(".producto_cantidades").text("");
			$(".producto_cantidades").hide();
			$(".helper_aclaracion").hide();
			$(".helper_variedades_agregar").hide();
			$(".separador-producto-de-variedad").hide();
			$(".separador-productos").show();

			g_pedido.productos.forEach(function(producto, p_idx) {

				//console.log(producto);

				id = producto.id;
				
				$("#fila_" + id).addClass("producto-pedido");

				if (producto.variedad)
				{

					var variedad_1_mostrar = '';
					if (producto.variedad)
					{
						variedad_1_mostrar = ' '+ producto.variedad;
					}

					var variedad_2_mostrar = '';
					if (producto.variedad2)
					{
						variedad_2_mostrar = ', '+ producto.variedad2;
					}

					var variedad_3_mostrar = '';
					if (producto.variedad3)
					{
						variedad_3_mostrar = ', '+ producto.variedad3;
					}

					var variedad_4_mostrar = '';
					if (producto.variedad4)
					{
						variedad_4_mostrar = ', '+ producto.variedad4;
					}

					var variedad_5_mostrar = '';
					if (producto.variedad5)
					{
						variedad_5_mostrar = ', '+ producto.variedad5;
					}

					var variedad_6_mostrar = '';
					if (producto.variedad6)
					{
						variedad_6_mostrar = ', '+ producto.variedad6;
					}

					var variedad_7_mostrar = '';
					if (producto.variedad7)
					{
						variedad_7_mostrar = ', '+ producto.variedad7;
					}

					var variedad_8_mostrar = '';
					if (producto.variedad8)
					{
						variedad_8_mostrar = ', '+ producto.variedad8;
					}

					var variedad_9_mostrar = '';
					if (producto.variedad9)
					{
						variedad_9_mostrar = ', '+ producto.variedad9;
					}

					var variedad_10_mostrar = '';
					if (producto.variedad10)
					{
						variedad_10_mostrar = ', '+ producto.variedad10;
					}

					var variedad_11_mostrar = '';
					if (producto.variedad11)
					{
						variedad_11_mostrar = ', '+ producto.variedad11;
					}

					var variedad_12_mostrar = '';
					if (producto.variedad12)
					{
						variedad_12_mostrar = ', '+ producto.variedad12;
					}


					var v_html_boton = "";

					v_html_boton += "<div class='btn-group float-right botonera-productos-qty'>";
					
					v_html_boton += "<button class='btn botonera-productos-qty-less' onclick='quitar_del_pedido(\"" + producto.id + "\", \"" + producto.variedad + "\", \"" + producto.variedad2 + "\", \"" + producto.variedad3 + "\", \"" + producto.variedad4 + "\", \"" + producto.variedad5 + "\", \"" + producto.variedad6 + "\", \"" + producto.variedad7 + "\", \"" + producto.variedad8 + "\", \"" + producto.variedad9 + "\", \"" + producto.variedad10 + "\", \"" + producto.variedad11 + "\", \"" + producto.variedad12 + "\")' style=''>-</button>";

					v_html_boton += "<button class='btn botonera-productos-qty-middle' onclick='cambiar_cantidad_producto(this, \"" + producto.id + "\", \"" + producto.variedad + "\", \"" + producto.variedad2 + "\", \"" + producto.variedad3 + "\", \"" + producto.variedad4 + "\", \"" + producto.variedad5 + "\", \"" + producto.variedad6 + "\", \"" + producto.variedad7 + "\", \"" + producto.variedad8 + "\", \"" + producto.variedad9 + "\", \"" + producto.variedad10 + "\", \"" + producto.variedad11 + "\", \"" + producto.variedad12 + "\")'>" + producto.cantidad + "</button>";
					
					v_html_boton += "<button class='btn botonera-productos-qty-more' onclick='agregar_al_pedido(\"" + producto.id + "\", \"" + producto.variedad + "\", \"" + producto.variedad2 + "\", \"" + producto.variedad3 + "\", \"" + producto.variedad4 + "\", \"" + producto.variedad5 + "\", \"" + producto.variedad6 + "\", \"" + producto.variedad7 + "\", \"" + producto.variedad8 + "\", \"" + producto.variedad9 + "\", \"" + producto.variedad10 + "\", \"" + producto.variedad11 + "\", \"" + producto.variedad12 + "\")'>+</button>";

					v_html_boton += "</div>";


											var texto_adicionales = '';
						if(producto.adicionales>0)
						{
							// texto_adicionales = " + $" + formatear_moneda(producto.cantidad * producto.adicionales) +' extras';
						}
						v_html_texto = "<div style='float-left;padding-top: 8px;'>" + producto.cantidad + " x " + producto.variedad + variedad_2_mostrar + variedad_3_mostrar + variedad_4_mostrar + variedad_5_mostrar + variedad_6_mostrar + variedad_7_mostrar + variedad_8_mostrar + variedad_9_mostrar + variedad_10_mostrar + variedad_11_mostrar + variedad_12_mostrar + texto_adicionales + " = $" + formatear_moneda((producto.cantidad * producto.precio) + (producto.cantidad * producto.adicionales)) +"</div>";
					

					v_html = $("#cantidades_" + id).html();
					v_html += "<div style='margin-top:5px;' class='clearfix'>" + v_html_boton + v_html_texto + "</div>";
					
					$("#cantidades_" + id).html(v_html);
					$("#cantidades_" + id).show();

					$("#fila_" + id + " .helper_variedades_agregar").show();
					$("#fila_" + id + " .separador-producto-de-variedad").show();

				}else{

					v_html = "";

					var v_html_boton = "";


					v_html_boton += "<div class='btn-group float-right botonera-productos-qty'>";
					
					v_html_boton += "<button class='btn botonera-productos-qty-less' onclick='quitar_del_pedido(\"" + producto.id + "\")' style=''>-</button>";

					v_html_boton += "<button class='btn botonera-productos-qty-middle' onclick='cambiar_cantidad_producto(this, \"" + producto.id + "\")'>" + producto.cantidad + "</button>";
					
					v_html_boton += "<button class='btn botonera-productos-qty-more' onclick='agregar_al_pedido(\"" + producto.id + "\")'>+</button>";

					v_html_boton += "</div>";

					v_html_texto = "";
					if (producto.cantidad>0)
					{
						v_html_texto = "<div style='float-left;padding-top: 8px;'>" ;
						//v_html_texto = "<div style='float-left;padding-top: 8px;'>" + producto.cantidad + " ";

						if (producto.cantidad==1)
						{
							//v_html_texto += "unidad"
						}else{
							//v_html_texto += "unidades"
						}

						//v_html_texto += " x " + producto.nombre;

						//v_html_texto += " = $" + formatear_moneda(producto.cantidad * producto.precio) + "</div>";

													v_html_texto += "$" + formatear_moneda(producto.cantidad * producto.precio);
						
						v_html_texto += "</div>";
					}

					v_html += "<div style='margin-top:5px;' class='clearfix'>" + v_html_boton + v_html_texto + "</div>";

					$("#cantidades_" + id).html(v_html);
					$("#cantidades_" + id).show();
				}

				//$("#fila_" + id + " .boton-menos").show();

				total += (parseFloat(producto.precio) * parseFloat(producto.cantidad)) + (parseFloat(producto.adicionales) * parseFloat(producto.cantidad));
				total_cantidad_de_productos += parseFloat(producto.cantidad);
				total_cantidad_de_articulos++;
				total_adicionales += producto.cantidad * producto.adicionales;

				$("#fila_" + id + " .producto_cantidades").show();
				$("#fila_" + id + " .helper_aclaracion").show();
				$("#fila_" + id + " .separador-productos").hide();

			});

			pedido = "";

			preguntas_whatsapp = "";

			g_pedido.preguntas = [];

							preguntas_whatsapp = preguntas_whatsapp + "*Nombre**\n";
				preguntas_whatsapp = preguntas_whatsapp + "_" + $("#pregunta_1_respuesta").val() + "_\n\n";
				g_pedido.preguntas.push({
					pregunta: 'Nombre*',
					respuesta: $("#pregunta_1_respuesta").val()
				});
										preguntas_whatsapp = preguntas_whatsapp + "*" + $("#pregunta_2_label").text() + "*\n";
				preguntas_whatsapp = preguntas_whatsapp + "_" + $("#pregunta_2_respuesta").val() + "_\n\n";
				g_pedido.preguntas.push({
					pregunta: $("#pregunta_2_label").text(),
					respuesta: $("#pregunta_2_respuesta").val()
				});
										preguntas_whatsapp = preguntas_whatsapp + "*" + $("#pregunta_3_label").text() + "*\n";
				preguntas_whatsapp = preguntas_whatsapp + "_" + $("#pregunta_3_respuesta").val() + "_\n\n";
				g_pedido.preguntas.push({
					pregunta: $("#pregunta_3_label").text(),
					respuesta: $("#pregunta_3_respuesta").val()
				});
										preguntas_whatsapp = preguntas_whatsapp + "*" + $("#pregunta_4_label").text() + "*\n";
				preguntas_whatsapp = preguntas_whatsapp + "_" + $("#pregunta_4_respuesta").val() + "_\n\n";
				g_pedido.preguntas.push({
					pregunta: $("#pregunta_4_label").text(),
					respuesta: $("#pregunta_4_respuesta").val()
				});
																		
			if(g_zonas_envios.length>0) 
			{
				preguntas_whatsapp = preguntas_whatsapp + "*" + $("#pregunta_10_label").text() + "*\n";
				preguntas_whatsapp = preguntas_whatsapp + "_" + $("#pregunta_10_respuesta").val() + "_\n\n";
				g_pedido.preguntas.push({
					pregunta: $("#pregunta_10_label").text(),
					respuesta: $("#pregunta_10_respuesta").val()
				});
			}
			pedido = pedido + preguntas_whatsapp;

			pedido = pedido + "*Pedido:*\n";

			g_pedido.productos.forEach(function(producto) {

                    // console.log('producto: ', producto);

					nombre = producto.nombre;
					descripcion = producto.descripcion;
					categoria = producto.categoria;
					subcategoria = producto.subcategoria;
					cantidad = parseFloat(producto.cantidad);
					precio = parseFloat(producto.precio);
                    precioanterior = producto.precioanterior>0 ? parseFloat(producto.precioanterior) : '';
					adicionales = parseFloat(producto.adicionales);
					codigo = producto.codigo;
					variedad = producto.variedad;
					variedad2 = producto.variedad2;
					variedad3 = producto.variedad3;
					variedad4 = producto.variedad4;
					variedad5 = producto.variedad5;
					variedad6 = producto.variedad6;
					variedad7 = producto.variedad7;
					variedad8 = producto.variedad8;
					variedad9 = producto.variedad9;
					variedad10 = producto.variedad10;
					variedad11 = producto.variedad11;
					variedad12 = producto.variedad12;
					aclaracion = $("#aclaracion_" + producto.id).val();
					producto.aclaracion = aclaracion;

					if (variedad==undefined)
					{
						variedad = "";
					}else{

						var separador_de_variedad = ", ";

						variedad2 = (variedad2==undefined) ? "" : separador_de_variedad + variedad2.trim();
						variedad3 = (variedad3==undefined) ? "" : separador_de_variedad + variedad3.trim();
						variedad4 = (variedad4==undefined) ? "" : separador_de_variedad + variedad4.trim();
						variedad5 = (variedad5==undefined) ? "" : separador_de_variedad + variedad5.trim();
						variedad6 = (variedad6==undefined) ? "" : separador_de_variedad + variedad6.trim();
						variedad7 = (variedad7==undefined) ? "" : separador_de_variedad + variedad7.trim();
						variedad8 = (variedad8==undefined) ? "" : separador_de_variedad + variedad8.trim();
						variedad9 = (variedad9==undefined) ? "" : separador_de_variedad + variedad9.trim();
						variedad10 = (variedad10==undefined) ? "" : separador_de_variedad + variedad10.trim();
						variedad11 = (variedad11==undefined) ? "" : separador_de_variedad + variedad11.trim();
						variedad12 = (variedad12==undefined) ? "" : separador_de_variedad + variedad12.trim();

						if(g_variedades_en_lista){
							variedad = '\n - ' + variedad + variedad2 + variedad3 + variedad4 + variedad5 + variedad6 + variedad7 + variedad8 + variedad9 + variedad10 + variedad11 + variedad12;
							variedad = variedad.replace(/, /g, "\n - ");

						}else{
							variedad = "(" + variedad + variedad2 + variedad3 + variedad4 + variedad5 + variedad6 + variedad7 + variedad8 + variedad9 + variedad10 + variedad11 + variedad12 + ")";
							
						}
						

					}

					if (cantidad>0)
					{
						modelo_pedido = '*CANTIDAD* x *NOMBRE* *VARIEDAD* *ACLARACION*\nSubtotal = $*SUBTOTAL*\n';
						linea_pedido = modelo_pedido;
						linea_pedido = linea_pedido.replace('*CANTIDAD*', "*" + cantidad + "*");
						linea_pedido = linea_pedido.replace('*cantidad*', "*" + cantidad + "*");
						
						linea_pedido = linea_pedido.replace('*CODIGO*', codigo);
						linea_pedido = linea_pedido.replace('*codigo*', codigo);

						var subtotal = (cantidad * precio) + (cantidad * adicionales);
						linea_pedido = linea_pedido.replace('*SUBTOTAL*', "" + formatear_moneda(subtotal) + "");
						linea_pedido = linea_pedido.replace('*subtotal*', "" + formatear_moneda(subtotal) + "");

                        if(precioanterior)
                        {
                            var subtotal_anterior = (cantidad * precioanterior) + (cantidad * adicionales);
                            linea_pedido = linea_pedido.replace('*SUBTOTALANTERIOR*', "~$" + formatear_moneda(subtotal_anterior) + "~");
                            linea_pedido = linea_pedido.replace('*subtotalanterior*', "~$" + formatear_moneda(subtotal_anterior) + "~");
                        }else{
                            linea_pedido = linea_pedido.replace('*SUBTOTALANTERIOR*', '');
                            linea_pedido = linea_pedido.replace('*subtotalanterior*', '');

                        }

						linea_pedido = linea_pedido.replace('*UNITARIO*', "" + formatear_moneda(precio) + "");
						linea_pedido = linea_pedido.replace('*unitario*', "" + formatear_moneda(precio) + "");

						linea_pedido = linea_pedido.replace('*NOMBRE*', "*" + nombre + "*");
						linea_pedido = linea_pedido.replace('*nombre*', "*" + nombre + "*");

						if (descripcion)
						{
							linea_pedido = linea_pedido.replace('*DESCRIPCION*', "_" + descripcion + "_");
							linea_pedido = linea_pedido.replace('*descripcion*', "_" + descripcion + "_");
						}else{
							linea_pedido = linea_pedido.replace('*DESCRIPCION*', "");
							linea_pedido = linea_pedido.replace('*descripcion*', "");
						}

						linea_pedido = linea_pedido.replace('*PRECIO*', formatear_moneda(precio) );
						linea_pedido = linea_pedido.replace('*precio*', formatear_moneda(precio) );

						if (variedad)
						{
							if(g_variedades_en_lista){
								linea_pedido = linea_pedido.replace('*VARIEDAD*', variedad);
								linea_pedido = linea_pedido.replace('*variedad*', variedad);

							}else{
								linea_pedido = linea_pedido.replace('*VARIEDAD*', "*" + variedad + "*");
								linea_pedido = linea_pedido.replace('*variedad*', "*" + variedad + "*");

							}
						}else{
							linea_pedido = linea_pedido.replace('*VARIEDAD*', "");
							linea_pedido = linea_pedido.replace('*variedad*', "");
						}

						if (aclaracion)
						{
							linea_pedido = linea_pedido.replace('*ACLARACION*', "\n*Aclaración: " + aclaracion + "*");
							linea_pedido = linea_pedido.replace('*aclaracion*', "\n*Aclaración: " + aclaracion + "*");
						}else{
							linea_pedido = linea_pedido.replace('*ACLARACION*', "");
							linea_pedido = linea_pedido.replace('*aclaracion*', "");
						}

						if (subcategoria)
						{
							linea_pedido = linea_pedido.replace('*SUBCATEGORIA*', "\n_" + subcategoria + "_");
							linea_pedido = linea_pedido.replace('*subcategoria*', "\n_" + subcategoria + "_");
						}else{
							linea_pedido = linea_pedido.replace('*SUBCATEGORIA*', "");
							linea_pedido = linea_pedido.replace('*subcategoria*', "");
						}

						if (categoria)
						{
							linea_pedido = linea_pedido.replace('*CATEGORIA*', "\n_" + categoria + "_");
							linea_pedido = linea_pedido.replace('*categoria*', "\n_" + categoria + "_");
						}else{
							linea_pedido = linea_pedido.replace('*CATEGORIA*', "");
							linea_pedido = linea_pedido.replace('*categoria*', "");
						}

						linea_pedido = linea_pedido.replace('  ', ' ');
						linea_pedido = linea_pedido.replace('  ', ' ');
						linea_pedido = linea_pedido.replace('  ', ' ');
						linea_pedido = linea_pedido.replace('  ', ' ');
						linea_pedido = linea_pedido.replace('  ', ' ');
						linea_pedido = linea_pedido.replace('  ', ' ');

						pedido = pedido + "\n" + linea_pedido;
					}
			})

			var total_sin_descuento = total;            
			var descuento_final = 0;			

			
			var pedido_extras = 0;

			g_pedido.precio_final = 0;
			g_pedido.precio_solo_articulos = 0;
			g_pedido.cantidad_articulos_final = 0;
			g_pedido.precio_extras_final = 0;			

			var tiene_pedido_extra_1_monto = false;
				


			var pedido_extra_2_costo = 0;
			var pedido_extra_2_nombre = '';

			if(g_zonas_envios.length>0) {

				var pedido_extra_2_costo = $("#pregunta_10_respuesta").find(':selected').data('costo');
				var pedido_extra_2_nombre = $("#pregunta_10_respuesta").find(':selected').data('nombre');

				if(isNaN(pedido_extra_2_costo)){
					
				}else{

					pedido_extra_2_costo = parseFloat(pedido_extra_2_costo);
					pedido_extras += pedido_extra_2_costo; 
					
				}

			}


					

					


			var impuestos = 0;
			var impuestos_subtotal = 0;
			

			
				if(descuento_final>0)
				{
					pedido = pedido + "\n_Descuento: -$" + formatear_moneda(descuento_final) + "_";
				}

				if(impuestos>0)
				{
					pedido = pedido + "\n_: $" + formatear_moneda( impuestos ) + "_";
				}

				pedido = pedido + "\n*Total pedido: $" + formatear_moneda(total + pedido_extras + impuestos) + "*";
			
			
							pedido = "Pedido: *https://pidorapido.com/pedido/?pedido=MIIDPUBLICO*\n\n" + pedido;
			
			
			
			
			
			var preguntas_resumen = '';

							// preguntas_resumen += '<strong>Resumen</strong>';
				preguntas_resumen += '<table style="width: 100%;"><tbody>';
				preguntas_resumen += '<tr><td>Pedido</td><td style="text-align: right;">$' + formatear_moneda(total + descuento_final) +'</td></tr>';
				if(descuento_final>0){
					preguntas_resumen += '<tr><td>Descuentos</td><td style="text-align: right;">-$' + formatear_moneda(descuento_final) +'</td></tr>';
				}
				if(impuestos>0){
					preguntas_resumen += '<tr><td></td><td style="text-align: right;">$' + formatear_moneda(impuestos) +'</td></tr>';
				}
				if(tiene_pedido_extra_1_monto){
					preguntas_resumen += '<tr><td>'+ pedido_extra_1_descripcion +'</td><td style="text-align: right;">$' + formatear_moneda(pedido_extra_1_monto) +'</td></tr>';
				}
				if(pedido_extra_2_costo>0){							
					preguntas_resumen += '<tr><td>'+ pedido_extra_2_nombre +'</td><td style="text-align: right;">$' + formatear_moneda(pedido_extra_2_costo) +'</td></tr>';
				}
				
				preguntas_resumen += '<tr><td><strong>Total</strong></td><td style="text-align: right;"><strong>$' + formatear_moneda(total + pedido_extras + impuestos) +'</strong></td></tr>';

				preguntas_resumen += '</tbody></table>';

				$("#preguntas_resumen").show();
						$("#preguntas_resumen").html(preguntas_resumen);


			g_pedido.precio_final = total + pedido_extras + impuestos;
			g_pedido.precio_final_sin_impuestos = total + pedido_extras;
			g_pedido.impuestos = impuestos;
			g_pedido.precio_solo_articulos = total;
			g_pedido.precio_extras_final = pedido_extras; // Estos son los extras del pedido: gastos de envío (no participa de los impuestos)
			g_pedido.precio_adicionales_final = total_adicionales; // Estos son los adicionales x ingredientes (si participan de los impuestos y del total del pedido)
			g_pedido.cantidad_articulos_final = total_cantidad_de_articulos;
			g_pedido.cantidad_productos_final = total_cantidad_de_productos;
			g_pedido.whatsapp = g_telefono;
			g_pedido.mensaje = pedido;


			url_pedido = "https://wa.me/"+ g_telefono +"?text=" + encodeURIComponent(pedido);
			//url_pedido = "/create.order.v2.php?alias=burracomidamexicana&url=" + encodeURI(url_pedido);

			// console.log(pedido)
			// console.log(url_pedido)

			// Lleno el FORM
			$("#form_order_text").val(pedido);
			$("#form_order_json").val(JSON.stringify(g_pedido));
			$("#form_url").val(url_pedido);

			$('.pedido_productos_cantidad_total').html(total_cantidad_de_productos);

			if (g_pedido.productos.length==0)
			{
				$("#footer_enviar").slideUp();
				$('.helper_footer_padding').hide();
				// $('.helper_changuito').hide();

				//$("#boton_enviar").hide();
				//$("#link_titulo").show();
			}else{
				if (total>0) {

					
						if(total==total_sin_descuento){

							$("#boton_enviar").html("<i class='fab fa-whatsapp'></i> <span id='send_message_text'>&nbsp;Enviar pedido por WhatsApp&nbsp;</span> <b>$" + formatear_moneda(total) + "</b>");

						}else{

							$("#boton_enviar").html("<i class='fab fa-whatsapp'></i> <span id='send_message_text'>&nbsp;Enviar pedido por WhatsApp&nbsp;</span> <s style='font-size: 12px;'>$" + formatear_moneda(total_sin_descuento) + "</s>&nbsp;<b>$" + formatear_moneda(total) + "</b>");

						}

					
				}else{
					$("#boton_enviar").html("<i class='fab fa-whatsapp'></i> <span id='send_message_text'>&nbsp;Enviar pedido por WhatsApp&nbsp;</span></b>")
				}
				$("#footer_enviar").slideDown();
				// $('.helper_footer_padding').show();
				// $('.helper_changuito').show();

				$(".helper_changuito").addClass("tada animated");
				$("#boton_enviar").addClass("tada");

				setTimeout(function() {
					$("#boton_enviar").removeClass('tada');
					$(".helper_changuito").removeClass("tada animated");
				}, 3000);
				
				//$("#boton_enviar").show()
				//$("#link_titulo").hide();
			}

		}else{
			// No calculo el total

		}
	}

	function formatear_moneda(x) 
	{
		
			if (Number.parseFloat(x)==Number.parseInt(x)) {

				return Number.parseInt(x).toLocaleString('es');

			}else{
				return Number.parseFloat(x).toFixed(2).toLocaleString('es');

			}

			}

	function enviar_pedido(){

		if(controlar_horario()){
			
			var pedido_monto_minimo = 0;
			
					
			if(this.total >= pedido_monto_minimo) {

				
				pre_abrir_preguntas();
				
				$.fancybox.open({
					src  : '#preguntas_pedido',
					opts : {
						afterShow : function( instance, current ) {
							// console.info( 'done!' );
						},
						beforeShow: function(){
							$("body").css({'overflow-y':'hidden'});
						},
						afterClose: function(){
							$("body").css({'overflow-y':'visible'});
						}
					}
				});

				

				var my_event = new CustomEvent('initiate_checkout', {});
				document.body.dispatchEvent(my_event);
				

			}else{

				$.fancybox.open({
					src  : "#popup_monto_minimo"
				});

			}

		}


	}

	function pre_abrir_preguntas()
	{
		// Agrego las preguntas del pedido
		if(g_zonas_envios.length>0)
		{
			$("#pregunta_10_respuesta").empty();
			$("#pregunta_10_respuesta").append('<option value="">');

			for (var i = 0; i < g_zonas_envios.length; i++) 
			{
				var zona = g_zonas_envios[i];

				var costo_envio = zona.costo;
				if(g_pedido_zona_envio_ignorar_monto != -1)
				{
					if(g_pedido.precio_solo_articulos >= g_pedido_zona_envio_ignorar_monto)
					{
						costo_envio = 0;
					}
				}

				var zona_respuesta = zona.nombre + ' ($'+ costo_envio +')';

				var nueva_zona = '<option value="'+ zona_respuesta +'" data-costo="'+ costo_envio +'" data-nombre="'+ zona.nombre +'">' + zona_respuesta;
				$("#pregunta_10_respuesta").append(nueva_zona);
			}
			
		}


	}

	function finalizar_pedido()
	{
		calcular_total();

		$.fancybox.close();

		document.body.dispatchEvent(new CustomEvent('purchase'));

					localStorage.removeItem('pedido-burracomidamexicana')
		
		$("#form_pedido").submit();
		
	}
	
	</script>

	<div id="popup_control_horario" style="display:none;  border-radius: .5rem;">
		<center>
			<div style="text-align:center;">
			Estamos cerrados			</div>
		</center>
	</div>

	<div id="popup_monto_minimo" style="display:none;  border-radius: .5rem;">
		<center>
			<div style="text-align:center;">
			El monto mínimo para realizar un pedido es de $			</div>
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
			<button class="btn my-btn-primary"  onclick="
				
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

	<div id="preguntas_pedido" style="display: none; border-radius: .5rem;" class="">

	
		<div style='text-align:center;font-size:18px;margin-bottom:20px;'>COMPLETA LAS SIGUIENTES <BR> PREGUNTAS PARA QUE <BR> PREPAREMOS TU PEDIDO</div>
		<h5 class="mb-3" style="">
					</h5>


		<form onSubmit="finalizar_pedido(); return false;">

			<p>
			<label id='pregunta_1_label'>Nombre*</label>			<input type="text" value="" id="pregunta_1_respuesta"
				name="pr_preg1" 
				class="form-control" 
				required				placeholder="">
			</p>

												<p>
					<label id='pregunta_2_label'>Dirección*</label>					<input type="text" value="" id="pregunta_2_respuesta" 
						name="pr_preg2" 
						class="form-control" 
						required						placeholder="">
					</p>
							
												<p>
					<label id='pregunta_3_label'>Piso/Depto:*</label>					<input type="text" value="" id="pregunta_3_respuesta" 
						name="pr_preg3" 
						class="form-control" 
						required						placeholder="">
					</p>
							
												<p>
					<label id='pregunta_4_label'>Como va a abonar: <br> Efectivo <br> con MP <br> con tarjeta?*</label>					<input type="text" value="" id="pregunta_4_respuesta" 
						name="pr_preg4" 
						class="form-control" 
						required						placeholder="">
					</p>
							
			
			
			
			
			
			

			<p style='text-align:center;font-size:18px;'>GRACIAS POR ELEGIRNOS <BR> HORARIO DE ATENCIÓN <BR> Miercoles a Domingo de 20:00 a 23:50hs</p>
			<div id="preguntas_resumen" style="display:none;" class="preguntas-resumen"></div>

			<p class="mb-0 text-center">
				<input value="Enviar Pedido" type="submit" class="btn my-btn-primary" >
			</p>

		</form>

	</div>

	<div id="pregunta_variedades" style="display: none; border-radius: .5rem;" class="pregunta-variedades-box">

		<h5 class="mb-3" class="titulo-ventana" id="pregunta_variedades_titulo">
			Elija una opción		</h5>
		<span id="pregunta_variedades_opciones"></span>

	</div>

	<form id="form_pedido" action="https://pidorapido.com/create.order.v15.php" target="_top" method="POST" style="display:none;margin-top:100px;">
		<input id="form_alias" name="alias" value="burracomidamexicana">
		<input id="form_url" name="url">
		<input name="email" value="">
		<input id="isdesktop" name="isdesktop" value="">
		<input name="webhook" value="">
		<textarea id="form_order_json" name="order_json"></textarea>
		<textarea id="form_order_text" name="order_text"></textarea>
	</form>

				<div class="slider-container"> 
                <div id="carouselExampleControls" class="carousel slide " 
                    data-ride="carousel"
                    data-interval="3000"
                    style="margin-top: -12px;">

                    <div class="carousel-inner">

                                                        <div class="carousel-item  active">
                                    <img src="https://yourfiles.cloud/uploads/868a1f341ed053b47d8c03170436d940/Banner%20Horizontal%20Minimalista%20Joyer%C3%ADa%20%282%29.gif" class="d-block w-100" alt="...">
                                </div>
                                                    
                    </div>

                    
                </div>
            </div>
			
		<div class="container" style="max-width: 600px;background-color: #FFFFFF !important; padding-top: 10px;">
		
			<div class="row" id="productos">

				
					<script>
						var g_productos = [{"id":"1","nombre":"Flautitas (x3)","descripcion":"Tortilla de trigo frita rellena con pollo y queso fundido, acompa\u00f1ada de crema agria y pico de gallo.","variedad":null,"precio":"10000","precio_mostrar":"10.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Entrada","subcategoria":"","categoriaicono":"https:\/\/yourfiles.cloud\/uploads\/4c761a312396e48a03511bc6dabcb7cb\/entradasnacho.png","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"2","nombre":"Bastones","descripcion":"Suprema de pollo crujiente acompa\u00f1ada con dip de chipotle cremoso y dip de sriracha.","variedad":null,"precio":"10000","precio_mostrar":"10.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Entrada","subcategoria":"","categoriaicono":"","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"3","nombre":"Nachos para compartir","descripcion":"Con dips de cheddar y guacamole.","variedad":null,"variedades":[{"nombre":"- Dip Cheddar","precio":"9000","precio_mostrar":"9.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"Dip Guacamole","precio":"9000","precio_mostrar":"9.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""}],"precio":"9000","precio_mostrar":"9.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Entrada","subcategoria":"","categoriaicono":"","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"4","nombre":"Papas fritas","descripcion":"Cl\u00e1sicas","variedad":null,"precio":"5000","precio_mostrar":"5.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Entrada","subcategoria":"","categoriaicono":"","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":true,"se_puede_pedir":true,"variedades":[{"nombre":"Sin Cheddar","precio":"5000","precio_mostrar":"5.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"Con Cheddar","precio":"7500","precio_mostrar":"7.500","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""}]},{"id":"6","nombre":"Burrito (400 g)","descripcion":"Tortilla de trigo con queso fundido y tu relleno favorito, acompa\u00f1ado con dip a elecci\u00f3n.","variedad":null,"variedades":[{"nombre":"Pollo","precio":"13000","precio_mostrar":"13.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"Guacamole , Chipotle cremoso , Crema agria , Salsa picante","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"DIP A ELECCI\u00d3N","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"Veggie","precio":"13000","precio_mostrar":"13.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"Guacamole , Chipotle cremoso , Crema agria , Salsa picante","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"DIP A ELECCI\u00d3N","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""}],"precio":"13000","precio_mostrar":"13.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Principal","subcategoria":"","categoriaicono":"https:\/\/yourfiles.cloud\/uploads\/8243ec24b0182add322ef5e7008434da\/BURRITO.png","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"7","nombre":"Burrito (400 g)","descripcion":"Tortilla de trigo con queso fundido y tu relleno favorito, acompa\u00f1ado con dip a elecci\u00f3n.","variedad":null,"variedades":[{"nombre":"","precio":"13500","precio_mostrar":"13.500","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"Guacamole , Chipotle cremoso , Crema agria , Salsa picante","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"DIP A ELECCI\u00d3N","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"Bondiola","precio":"13500","precio_mostrar":"13.500","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"Guacamole , Chipotle cremoso , Crema agria , Salsa picante","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"DIP A ELECCI\u00d3N","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"carne","precio":"13500","precio_mostrar":"13.500","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"Guacamole , Chipotle cremoso , Crema agria , Salsa picante","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"DIP A ELECCI\u00d3N","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""}],"precio":"13500","precio_mostrar":"13.500","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Principal","subcategoria":"","categoriaicono":"","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"8","nombre":"Taquitos (x2) ","descripcion":"Tortilla de trigo o ma\u00edz con queso fundido y tu relleno favorito.","variedad":null,"variedades":[{"nombre":"Pollo","precio":"10000","precio_mostrar":"10.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"Bondiola","precio":"10000","precio_mostrar":"10.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"carne","precio":"10000","precio_mostrar":"10.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""}],"precio":"10000","precio_mostrar":"10.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Principal","subcategoria":"","categoriaicono":"","categoriaimagendefondo":"https:\/\/yourfiles.cloud\/uploads\/47367a235ba6db6d3de1f63bf1afed70\/WhatsApp%20Image%202026-01-13%20at%2020.16.39.jpeg","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"9","nombre":"Quesadilla","descripcion":"Tortilla de trigo con muzzarella y cheddar.","variedad":null,"precio":"9000","precio_mostrar":"9.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Principal","subcategoria":"","categoriaicono":"","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"10","nombre":"Quesadilla de Pollo","descripcion":"Tortilla de trigo con queso fundido y suprema desmenuzada.","variedad":null,"precio":"9000","precio_mostrar":"9.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Principal","subcategoria":"","categoriaicono":"","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"11","nombre":"Sandwich","descripcion":"Suprema de pollo crujiente con queso cheddar, lechuga repollada y salsa chipotle cremosa en pan de papa, acompa\u00f1ado con papas fritas.","variedad":null,"precio":"13500","precio_mostrar":"13.500","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Burra Fusi\u00f3n","subcategoria":"","categoriaicono":"https:\/\/yourfiles.cloud\/uploads\/4c761a312396e48a03511bc6dabcb7cb\/empanadass.png","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"12","nombre":"Empanadas fritas (x3)","descripcion":"De bondiola con dip de crema agria.","variedad":null,"precio":"6500","precio_mostrar":"6.500","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Burra Fusi\u00f3n","subcategoria":"","categoriaicono":"","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true},{"id":"13","nombre":"Dips","descripcion":"-","variedad":null,"variedades":[{"nombre":"Guacamole","precio":"2000","precio_mostrar":"2.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"Chipotle cremoso","precio":"2000","precio_mostrar":"2.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"Crema agria","precio":"2000","precio_mostrar":"2.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""},{"nombre":"Salsa picante","precio":"2000","precio_mostrar":"2.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"variedades2":"","variedades3":"","variedades4":"","variedades5":"","variedades6":"","variedades7":"","variedades8":"","variedades9":"","variedades10":"","variedades11":"","variedades12":"","minimo":1,"maximo":999999,"step":1,"variedadtotal":1,"variedad2total":1,"variedad3total":1,"variedad4total":1,"variedad5total":1,"variedad6total":1,"variedad7total":1,"variedad8total":1,"variedad9total":1,"variedad10total":1,"variedad11total":1,"variedad12total":1,"variedadestilo":"NORMAL","variedad2estilo":"NORMAL","variedad3estilo":"NORMAL","variedad4estilo":"NORMAL","variedad5estilo":"NORMAL","variedad6estilo":"NORMAL","variedad7estilo":"NORMAL","variedad8estilo":"NORMAL","variedad9estilo":"NORMAL","variedad10estilo":"NORMAL","variedad11estilo":"NORMAL","variedad12estilo":"NORMAL","variedadtitulo":"","variedad2titulo":"","variedad3titulo":"","variedad4titulo":"","variedad5titulo":"","variedad6titulo":"","variedad7titulo":"","variedad8titulo":"","variedad9titulo":"","variedad10titulo":"","variedad11titulo":"","variedad12titulo":"","variedadrender":"","variedad2render":"","variedad3render":"","variedad4render":"","variedad5render":"","variedad6render":"","variedad7render":"","variedad8render":"","variedad9render":"","variedad10render":"","variedad11render":"","variedad12render":""}],"precio":"2000","precio_mostrar":"2.000","precioanterior":"","precioanterior_mostrar":"0","descuento":0,"categoria":"Dips","subcategoria":"","categoriaicono":"https:\/\/yourfiles.cloud\/uploads\/3fe90488bf11e8e211516489cfec9748\/dips.png","categoriaimagendefondo":"","ocultar":"","stock":"","codigo":"","minimo":1,"maximo":999999,"step":1,"imagen":"","imagen_tamano":"CHICA","imagenes":[],"tiene_precios_diferentes":false,"se_puede_pedir":true}];
					</script>
					
					<script>
						var g_zonas_envios = [];						
					</script>
					<script>
						var g_pedido_zona_envio_ignorar_monto = -1;						
					</script>
					<script>
					var g_stock = {};						
				</script>
				<script>
						var g_stock = {};											
					</script>
					<script>
						var g_control_mostrar_stock_disponible = true;											
					</script>
					
				<!--
				<div class="col-md-12 helper_resumen">
					<a href="javascript://" style="" onclick="mostrar_resumen_pedido();" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Volver</a>
				</div>
				-->

				<div class="helper_resumen resumen_titulo col-md-12" style="
					margin-top: 10px;
					margin-bottom: 10px;
					font-weight: 900;
					font-size: 20px;
					display: none;
					">

					<a href="javascript://" onclick="vaciar_pedido();" class="btn btn-link" id="boton_vaciar" style="position:absolute; right:5px; margin-top: -5px;"><i class="fas fa-trash"></i> </a>

					<a href="javascript://" onclick="mostrar_resumen_pedido();" class="btn btn-link" style="position:absolute; left:5px; margin-top: -5px;"><i class="fas fa-arrow-left"></i></a>

					<center>
					Tu pedido					</center>
				</div>

				<div class="helper_buscador resumen_titulo col-md-12" style="
					margin-top: 10px;
					margin-bottom: 10px;
					font-weight: 900;
					font-size: 20px;
					display: none;
					">

					<a href="javascript://" onclick="mostrar_buscador();" class="btn btn-link" style="position:absolute; left:5px; margin-top: -5px;"><i class="fas fa-arrow-left"></i></a>

					<a href="javascript://" onclick="copiar_busqueda();" class="btn btn-link" style="position:absolute;left: 34px;margin-top: -5px;"><i class="fas fa-copy"></i></a>
					
					<input type="search" value="" id="input_buscador" name="buscador" class="form-control float-right" style="margin-top:-4px;width: calc(100% - 62px);" placeholder="Texto a buscar" onkeyup="buscar();">
					
				</div>

										<div class="col-md-12 category-wrapper"><div class="row">							<div class="col-md-12 categoria  " 
								data-categoria="1" 
								id="categoria_1"
								style=""
								onclick="mostrar_categoria('1');"
								>

								<div class="categoria-titulo-box">

									<div class="categoria-titulo "
										onclick="mostrar_categoria('1');"
										>

										<a href="javascript://" onclick="mostrar_categoria('1');">

																							<img src="https://yourfiles.cloud/uploads/4c761a312396e48a03511bc6dabcb7cb/entradasnacho.png" style="" class="categoria-titulo-icono">
												Entrada
										</a>
									</div>

									<div class="categoria-titulo-open-close-icon-container">
										<i class="fas fa-angle-down icono_1 categoria_icono " style=""></i>
									</div>

								</div>

								<!-- <div class="separador-categorias"></div> -->

							</div>
												
						<div class=" col-md-12  producto"
							data-categoria="1"
							data-subcategoria="1"
							style="display:none;"
							id="producto_1"
							>

															
								<div class="producto_fila producto-box" id="fila_1">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('1');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_1" class="producto-titulo">Flautitas (x3)</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$10.000</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_1"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Tortilla de trigo frita rellena con pollo y queso fundido, acompañada de crema agria y pico de gallo.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_1" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('1');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_1" name="aclaracion_1" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
																
						<div class=" col-md-12  producto"
							data-categoria="1"
							data-subcategoria="2"
							style="display:none;"
							id="producto_2"
							>

															
								<div class="producto_fila producto-box" id="fila_2">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('2');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_2" class="producto-titulo">Bastones</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$10.000</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_2"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Suprema de pollo crujiente acompañada con dip de chipotle cremoso y dip de sriracha.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_2" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('2');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_2" name="aclaracion_2" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
																
						<div class=" col-md-12  producto"
							data-categoria="1"
							data-subcategoria="3"
							style="display:none;"
							id="producto_3"
							>

															
								<div class="producto_fila producto-box" id="fila_3">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('3');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_3" class="producto-titulo">Nachos para compartir</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$9.000</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_3"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Con dips de cheddar y guacamole.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_3" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('3');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_3" name="aclaracion_3" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
																
						<div class=" col-md-12  producto"
							data-categoria="1"
							data-subcategoria="4"
							style="display:none;"
							id="producto_4"
							>

															
								<div class="producto_fila producto-box" id="fila_4">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('4');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_4" class="producto-titulo">Papas fritas</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">Desde $5.000</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_4"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Clásicas</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_4" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('4');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_4" name="aclaracion_4" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
											</div></div><div class="col-md-12 category-wrapper"><div class="row">							<div class="col-md-12 categoria  " 
								data-categoria="2" 
								id="categoria_2"
								style=""
								onclick="mostrar_categoria('2');"
								>

								<div class="categoria-titulo-box">

									<div class="categoria-titulo "
										onclick="mostrar_categoria('2');"
										>

										<a href="javascript://" onclick="mostrar_categoria('2');">

																							<img src="https://yourfiles.cloud/uploads/8243ec24b0182add322ef5e7008434da/BURRITO.png" style="" class="categoria-titulo-icono">
												Principal
										</a>
									</div>

									<div class="categoria-titulo-open-close-icon-container">
										<i class="fas fa-angle-down icono_2 categoria_icono " style=""></i>
									</div>

								</div>

								<!-- <div class="separador-categorias"></div> -->

							</div>
												
						<div class=" col-md-12  producto"
							data-categoria="2"
							data-subcategoria="5"
							style="display:none;"
							id="producto_6"
							>

															
								<div class="producto_fila producto-box" id="fila_6">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('6');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_6" class="producto-titulo">Burrito (400 g)</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$13.000</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_6"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Tortilla de trigo con queso fundido y tu relleno favorito, acompañado con dip a elección.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_6" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('6');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_6" name="aclaracion_6" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
																
						<div class=" col-md-12  producto"
							data-categoria="2"
							data-subcategoria="6"
							style="display:none;"
							id="producto_7"
							>

															
								<div class="producto_fila producto-box" id="fila_7">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('7');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_7" class="producto-titulo">Burrito (400 g)</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$13.500</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_7"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Tortilla de trigo con queso fundido y tu relleno favorito, acompañado con dip a elección.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_7" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('7');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_7" name="aclaracion_7" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
																
						<div class=" col-md-12  producto"
							data-categoria="2"
							data-subcategoria="7"
							style="display:none;"
							id="producto_8"
							>

															
								<div class="producto_fila producto-box" id="fila_8">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('8');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_8" class="producto-titulo">Taquitos (x2) </div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$10.000</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_8"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Tortilla de trigo o maíz con queso fundido y tu relleno favorito.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_8" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('8');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_8" name="aclaracion_8" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
																
						<div class=" col-md-12  producto"
							data-categoria="2"
							data-subcategoria="8"
							style="display:none;"
							id="producto_9"
							>

															
								<div class="producto_fila producto-box" id="fila_9">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('9');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_9" class="producto-titulo">Quesadilla</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$9.000</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_9"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Tortilla de trigo con muzzarella y cheddar.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_9" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('9');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_9" name="aclaracion_9" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
																
						<div class=" col-md-12  producto"
							data-categoria="2"
							data-subcategoria="9"
							style="display:none;"
							id="producto_10"
							>

															
								<div class="producto_fila producto-box" id="fila_10">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('10');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_10" class="producto-titulo">Quesadilla de Pollo</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$9.000</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_10"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Tortilla de trigo con queso fundido y suprema desmenuzada.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_10" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('10');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_10" name="aclaracion_10" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
											</div></div><div class="col-md-12 category-wrapper"><div class="row">							<div class="col-md-12 categoria  " 
								data-categoria="3" 
								id="categoria_3"
								style=""
								onclick="mostrar_categoria('3');"
								>

								<div class="categoria-titulo-box">

									<div class="categoria-titulo "
										onclick="mostrar_categoria('3');"
										>

										<a href="javascript://" onclick="mostrar_categoria('3');">

																							<img src="https://yourfiles.cloud/uploads/4c761a312396e48a03511bc6dabcb7cb/empanadass.png" style="" class="categoria-titulo-icono">
												Burra Fusión
										</a>
									</div>

									<div class="categoria-titulo-open-close-icon-container">
										<i class="fas fa-angle-down icono_3 categoria_icono " style=""></i>
									</div>

								</div>

								<!-- <div class="separador-categorias"></div> -->

							</div>
												
						<div class=" col-md-12  producto"
							data-categoria="3"
							data-subcategoria="10"
							style="display:none;"
							id="producto_11"
							>

															
								<div class="producto_fila producto-box" id="fila_11">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('11');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_11" class="producto-titulo">Sandwich</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$13.500</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_11"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >Suprema de pollo crujiente con queso cheddar, lechuga repollada y salsa chipotle cremosa en pan de papa, acompañado con papas fritas.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_11" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('11');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_11" name="aclaracion_11" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
																
						<div class=" col-md-12  producto"
							data-categoria="3"
							data-subcategoria="11"
							style="display:none;"
							id="producto_12"
							>

															
								<div class="producto_fila producto-box" id="fila_12">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('12');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_12" class="producto-titulo">Empanadas fritas (x3)</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$6.500</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_12"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >De bondiola con dip de crema agria.</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_12" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('12');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_12" name="aclaracion_12" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
											</div></div><div class="col-md-12 category-wrapper"><div class="row">							<div class="col-md-12 categoria  " 
								data-categoria="4" 
								id="categoria_4"
								style=""
								onclick="mostrar_categoria('4');"
								>

								<div class="categoria-titulo-box">

									<div class="categoria-titulo "
										onclick="mostrar_categoria('4');"
										>

										<a href="javascript://" onclick="mostrar_categoria('4');">

																							<img src="https://yourfiles.cloud/uploads/3fe90488bf11e8e211516489cfec9748/dips.png" style="" class="categoria-titulo-icono">
												Dips
										</a>
									</div>

									<div class="categoria-titulo-open-close-icon-container">
										<i class="fas fa-angle-down icono_4 categoria_icono " style=""></i>
									</div>

								</div>

								<!-- <div class="separador-categorias"></div> -->

							</div>
												
						<div class=" col-md-12  producto"
							data-categoria="4"
							data-subcategoria="12"
							style="display:none;"
							id="producto_13"
							>

															
								<div class="producto_fila producto-box" id="fila_13">

									<!-- Nueva caja -->
									<div style="
										display:flex; 
										justify-content: space-between;
																				"

																					onclick="agregar_al_pedido('13');"
																				style="cursor:pointer;display: flow-root;min-height:50px;"
										>

										<!-- Caja para la imagen -->
										<div class="producto-box-auxiliar imagen-grande" style="display:none;">

											
												
											
											
										</div>


										<!-- Caja para el titulo y descripcion -->
										<div class="producto-box-main">

											
											<div style="display:flex; flex-direction: column;">

												<!-- Boton agregar + título + Precio -->
												<div style="display:flex; justify-content: space-between;">

													<!-- Boton agregar + Titilo -->
													<div style="display:flex;">

														
														
														
														<div>

															<div id="producto_titulo_13" class="producto-titulo">Dips</div>

															
														</div>

														
													</div>



													<!-- Precio -->
														
																												<div class="precio-box" style="font-weight:900;">
	
															<div style="display: flex;flex-direction: column;text-align: right;">													
																<div style="white-space: nowrap;">
																	<span class="producto_descuento" 
																		style="font-size: 0.75rem;
																		margin-right: 5px;
																		vertical-align: middle;"></span>
																	<span style="vertical-align: middle;">$2.000</span>
																</div>
																<span class="producto_descuento_porcentaje" style="font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;"></span>
																<span id="cantidad_13"></span>
															</div>															
														</div>
	
																									</div>

												<!-- Descripcion -->
												<div>
													<div class='producto-descripcion' >-</div>												</div>
											</div>

										</div>

									</div>

									<div class='separador-producto-de-variedad' style="display: none;">
										<hr>
									</div>

									<div class="producto_cantidades" id="cantidades_13" style="display:none;font-weight: bold;"></div>

									<div class="helper_variedades_agregar clearfix" style="display: none;padding:7px;padding-top:0px;">
										<button class='btn float-right add-new-option producto-agregar-opcion' onclick="agregar_al_pedido('13');">Agregar otra opción</button>
									</div>

									<div class="helper_aclaracion clearfix producto-aclaracion" style="display: none;">
										<form onsubmit="return false;">
                                            <textarea type="text" value="" id="aclaracion_13" name="aclaracion_13" class="form-control" placeholder="Agregar aclaraciones"></textarea>
                                        </form>
									</div>

																			<div class="separador-productos"></div>
									

								</div>
							
							

						</div>
					</div></div>				
			</div>

		</div>


					<a href="https://wa.me/5493764865939" class="whatsapp-floating-button" target="_blank"><img src="https://pidorapido.com/img/whatsapp-icon.svg" width="70"></a>
			
		<script>
			var g_categorias = [{"nro":1,"categoria":"Entrada","imagen_fondo":"","icono":"https:\/\/yourfiles.cloud\/uploads\/4c761a312396e48a03511bc6dabcb7cb\/entradasnacho.png"},{"nro":2,"categoria":"Principal","imagen_fondo":"","icono":"https:\/\/yourfiles.cloud\/uploads\/8243ec24b0182add322ef5e7008434da\/BURRITO.png"},{"nro":3,"categoria":"Burra Fusi\u00f3n","imagen_fondo":"","icono":"https:\/\/yourfiles.cloud\/uploads\/4c761a312396e48a03511bc6dabcb7cb\/empanadass.png"},{"nro":4,"categoria":"Dips","imagen_fondo":"","icono":"https:\/\/yourfiles.cloud\/uploads\/3fe90488bf11e8e211516489cfec9748\/dips.png"}];
		</script>
		

			<div class="footer-con-logo-contenedor">
			<img src="https://yourfiles.cloud/uploads/da5d4cdf2db9869901d6d88e8bf7cf77/WhatsApp%20Image%202025-12-22%20at%2020.00.13%20-%20Nadia%20Maximowicz.jpeg" class="footer-logo">
		</div>
	
	<footer class="footer text-center">
		<div class="container">
			<div class="row">

				<!-- Footer About Text -->
				<div class="col-lg-12">
					<p class="lead mb-0">

						<div>

							
								BURRA COMIDA MEXICANA<BR> Lunes y Martes cerrado<BR>Miercoles a Domingo de 20:00 a 23:50<br>Jujuy 1874, Posadas Misiones
<br><span class="fab fa-instagram">&nbsp;</span><a href="https://www.instagram.com/XXXXXXXXXXXX" target=_blank>@burra.comidamexicana</a> 
																	
																		
										<!-- Pixel pidorapido carritos propios -->
										<!-- Facebook Pixel Code -->
										<script>
										!function(f,b,e,v,n,t,s)
										{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
										n.callMethod.apply(n,arguments):n.queue.push(arguments)};
										if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
										n.queue=[];t=b.createElement(e);t.async=!0;
										t.src=v;s=b.getElementsByTagName(e)[0];
										s.parentNode.insertBefore(t,s)}(window, document,'script',
										'https://connect.facebook.net/en_US/fbevents.js');
										fbq('init', '790589938408064');
										fbq('track', 'PageView');
										</script>
										<noscript><img height="1" width="1" style="display:none"
										src="https://www.facebook.com/tr?id=790589938408064&ev=PageView&noscript=1"
										/></noscript>
										<!-- End Facebook Pixel Code -->

																														</div>

						<div class="helper_footer_padding" style="height: 70px; display: none;"></div>
					</p>
				</div>

			</div>
		</div>
	</footer>


	<div class="footer-enviar-pedido" style="display:none;pointer-events: none;" id="footer_enviar">
		
					<a href="javascript://" onclick="clickEnviarPedido()" class="btn animated my-btn-auxiliar" id="boton_enviar" style="pointer-events: auto;">Enviar pedido</a>
		
	</div>

    <div class="popup_instagram">
        <div class="popup_instagram_titulo">Navegador no soportado</div>
        <div class="popup_instagram_texto">Copia el link y pégalo en tu navegador para poder realizar tu pedido</div>

        <div class="popup_instagram_link">
            <input type="text" readonly value="https://pidorapido.com/burracomidamexicana" id="input_instagram_link" style="width: calc(100% - 50px);margin-right: 10px;"/>
            <button class="btn" onclick="copiar_link_instagram();">Copiar</button>
        </div>

    </div>

	<div class="navbar-footer-container">
		<div style="" class="navbar-footer">			

			
				<button type="button" style="display:none;" onclick="openNav()" class="btn my-btn-primary animated fadeIn" id="mobile-nav-toggle">
					<i class="fa fa-bars"></i>
				</button>

				<button class="btn my-btn-primary" id="boton_buscador" style="HCHdisplay:none;" type="button" onclick="mostrar_buscador();">
					<i id="icono_buscador" class="fas fa-search"></i>
				</button>

				<button class="btn helper_changuito my-btn-primary" type="button" onclick="mostrar_resumen_pedido();">
					<i id="icono_resumen_pedido" class="fas fa-shopping-bag"></i>
					<div class="badge hchbadge-primary pedido_productos_cantidad_total">0</div>
				</button>		
				
				<!-- <div style="background-color:#AA282C!important; padding-left: 10px; z-index:999999;"></div> -->

			
		</div>
	</div>

	<div class="navbar-footer-brand-container">
		
				
			<span>Desarrollado por<b><a href="https://pidorapido.com" target="_blank">&nbsp;PidoRapido.com</a></b></span>
			
		
	</div>


	<!-- Bootstrap core JavaScript -->
	<script src="https://pidorapido.com/vendor/jquery/jquery.min.js"></script>
	<script src="https://pidorapido.com/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
			
	<!-- Plugin JavaScript -->
	<script src="https://pidorapido.com/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for this template -->
	<script src="https://pidorapido.com/js/freelancer.min.js"></script>


	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

	<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
	<script src="https://pidorapido.com/vendor/swal11/sweetalert2.min.js"></script>



	<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>

	<script>
	function hasTouch() {
		return 'ontouchstart' in document.documentElement
				|| navigator.maxTouchPoints > 0
				|| navigator.msMaxTouchPoints > 0;
	}

	function clickEnviarPedido()
	{
		calcular_total();
		enviar_pedido();
	}

	// Ajustar posición sticky de subcategorías
		function ajustarStickySubcategorias() {}
	
	$( document ).ready(function() {
		
		// console.log( "Ready!" );

		
		
					$("#mobile-nav-toggle").show();
			$("#sidenav_categorias").empty();

			
					g_categorias.forEach( function(elem, idx)
					{
						var cat_to_add = elem;

						$("#sidenav_categorias").append(`
							<a href="javascript://" class="sidenav-item" onclick="ir_a_categoria(${elem.nro})">${elem.categoria}</a>
							<div class="separador-menu"></div>
						`);				
					});

							

		actualizar_url_carrito();

		lazyload();

		if (!hasTouch()) {
			document.body.className += ' tienehover';
		}

		if (
			localStorage.getItem('pedido-burracomidamexicana')!="" &&
			localStorage.getItem('pedido-burracomidamexicana')!=undefined
			)
		{
			// Chequeo que no hayan pasado X minutos
			// v_minutos_que_recuerda_el_pedido = 60;
			v_minutos_que_recuerda_el_pedido = 30;
			
			g_pedido = JSON.parse(localStorage['pedido-burracomidamexicana']);

			if ( true && (new Date().getTime() - g_pedido.ultima_actualizacion < v_minutos_que_recuerda_el_pedido * 60 * 1000) )
			{
				
				console.log("Recupero el carrito");

				calcular_total();

			}else{

				console.log("Expiró el carrito");

				g_pedido.productos=[];

			}
			
		}

		window.onpopstate = function(event) {
			
			if (document.location.hash!="#mipedido")
			{
				g_viendo_resumen = true;
				mostrar_resumen_pedido();
			}
			
		};

		const categorias = document.querySelectorAll(
  ".col-md-12.categoria.imagen-fondo"
);
categorias.forEach((categoria) => {
  categoria.style.cursor = "pointer";
});
const subcategorias = document.querySelectorAll(".subcategoria");
subcategorias.forEach((subcategoria) => {
  const titulos = subcategoria.querySelectorAll(".subcategoria-titulo");
  titulos.forEach((titulo) => {
    titulo.style.cursor = "pointer";
  });
});

const productos = document.querySelectorAll(".producto-box-main");

productos.forEach((producto) => {
  producto.style.cursor = "pointer";
});


// IMAGEN HEAD LOGO

var link = document.createElement("link");
link.rel = "icon";
link.type = "image/svg+xml";
link.href =
  "https://yourfiles.cloud/uploads/856b0c5f73b03f45f05ce300bec7ce66/logo%20florida%20vinos.png";
var head = document.head;
head.appendChild(link);



		

		controlar_horario();

		// Si tiene telefono, el producto puede ser pedido y le agrego el ícono del +
		if(g_telefono != '') {
			$(".product-add-icon").show();
		}else{			
		}


		

		


		document.body.addEventListener('add_to_cart', function(e) {
			
			try {
				
				var params = {
					  value: parseFloat(e.detail.producto.precio) + parseFloat(e.detail.producto.adicionales)
					, currency: 'USD'
				};
				// console.log(params);
				fbq('track', 'AddToCart', params);

			} catch (error) {
				// console.log('error', error);
			}
		});

		document.body.addEventListener('purchase', function(e) {
			
			try {
				
				var params = {
					  value: parseFloat(g_pedido.precio_final)
					, currency: 'USD'
					, num_items: g_pedido.cantidad_productos_final
				};
				// console.log(params);
				fbq('track', 'Purchase', params);

			} catch (error) {
				// console.log('error', error);
			}

		});

		document.body.addEventListener('initiate_checkout', function(e) {
			
			try {
				
				var params = {
					  value: parseFloat(g_pedido.precio_final)
					, currency: 'USD'
					, num_items: g_pedido.cantidad_productos_final
				};
				// console.log(params);
				fbq('track', 'InitiateCheckout', params);

			} catch (error) {
				// console.log('error', error);
			}

		});



        
        
	});

	function ir_a_categoria(cat_nro)
	{
		goToByScroll('categoria_' + cat_nro);
		closeNav();
		abrir_categoria(cat_nro);
	}

	function open_gallery(p_id)
	{
		var producto = dame_producto(p_id);

		var fancy_images = [];

		for (let i = 0; i < producto.imagenes.length; i++) 
		{
			var myimg = producto.imagenes[i];
		
			fancy_images.push({
				src  : myimg,
				opts : {
					caption : '',
					thumb   : ''
				}
			});
		}

		var slideShow = {};
		if(producto.imagenes.length>1)
		{
			slideShow = {
				autoStart: false,
				speed: 3000
			};
		}

		$.fancybox.open( fancy_images, 
			{
				loop: true,
				slideShow: slideShow
			}
		);
	}

	function controlar_horario()
	{	
		var abierto = true;

		// Si el control horario está desactivado, entonces el local siempre está abierto
		var control_horario = true;
		// console.log('Control horario? ', control_horario);

		if(control_horario)
		{
			var horario_string = '';

			var today = new Date();
			// console.log('Dia: ' + today.getDay());

			var dia_de_la_semana = today.getDay();
			// dia_de_la_semana = 0;
			switch (dia_de_la_semana) 
			{
				case 0:
					horario_string = '20:00-23:50';
					break;
				case 1:
					horario_string = 'ESTAMOS CERRADOS';
					break;
				case 2:
					horario_string = 'ESTAMOS CERRADOS';
					break;
				case 3:
					horario_string = '20:00-23:50';
					break;
				case 4:
					horario_string = '20:00-23:50';
					break;
				case 5:
					horario_string = '20:00-23:50';
					break;
				case 6:
					horario_string = '20:00-23:50';
					break;
			}

			// console.log('Horario de hoy (crudo): ' + horario_string);
			horario_string = horario_string.replace(/ - /g, "-"); 
			horario_string = horario_string.replace(/DESDE/g, ""); // Reemplazo la palabra de por nada
			horario_string = horario_string.replace(/DE/g, ""); // Reemplazo la palabra de por nada
			horario_string = horario_string.replace(/LAS/g, ""); // Reemplazo la palabra de por nada
			horario_string = horario_string.replace(/LA/g, ""); // Reemplazo la palabra de por nada
			horario_string = horario_string.replace(/HASTA/g, ""); // Reemplazo la palabra de por nada
			horario_string = horario_string.replace(/HORAS/g, ""); // Reemplazo la palabra de por nada
			horario_string = horario_string.replace(/HS/g, ""); // Reemplazo la palabra de por nada
			horario_string = horario_string.replace(/\./g, ""); // Reemplazo la palabra de por nada
			horario_string = horario_string.replace(/ Y /g, " "); // Reemplazo cualquier Y por un espacio
			horario_string = horario_string.replace(/,/g, " "); // Reemplazo cualquier coma por un espacio
			horario_string = horario_string.replace(/  /g, " "); // Reemplazo doble espacios por uno simple
			horario_string = horario_string.replace(/  /g, " "); // más de lo de arriba
			horario_string = horario_string.replace(/  /g, " "); // más de lo de arriba
			horario_string = horario_string.replace(/ A /g, "-"); // Si el horario dice de 9 a 18 reemplazo el ' a ' por un guión
			horario_string = horario_string.trim(/ A /g, "-");
			// console.log('Horario (formateado): ' + horario_string);

			if(horario_string!=''){

				var intervalos = horario_string.split(" ");

				var minutos_ahora = today.getHours() * 60 + today.getMinutes();
				// console.log('Minutos de AHORA: ' + minutos_ahora);

				abierto = false;
				$(intervalos).each( (idx, intervalo) => 
				{
					// console.log('Intervalo Nº '+ (idx+1) +': ' + intervalo);

					var horario_desde_hasta = intervalo.split("-");

					if(horario_desde_hasta.length==2)
					{
						var horario_desde = horario_desde_hasta[0];
						var horario_hasta = horario_desde_hasta[1];

						minutos_desde = 0;
						if(horario_desde.indexOf(":")>0){
							minutos_desde = parseInt(horario_desde.split(":")[0]) * 60;
							minutos_desde += parseInt(horario_desde.split(":")[1]);

						}else{
							minutos_desde = parseInt(horario_desde) * 60;
						}

						minutos_hasta = 0;
						if(horario_hasta.indexOf(":")>0){
							minutos_hasta = parseInt(horario_hasta.split(":")[0]) * 60;
							minutos_hasta += parseInt(horario_hasta.split(":")[1]);

						}else{
							minutos_hasta = parseInt(horario_hasta) * 60;
						}

						// console.log('Minutos Desde: ' + minutos_desde);
						// console.log('Minutos Hasta: ' + minutos_hasta);

						if(minutos_ahora >= minutos_desde && minutos_ahora <= minutos_hasta)
						{
							console.log('Esta ABIERTO');
							abierto = true;
						}

					}

				});

			}else{
				// console.log("El día no tiene un horario asignado => CERRADO");
				abierto = false;

			}

		}else{
			// console.log('Control horario DESACTIVADO');

		}

		if(!abierto)
		{
			$.fancybox.open({
				src  : "#popup_control_horario"
			});
		}

		return abierto;
	}
	

	function actualizar_url_carrito()
	{
		var carrito_link = '/burracomidamexicana/' + g_telefono;
		console.log('carrito link ',  carrito_link);
		$('#link_logo').attr("href", carrito_link);
		$('#link_titulo').attr("href", carrito_link);
	}


	function cambiar_cantidad_producto(btn_elem
	, p_id
	, p_variedad
	, p_variedad_2 = null
	, p_variedad_3 = null
	, p_variedad_4 = null
	, p_variedad_5 = null
	, p_variedad_6 = null
	, p_variedad_7 = null
	, p_variedad_8 = null
	, p_variedad_9 = null
	, p_variedad_10 = null
	, p_variedad_11 = null
	, p_variedad_12 = null
	){
		const btn_jq = $(btn_elem);
		const current_value = parseFloat($(btn_elem).html());
		const producto = dame_producto(p_id);	

		var input_type = "number";
		if(!Number.isInteger(producto.step))
		{
			input_type = "text";
		}

		Swal.fire({
			text: 'Nueva cantidad',
			input: input_type,
			inputValue: current_value,
			validationMessage: 'Debe ingresar un número',
			buttonsStyling: false,
			color: '#AA282C',
			background: '#E59396',
			customClass: {
				confirmButton: 'btn my-btn-auxiliar',
				cancelButton: 'btn'
			}
		}).then(function(result) {
		if (result.value) 
		{
			result.value = result.value.replace(',', '.');

			if(isNaN(result.value)){


			}else{

				if(!result.value)
				{
					result.value = 1;
				}
				
				var new_value = parseFloat(result.value);

				if(new_value<0){
					new_value = 0;
				}

				// console.log('current_value', current_value);
				// console.log('new_value', new_value);

				no_calcular = true;

				if(new_value>current_value){

					// Swal.fire('Tengo que agregar: ' + (new_value - current_value) );

					for (let i = 0; i < ((new_value - current_value) / producto.step); i ++) 
					{				
						if( (i+1) >= ((new_value - current_value) / producto.step))
						{
							// console.log('este es el último');
							no_calcular = false;
						}	

						agregar_al_pedido(p_id
						, p_variedad
						, p_variedad_2
						, p_variedad_3
						, p_variedad_4
						, p_variedad_5
						, p_variedad_6
						, p_variedad_7
						, p_variedad_8
						, p_variedad_9
						, p_variedad_10
						, p_variedad_11
						, p_variedad_12
						);
					}

					btn_jq.html(new_value);					
					
				}else if(new_value < current_value){
					// Swal.fire('Tengo que quitar: ' + (current_value - new_value) );

					for (let i = 0; i < ((current_value - new_value) / producto.step); i++) 
					{	
						if( (i + 1) >= ((current_value - new_value) / producto.step) )
						{
							// console.log('este es el último');
							no_calcular = false;
						}	

						quitar_del_pedido(p_id
						, p_variedad
						, p_variedad_2
						, p_variedad_3
						, p_variedad_4
						, p_variedad_5
						, p_variedad_6
						, p_variedad_7
						, p_variedad_8
						, p_variedad_9
						, p_variedad_10
						, p_variedad_11
						, p_variedad_12
						);
					}

					btn_jq.html(new_value);	
					
				}else{
					// Swal.fire('Dejo igual');
					
				}

				no_calcular = false;
				calcular_total();

			}

		}
		});

		return false;
	}


	function dame_html_variantes(variedades_array, p_id, variante_nro, moneda_signo, ocultar_precios)
	{		
		console.log('variedades_array', variedades_array);
		console.log('p_id', p_id);
		console.log('variante_nro', variante_nro);
		
		var producto = dame_producto(p_id);
		// console.log('producto', producto);

		variedades_actuales = [];

		variedades_html = "<div style='display:flex; flex-direction: column;'>";
		var variedades_estilo = "";

		variedades_array.forEach(function(variedad, varposidx) {

			var monto_a_sumar = 0;
			if(variedad.nombre.indexOf("{") != -1 && variedad.nombre.indexOf("}") != -1)
			{
				var monto_a_sumar = variedad.nombre.substring(
					variedad.nombre.lastIndexOf("{") + 1, 
					variedad.nombre.lastIndexOf("}")
				);
				if(monto_a_sumar=="") { 
					monto_a_sumar = 0; 
				}else{
					monto_a_sumar = monto_a_sumar.trim();
					monto_a_sumar = parseFloat(monto_a_sumar); 
					variedad.nombre = variedad.nombre.substring(0, variedad.nombre.lastIndexOf("{"));
					variedad.nombre = variedad.nombre.trim();
				}
			}
			variedad.monto_a_sumar = monto_a_sumar;

			console.log('varposidx', varposidx);
			console.log('variedad', variedad);


			if(!variedad.variedadestilo)
			{
				variedad.variedadestilo = "NORMAL";
			}

			// Si la primer variante tiene precios distintos, solo
			// tengo la selección común (no se aceptan precios distintos
			// en las opciones HASTA o HASTA COMPLETAR)
			if(producto.tiene_precios_diferentes && variante_nro==0)
			{
				variedad.variedadestilo = "NORMAL";
			}

			var var_nombre = variedad.nombre.trim();
			var var_total = variedad.variedadtotal;
			var var_estilo = variedad.variedadestilo;

			if(variante_nro>0){

			}

			// Reviso el Stock
			var tiene_stock = true;
			var var_nombre_mostrar = var_nombre;


            if(variedad.variedadrender)
            {
                // split variedad.variedadrender by ;;;
                console.log('variedad.variedadrender', variedad.variedadrender);
                var variedad_render_array = variedad.variedadrender.split(";;;");

                if(variedad_render_array.length > varposidx)
                {
                    var_nombre_mostrar = variedad_render_array[varposidx];
                }
            }


			if (g_stock && g_stock.stock && g_stock.stock.length>0)
			{				
				var variedades_seleccionadas_temp = variedades_seleccionadas.slice();
				variedades_seleccionadas_temp.push(var_nombre);
				var producto_id_stock = dame_producto_id_stock(producto, variedades_seleccionadas_temp);
				// console.log('producto id stock', producto_id_stock);

				stock_actual = dame_stock(producto_id_stock);
				if(stock_actual)
				{
					if(stock_actual.stock <= stock_actual.stockinferior){
						tiene_stock = false;
						var_nombre_mostrar = var_nombre_mostrar + ' (sin stock)';

					}else{

						if(stock_actual.stockinfinito){

							// Cuando el stock es 999999 no pongo nada
							
						}else{

							if(g_control_mostrar_stock_disponible)
							{
								var_nombre_mostrar = var_nombre_mostrar + ' ('+ stock_actual.stock + ' disponible/s)';
							}

						}


					}
				}

				
			}

			// console.log('nombre: ', var_nombre);
			// console.log('variedadestilo: ', var_estilo);
			// console.log('variedadtotal: ', var_total);

			variedades_actuales.push({
				variedad: var_nombre,
				total: var_total,
				cantidad: 0,
				monto_a_sumar: monto_a_sumar
			});

			if(variedades_estilo=="")
			{
				variedades_estilo = var_estilo;
			}

			if(variedad.variedadestilo=="NORMAL"){


				// Si tiene precios diferentes entonces en cada variedad muestro el precio
				if (producto.tiene_precios_diferentes) {

					// Solo la primer variedad puede tener precio
					if(ocultar_precios || variante_nro > 0){

						if(variedad.monto_a_sumar > 0){

							html_boton = var_nombre_mostrar + ' +$' +  formatear_moneda(variedad.monto_a_sumar) + '	';

						}else{

							html_boton = var_nombre_mostrar;

						}

					}else{

						var precio_imprimir = moneda_signo + variedad.precio_mostrar;

						// Si el precio tiene descuento
						if(variedad.precioanterior)
						{
							precio_imprimir = '<div style="display: flex;flex-direction: column;text-align: right;">\
								<div>\
									<span style="vertical-align: middle;">'+ moneda_signo + variedad.precio_mostrar +'</span>\
								</div>\
								<span class="producto_descuento_variedad" style="font-size: 0.75rem;text-align: right;">('+ variedad.descuento +'% OFF)</span>\
								<span style="display:none; font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;">'+ moneda_signo + variedad.precioanterior_mostrar +'</span>\
							</div>';
						}

						html_boton = "<span class='float-left'>" + var_nombre_mostrar + "</span><span class='float-right' style='margin-left:8px;'>" + precio_imprimir + "</span>";

					}

				}else{

					if(variedad.monto_a_sumar > 0){

						html_boton = var_nombre_mostrar + ' +$' +  formatear_moneda(variedad.monto_a_sumar) + '	';

					}else{

						html_boton = var_nombre_mostrar;

					}


				}

				variedades_extra_clase = "";
				variedades_extra_atributos = "";

				if (variedad && variedad.nombre && variedad.nombre.toLowerCase().indexOf('sin stock')>=0)
				{
					variedades_extra_clase = " sin-stock ";
					variedades_extra_atributos = " disabled ";

				}else if(!tiene_stock){

					variedades_extra_clase = " sin-stock ";
					variedades_extra_atributos = " disabled ";

				}

				variedades_html = variedades_html + "<button "+ variedades_extra_atributos + " class='btn btn-variedad"+ variedades_extra_clase + "' onclick='pre_agregar_al_pedido(\""+ p_id + "\",\""+ variedad.nombre + "\", "+ monto_a_sumar +")'>" + html_boton  + "</button>";


			}else if(variedad.variedadestilo=="HASTA"){

				
				if(variedad.monto_a_sumar > 0){

					html_boton = var_nombre_mostrar + ' +$' +  formatear_moneda(variedad.monto_a_sumar) + '	';

				}else{

					html_boton = var_nombre_mostrar;

				}				

				variedades_extra_clase = "";
				variedades_extra_atributos = "";

				if (variedad && variedad.nombre && variedad.nombre.toLowerCase().indexOf('sin stock')>=0) {
					variedades_extra_clase = " sin-stock ";
					variedades_extra_atributos = " disabled ";

				}else if(!tiene_stock){
					variedades_extra_clase = " sin-stock ";
					variedades_extra_atributos = " disabled ";

				}

				variedad.cantidad = 1;

				variedades_html = variedades_html + '<div style="display:flex;justify-content:space-between;align-items:center;"><span onclick="return false;" style="width:100%;">' + html_boton + "</span><input "+ variedades_extra_atributos + " id='variedad_item_checkbox_"+ variedades_actuales.length +"' onchange='(this.checked ? agregar_variedad_actual(\""+ variedad.nombre +"\", \""+ variedad.variedadestilo +"\") : quitar_variedad_actual(\""+ variedad.nombre +"\", \""+ variedad.variedadestilo +"\") )' style='width: 25px;margin-left: 10px;' type=checkbox class='form-control "+ variedades_extra_clase + "'></div>";

			}else if(variedad.variedadestilo=="HASTA COMPLETAR"){

				if(variedad.monto_a_sumar > 0){

					html_boton = var_nombre_mostrar + ' +$' +  formatear_moneda(variedad.monto_a_sumar) + '	';

				}else{

					html_boton = var_nombre_mostrar;

				}

				variedades_extra_clase = "";
				variedades_extra_atributos = "";

				if (variedad && variedad.nombre && variedad.nombre.toLowerCase().indexOf('sin stock')>=0) {
					variedades_extra_clase = " sin-stock ";
					variedades_extra_atributos = " disabled ";

				}else if(!tiene_stock){
					variedades_extra_clase = " sin-stock ";
					variedades_extra_atributos = " disabled ";

				}

				v_html_boton = "<div class='btn-group float-right botonera-productos-qty' style='padding-left: 10px;'>";					
					v_html_boton += "<button "+ variedades_extra_atributos +" class='"+ variedades_extra_clase +" btn botonera-productos-qty-less' onclick=\"quitar_variedad_actual('"+ variedad.nombre +"', '"+ variedad.variedadestilo +"')\" style=''>-</button>";
					v_html_boton += "<input onchange=\"agregar_quitar_variedad_actual(event, '"+ variedad.nombre +"', '"+ variedad.variedadestilo +"')\" size=4 id='variedad_item_cantidad_"+ variedades_actuales.length +"' "+ variedades_extra_atributos +" class='"+ variedades_extra_clase +" btn botonera-productos-qty-middle' onclick='' value='0'>";					
					v_html_boton += "<button "+ variedades_extra_atributos +" class='"+ variedades_extra_clase +" btn botonera-productos-qty-more' onclick=\"agregar_variedad_actual('"+ variedad.nombre +"', '"+ variedad.variedadestilo +"')\">+</button>";
				v_html_boton += "</div>";



				variedades_html = variedades_html + '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;"><span>' + html_boton + "</span>"+ v_html_boton +"</div>";
				
				
			}				

			
		});
		
		variedades_html += '</div>';
		

		if(variedades_estilo != "NORMAL"){
			variedades_html = variedades_html + "<button id='variedad_actual_continuar_btn' style='margin-top:10px;' disabled class='btn btn-block my-btn-primary' onclick='buscar_seleccionadas_y_agregar("+ p_id +", \""+ variedades_estilo +"\")'>Continuar</button>";
		}




		return variedades_html;

		
	}




	function agregar_quitar_variedad_actual(event, variedad, estilo)
	{
		var idx_buscado = buscar_variedad_actual_idx(variedad);
		var nueva_cantidad = event.target.value;
		if(nueva_cantidad==''){ nueva_cantidad = 0; }
		try {
			nueva_cantidad = parseInt(nueva_cantidad);
		} catch (error) {
			nueva_cantidad = 0;
		}
		if(nueva_cantidad<0){
			nueva_cantidad = 0;
		}

		var llego_al_tope = false;

		seleccionados = contar_variedad_actual_seleccionados();
		var todos_menos_actual = seleccionados - variedades_actuales[idx_buscado].cantidad;

		if((nueva_cantidad + todos_menos_actual) <= variedades_actuales[idx_buscado].total || variedades_actuales[idx_buscado].total==-1){
			variedades_actuales[idx_buscado].cantidad = nueva_cantidad;
		}else{			
			$("#variedad_item_checkbox_"+ (idx_buscado +1)).prop("checked", false);
		}
		
		seleccionados = contar_variedad_actual_seleccionados();
		if(seleccionados >= variedades_actuales[idx_buscado].total){
			llego_al_tope = true;

		}

		console.log('casa', "#variedad_item_cantidad_" + (idx_buscado +1));
		$("#variedad_item_cantidad_" + (idx_buscado +1)).val(variedades_actuales[idx_buscado].cantidad);

		// console.log('variedad_buscada', variedades_actuales[idx_buscado]);

		if(estilo=="HASTA COMPLETAR"){

			if(variedades_actuales[idx_buscado].total==-1){
				$("#variedad_actual_continuar_btn").attr("disabled", false);
				$("#variedad_actual_continuar_btn").html('Continuar ('+ seleccionados +')');

			}else{
				$("#variedad_actual_continuar_btn").attr("disabled", !llego_al_tope);
				$("#variedad_actual_continuar_btn").html('Continuar ('+ seleccionados +'/'+ variedades_actuales[idx_buscado].total +')');

			}

		}else{
			$("#variedad_actual_continuar_btn").attr("disabled", seleccionados==0);
			$("#variedad_actual_continuar_btn").html('Continuar (hasta '+ variedades_actuales[idx_buscado].total +')');

		}

	}

	function agregar_variedad_actual(variedad, estilo)
	{
		var idx_buscado = buscar_variedad_actual_idx(variedad);

		var llego_al_tope = false;

		var seleccionados = contar_variedad_actual_seleccionados();

		if(seleccionados < variedades_actuales[idx_buscado].total || variedades_actuales[idx_buscado].total==-1){
			variedades_actuales[idx_buscado].cantidad++;
		}else{			
			$("#variedad_item_checkbox_"+ (idx_buscado +1)).prop("checked", false);
		}
		
		seleccionados = contar_variedad_actual_seleccionados();
		if(seleccionados >= variedades_actuales[idx_buscado].total){
			llego_al_tope = true;

		}

		$("#variedad_item_cantidad_" + (idx_buscado +1)).val(variedades_actuales[idx_buscado].cantidad);

		// console.log('variedad_buscada', variedades_actuales[idx_buscado]);

		if(estilo=="HASTA COMPLETAR"){

			if(variedades_actuales[idx_buscado].total==-1){
				$("#variedad_actual_continuar_btn").attr("disabled", false);
				$("#variedad_actual_continuar_btn").html('Continuar ('+ seleccionados +')');

			}else{
				$("#variedad_actual_continuar_btn").attr("disabled", !llego_al_tope);
				$("#variedad_actual_continuar_btn").html('Continuar ('+ seleccionados +'/'+ variedades_actuales[idx_buscado].total +')');

			}

		}else{
			$("#variedad_actual_continuar_btn").attr("disabled", seleccionados==0);
			$("#variedad_actual_continuar_btn").html('Continuar (hasta '+ variedades_actuales[idx_buscado].total +')');

		}

	}


	function quitar_variedad_actual(variedad, estilo)
	{
		var idx_buscado = buscar_variedad_actual_idx(variedad);
		
		var deshabilitar = false;

		if(variedades_actuales[idx_buscado].cantidad>0)
		{
			variedades_actuales[idx_buscado].cantidad--;				
		}

		var seleccionados = contar_variedad_actual_seleccionados();
		if(seleccionados < variedades_actuales[idx_buscado].total){
			deshabilitar = true;
		}
		
		$("#variedad_item_cantidad_" + (idx_buscado +1)).val(variedades_actuales[idx_buscado].cantidad);

		// console.log('variedad_buscada', variedades_actuales[idx_buscado]);

		if(estilo=="HASTA COMPLETAR"){
		
			if(variedades_actuales[idx_buscado].total==-1){
				$("#variedad_actual_continuar_btn").attr("disabled", false);
				$("#variedad_actual_continuar_btn").html('Continuar ('+ seleccionados +')');

			}else{
				$("#variedad_actual_continuar_btn").attr("disabled", deshabilitar);
				$("#variedad_actual_continuar_btn").html('Continuar ('+ seleccionados +'/'+ variedades_actuales[idx_buscado].total +')');

			}
		}else{
			$("#variedad_actual_continuar_btn").attr("disabled", seleccionados==0);
			$("#variedad_actual_continuar_btn").html('Continuar (hasta '+ variedades_actuales[idx_buscado].total +')');

		}

	}

	function buscar_variedad_actual_idx(variedad)
	{
		var i = 0;
		var idx_buscado = -1;
		while(idx_buscado==-1 && i<variedades_actuales.length)
		{
			variedad = variedad.trim();
			if(variedades_actuales[i].variedad==variedad)
			{
				idx_buscado = i;
			}

			i++;
		}

		return idx_buscado;
	}

	function contar_variedad_actual_seleccionados()
	{
		var i = 0;
		var total_seleccionados = 0;
		while(i<variedades_actuales.length)
		{
			total_seleccionados = total_seleccionados + variedades_actuales[i].cantidad;
			i++;
		}

		return total_seleccionados;
	}

	function buscar_seleccionadas_y_agregar(product_id, estilo)
	{
		var texto_final = "";

		var i = 0;
		var monto_a_sumar = 0;
		while(i<variedades_actuales.length)
		{
			var actual = variedades_actuales[i];

			if(actual.cantidad>0){
				
				actual.variedad = actual.variedad.trim();

				if(texto_final!=""){
					texto_final += ', ';
				}

				// texto_final += actual.cantidad +' x '+ actual.variedad;
				if(estilo=="HASTA"){
					texto_final += actual.variedad;
					
				}else{
					texto_final += actual.variedad + ' ('+ actual.cantidad +')';

				}

				monto_a_sumar += actual.monto_a_sumar * actual.cantidad;
			}
			i++;
		}

		// console.log(texto_final);

		pre_agregar_al_pedido(product_id, texto_final, monto_a_sumar);
	}


	function isMobile() 
	{
		try{ 
			document.createEvent("TouchEvent"); 
			return true; 
		}catch(e){ 
			return false; 
		}
	}

	function dame_stock(stock_id)
	{
		var stock = null;

		if(g_stock && g_stock.stock && g_stock.stock.length>0)
		{
			var i = 0;
			while( stock==null && i<g_stock.stock.length)
			{
				var actual = g_stock.stock[i];
				if(actual.id.toUpperCase()==stock_id.toUpperCase())
				{
					stock = actual;
				}
				i++;
			}
		}

		// console.log('stock: ', stock);

		return stock;
	}
	
	function dame_producto_id_stock(producto, variedades_selec)
	{		
		variedades_select = trim_all(variedades_selec);

		// console.log('dame_producto_id_stock prod', producto);
		// console.log('dame_producto_id_stock select', variedades_selec);
		var variedades_seleccionadas_nombre = variedades_selec.join(' ');
		if(variedades_selec.length>0){
			variedades_seleccionadas_nombre = ' ' + variedades_seleccionadas_nombre;
		}
		return producto.nombre + variedades_seleccionadas_nombre + producto.descripcion;
		
	}

	function trim_all(a)
	{
		for (var i = 0; i < a.length; i++) 
		{
			a[i] = a[i].trim();
		}

		return a;
	}

	function dame_variedades_seleccionadas(producto)
	{
		var prod_vars = [];
		var var_temp='';

		var_temp = producto.variedad;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad2;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad3;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad4;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad5;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad6;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad7;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad8;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad9;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad10;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad11;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		var_temp = producto.variedad12;
		if(var_temp){ var_temp.trim(); prod_vars.push(var_temp); }
		
		return prod_vars;
	}


	function openNav() {
		document.getElementById("mySidenav").style.width = "350px";
	}

	function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
	}

	function goToByScroll(id) {
		try {
		
			$('html,body').animate({
				scrollTop: $("#" + id).offset().top - 82
			}, 'slow');
			
		} catch (error) {	
		}
		
	}

	function mostrar_aviso(mensaje)
	{
		Swal.fire({
			html: mensaje,
			icon: 'success',
			buttonsStyling: false,
			color: '#AA282C',
			background: '#E59396',
			customClass: {
				confirmButton: 'btn my-btn-auxiliar',
				cancelButton: 'btn'
			}
		});
	}

	function mostrar_aviso_error(mensaje)
	{
		Swal.fire({
			html: mensaje,
			icon: 'error',
			buttonsStyling: false,
			color: '#AA282C',
			background: '#E59396',
			customClass: {
				confirmButton: 'btn my-btn-auxiliar',
				cancelButton: 'btn'
			}
		});
	}

    function abrirURLPopup(url) {
        $.fancybox.open({
        src: url,
        type: 'iframe',
        // Opciones de Fancybox aquí
        });
    }

    function check_ig_user_agent()
    {
        var isInstagram = navigator.userAgent.match(/instagram/i) != null;

        return isInstagram;
    }

    function open_popup_if_instagram()
    {
        if(check_ig_user_agent())
        {
            $.fancybox.open({
                src: '.popup_instagram',
                type: 'inline'
            });
        }else{
            console.log('No es instagram');
        }

    }

    function copiar_link_instagram(){

        $.fancybox.close();

        var copyText = document.getElementById("input_instagram_link").value;
        copyTextToClipboard(copyText);
        Swal.fire({
            text: 'Link copiado al portapapeles',
            icon: 'success',
            buttonsStyling: false,
            color: '#AA282C',
            background: '#E59396',
            customClass: {
                confirmButton: 'btn my-btn-auxiliar',
                cancelButton: 'btn'
            }
        });
    }

	</script>

</body>

</html>
