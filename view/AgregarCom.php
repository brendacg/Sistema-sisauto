<?php
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html lang="es">
<script src="../assets/Validaciones/validarCliente.js"></script>
<?php include("generalidades/apertura.php"); ?>
<body>
    <div id="wrapper">
        <?php include("generalidades/menu.php"); ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php" style="font-size:15px;color:blue;">Inicio</a>
                    </li>
                    <li>
                        <a href="Compras.php" style="font-size:15px;color:blue;">Compras</a>
                    </li>
                    <li>
                        <a style="font-size:15px;">Registrar compra</a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <form class="form-horizontal" action="../Controlador/comprasC.php" method="POST" id="guardarCom" align="center" autocomplete="off">
                                    <h3><b>Datos generales</b></h3>
                                    <hr width="75%" style="background-color:#007bff;"/><br>
                                    <input type="hidden" value="GuardarCom" name="bandera"></input>
                                    <div class="form-group row">
                                        <label for="empresa" class="col-sm-3 control-label">Número de factura: </label>
                                        <div class="col-sm-3 input-group">
                                            <input  id="numFacCom" name="numFac_Com" class="form-control" type="text" id="num" style="width:150px;height:40px" onkeypress="return validarNumFac(this,event,this.value)"><a id='mensajeNumFac'></a>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="data_2">
                                        <?php
                                        
                                            date_default_timezone_set('america/el_salvador');
                                            $hora1 = date("A");
                                            $hoy = getdate();
                                            $hora = date("g");
                                            $dia = date("d");
                                             $fech = $dia.'/'.$hoy['mon'].'/'.$hoy['year'];                                           
                                        ?>
                                        <label for="empresa" class="col-sm-3 control-label">Fecha: </label>
                                        <div class="col-sm-3 input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input id="fecha" name="fecha_Com" type="text" class="form-control" value="<?php echo $fech?>" min="01/01/2000" max="<?php echo $fech?>" style="width:150px;height:40px">
                                            <a id='mensajitoFecha'></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <?php 
                                            $sql="SELECT * from proveedor where tipo_Prov = 1 order by nombre_Prov ASC";
                                            $proveedores = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta"); 
                                        ?>
                                        <label for="empresa" class="col-sm-3 control-label">Proveedor:</label>
                                        <div class="col-sm-3 input-group">
                                            <select id="proves" name="id_Proveedor" style="width:600px;height:40px" class="form-control"> 
                                                <option value="">[Selecionar proveedor]</option>
                                                <?php

                                                While($proveedor=mysqli_fetch_array($proveedores)){
                                                     echo '<option value="'.$proveedor['idProveedor'].'">'.$proveedor['nombre_Prov'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br><br>
                                    <h3><b>Datos del producto</b></h3>
                                    <hr width="75%" style="background-color:#007bff;"/><br>
                                    <div class="form-group row">
                                        <label for="tele1" class="col-sm-3 control-label">Categoría:</label>
                                        <div class="col-sm-2">
                                          <select id="categoriaPro" name="categorias" style="width:400px;height:40px" class="form-control" onchange="filtrarCategoria(this.value);">
                                            <option value="">[Selecionar categoría]</option>
                                            <option value="1">AMORTIGUADORES</option>
                                            <option value="2">BUJÍAS</option>
                                            <option value="3">COMBUSTIBLE</option>
                                            <option value="4">ELÉCTRICO</option>
                                            <option value="5">ENFRIAMIENTO</option>
                                            <option value="6">FILTROS</option>
                                            <option value="7">FRENOS</option>
                                            <option value="8">MOTOR</option>
                                            <option value="8">SENSORES</option>
                                            <option value="10">SUSPENSIÓN Y DIRECCIÓN</option>
                                            <option value="11">TRANSMISIÓN Y EMBRAGUE</option>
                                            <option value="12">UNIVERSALES</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="empresa" class="col-sm-3 control-label">Producto:</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select id="productoFiltrado" name="productos" style="width:600px;height:40px" class="form-control"> 
                                                <option value="">[Selecionar producto]</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 col-md-1">
                                            <button title="Ver caracteristicas" type="button" class="btn btn-info fa fa-eye" data-toggle="modal" data-target="#modalVerAddProducto" href="" onclick="mostrarAddProduc();" style="width:39px;height:39px">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="direccion" class="col-sm-3 control-label">Cantidad:</label>
                                        <div class="col-sm-12 col-md-1">
                                            <input id="cantidad" name="cantidadProd" class="form-control" type="text" placeholder="Cantidad" style="width:150px;height:40px" onkeypress="return validarCantidad(this,event,this.value)"><a id='mensajeCantidad'></a>
                                        </div>
                                        
                                        <label for="direccion" class="col-sm-3 control-label">Precio unitario:</label>
                                        <div class="col-sm-12 col-md-3 input-group date">
                                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                            <input id="precio" name="precioProd" class="form-control" type="text" style="width:150px;height:40px" onkeypress="return validarPrecioUnitario(this,event,this.value)"><a id='mensajePrecio'></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-3">
                                        </div>
                                        <div class="col-sm-12 col-md-5">
                                            <a id='mensajeee1'></a>
                                        </div>
                                    </div>
                                    <hr width="75%" /><br>
                                    <div class="form-group" align="center">
                                        <button title="Agregar a tabla" type="button" class="btn btn-primary fa fa-plus" style="width:80px;height:40px" onclick="agregar();"></button>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h3><b>Detalles de la compra</b></h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:10px">Cantidad</th>
                                                            <th style="width:200px">Producto</th>
                                                            <th style="width:30px">Precio unitario ($)</th>
                                                            <th style="width:30px">Subtotal ($)</th>
                                                            <th style="width:50px">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id = "tablaProductos">
                            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card-footer small text-muted"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label align="right" for="nrc" class="col-sm-12 col-md-8 control-label">Total de compra:</label>
                                        <div class="col-sm-12 col-md-2 input-group date">
                                            <span class="input-group-addon"><i class="fa fa-usd"></i></span><input value="0" id="total" name="total" class="form-control" type="number" readonly="readonly" style="width:150px;height:40px">
                                            <!--
                                                El id es para el js y el name para el controlador
                                            -->
                                        </div>
                                    </div>
                                    <br>
                                    <hr width="75%">
                                        <div class="form-group" align="center">
                                            <button title="Aceptar" type="button" class="btn" style="color:#fff; background-color:#28a745; width:90px; height:40px" onclick="validarCompra();">Aceptar</button>
                                            <button title="Cancelar" type="reset" value="Cancelar" class="btn " style="color:#fff; background-color:#ffc107; width:90px; height:40px" >Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                    <?php include("generalidades/cierre.php"); ?>



                    <!-- MODAL VER PROVEEDOR -->

          <div class="modal fade" id="modalVerAddProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header" style="background-color:#007bff;color:black;">

                     <h3 class="modal-title" id="myModalLabel"> <i class="fa fa-user"></i> Producto</h3>
                 </div>
                 <div class="modal-body">
                         <hr width="75%" style="background-color:#007bff;"/>
                         <div class="form-group ">
                             <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Codigo: </label>
                             <div class="col-sm-7">
                                 <input class="form-control" type="text" id="codigoAddP" name="codigoP" readonly="readonly" aria-required="true" value="">
                             </div>
                         </div>
                         <br><br><br><br>
                         <div class="form-group">
                             <label align="right" for="tel3" class="col-sm-4 control-label" style="font-size:15px;">Nombre Producto:</label>
                             <div  class="col-sm-7">
                                 <input class="form-control" type="text" id="nombreAddP" name="nombreAddP" readonly="readonly">
                             </div>
                         </div>
                         <br><br><br>
                         <div class="form-group">
                             <label align="right" for="cateP" class="col-sm-4 control-label" style="font-size:15px;">Categoria:</label>
                             <div class="col-sm-3">
                                 <input class="form-control" type="text" id="cateAddP" name="cateP" value="" readonly="readonly">
                             </div>
                         </div>
                         <br><br><br>
                         <div class="form-group">
                             <label align="right" for="direccion" class="col-sm-4 control-label" style="font-size:15px;">Marca de Producto:</label>
                             <div class="col-sm-7">
                                 <input class="form-control" type="text" type="text" name="marcaP"  id="marcaAddP" readonly="readonly">
                             </div>
                         </div>
                         <br><br><br>
                         <div class="form-group">
                             <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Modelo de Vehículo:</label>
                             <div class="col-sm-7">
                                 <input class="form-control" type="text" id="modeloAddP" name="modeloP" readonly="readonly">
                             </div>
                         </div>
                         <br><br><br>
                         <div class="form-group">
                             <label align="right" for="usuario" class="col-sm-4 control-label" style="font-size:15px;">Año del Vehículo:</label>
                             <div class="col-sm-3">
                                 <input class="form-control" type="text" id="anioAddP" name="anioP" readonly="readonly">
                             </div>
                         </div>
                         <div id="ocultar">
                         <br><br><br>
                         <div class="form-group">
                             <label align="right" for="usuario" class="col-sm-4 control-label" style="font-size:15px;">Descripción:</label>
                             <div class="col-sm-7">
                                <textarea class="form-control" type="text" name="descripcion" id="descripcionAddP"  placeholder="Escriba aqui..." readonly="readonly">
                                </textarea>
                             </div>
                         </div>
                        </div>
                 </div>
                 <br><br>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#007bff;color:black;font-size:15px;">Cerrar</button>
                 </div>
             </div>
         </div>

             </div>

    
                    <script src="../assets/Validaciones/mostrarProducto.js"></script>
                    <script src="../assets/Validaciones/validarProducto.js"></script>
                    <script src="../assets/Validaciones/validarCompras.js"></script>
                    <script src="../assets/Validaciones/validarNumeros.js"></script>
                    <script src="../assets/Validaciones/validarCliente.js"></script>
                    <script src="../assets/js/plugins/chosen/chosen.jquery.js"></script>
                    <script src="../assets/js/plugins/jsKnob/jquery.knob.js"></script>
                    <script src="../assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
                    <script src="../assets/js/plugins/fullcalendar/moment.min.js"></script>








                <script>
                        $(document).ready(function(){

                            var $image = $(".image-crop > img")
                            $($image).cropper({
                                aspectRatio: 1.618,
                                preview: ".img-preview",
                                done: function(data) {
                                    // Output the result data for cropping image.
                                }
                            });

                            var $inputImage = $("#inputImage");
                            if (window.FileReader) {
                                $inputImage.change(function() {
                                    var fileReader = new FileReader(),
                                            files = this.files,
                                            file;

                                    if (!files.length) {
                                        return;
                                    }

                                    file = files[0];

                                    if (/^image\/\w+$/.test(file.type)) {
                                        fileReader.readAsDataURL(file);
                                        fileReader.onload = function () {
                                            $inputImage.val("");
                                            $image.cropper("reset", true).cropper("replace", this.result);
                                        };
                                    } else {
                                        showMessage("Please choose an image file.");
                                    }
                                });
                            } else {
                                $inputImage.addClass("hide");
                            }

                            $("#download").click(function() {
                                window.open($image.cropper("getDataURL"));
                            });

                            $("#zoomIn").click(function() {
                                $image.cropper("zoom", 0.1);
                            });

                            $("#zoomOut").click(function() {
                                $image.cropper("zoom", -0.1);
                            });

                            $("#rotateLeft").click(function() {
                                $image.cropper("rotate", 45);
                            });

                            $("#rotateRight").click(function() {
                                $image.cropper("rotate", -45);
                            });

                            $("#setDrag").click(function() {
                                $image.cropper("setDragMode", "crop");
                            });

                            $('#data_1 .input-group.date').datepicker({
                                todayBtn: "linked",
                                keyboardNavigation: false,
                                forceParse: false,
                                calendarWeeks: true,
                                autoclose: true
                            });

                            $('#data_2 .input-group.date').datepicker({
                                startView: 1,
                                todayBtn: "linked",
                                keyboardNavigation: false,
                                forceParse: false,
                                autoclose: true,
                                format: "dd/mm/yyyy"
                            });

                            $('#data_3 .input-group.date').datepicker({
                                startView: 2,
                                todayBtn: "linked",
                                keyboardNavigation: false,
                                forceParse: false,
                                autoclose: true
                            });

                            $('#data_4 .input-group.date').datepicker({
                                minViewMode: 1,
                                keyboardNavigation: false,
                                forceParse: false,
                                autoclose: true,
                                todayHighlight: true
                            });

                            $('#data_5 .input-daterange').datepicker({
                                keyboardNavigation: false,
                                forceParse: false,
                                autoclose: true
                            });

                            var elem = document.querySelector('.js-switch');
                            var switchery = new Switchery(elem, { color: '#1AB394' });

                            var elem_2 = document.querySelector('.js-switch_2');
                            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

                            var elem_3 = document.querySelector('.js-switch_3');
                            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

                            $('.i-checks').iCheck({
                                checkboxClass: 'icheckbox_square-green',
                                radioClass: 'iradio_square-green'
                            });

                            $('.demo1').colorpicker();

                            var divStyle = $('.back-change')[0].style;
                            $('#demo_apidemo').colorpicker({
                                color: divStyle.backgroundColor
                            }).on('changeColor', function(ev) {
                                        divStyle.backgroundColor = ev.color.toHex();
                                    });

                            $('.clockpicker').clockpicker();

                            $('input[name="daterange"]').daterangepicker();

                            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

                            $('#reportrange').daterangepicker({
                                format: 'MM/DD/YYYY',
                                startDate: moment().subtract(29, 'days'),
                                endDate: moment(),
                                minDate: '01/01/2012',
                                maxDate: '12/31/2015',
                                dateLimit: { days: 60 },
                                showDropdowns: true,
                                showWeekNumbers: true,
                                timePicker: false,
                                timePickerIncrement: 1,
                                timePicker12Hour: true,
                                ranges: {
                                    'Hoy': [moment(), moment()],
                                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                },
                                opens: 'right',
                                drops: 'down',
                                buttonClasses: ['btn', 'btn-sm'],
                                applyClass: 'btn-primary',
                                cancelClass: 'btn-default',
                                separator: ' to ',
                                locale: {
                                    applyLabel: 'Submit',
                                    cancelLabel: 'Cancel',
                                    fromLabel: 'From',
                                    toLabel: 'To',
                                    customRangeLabel: 'Custom',
                                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                    firstDay: 1
                                }
                            }, function(start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                            });

                            $(".select2_demo_1").select2();
                            $(".select2_demo_2").select2();
                            $(".select2_demo_3").select2({
                                placeholder: "Select a state",
                                allowClear: true
                            });


                            $(".touchspin1").TouchSpin({
                                buttondown_class: 'btn btn-white',
                                buttonup_class: 'btn btn-white'
                            });

                            $(".touchspin2").TouchSpin({
                                min: 0,
                                max: 100,
                                step: 0.1,
                                decimals: 2,
                                boostat: 5,
                                maxboostedstep: 10,
                                postfix: '%',
                                buttondown_class: 'btn btn-white',
                                buttonup_class: 'btn btn-white'
                            });

                            $(".touchspin3").TouchSpin({
                                verticalbuttons: true,
                                buttondown_class: 'btn btn-white',
                                buttonup_class: 'btn btn-white'
                            });


                        });
                        var config = {
                                '.chosen-select'           : {},
                                '.chosen-select-deselect'  : {allow_single_deselect:true},
                                '.chosen-select-no-single' : {disable_search_threshold:10},
                                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                                '.chosen-select-width'     : {width:"95%"}
                                }
                            for (var selector in config) {
                                $(selector).chosen(config[selector]);
                            }

                        $("#ionrange_1").ionRangeSlider({
                            min: 0,
                            max: 5000,
                            type: 'double',
                            prefix: "$",
                            maxPostfix: "+",
                            prettify: false,
                            hasGrid: true
                        });

                        $("#ionrange_2").ionRangeSlider({
                            min: 0,
                            max: 10,
                            type: 'single',
                            step: 0.1,
                            postfix: " carats",
                            prettify: false,
                            hasGrid: true
                        });

                        $("#ionrange_3").ionRangeSlider({
                            min: -50,
                            max: 50,
                            from: 0,
                            postfix: "°",
                            prettify: false,
                            hasGrid: true
                        });

                        $("#ionrange_4").ionRangeSlider({
                            values: [
                                "January", "February", "March",
                                "April", "May", "June",
                                "July", "August", "September",
                                "October", "November", "December"
                            ],
                            type: 'single',
                            hasGrid: true
                        });

                        $("#ionrange_5").ionRangeSlider({
                            min: 10000,
                            max: 100000,
                            step: 100,
                            postfix: " km",
                            from: 55000,
                            hideMinMax: true,
                            hideFromTo: false
                        });

                        $(".dial").knob();

                        $("#basic_slider").noUiSlider({
                            start: 40,
                            behaviour: 'tap',
                            connect: 'upper',
                            range: {
                                'min':  20,
                                'max':  80
                            }
                        });

                        $("#range_slider").noUiSlider({
                            start: [ 40, 60 ],
                            behaviour: 'drag',
                            connect: true,
                            range: {
                                'min':  20,
                                'max':  80
                            }
                        });

                        $("#drag-fixed").noUiSlider({
                            start: [ 40, 60 ],
                            behaviour: 'drag-fixed',
                            connect: true,
                            range: {
                                'min':  20,
                                'max':  80
                            }
                        });


                </script>






    














        </div>
    </div>
</body>
</html>

<?php
}else{
    ?>
    <!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="refresh" content="0;URL=/SISAUTO1/view/login.php">
</head>
<body>
</body>
</html>
    <?php
}
?>