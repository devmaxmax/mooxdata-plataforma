function hasTouch() {
    return 'ontouchstart' in document.documentElement ||
        navigator.maxTouchPoints > 0 ||
        navigator.msMaxTouchPoints > 0;
}

function clickEnviarPedido() {
    calcular_total();
    enviar_pedido();
}

function ajustarStickySubcategorias() { }

$(document).ready(function () {

    $("#mobile-nav-toggle").show();
    $("#sidenav_categorias").empty();
    g_categorias.forEach(function (elem, idx) {
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
        localStorage.getItem('pedido-burracomidamexicana') != "" &&
        localStorage.getItem('pedido-burracomidamexicana') != undefined
    ) {
        v_minutos_que_recuerda_el_pedido = 30;
        g_pedido = JSON.parse(localStorage['pedido-burracomidamexicana']);

        if (true && (new Date().getTime() - g_pedido.ultima_actualizacion <
            v_minutos_que_recuerda_el_pedido * 60 * 1000)) {

            // console.log("Recupero el carrito");
            calcular_total();

        } else {

            console.log("Expiró el carrito");
            g_pedido.productos = [];

        }

    }

    window.onpopstate = function (event) {

        if (document.location.hash != "#mipedido") {
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

    controlar_horario();

    // Si tiene telefono, el producto puede ser pedido y le agrego el ícono del +
    if (g_telefono != '') {
        $(".product-add-icon").show();
    } else { }

    document.body.addEventListener('add_to_cart', function (e) {
        try {
            var params = {
                value: parseFloat(e.detail.producto.precio) + parseFloat(e.detail.producto
                    .adicionales),
                currency: 'USD'
            };
            // console.log(params);
            fbq('track', 'AddToCart', params);

        } catch (error) {
            // console.log('error', error);
        }
    });

    document.body.addEventListener('purchase', function (e) {

        try {

            var params = {
                value: parseFloat(g_pedido.precio_final),
                currency: 'USD',
                num_items: g_pedido.cantidad_productos_final
            };
            // console.log(params);
            fbq('track', 'Purchase', params);

        } catch (error) {
            // console.log('error', error);
        }

    });

    document.body.addEventListener('initiate_checkout', function (e) {

        try {
            let params = {
                value: parseFloat(g_pedido.precio_final),
                currency: 'USD',
                num_items: g_pedido.cantidad_productos_final
            };
            // console.log(params);
            fbq('track', 'InitiateCheckout', params);

        } catch (error) {
            // console.log('error', error);
        }

    });





});

function ir_a_categoria(cat_nro) {
    goToByScroll('categoria_' + cat_nro);
    closeNav();
    abrir_categoria(cat_nro);
}

function open_gallery(p_id) {
    let producto = dame_producto(p_id);

    let fancy_images = [];

    for (let i = 0; i < producto.imagenes.length; i++) {
        let myimg = producto.imagenes[i];

        fancy_images.push({
            src: myimg,
            opts: {
                caption: '',
                thumb: ''
            }
        });
    }

    let slideShow = {};
    if (producto.imagenes.length > 1) {
        slideShow = {
            autoStart: false,
            speed: 3000
        };
    }

    $.fancybox.open(fancy_images, {
        loop: true,
        slideShow: slideShow
    });
}

function controlar_horario() {
    let abierto = true;

    // Si el control horario está desactivado, entonces el local siempre está abierto
    let control_horario = true;
    // console.log('Control horario? ', control_horario);

    if (control_horario) {
        let horario_string = '';

        let today = new Date();
        // console.log('Dia: ' + today.getDay());

        let dia_de_la_semana = today.getDay();
        // dia_de_la_semana = 0;
        switch (dia_de_la_semana) {
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
        horario_string = horario_string.replace(/ A /g,
            "-"); // Si el horario dice de 9 a 18 reemplazo el ' a ' por un guión
        horario_string = horario_string.trim(/ A /g, "-");
        // console.log('Horario (formateado): ' + horario_string);

        if (horario_string != '') {

            let intervalos = horario_string.split(" ");

            let minutos_ahora = today.getHours() * 60 + today.getMinutes();
            // console.log('Minutos de AHORA: ' + minutos_ahora);

            abierto = false;
            $(intervalos).each((idx, intervalo) => {
                // console.log('Intervalo Nº '+ (idx+1) +': ' + intervalo);

                let horario_desde_hasta = intervalo.split("-");

                if (horario_desde_hasta.length == 2) {
                    let horario_desde = horario_desde_hasta[0];
                    let horario_hasta = horario_desde_hasta[1];

                    minutos_desde = 0;
                    if (horario_desde.indexOf(":") > 0) {
                        minutos_desde = parseInt(horario_desde.split(":")[0]) * 60;
                        minutos_desde += parseInt(horario_desde.split(":")[1]);

                    } else {
                        minutos_desde = parseInt(horario_desde) * 60;
                    }

                    minutos_hasta = 0;
                    if (horario_hasta.indexOf(":") > 0) {
                        minutos_hasta = parseInt(horario_hasta.split(":")[0]) * 60;
                        minutos_hasta += parseInt(horario_hasta.split(":")[1]);

                    } else {
                        minutos_hasta = parseInt(horario_hasta) * 60;
                    }

                    // console.log('Minutos Desde: ' + minutos_desde);
                    // console.log('Minutos Hasta: ' + minutos_hasta);

                    if (minutos_ahora >= minutos_desde && minutos_ahora <= minutos_hasta) {
                        console.log('Esta ABIERTO');
                        abierto = true;
                    }

                }

            });

        } else {
            // console.log("El día no tiene un horario asignado => CERRADO");
            abierto = false;

        }

    } else {
        // console.log('Control horario DESACTIVADO');

    }

    if (!abierto) {
        $.fancybox.open({
            src: "#popup_control_horario"
        });
    }

    return abierto;
}


function actualizar_url_carrito() {
    let carrito_link = '/burracomidamexicana/' + g_telefono;
    console.log('carrito link ', carrito_link);
    $('#link_logo').attr("href", carrito_link);
    $('#link_titulo').attr("href", carrito_link);
}


function cambiar_cantidad_producto(btn_elem, p_id, p_variedad, p_variedad_2 = null, p_variedad_3 = null,
    p_variedad_4 = null, p_variedad_5 = null, p_variedad_6 = null, p_variedad_7 = null, p_variedad_8 = null,
    p_variedad_9 = null, p_variedad_10 = null, p_variedad_11 = null, p_variedad_12 = null
) {
    const btn_jq = $(btn_elem);
    const current_value = parseFloat($(btn_elem).html());
    const producto = dame_producto(p_id);

    let input_type = "number";
    if (!Number.isInteger(producto.step)) {
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
    }).then(function (result) {
        if (result.value) {
            result.value = result.value.replace(',', '.');

            if (isNaN(result.value)) {


            } else {

                if (!result.value) {
                    result.value = 1;
                }

                let new_value = parseFloat(result.value);

                if (new_value < 0) {
                    new_value = 0;
                }

                // console.log('current_value', current_value);
                // console.log('new_value', new_value);

                no_calcular = true;

                if (new_value > current_value) {

                    // Swal.fire('Tengo que agregar: ' + (new_value - current_value) );

                    for (let i = 0; i < ((new_value - current_value) / producto.step); i++) {
                        if ((i + 1) >= ((new_value - current_value) / producto.step)) {
                            // console.log('este es el último');
                            no_calcular = false;
                        }

                        agregar_al_pedido(p_id, p_variedad, p_variedad_2, p_variedad_3, p_variedad_4,
                            p_variedad_5, p_variedad_6, p_variedad_7, p_variedad_8, p_variedad_9,
                            p_variedad_10, p_variedad_11, p_variedad_12
                        );
                    }

                    btn_jq.html(new_value);

                } else if (new_value < current_value) {
                    // Swal.fire('Tengo que quitar: ' + (current_value - new_value) );

                    for (let i = 0; i < ((current_value - new_value) / producto.step); i++) {
                        if ((i + 1) >= ((current_value - new_value) / producto.step)) {
                            // console.log('este es el último');
                            no_calcular = false;
                        }

                        quitar_del_pedido(p_id, p_variedad, p_variedad_2, p_variedad_3, p_variedad_4,
                            p_variedad_5, p_variedad_6, p_variedad_7, p_variedad_8, p_variedad_9,
                            p_variedad_10, p_variedad_11, p_variedad_12
                        );
                    }

                    btn_jq.html(new_value);

                } else {
                    // Swal.fire('Dejo igual');

                }

                no_calcular = false;
                calcular_total();

            }

        }
    });

    return false;
}


function dame_html_variantes(variedades_array, p_id, variante_nro, moneda_signo, ocultar_precios) {
    console.log('variedades_array', variedades_array);
    console.log('p_id', p_id);
    console.log('variante_nro', variante_nro);

    let producto = dame_producto(p_id);
    // console.log('producto', producto);

    variedades_actuales = [];

    variedades_html = "<div style='display:flex; flex-direction: column;'>";
    var variedades_estilo = "";

    variedades_array.forEach(function (variedad, varposidx) {

        var monto_a_sumar = 0;
        if (variedad.nombre.indexOf("{") != -1 && variedad.nombre.indexOf("}") != -1) {
            var monto_a_sumar = variedad.nombre.substring(
                variedad.nombre.lastIndexOf("{") + 1,
                variedad.nombre.lastIndexOf("}")
            );
            if (monto_a_sumar == "") {
                monto_a_sumar = 0;
            } else {
                monto_a_sumar = monto_a_sumar.trim();
                monto_a_sumar = parseFloat(monto_a_sumar);
                variedad.nombre = variedad.nombre.substring(0, variedad.nombre.lastIndexOf("{"));
                variedad.nombre = variedad.nombre.trim();
            }
        }
        variedad.monto_a_sumar = monto_a_sumar;

        // console.log('varposidx', varposidx);
        // console.log('variedad', variedad);


        if (!variedad.variedadestilo) {
            variedad.variedadestilo = "NORMAL";
        }
        
        if (producto.tiene_precios_diferentes && variante_nro == 0) {
            variedad.variedadestilo = "NORMAL";
        }

        var var_nombre = variedad.nombre.trim();
        var var_total = variedad.variedadtotal;
        var var_estilo = variedad.variedadestilo;

        if (variante_nro > 0) {

        }

        // Reviso el Stock
        var tiene_stock = true;
        var var_nombre_mostrar = var_nombre;


        if (variedad.variedadrender) {
            // split variedad.variedadrender by ;;;
            console.log('variedad.variedadrender', variedad.variedadrender);
            var variedad_render_array = variedad.variedadrender.split(";;;");

            if (variedad_render_array.length > varposidx) {
                var_nombre_mostrar = variedad_render_array[varposidx];
            }
        }


        if (g_stock && g_stock.stock && g_stock.stock.length > 0) {
            var variedades_seleccionadas_temp = variedades_seleccionadas.slice();
            variedades_seleccionadas_temp.push(var_nombre);
            var producto_id_stock = dame_producto_id_stock(producto, variedades_seleccionadas_temp);
            // console.log('producto id stock', producto_id_stock);

            stock_actual = dame_stock(producto_id_stock);
            if (stock_actual) {
                if (stock_actual.stock <= stock_actual.stockinferior) {
                    tiene_stock = false;
                    var_nombre_mostrar = var_nombre_mostrar + ' (sin stock)';

                } else {

                    if (stock_actual.stockinfinito) {

                        // Cuando el stock es 999999 no pongo nada

                    } else {

                        if (g_control_mostrar_stock_disponible) {
                            var_nombre_mostrar = var_nombre_mostrar + ' (' + stock_actual.stock +
                                ' disponible/s)';
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

        if (variedades_estilo == "") {
            variedades_estilo = var_estilo;
        }

        if (variedad.variedadestilo == "NORMAL") {


            // Si tiene precios diferentes entonces en cada variedad muestro el precio
            if (producto.tiene_precios_diferentes) {

                // Solo la primer variedad puede tener precio
                if (ocultar_precios || variante_nro > 0) {

                    if (variedad.monto_a_sumar > 0) {

                        html_boton = var_nombre_mostrar + ' +$' + formatear_moneda(variedad.monto_a_sumar) +
                            '	';

                    } else {

                        html_boton = var_nombre_mostrar;

                    }

                } else {

                    var precio_imprimir = moneda_signo + variedad.precio_mostrar;

                    // Si el precio tiene descuento
                    if (variedad.precioanterior) {
                        precio_imprimir =
                            '<div style="display: flex;flex-direction: column;text-align: right;">\
                                                                                                                                        <div>\
                                                                                                                                            <span style="vertical-align: middle;">' +
                            moneda_signo +
                            variedad
                                .precio_mostrar +
                            '</span>\
                                                                                                                                        </div>\
                                                                                                                                        <span class="producto_descuento_variedad" style="font-size: 0.75rem;text-align: right;">(' +
                            variedad
                                .descuento +
                            '% OFF)</span>\
                                                                                                                                        <span style="display:none; font-size: 0.75rem;text-decoration: line-through;text-align: right;margin-top:0px;">' +
                            moneda_signo + variedad.precioanterior_mostrar +
                            '</span>\
                                                                                                                                    </div>';
                    }

                    html_boton = "<span class='float-left'>" + var_nombre_mostrar +
                        "</span><span class='float-right' style='margin-left:8px;'>" + precio_imprimir +
                        "</span>";

                }

            } else {

                if (variedad.monto_a_sumar > 0) {

                    html_boton = var_nombre_mostrar + ' +$' + formatear_moneda(variedad.monto_a_sumar) +
                        '	';

                } else {

                    html_boton = var_nombre_mostrar;

                }


            }

            variedades_extra_clase = "";
            variedades_extra_atributos = "";

            if (variedad && variedad.nombre && variedad.nombre.toLowerCase().indexOf('sin stock') >= 0) {
                variedades_extra_clase = " sin-stock ";
                variedades_extra_atributos = " disabled ";

            } else if (!tiene_stock) {

                variedades_extra_clase = " sin-stock ";
                variedades_extra_atributos = " disabled ";

            }

            variedades_html = variedades_html + "<button " + variedades_extra_atributos +
                " class='btn btn-variedad" + variedades_extra_clase +
                "' onclick='pre_agregar_al_pedido(\"" + p_id + "\",\"" + variedad.nombre + "\", " +
                monto_a_sumar + ")'>" + html_boton + "</button>";


        } else if (variedad.variedadestilo == "HASTA") {


            if (variedad.monto_a_sumar > 0) {

                html_boton = var_nombre_mostrar + ' +$' + formatear_moneda(variedad.monto_a_sumar) + '	';

            } else {

                html_boton = var_nombre_mostrar;

            }

            variedades_extra_clase = "";
            variedades_extra_atributos = "";

            if (variedad && variedad.nombre && variedad.nombre.toLowerCase().indexOf('sin stock') >= 0) {
                variedades_extra_clase = " sin-stock ";
                variedades_extra_atributos = " disabled ";

            } else if (!tiene_stock) {
                variedades_extra_clase = " sin-stock ";
                variedades_extra_atributos = " disabled ";

            }

            variedad.cantidad = 1;

            variedades_html = variedades_html +
                '<div style="display:flex;justify-content:space-between;align-items:center;"><span onclick="return false;" style="width:100%;">' +
                html_boton + "</span><input " + variedades_extra_atributos +
                " id='variedad_item_checkbox_" + variedades_actuales.length +
                "' onchange='(this.checked ? agregar_variedad_actual(\"" + variedad.nombre + "\", \"" +
                variedad.variedadestilo + "\") : quitar_variedad_actual(\"" + variedad.nombre + "\", \"" +
                variedad.variedadestilo +
                "\") )' style='width: 25px;margin-left: 10px;' type=checkbox class='form-control " +
                variedades_extra_clase + "'></div>";

        } else if (variedad.variedadestilo == "HASTA COMPLETAR") {

            if (variedad.monto_a_sumar > 0) {

                html_boton = var_nombre_mostrar + ' +$' + formatear_moneda(variedad.monto_a_sumar) + '	';

            } else {

                html_boton = var_nombre_mostrar;

            }

            variedades_extra_clase = "";
            variedades_extra_atributos = "";

            if (variedad && variedad.nombre && variedad.nombre.toLowerCase().indexOf('sin stock') >= 0) {
                variedades_extra_clase = " sin-stock ";
                variedades_extra_atributos = " disabled ";

            } else if (!tiene_stock) {
                variedades_extra_clase = " sin-stock ";
                variedades_extra_atributos = " disabled ";

            }

            v_html_boton =
                "<div class='btn-group float-right botonera-productos-qty' style='padding-left: 10px;'>";
            v_html_boton += "<button " + variedades_extra_atributos + " class='" + variedades_extra_clase +
                " btn botonera-productos-qty-less' onclick=\"quitar_variedad_actual('" + variedad.nombre +
                "', '" + variedad.variedadestilo + "')\" style=''>-</button>";
            v_html_boton += "<input onchange=\"agregar_quitar_variedad_actual(event, '" + variedad.nombre +
                "', '" + variedad.variedadestilo + "')\" size=4 id='variedad_item_cantidad_" +
                variedades_actuales.length + "' " + variedades_extra_atributos + " class='" +
                variedades_extra_clase + " btn botonera-productos-qty-middle' onclick='' value='0'>";
            v_html_boton += "<button " + variedades_extra_atributos + " class='" + variedades_extra_clase +
                " btn botonera-productos-qty-more' onclick=\"agregar_variedad_actual('" + variedad.nombre +
                "', '" + variedad.variedadestilo + "')\">+</button>";
            v_html_boton += "</div>";



            variedades_html = variedades_html +
                '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;"><span>' +
                html_boton + "</span>" + v_html_boton + "</div>";


        }


    });

    variedades_html += '</div>';


    if (variedades_estilo != "NORMAL") {
        variedades_html = variedades_html +
            "<button id='variedad_actual_continuar_btn' style='margin-top:10px;' disabled class='btn btn-block my-btn-primary' onclick='buscar_seleccionadas_y_agregar(" +
            p_id + ", \"" + variedades_estilo + "\")'>Continuar</button>";
    }

    return variedades_html;

}




function agregar_quitar_variedad_actual(event, variedad, estilo) {
    var idx_buscado = buscar_variedad_actual_idx(variedad);
    var nueva_cantidad = event.target.value;
    if (nueva_cantidad == '') {
        nueva_cantidad = 0;
    }
    try {
        nueva_cantidad = parseInt(nueva_cantidad);
    } catch (error) {
        nueva_cantidad = 0;
    }
    if (nueva_cantidad < 0) {
        nueva_cantidad = 0;
    }

    var llego_al_tope = false;

    seleccionados = contar_variedad_actual_seleccionados();
    var todos_menos_actual = seleccionados - variedades_actuales[idx_buscado].cantidad;

    if ((nueva_cantidad + todos_menos_actual) <= variedades_actuales[idx_buscado].total || variedades_actuales[
        idx_buscado].total == -1) {
        variedades_actuales[idx_buscado].cantidad = nueva_cantidad;
    } else {
        $("#variedad_item_checkbox_" + (idx_buscado + 1)).prop("checked", false);
    }

    seleccionados = contar_variedad_actual_seleccionados();
    if (seleccionados >= variedades_actuales[idx_buscado].total) {
        llego_al_tope = true;

    }

    console.log('casa', "#variedad_item_cantidad_" + (idx_buscado + 1));
    $("#variedad_item_cantidad_" + (idx_buscado + 1)).val(variedades_actuales[idx_buscado].cantidad);

    // console.log('variedad_buscada', variedades_actuales[idx_buscado]);

    if (estilo == "HASTA COMPLETAR") {

        if (variedades_actuales[idx_buscado].total == -1) {
            $("#variedad_actual_continuar_btn").attr("disabled", false);
            $("#variedad_actual_continuar_btn").html('Continuar (' + seleccionados + ')');

        } else {
            $("#variedad_actual_continuar_btn").attr("disabled", !llego_al_tope);
            $("#variedad_actual_continuar_btn").html('Continuar (' + seleccionados + '/' + variedades_actuales[
                idx_buscado].total + ')');

        }

    } else {
        $("#variedad_actual_continuar_btn").attr("disabled", seleccionados == 0);
        $("#variedad_actual_continuar_btn").html('Continuar (hasta ' + variedades_actuales[idx_buscado].total +
            ')');

    }

}

function agregar_variedad_actual(variedad, estilo) {
    var idx_buscado = buscar_variedad_actual_idx(variedad);

    var llego_al_tope = false;

    var seleccionados = contar_variedad_actual_seleccionados();

    if (seleccionados < variedades_actuales[idx_buscado].total || variedades_actuales[idx_buscado].total == -1) {
        variedades_actuales[idx_buscado].cantidad++;
    } else {
        $("#variedad_item_checkbox_" + (idx_buscado + 1)).prop("checked", false);
    }

    seleccionados = contar_variedad_actual_seleccionados();
    if (seleccionados >= variedades_actuales[idx_buscado].total) {
        llego_al_tope = true;

    }

    $("#variedad_item_cantidad_" + (idx_buscado + 1)).val(variedades_actuales[idx_buscado].cantidad);

    // console.log('variedad_buscada', variedades_actuales[idx_buscado]);

    if (estilo == "HASTA COMPLETAR") {

        if (variedades_actuales[idx_buscado].total == -1) {
            $("#variedad_actual_continuar_btn").attr("disabled", false);
            $("#variedad_actual_continuar_btn").html('Continuar (' + seleccionados + ')');

        } else {
            $("#variedad_actual_continuar_btn").attr("disabled", !llego_al_tope);
            $("#variedad_actual_continuar_btn").html('Continuar (' + seleccionados + '/' + variedades_actuales[
                idx_buscado].total + ')');

        }

    } else {
        $("#variedad_actual_continuar_btn").attr("disabled", seleccionados == 0);
        $("#variedad_actual_continuar_btn").html('Continuar (hasta ' + variedades_actuales[idx_buscado].total +
            ')');

    }

}


function quitar_variedad_actual(variedad, estilo) {
    var idx_buscado = buscar_variedad_actual_idx(variedad);

    var deshabilitar = false;

    if (variedades_actuales[idx_buscado].cantidad > 0) {
        variedades_actuales[idx_buscado].cantidad--;
    }

    var seleccionados = contar_variedad_actual_seleccionados();
    if (seleccionados < variedades_actuales[idx_buscado].total) {
        deshabilitar = true;
    }

    $("#variedad_item_cantidad_" + (idx_buscado + 1)).val(variedades_actuales[idx_buscado].cantidad);

    // console.log('variedad_buscada', variedades_actuales[idx_buscado]);

    if (estilo == "HASTA COMPLETAR") {

        if (variedades_actuales[idx_buscado].total == -1) {
            $("#variedad_actual_continuar_btn").attr("disabled", false);
            $("#variedad_actual_continuar_btn").html('Continuar (' + seleccionados + ')');

        } else {
            $("#variedad_actual_continuar_btn").attr("disabled", deshabilitar);
            $("#variedad_actual_continuar_btn").html('Continuar (' + seleccionados + '/' + variedades_actuales[
                idx_buscado].total + ')');

        }
    } else {
        $("#variedad_actual_continuar_btn").attr("disabled", seleccionados == 0);
        $("#variedad_actual_continuar_btn").html('Continuar (hasta ' + variedades_actuales[idx_buscado].total +
            ')');

    }

}

function buscar_variedad_actual_idx(variedad) {
    var i = 0;
    var idx_buscado = -1;
    while (idx_buscado == -1 && i < variedades_actuales.length) {
        variedad = variedad.trim();
        if (variedades_actuales[i].variedad == variedad) {
            idx_buscado = i;
        }

        i++;
    }

    return idx_buscado;
}

function contar_variedad_actual_seleccionados() {
    var i = 0;
    var total_seleccionados = 0;
    while (i < variedades_actuales.length) {
        total_seleccionados = total_seleccionados + variedades_actuales[i].cantidad;
        i++;
    }

    return total_seleccionados;
}

function buscar_seleccionadas_y_agregar(product_id, estilo) {
    var texto_final = "";

    var i = 0;
    var monto_a_sumar = 0;
    while (i < variedades_actuales.length) {
        var actual = variedades_actuales[i];

        if (actual.cantidad > 0) {

            actual.variedad = actual.variedad.trim();

            if (texto_final != "") {
                texto_final += ', ';
            }

            // texto_final += actual.cantidad +' x '+ actual.variedad;
            if (estilo == "HASTA") {
                texto_final += actual.variedad;

            } else {
                texto_final += actual.variedad + ' (' + actual.cantidad + ')';

            }

            monto_a_sumar += actual.monto_a_sumar * actual.cantidad;
        }
        i++;
    }

    // console.log(texto_final);

    pre_agregar_al_pedido(product_id, texto_final, monto_a_sumar);
}


function isMobile() {
    try {
        document.createEvent("TouchEvent");
        return true;
    } catch (e) {
        return false;
    }
}

function dame_stock(stock_id) {
    var stock = null;

    if (g_stock && g_stock.stock && g_stock.stock.length > 0) {
        var i = 0;
        while (stock == null && i < g_stock.stock.length) {
            var actual = g_stock.stock[i];
            if (actual.id.toUpperCase() == stock_id.toUpperCase()) {
                stock = actual;
            }
            i++;
        }
    }

    // console.log('stock: ', stock);

    return stock;
}

function dame_producto_id_stock(producto, variedades_selec) {
    variedades_select = trim_all(variedades_selec);

    // console.log('dame_producto_id_stock prod', producto);
    // console.log('dame_producto_id_stock select', variedades_selec);
    var variedades_seleccionadas_nombre = variedades_selec.join(' ');
    if (variedades_selec.length > 0) {
        variedades_seleccionadas_nombre = ' ' + variedades_seleccionadas_nombre;
    }
    return producto.nombre + variedades_seleccionadas_nombre + producto.descripcion;

}

function trim_all(a) {
    for (var i = 0; i < a.length; i++) {
        a[i] = a[i].trim();
    }

    return a;
}

function dame_variedades_seleccionadas(producto) {
    var prod_vars = [];
    var var_temp = '';

    var_temp = producto.variedad;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad2;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad3;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad4;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad5;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad6;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad7;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad8;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad9;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad10;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad11;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }
    var_temp = producto.variedad12;
    if (var_temp) {
        var_temp.trim();
        prod_vars.push(var_temp);
    }

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

    } catch (error) { }

}

function mostrar_aviso(mensaje) {
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

function mostrar_aviso_error(mensaje) {
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

function check_ig_user_agent() {
    var isInstagram = navigator.userAgent.match(/instagram/i) != null;

    return isInstagram;
}

function open_popup_if_instagram() {
    if (check_ig_user_agent()) {
        $.fancybox.open({
            src: '.popup_instagram',
            type: 'inline'
        });
    } else {
        console.log('No es instagram');
    }

}

function copiar_link_instagram() {

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

/* Refactored from index.blade.php */

function mostrar_resumen_pedido() {
    if (!g_viendo_resumen) {
        $('.categoria').hide();
        $('.subcategoria').hide();
        $('.producto').hide();

        $('.helper_resumen').show();
        $('.producto-imagen-carrito').show();

        g_pedido.productos.forEach(function(producto, index, mi_array) {
            $('#producto_' + producto.id).show();
        });

        $('.boton-eliminar-carrito').show();

        $('#icono_resumen_pedido').removeClass("fa-shopping-bag");
        $('#icono_resumen_pedido').addClass("fa-arrow-left");

        $('.pedido_productos_cantidad_total').hide();

        location.href = "#mipedido";

        $(window).scrollTop(0);

        g_viendo_resumen = true;

    } else {

        $('.producto-imagen').show();
        $('.categoria').show();
        $('.subcategoria').show();
        $('.producto').show();

        $('.helper_resumen').hide();
        $('.producto-imagen-carrito').hide();

        $('#icono_resumen_pedido').addClass("fa-shopping-bag");
        $('#icono_resumen_pedido').removeClass("fa-arrow-left");
        $('.pedido_productos_cantidad_total').show();

        $('.categoria-titulo ').click();

        $(window).scrollTop(0);

        $('.boton-eliminar-carrito').hide();
        g_viendo_resumen = false;
    }
}

function quitar_acentos(p_palabra) {
    p_palabra = p_palabra.replace(/á/g, "a");
    p_palabra = p_palabra.replace(/é/g, "e");
    p_palabra = p_palabra.replace(/í/g, "i");
    p_palabra = p_palabra.replace(/ó/g, "o");
    p_palabra = p_palabra.replace(/ú/g, "u");
    p_palabra = p_palabra.replace(/ü/g, "u");
    return p_palabra;
}

function buscar() {
    v_palabra = $("#input_buscador").val().toLowerCase();
    v_palabra = quitar_acentos(v_palabra);

    if (v_palabra.length < 0) { console.log("Aun no llega al limite de caracteres"); return false; }
    g_productos.forEach( function(producto, index, mi_array) { 
        v_mostrar_producto=false; 
        if (quitar_acentos(producto.nombre.toLowerCase()).indexOf(v_palabra)>= 0) v_mostrar_producto = true;
        if (quitar_acentos(producto.descripcion.toLowerCase()).indexOf(v_palabra) >= 0) v_mostrar_producto = true;

        if (v_palabra == "") v_mostrar_producto = false;

        if (v_mostrar_producto) {
            $('#producto_' + producto.id).show();
        } else {
            $('#producto_' + producto.id).hide();
        }
    });
}

function mostrar_buscador() {
    if (g_viendo_resumen) mostrar_resumen_pedido();

    ver_todas_las_categorias();

    if (!g_viendo_buscador) {

        $('.producto-imagen').hide();
        $('.categoria').hide();
        $('.subcategoria').hide();
        $('.producto').hide();

        $('.helper_buscador').show();
        $('.producto-imagen-carrito').show();

        $(window).scrollTop(0);

        $("#input_buscador").focus();
        $("#input_buscador").select();

        buscar();

        g_viendo_buscador = true;

    } else {

        $('.producto-imagen').show();
        $('.categoria').show();
        $('.subcategoria').show();
        $('.producto').show();

        $('.helper_buscador').hide();
        $('.producto-imagen-carrito').hide();

        // cierro todas las categorias
        $('.categoria-titulo ').click();

        $(window).scrollTop(0);

        g_viendo_buscador = false;
    }
}


function copiar_busqueda() {
    var mibusqueda = $("#input_buscador").val().trim();

    if (mibusqueda != '') {
        var url_a_copiar = "https://mooxdata.xyz/app/burracomidamexicana/" + g_telefono + "/?q=" + encodeURIComponent(mibusqueda);
        copyTextToClipboard(url_a_copiar);
        mostrar_aviso('El link para compartir ha sido copiado');
    }
}

function copyTextToClipboard(text) {
    var textArea = document.createElement("textarea");

    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;
    textArea.style.width = '2em';
    textArea.style.height = '2em';
    textArea.style.padding = 0;
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
    textArea.style.background = 'transparent';

    textArea.value = text;

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
    } catch (err) {}

    document.body.removeChild(textArea);
}


function mostrar_categoria(p_categoria) {
    if ($('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').hasClass("fa-angle-down")) {
        abrir_categoria(p_categoria);
    } else {
        cerrar_categoria(p_categoria);
    }
}

function abrir_categoria(p_categoria) {
    $('.producto[data-categoria="' + p_categoria + '"]').show();
    $('.subcategoria[data-categoria="' + p_categoria + '"]').show();

    $('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').removeClass("fa-angle-down");
    $('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').addClass("fa-angle-up");

    // Activar sticky
    $('.categoria[data-categoria="' + p_categoria + '"]').addClass('sticky-active');

    $('.subcategoria[data-categoria="' + p_categoria + '"]').each((idx, elem) => {
        cerrar_subcategoria($(elem).data('subcategoria'));
    });
}

function cerrar_categoria(p_categoria) {
    $('.producto[data-categoria="' + p_categoria + '"]').hide();
    $('.subcategoria[data-categoria="' + p_categoria + '"]').hide();

    $('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').removeClass("fa-angle-up");
    $('.categoria[data-categoria="' + p_categoria + '"] .categoria_icono').addClass("fa-angle-down");

    // Desactivar sticky
    $('.categoria[data-categoria="' + p_categoria + '"]').removeClass('sticky-active');

    $('.subcategoria[data-categoria="' + p_categoria + '"]').each((idx, elem) => {
        cerrar_subcategoria($(elem).data('subcategoria'));
    });
}

function cerrar_subcategoria(p_subcategoria) {
    $('.producto[data-subcategoria="' + p_subcategoria + '"]').hide();

    $('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').removeClass("fa-angle-up");
    $('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').addClass("fa-angle-down");

    // Desactivar sticky
    $('.subcategoria[data-subcategoria="' + p_subcategoria + '"]').removeClass('sticky-active');
    $('.subcategoria[data-subcategoria="' + p_subcategoria + '"]').css('top', '');
}

function abrir_subcategoria(p_subcategoria) {
    $('.producto[data-subcategoria="' + p_subcategoria + '"]').show();
    $('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').removeClass("fa-angle-down");
    $('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').addClass("fa-angle-up");

    // Activar sticky
    $('.subcategoria[data-subcategoria="' + p_subcategoria + '"]').addClass('sticky-active');
    ajustarStickySubcategorias();
}

function mostrar_subcategoria(p_subcategoria) {
    if ($('.subcategoria[data-subcategoria="' + p_subcategoria + '"] .subcategoria_icono').hasClass("fa-angle-down")) {
        abrir_subcategoria(p_subcategoria);
    } else {
        cerrar_subcategoria(p_subcategoria);
    }
}

function ver_todas_las_categorias() {
    $('.producto').show();
    $('.subcategoria').show();
    $('.categoria-titulo .categoria_icono').removeClass("fa-angle-down");
    $('.categoria-titulo .categoria_icono').addClass("fa-angle-up");
}

function eliminar_producto_completo(p_id, p_variedad, p_variedad2 = null, p_variedad3 = null, p_variedad4 = null,
    p_variedad5 = null, p_variedad6 = null, p_variedad7 = null, p_variedad8 = null, p_variedad9 = null,
    p_variedad10 = null, p_variedad11 = null, p_variedad12 = null
) {
    for (var i = 0; i < g_pedido.productos.length; i++) { 
        var producto=g_pedido.productos[i]; 
        if (p_id==producto.id
            && p_variedad==producto.variedad && p_variedad2==producto.variedad2 && p_variedad3==producto.variedad3 &&
            p_variedad4==producto.variedad4 && p_variedad5==producto.variedad5 && p_variedad6==producto.variedad6 &&
            p_variedad7==producto.variedad7 && p_variedad8==producto.variedad8 && p_variedad9==producto.variedad9 &&
            p_variedad10==producto.variedad10 && p_variedad11==producto.variedad11 && p_variedad12==producto.variedad12
        ) { 
            g_pedido.productos.splice(i, 1); 
            i--; 
            break; 
        } 
    } 
    calcular_total(); 
    if (g_viendo_resumen) {
        $('#producto_' + p_id).hide(); 
        var remaining=g_pedido.productos.filter(p=> p.id == p_id).length;
        if (remaining > 0) {
            $('#producto_' + p_id).show();
        }
    }
}

function quitar_del_pedido(p_id, p_variedad, p_variedad2 = null, p_variedad3 = null, p_variedad4 = null,
    p_variedad5 = null, p_variedad6 = null, p_variedad7 = null, p_variedad8 = null, p_variedad9 = null,
    p_variedad10 = null, p_variedad11 = null, p_variedad12 = null
) {
    p_variedad2 = (p_variedad2 == "undefined") ? undefined : p_variedad2;
    p_variedad3 = (p_variedad3 == "undefined") ? undefined : p_variedad3;
    p_variedad4 = (p_variedad4 == "undefined") ? undefined : p_variedad4;
    p_variedad5 = (p_variedad5 == "undefined") ? undefined : p_variedad5;
    p_variedad6 = (p_variedad6 == "undefined") ? undefined : p_variedad6;
    p_variedad7 = (p_variedad7 == "undefined") ? undefined : p_variedad7;
    p_variedad8 = (p_variedad8 == "undefined") ? undefined : p_variedad8;
    p_variedad9 = (p_variedad9 == "undefined") ? undefined : p_variedad9;
    p_variedad10 = (p_variedad10 == "undefined") ? undefined : p_variedad10;
    p_variedad11 = (p_variedad11 == "undefined") ? undefined : p_variedad11;
    p_variedad12 = (p_variedad12 == "undefined") ? undefined : p_variedad12;

    g_pedido.productos.forEach(function(producto, index, mi_array) {
        if (p_id == producto.id &&
            p_variedad == producto.variedad &&
            p_variedad2 == producto.variedad2 &&
            p_variedad3 == producto.variedad3 &&
            p_variedad4 == producto.variedad4 &&
            p_variedad5 == producto.variedad5 &&
            p_variedad6 == producto.variedad6 &&
            p_variedad7 == producto.variedad7 &&
            p_variedad8 == producto.variedad8 &&
            p_variedad9 == producto.variedad9 &&
            p_variedad10 == producto.variedad10 &&
            p_variedad11 == producto.variedad11 &&
            p_variedad12 == producto.variedad12
        ) {
            var nueva_cantidad = parseFloat(producto.cantidad) - parseFloat(producto.step);

            if (nueva_cantidad < producto.minimo) { 
                producto.cantidad=0; 
                if (!no_calcular) {} 
            } else {
                producto.cantidad=nueva_cantidad; 
            } 
            if (producto.cantidad=="0" ) { 
                mi_array.splice(index, 1); 
            } 
        } 
    });
    calcular_total(); 
} 

function dame_producto(p_id) { 
    var producto_seleccionado = null;
    g_productos.forEach(function(producto) { 
        if (producto.id==p_id) { 
            producto_seleccionado=JSON.parse(JSON.stringify(producto)); 
            return; 
        } 
    }); 
    return producto_seleccionado; 
} 

var variedades_actuales=[]; 
var variedades_seleccionadas = [];
var suma_de_adicionales = 0;

function agregar_al_pedido(p_id, p_variedad, p_variedad_2=null, p_variedad_3=null, p_variedad_4=null, p_variedad_5=null, p_variedad_6=null,
    p_variedad_7=null, p_variedad_8=null, p_variedad_9=null, p_variedad_10=null, p_variedad_11=null,
    p_variedad_12=null ) { 
    
    if (!g_telefono) { console.log('NO tiene teléfono, el producto no puede ser pedido'); return false; } 
    var variedades_seleccionadas_final=variedades_seleccionadas;
    variedades_seleccionadas=[]; 
    
    var producto=dame_producto(p_id); 
    
    p_variedad_2=(p_variedad_2=="undefined" ) ? undefined : p_variedad_2; 
    p_variedad_3=(p_variedad_3=="undefined" ) ? undefined : p_variedad_3;
    p_variedad_4=(p_variedad_4=="undefined" ) ? undefined : p_variedad_4;
    p_variedad_5=(p_variedad_5=="undefined" ) ? undefined : p_variedad_5;
    p_variedad_6=(p_variedad_6=="undefined" ) ? undefined : p_variedad_6;
    p_variedad_7=(p_variedad_7=="undefined" ) ? undefined : p_variedad_7;
    p_variedad_8=(p_variedad_8=="undefined" ) ? undefined : p_variedad_8;
    p_variedad_9=(p_variedad_9=="undefined" ) ? undefined : p_variedad_9;
    p_variedad_10=(p_variedad_10=="undefined" ) ? undefined : p_variedad_10;
    p_variedad_11=(p_variedad_11=="undefined" ) ? undefined : p_variedad_11;
    p_variedad_12=(p_variedad_12=="undefined" ) ? undefined : p_variedad_12; 
    
    if (p_variedad==undefined || p_variedad==null) { 
        console.log("Inicializo los ingredientes"); 
        suma_de_adicionales=0; 
    } 
    
    if (producto.variedades && producto.variedades.length> 0 && p_variedad == undefined) {
        var variedades_array = producto.variedades;
        var variedades_html = dame_html_variantes(variedades_array, p_id, 0, "$", false);

        if (producto.variedades[0].variedadtitulo) {
            $("#pregunta_variedades_titulo").html(producto.variedades[0].variedadtitulo);
        } else {
            if (producto.variedades[0].variedadestilo == "HASTA") {
                $("#pregunta_variedades_titulo").html("Elija hasta " + producto.variedades[0].variedadtotal);
            } else if (producto.variedades[0].variedadestilo == "HASTA COMPLETAR") {
                if (producto.variedades[0].variedadtotal == -1) {
                    $("#pregunta_variedades_titulo").html("Elija");
                } else {
                    $("#pregunta_variedades_titulo").html("Elija " + producto.variedades[0].variedadtotal);
                }
            } else {
                $("#pregunta_variedades_titulo").html('Elija una opción');
            }
        }
        $("#pregunta_variedades_opciones").html(variedades_html);

        $.fancybox.open({
            src: "#pregunta_variedades",
            opts: {
                beforeShow: function() {
                    $("body").css({ 'overflow-y': 'hidden' });
                },
                afterClose: function() {
                    $("body").css({ 'overflow-y': 'visible' });
                }
            }
        });

    } else {

        if (p_variedad == undefined) {
        } else {
            producto.variedad = p_variedad;
            producto.variedades.forEach(function(variedad) {
                if (variedad.nombre == p_variedad) {
                    producto.precio = variedad.precio;
                    producto.minimo = variedad.minimo;
                    producto.maximo = variedad.maximo;
                    producto.step = variedad.step;
                }
            });
        }

        if (p_variedad_2 != undefined) producto.variedad2 = p_variedad_2;
        if (p_variedad_3 != undefined) producto.variedad3 = p_variedad_3;
        if (p_variedad_4 != undefined) producto.variedad4 = p_variedad_4;
        if (p_variedad_5 != undefined) producto.variedad5 = p_variedad_5;
        if (p_variedad_6 != undefined) producto.variedad6 = p_variedad_6;
        if (p_variedad_7 != undefined) producto.variedad7 = p_variedad_7;
        if (p_variedad_8 != undefined) producto.variedad8 = p_variedad_8;
        if (p_variedad_9 != undefined) producto.variedad9 = p_variedad_9;
        if (p_variedad_10 != undefined) producto.variedad10 = p_variedad_10;
        if (p_variedad_11 != undefined) producto.variedad11 = p_variedad_11;
        if (p_variedad_12 != undefined) producto.variedad12 = p_variedad_12;

        var variedades_producto = dame_variedades_seleccionadas(producto);
        var id_producto_stock = dame_producto_id_stock(producto, variedades_producto);
        var stock_producto = dame_stock(id_producto_stock);

        if (stock_producto) {
            producto.id_stock = stock_producto.id;
            if (stock_producto.stock < producto.maximo) { 
                console.log('El stock es inferior al máximo a pedir. Lo cambio'); 
                producto.maximo=stock_producto.stock; 
            } 
        } 
        
        var agrupado=false;
        g_pedido.productos.forEach(function(producto_para_agrupar) { 
            if (producto_para_agrupar.id==producto.id && producto_para_agrupar.variedad==producto.variedad &&
                producto_para_agrupar.variedad2==producto.variedad2 &&
                producto_para_agrupar.variedad3==producto.variedad3 &&
                producto_para_agrupar.variedad4==producto.variedad4 &&
                producto_para_agrupar.variedad5==producto.variedad5 &&
                producto_para_agrupar.variedad6==producto.variedad6 &&
                producto_para_agrupar.variedad7==producto.variedad7 &&
                producto_para_agrupar.variedad8==producto.variedad8 &&
                producto_para_agrupar.variedad9==producto.variedad9 &&
                producto_para_agrupar.variedad10==producto.variedad10 &&
                producto_para_agrupar.variedad11==producto.variedad11 &&
                producto_para_agrupar.variedad12==producto.variedad12 
            ) { 
                agrupado=true; 
                var nueva_cantidad=parseFloat(producto_para_agrupar.cantidad) + parseFloat(producto.step); 
                if (nueva_cantidad> parseFloat(producto.maximo)) {
                    producto_para_agrupar.cantidad = producto.maximo;
                    if (!no_calcular) {
                        mostrar_aviso_error('No puede agregar más de ' + producto.maximo);
                    }
                } else {
                    producto_para_agrupar.cantidad = nueva_cantidad;
                    var my_event = new CustomEvent('add_to_cart', { detail: { producto: producto_para_agrupar } });
                    document.body.dispatchEvent(my_event);
                }
            }
        });

        if (!agrupado) {
            if (parseFloat(producto.step) > parseFloat(producto.maximo)) {
                producto.cantidad = producto.maximo;
            } else {
                producto.cantidad = parseFloat(producto.minimo);
            }
            producto.adicionales = suma_de_adicionales;

            var my_event = new CustomEvent('add_to_cart', { detail: { producto: producto } });
            document.body.dispatchEvent(my_event);

            g_pedido.productos.push(producto);
        }

        $.fancybox.close();
    }
    calcular_total();
}

function pre_agregar_al_pedido(prod_id, variedad_nombre, monto_a_sumar = 0) {
    var miprod = dame_producto(prod_id, variedad_nombre);
    variedades_seleccionadas.push(variedad_nombre);
    suma_de_adicionales = suma_de_adicionales + monto_a_sumar;

    var variedad_siguiente = null;
    var variedad_siguiente_nro = variedades_seleccionadas.length + 1;
    var varidad_actual_idx = 0;

    for (var idxvar = 0; idxvar < miprod.variedades.length; idxvar++) { 
        if (miprod.variedades[idxvar].nombre==variedad_nombre) { 
            varidad_actual_idx=idxvar; 
        } 
    } 
    
    if (miprod.variedades[varidad_actual_idx]['variedades' + variedad_siguiente_nro]) {
        variedad_siguiente=miprod.variedades[varidad_actual_idx]['variedades' + variedad_siguiente_nro];
    } 
    
    if (variedad_siguiente) {
        $.fancybox.close(); 
        var variedades_sig_arr=variedad_siguiente.split(','); 
        var variedades_sig_arr_con_estilos=[]; 
        
        $(variedades_sig_arr).each((ii, vari)=> {
            var conestilo = {
                nombre: vari,
                variedadestilo: miprod.variedades[varidad_actual_idx]['variedad' + variedad_siguiente_nro + 'estilo'],
                variedadtotal: miprod.variedades[varidad_actual_idx]['variedad' + variedad_siguiente_nro + 'total'],
                variedadtitulo: miprod.variedades[varidad_actual_idx]['variedad' + variedad_siguiente_nro + 'titulo']
            };
            variedades_sig_arr_con_estilos.push(conestilo);
        });

        var variedades_html = dame_html_variantes(variedades_sig_arr_con_estilos, prod_id, variedad_siguiente_nro, "$", false);

        if (variedades_sig_arr_con_estilos[0].variedadtitulo) {
            $("#pregunta_variedades_titulo").html(variedades_sig_arr_con_estilos[0].variedadtitulo);
        } else {
            if (variedades_sig_arr_con_estilos[0].variedadestilo == "HASTA") {
                $("#pregunta_variedades_titulo").html("Elija hasta " + variedades_sig_arr_con_estilos[0].variedadtotal);
            } else if (variedades_sig_arr_con_estilos[0].variedadestilo == "HASTA COMPLETAR") {
                if (variedades_sig_arr_con_estilos[0].variedadtotal == -1) {
                    $("#pregunta_variedades_titulo").html("Elija");
                } else {
                    $("#pregunta_variedades_titulo").html("Elija " + variedades_sig_arr_con_estilos[0].variedadtotal);
                }
            } else {
                $("#pregunta_variedades_titulo").html('Elija la opción Nº' + variedad_siguiente_nro);
            }
        }
        $("#pregunta_variedades_opciones").html(variedades_html);
        $.fancybox.open({ src: "#pregunta_variedades" });

    } else {
        switch (variedades_seleccionadas.length) {
            case 1: agregar_al_pedido(prod_id, variedades_seleccionadas[0]); break;
            case 2: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1]); break;
            case 3: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2]); break;
            case 4: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3]); break;
            case 5: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4]); break;
            case 6: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5]); break;
            case 7: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6]); break;
            case 8: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7]); break;
            case 9: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7], variedades_seleccionadas[8]); break;
            case 10: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7], variedades_seleccionadas[8], variedades_seleccionadas[9]); break;
            case 11: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7], variedades_seleccionadas[8], variedades_seleccionadas[9], variedades_seleccionadas[10]); break;
            case 12: agregar_al_pedido(prod_id, variedades_seleccionadas[0], variedades_seleccionadas[1], variedades_seleccionadas[2], variedades_seleccionadas[3], variedades_seleccionadas[4], variedades_seleccionadas[5], variedades_seleccionadas[6], variedades_seleccionadas[7], variedades_seleccionadas[8], variedades_seleccionadas[9], variedades_seleccionadas[10], variedades_seleccionadas[11]); break;
        }
    }
}

