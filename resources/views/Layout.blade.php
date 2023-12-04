<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sistema de Facturaci&oacute;n Electr&oacute;nica</title>



        <!-- Bootstrap core CSS -->
        <link href="{{asset('recursos/framework/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('recursos/framework/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{asset('recursos/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">


        <!-- Morris Charts CSS -->
        <link href="{{asset('recursos/bower_components/morrisjs/morris.css')}}" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="{{asset('recursos/framework/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        {% block css %}
        {% endblock %}
        <!-- Style CSS -->
        <link href="{{asset('recursos/css/timeline.css')}}" rel="stylesheet">
        <link href="{{asset('recursos/css/sb-admin-2.css')}}" rel="stylesheet">
    </head>
    <body>
        <noscript>
        <meta http-equiv="refresh" content="0; URL={{path('no_script')}}"/>
        </noscript>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"class=""><img src="{{asset('recursos/img/login-logo.png')}}" alt="Logo" width="100" height="30"></a>
                    <a class="navbar-brand" href="{{path("home")}}"><i class="fa fa-life-ring"></i> Inicio</a>

                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">  {% if app.user.id is defined %} {{ app.user.nombre}} {{ app.user.apellidos}}   {% endif %}
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            {% if app.user.id is defined %}
                                <li><a href="{{ path('usuario_show', { 'id': app.user.id }) }}"><i class="fa fa-user fa-fw"></i> {{ app.user.nombre}} {{ app.user.apellidos}}</a>
                                {% endif %}
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{path("logout")}}"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            {% if is_granted('ROLE_EMISOR') %}
                                <li>
                                    <a href="{{path("home")}}"><i class="fa fa-dashboard fa-fw"></i> Mi Oficina</a>
                                </li>
                            {% endif %}

                            {% if is_granted('ROLE_EMISOR') %}
                                <li>
                                    <a href="#"><i class="fa fa-book"></i> Facturaci&oacute;n<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{{path("factura")}}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Factura </a>
                                        </li>
                                        <li>
                                            <a href="{{path("liquidacion")}}">Liquidacion Compra</a>
                                        </li>
                                        <li>
                                            <a href="{{path("notacredito")}}">Nota Cr&eacute;dito</a>
                                        </li>
                                        <li>
                                            <a href="{{path("notadebito")}}">Nota D&eacute;bito</a>
                                        </li>
                                        <li>
                                            <a href="{{path("retencion")}}">Retenci&oacute;n</a>
                                        </li>
                                        <li>
                                            <a href="{{path("guia")}}">Guias</a>
                                        </li>
                                        <li>
                                            <a href="{{path("proforma")}}">Proformas</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Proveedores<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{{path("compra")}}"><i class="fa fa-shopping-cart fa-fw"></i> Compras</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-edit fa-fw"></i> Reporte<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{{path("reporte")}}">Comprobantes</a>
                                        </li>
                                        <li>
                                            <a href="{{path("reporte_ventas")}}">Ventas</a>
                                        </li>
                                        <li>
                                            <a href="{{path("reporte_ventas_detallada")}}">Ventas Detallada</a>
                                        </li>
                                        {% if is_granted('ROLE_EMISOR_ADMIN') %}
                                            <li>
                                                <a href="{{path("total-retenciones")}}">Retenciones Total</a>
                                            </li>
                                            <li>
                                                <a href="{{path("retenciones_factura")}}">Retenciones Por Factura</a>
                                            </li>

                                        {% endif %}
                                    </ul>
                                </li>
                            {% endif %}
                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> Administrar<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    {% if is_granted('ROLE_ADMIN') %}
                                        <li>
                                            <a href="{{path("emisor")}}">Emisores</a>
                                        </li>

                                    {% endif %}

                                    {% if is_granted('ROLE_EMISOR_ADMIN') %}
                                        <li>
                                            <a href="{{path("emisor")}}">Emisor</a>
                                            <a href="{{path("borrar_doc")}}">Borrar Doc. Prueba</a>
                                        </li>
                                    {% endif %}
                                    {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_EMISOR_ADMIN') %}
                                        <li>
                                            <a href="{{path("establecimiento")}}">Establecimientos</a>
                                        </li>
                                        <li>
                                            <a href="{{path("ptoemision")}}">Puntos de Emision</a>
                                        </li>
                                    {% endif %}

                                    {% if is_granted('ROLE_ADMIN') %}
                                        <li>
                                            <a href="#">Impuestos<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="{{path("impuesto_iva")}}">IVA</a>
                                                </li>
                                                <li>
                                                    <a href="{{path("impuesto_ice")}}">ICE</a>
                                                </li>
                                                <li>
                                                    <a href="{{path("impuesto_irbpnr")}}">IRBPNR</a>
                                                </li>
                                            </ul>
                                            <!-- /.nav-third-level -->
                                        </li>
                                    {% endif %}
                                    {% if is_granted('ROLE_EMISOR_ADMIN') %}
                                        <li>
                                            <a href="{{path("facturas_load")}}">Cargar Facturas</a>
                                        </li>
                                        <li>
                                            <a href="{{path("producto")}}">Productos</a>
                                        </li>
                                        <li>
                                            <a href="{{path("producto_load")}}">Cargar Productos</a>
                                        </li>
                                        <li>
                                            <a href="{{path("cliente")}}">Clientes</a>

                                        </li>
                                        <li>
                                            <a href="{{path("cliente_load")}}">Cargar Cliente</a>
                                        </li>
                                    {% endif %}
                                    {% if is_granted('ROLE_ADMIN')%}
                                        <li>
                                            <a href="{{path("plan")}}">Planes</a>
                                        </li>
                                        <li>
                                            <a href="{{path("rol")}}">Roles</a>
                                        </li>
                                    {%endif %}
                                    {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_EMISOR_ADMIN') %}

                                        <li>
                                            <a href="{{path("usuario")}}">Usuarios</a>
                                        </li>
                                    {%endif %}


                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">

                <!-- /.row -->
                <br />
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {% block panel_title %}
                            <i class="fa fa-bar-chart-o fa-fw"></i> Comprobantes Electronicos
                        {% endblock %}
                    </div>
                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Eliminar</h4>
                                </div>

                                <div class="modal-body">
                                    <p>Una vez eliminado el registro no se recuperar&aacute;</p>
                                    <p>Desea continuar?</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger danger confirm" data-dismiss="modal">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        {% block content %}

                        {% endblock %}
                        <!-- /.panel-body -->
                    </div>

                </div>
                <!-- /#page-wrapper -->

            </div>

            <script src="{{asset('recursos/js/jquery-1.11.2.min.js')}}"></script>
            <script src="{{asset('recursos/framework/jquery-ui/jquery-ui.min.js')}}"></script>
            <script src="{{asset('recursos/framework/bootstrap/js/bootstrap.min.js')}}"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="{{asset('recursos/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

            <!-- Custom Theme JavaScript -->
            <script src="{{asset('recursos/js/sb-admin-2.js')}}"></script>
            <script src="{{asset('recursos/framework/jquery-validation/dist/jquery.validate.min.js')}}"></script>
            <script src="{{asset('recursos/framework/jquery-validation/dist/additional-methods.min.js')}}"></script>
            <script src="{{asset('recursos/framework/jquery-validation/dist/localization/messages_es.min.js')}}"></script>

            {% block javascript %}

            {% endblock %}
    </body>

</html>
