<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Compras &mdash; Estratega Contable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../backend/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../backend/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href=../backend/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../backend/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="../backend/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../backend/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../backend/assets/css/style.css">
  <link rel="stylesheet" href="../backend/assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>

        </form>
        <ul class="navbar-nav navbar-right">


          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../backend/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hola, {{ Auth::user()->name}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href=" {{ route('logout')}}"
                    onclick="event.preventDefault();
                this.closest('form').submit();"
                class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                  </a>

            </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Estratega Contable</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">EC</a>
          </div>
          <ul class="sidebar-menu">

            <li class="menu-header">Ingresos</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Ventas</span></a>

              <ul class="dropdown-menu">
                <li><a class="nav-link" href="layout-default.html">Facturación Electrónica</a></li>
                <li><a class="nav-link" href="layout-transparent.html">Retenciones en Ventas</a></li>
                <li><a class="nav-link" href="layout-top-navigation.html">Otros Ingresos</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Reportes</span></a>
              <ul class="dropdown-menu">

                <li><a class="nav-link" href="bootstrap-badge.html">Ventas</a></li>
                <li><a class="nav-link" href="bootstrap-breadcrumb.html">Retenciones</a></li>

              </ul>
            </li>
            <li class="menu-header">Egresos</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Compras</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="compra">Compras Electrónicas</a></li>
                <li><a class="nav-link" href="components-user.html">Notas de Venta</a></li>
                <li><a class="nav-link" href="components-user.html">Retenciones Efectuadas</a></li>
                <li><a class="nav-link" href="components-user.html">Reporte de Compras</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Empleados</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="forms-advanced-form.html">Información Personal</a></li>
                <li><a class="nav-link" href="forms-editor.html">Nómina</a></li>
                <li><a class="nav-link" href="forms-validation.html">Reporte Empleados</a></li>
              </ul>
            </li>
                       <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Registros</span></a>
              <ul class="dropdown-menu">

                <li><a class="nav-link" href="modules-chartjs.html">Ingreso de Diarios</a></li>
                <li><a class="nav-link" href="modules-datatables.html">Reportes de Diarios</a></li>

              </ul>
            </li>
            <li class="menu-header">Impuestos</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-pencil-ruler"></i> <span>Declaraciones</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="modules-chartjs.html">Declaración de IVA</a></li>
                <li><a class="nav-link" href="modules-datatables.html">Impuesto a la Renta</a></li>
                <li><a class="nav-link" href="modules-datatables.html">Retenciones</a></li>
                <li><a class="nav-link" href="modules-datatables.html">Reporte de Impuestos</a></li>
              </ul>
            </li>
            <li class="menu-header">Estados Financieros</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Estados Financieros</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="modules-chartjs.html">Balance General</a></li>
                <li><a class="nav-link" href="modules-datatables.html">Resultados Integrales</a></li>
                <li><a class="nav-link" href="modules-datatables.html">Movimiento de Patrimonio</a></li>
                <li><a class="nav-link" href="modules-datatables.html">Flujo de Caja</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i> <span>Pendientes</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="features-activities.html">Actividades</a></li>
                <li><a class="nav-link" href="features-post-create.html">Notas</a></li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
<br><br><br><br>
        <header>
            <div class="alert alert-info">
                <h3>Extraer XML Compras</h3>
            </div>
        </header>

        <form class="form-inline" method="post" name="xmlForm" id="xmlForm" enctype="multipart/form-data">
            @csrf
            <div class="col-xs-6 col-xs-offset-4">
                <div class="form-group">
                    <label for="input_factura">Factura de Compra a subir:</label>
                    <input type="file" class="form-control" name="input_factura" id="input_factura"  required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Extraer y Guardar</button>
                    <button type="button" onclick="limpiar()" class="btn btn-info">Limpiar</button>
                </div>
            </div>
        </form>
        <br><br><br><br><br>

        <div class="container">
            <pre class="col-xs-12 hidden" id="xml_data"></pre>
        </div>
    </div></div>
</body>

<script type="text/javascript">
    $('#xmlForm').submit(function (e){
        e.preventDefault();
        var Form = new FormData($('#xmlForm')[0]);
        $.ajax({
            url: "../xml.php",
            type: "post",
            data: Form,
            processData: false,
            contentType: false,
            success: function (data)
            {
                $('#xml_data').removeClass('hidden');
                $('#xml_data').append(data);
                $('#xml_data').html(data);
            }
        })
    })

    function limpiar()
    {
        $('#input_factura').val(null);
        $('#xml_data').empty();
        $('#xml_data').addClass('hidden');
    }

</script>



<!-- Resultado de la BD -->
<br><br>
      <div class="row">
        <div class="col-lg-7 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Listado de Facturas de Compra:</h4>

              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Ruc Proveedor</th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>Factura No.</th>
                        <th>Proveedor</th>
                        <th>RUC</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>ICE</th>
                        <th>Subtotal Iva 0%</th>
                        <th>Subtotal Iva 12%</th>
                        <th>Iva 12%</th>
                        <th>Propina</th>
                        <th>TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($compras as $compra)

                        <tr>
                            <th>{{$compra->ruc_empresa}}</th>
                            <th>{{$compra->empresa}}</th>
                            <th>{{$compra->fechaEmision}}</th>
                            <th>{{$compra->numeroFactura}}</th>
                            <th>{{$compra->razonSocialProveedor}}</th>
                            <th>{{$compra->identificacionProveedor}}</th>
                            <th>{{$compra->totalSinImpuestos}}</th>
                            <th>{{$compra->totalDescuento}}</th>
                            <th>{{$compra->valorICE}}</th>
                            <th>{{$compra->subTotalIva0}}</th>
                            <th>{{$compra->subTotalIva12}}</th>
                            <th>{{$compra->iva12}}</th>
                            <th>{{$compra->propina}}</th>
                            <th>{{$compra->valorTotal}}</th>

                            <th><a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"  data-confirm="Estás seguro?|Esta acción es delicada y es bajo tu responsabilidad. Quieres continuar?" data-confirm-yes="alert('Modificado')"><i class="fas fa-pencil-alt"></i></a></th>

                        </tr>

                    @endforeach


                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2024 <div class="bullet"></div> Diseñado por:  <a href="https://estrategacontable.com">Estratega Contable</a>
        </div>
        <div class="footer-right">

        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="../backend/assets/modules/jquery.min.js"></script>
  <script src="../backend/assets/modules/popper.js"></script>
  <script src="../backend/assets/modules/tooltip.js"></script>
  <script src="../backend/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../backend/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../backend/assets/modules/moment.min.js"></script>
  <script src="../backend/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../backend/assets/modules/jquery.sparkline.min.js"></script>
  <script src="../backend/assets/modules/chart.min.js"></script>
  <script src="../backend/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="../backend/assets/modules/summernote/summernote-bs4.js"></script>
  <script src="../backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="../backend/assets/js/page/index.js"></script>

  <!-- Template JS File -->
  <script src="../backend/assets/js/scripts.js"></script>
  <script src="../backend/assets/js/custom.js"></script>
</body>
</html>