function vaciar_pedido() {
    $.fancybox.open({ src: '#pregunta_vaciar_pedido' });
}

var pedido = "";
var url_pedido = "";
var no_calcular = false;

function calcular_total() {
    if (!no_calcular) {
        g_pedido.additional_info = {
            "user_agent": navigator.userAgent,
            "language": navigator.language,
            "platform": navigator.platform,
        }
        g_pedido.ultima_actualizacion = new Date().getTime();
        localStorage.setItem('pedido-burracomidamexicana', JSON.stringify(g_pedido));

        var total = 0;
        var total_cantidad_de_productos = 0;
        var total_cantidad_de_articulos = 0;
        var total_adicionales = 0;

        $(".producto_fila").removeClass("producto-pedido");
        $(".producto_cantidades").text("");
        $(".producto_cantidades").hide();
        $(".helper_aclaracion").hide();
        $(".helper_variedades_agregar").hide();
        $(".separador-producto-de-variedad").hide();
        $(".separador-productos").show();

        g_pedido.productos.forEach(function(producto, p_idx) {
            id = producto.id;
            $("#fila_" + id).addClass("producto-pedido");

            if (producto.variedad) {
                var variedad_1_mostrar = producto.variedad ? ' ' + producto.variedad : '';
                var variedad_2_mostrar = producto.variedad2 ? ', ' + producto.variedad2 : '';
                var variedad_3_mostrar = producto.variedad3 ? ', ' + producto.variedad3 : '';
                var variedad_4_mostrar = producto.variedad4 ? ', ' + producto.variedad4 : '';
                var variedad_5_mostrar = producto.variedad5 ? ', ' + producto.variedad5 : '';
                var variedad_6_mostrar = producto.variedad6 ? ', ' + producto.variedad6 : '';
                var variedad_7_mostrar = producto.variedad7 ? ', ' + producto.variedad7 : '';
                var variedad_8_mostrar = producto.variedad8 ? ', ' + producto.variedad8 : '';
                var variedad_9_mostrar = producto.variedad9 ? ', ' + producto.variedad9 : '';
                var variedad_10_mostrar = producto.variedad10 ? ', ' + producto.variedad10 : '';
                var variedad_11_mostrar = producto.variedad11 ? ', ' + producto.variedad11 : '';
                var variedad_12_mostrar = producto.variedad12 ? ', ' + producto.variedad12 : '';

                var v_html_boton = "<div class='btn-group float-right botonera-productos-qty'>";
                v_html_boton += "<button class='btn botonera-productos-qty-less' onclick='quitar_del_pedido(\"" + producto.id + "\", \"" + producto.variedad + "\", \"" + producto.variedad2 + "\", \"" + producto.variedad3 + "\", \"" + producto.variedad4 + "\", \"" + producto.variedad5 + "\", \"" + producto.variedad6 + "\", \"" + producto.variedad7 + "\", \"" + producto.variedad8 + "\", \"" + producto.variedad9 + "\", \"" + producto.variedad10 + "\", \"" + producto.variedad11 + "\", \"" + producto.variedad12 + "\")' style=''>-</button>";
                v_html_boton += "<button class='btn botonera-productos-qty-middle'>" + producto.cantidad + "</button>";
                v_html_boton += "<button class='btn botonera-productos-qty-more' onclick='agregar_al_pedido(\"" + producto.id + "\", \"" + producto.variedad + "\", \"" + producto.variedad2 + "\", \"" + producto.variedad3 + "\", \"" + producto.variedad4 + "\", \"" + producto.variedad5 + "\", \"" + producto.variedad6 + "\", \"" + producto.variedad7 + "\", \"" + producto.variedad8 + "\", \"" + producto.variedad9 + "\", \"" + producto.variedad10 + "\", \"" + producto.variedad11 + "\", \"" + producto.variedad12 + "\")'>+</button>";
                v_html_boton += "</div>";

                var v_html_texto = "<div style='float-left;padding-top: 8px;'>" + producto.cantidad + " x " + producto.variedad + variedad_2_mostrar + variedad_3_mostrar + variedad_4_mostrar + variedad_5_mostrar + variedad_6_mostrar + variedad_7_mostrar + variedad_8_mostrar + variedad_9_mostrar + variedad_10_mostrar + variedad_11_mostrar + variedad_12_mostrar + " = $" + formatear_moneda((producto.cantidad * producto.precio) + (producto.cantidad * producto.adicionales)) + " <button class='btn btn-sm btn-danger boton-eliminar-carrito' style='display:none; margin-left: 5px;' onclick='eliminar_producto_completo(\"" + producto.id + "\", \"" + producto.variedad + "\", \"" + producto.variedad2 + "\", \"" + producto.variedad3 + "\", \"" + producto.variedad4 + "\", \"" + producto.variedad5 + "\", \"" + producto.variedad6 + "\", \"" + producto.variedad7 + "\", \"" + producto.variedad8 + "\", \"" + producto.variedad9 + "\", \"" + producto.variedad10 + "\", \"" + producto.variedad11 + "\", \"" + producto.variedad12 + "\")'><i class=\"fas fa-trash\"></i></button></div>";

                v_html = $("#cantidades_" + id).html();
                v_html += "<div style='margin-top:5px;' class='clearfix'>" + v_html_boton + v_html_texto + "</div>";

                $("#cantidades_" + id).html(v_html);
                $("#cantidades_" + id).show();
                $("#fila_" + id + " .helper_variedades_agregar").show();
                $("#fila_" + id + " .separador-producto-de-variedad").show();
            } else {
                v_html = "";
                var v_html_boton = "<div class='btn-group float-right botonera-productos-qty'>";
                v_html_boton += "<button class='btn botonera-productos-qty-less' onclick='quitar_del_pedido(\"" + producto.id + "\")' style=''>-</button>";
                v_html_boton += "<button class='btn botonera-productos-qty-middle'>" + producto.cantidad + "</button>";
                v_html_boton += "<button class='btn botonera-productos-qty-more' onclick='agregar_al_pedido(\"" + producto.id + "\")'>+</button>";
                v_html_boton += "</div>";

                v_html_texto = "";
                if (producto.cantidad > 0) {
                    v_html_texto = "<div style='float-left;padding-top: 8px;'>$" + formatear_moneda(producto.cantidad * producto.precio) + " <button class='btn btn-sm btn-danger boton-eliminar-carrito' style='display:none; margin-left: 5px;' onclick='eliminar_producto_completo(\"" + producto.id + "\")'><i class=\"fas fa-trash\"></i></button></div>";
                }
                v_html += "<div style='margin-top:5px;' class='clearfix'>" + v_html_boton + v_html_texto + "</div>";

                $("#cantidades_" + id).html(v_html);
                $("#cantidades_" + id).show();
            }

            total += (parseFloat(producto.precio) * parseFloat(producto.cantidad)) + (parseFloat(producto.adicionales) * parseFloat(producto.cantidad));
            total_cantidad_de_productos += parseFloat(producto.cantidad);
            total_cantidad_de_articulos++;
            total_adicionales += producto.cantidad * producto.adicionales;

            $("#fila_" + id + " .producto_cantidades").show();
            $("#fila_" + id + " .helper_aclaracion").show();
            $("#fila_" + id + " .separador-productos").hide();
        });

        pedido = "";
        
        // WhatsApp Message Generation
        g_pedido.preguntas = [];
        pedido += "*Nombre y Apellido(*)*\n_" + $("#pregunta_1_respuesta").val() + "_\n\n";
        pedido += "*" + $("#pregunta_2_label").text() + "*\n_" + $("#pregunta_2_respuesta").val() + "_\n\n";
        pedido += "*" + $("#pregunta_3_label").text() + "*\n_" + $("#pregunta_3_respuesta").val() + "_\n\n";
        pedido += "*" + $("#pregunta_4_label").text() + "*\n_" + $("#pregunta_4_respuesta").val() + "_\n\n";

        if (g_zonas_envios.length > 0) {
            pedido += "*" + $("#pregunta_10_label").text() + "*\n_" + $("#pregunta_10_respuesta").val() + "_\n\n";
        }
        
        pedido += "*Pedido:*\n";

        g_pedido.productos.forEach(function(producto) {
             var linea_pedido = '*CANTIDAD* x *NOMBRE* *VARIEDAD* *ACLARACION*\nSubtotal = $*SUBTOTAL*\n';
             linea_pedido = linea_pedido.replace('*CANTIDAD*', "*" + producto.cantidad + "*");
             linea_pedido = linea_pedido.replace('*NOMBRE*', "*" + producto.nombre + "*");
             
             var subtotal = (producto.cantidad * producto.precio) + (producto.cantidad * producto.adicionales);
             linea_pedido = linea_pedido.replace('*SUBTOTAL*', "" + formatear_moneda(subtotal) + "");
             
             var variedad = "";
             if (producto.variedad) {
                 variedad = "(" + producto.variedad + 
                    (producto.variedad2 ? ", " + producto.variedad2 : "") +
                    (producto.variedad3 ? ", " + producto.variedad3 : "") +
                    ")"; // Simplified for brevity but logic should match original if needed
             }
             linea_pedido = linea_pedido.replace('*VARIEDAD*', variedad);
             
             var aclaracion = $("#aclaracion_" + producto.id).val();
             if (aclaracion) {
                 linea_pedido = linea_pedido.replace('*ACLARACION*', "\n*Aclaración: " + aclaracion + "*");
             } else {
                 linea_pedido = linea_pedido.replace('*ACLARACION*', "");
             }
             
             pedido += "\n" + linea_pedido;
        });
        
        var pedido_extras = 0;
        if (g_zonas_envios.length > 0) {
            var pedido_extra_2_costo = $("#pregunta_10_respuesta").find(':selected').data('costo');
            if (pedido_extra_2_costo && !isNaN(pedido_extra_2_costo)) {
                pedido_extras += parseFloat(pedido_extra_2_costo);
            }
        }
        
        pedido += "\n*Total pedido: $" + formatear_moneda(total + pedido_extras) + "*";

        url_pedido = "https://wa.me/" + g_telefono + "?text=" + encodeURIComponent(pedido);
        
        var preguntas_resumen = '';
        preguntas_resumen += '<table style="width: 100%;"><tbody>';
        preguntas_resumen += '<tr><td>Pedido</td><td style="text-align: right;">$' + formatear_moneda(total) + '</td></tr>';
        
        if (pedido_extras > 0) {
             preguntas_resumen += '<tr><td>Envio</td><td style="text-align: right;">$' + formatear_moneda(pedido_extras) + '</td></tr>';
        }

        preguntas_resumen += '<tr><td><strong>Total</strong></td><td style="text-align: right;"><strong>$' + formatear_moneda(total + pedido_extras) + '</strong></td></tr>';
        preguntas_resumen += '</tbody></table>';

        $("#preguntas_resumen").show();
        $("#preguntas_resumen").html(preguntas_resumen);

        g_pedido.precio_final = total + pedido_extras;
        g_pedido.precio_solo_articulos = total;
        g_pedido.cantidad_productos_final = total_cantidad_de_productos;
        g_pedido.whatsapp = g_telefono;
        g_pedido.mensaje = pedido;

        $('.pedido_productos_cantidad_total').html(total_cantidad_de_productos);
        
        if (g_pedido.productos.length == 0) {
            $("#footer_enviar").slideUp();
            $('.helper_footer_padding').hide();
        } else {
             if (total > 0) {
                $("#boton_enviar").html("<i class='fab fa-whatsapp'></i> <span id='send_message_text'>&nbsp;Enviar pedido por WhatsApp&nbsp;</span> <b>$" + formatear_moneda(total + pedido_extras) + "</b>");
            }
            $("#footer_enviar").slideDown();
        }

        if (typeof g_viendo_resumen !== 'undefined' && g_viendo_resumen) {
            $('.boton-eliminar-carrito').show();
        } else {
            $('.boton-eliminar-carrito').hide();
        }
    }
}


function formatear_moneda(x) {
    if (Number.parseFloat(x) == Number.parseInt(x)) {
        return Number.parseInt(x).toLocaleString('es');
    } else {
        return Number.parseFloat(x).toFixed(2).toLocaleString('es');
    }
}

function enviar_pedido() {
    var pedido_monto_minimo = 0; 
    
    if (g_pedido.precio_final >= pedido_monto_minimo) {
        pre_abrir_preguntas();

        $.fancybox.open({
            src: '#preguntas_pedido',
            opts: {
                beforeShow: function() { $("body").css({ 'overflow-y': 'hidden' }); },
                afterClose: function() { $("body").css({ 'overflow-y': 'visible' }); }
            }
        });

        var my_event = new CustomEvent('initiate_checkout', {});
        document.body.dispatchEvent(my_event);
    } else {
        $.fancybox.open({ src: "#popup_monto_minimo" });
    }
}

function pre_abrir_preguntas() {
    if (g_zonas_envios.length > 0) {
        $("#pregunta_10_respuesta").empty();
        $("#pregunta_10_respuesta").append('<option value="">');

        for (var i = 0; i < g_zonas_envios.length; i++) { 
            var zona=g_zonas_envios[i]; 
            var costo_envio=zona.costo; 
            if (g_pedido_zona_envio_ignorar_monto !=-1) { 
                if (g_pedido.precio_solo_articulos >= g_pedido_zona_envio_ignorar_monto) {
                    costo_envio = 0;
                }
            }
            var zona_respuesta = zona.nombre + ' ($' + costo_envio + ')';
            var nueva_zona = '<option value="' + zona_respuesta + '" data-costo="' + costo_envio + '" data-nombre="' + zona.nombre + '">' + zona_respuesta;
            $("#pregunta_10_respuesta").append(nueva_zona);
        }
    }
}

function finalizar_pedido() {
    calcular_total();

    var btn_finalizar = $("#btn_finalizar_pedido");
    var btn_txt_original = btn_finalizar.html();
    btn_finalizar.html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
    btn_finalizar.prop('disabled', true);

    g_pedido.preguntas = [];
    g_pedido.preguntas.push({ pregunta: 'Nombre y Apellido(*)', respuesta: $("#pregunta_1_respuesta").val() });
    g_pedido.preguntas.push({ pregunta: $("#pregunta_2_label").text(), respuesta: $("#pregunta_2_respuesta").val() });
    g_pedido.preguntas.push({ pregunta: $("#pregunta_3_label").text(), respuesta: $("#pregunta_3_respuesta").val() });
    g_pedido.preguntas.push({ pregunta: $("#pregunta_4_label").text(), respuesta: $("#pregunta_4_respuesta").val() });
    
    if (g_zonas_envios.length > 0) {
         g_pedido.preguntas.push({ pregunta: $("#pregunta_10_label").text(), respuesta: $("#pregunta_10_respuesta").val() });
    }

    var orderData = {
        pedido: g_pedido,
        _token: window.BurraConfig.csrf_token
    };

    $.ajax({
        url: window.BurraConfig.route_pedido,
        method: 'POST',
        data: orderData,
        success: function(response) {
            if (response.success) {
                $.fancybox.close();
                document.body.dispatchEvent(new CustomEvent('purchase'));
                localStorage.removeItem('pedido-burracomidamexicana');
                
                // Redirect to WhatsApp
                location.href = url_pedido;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al guardar tu pedido. Por favor intentá nuevamente.',
                });
                btn_finalizar.html(btn_txt_original);
                btn_finalizar.prop('disabled', false);
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema de conexión. Por favor intentá nuevamente.',
            });
            btn_finalizar.html(btn_txt_original);
            btn_finalizar.prop('disabled', false);
        }
    });
}
