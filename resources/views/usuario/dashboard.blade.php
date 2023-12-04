<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Finanzas &mdash; Estratega Contable</title>

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
            
</aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-title">Estadisticas del mes de: - 
                    <div class="dropdown d-inline">
                      <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
                      <ul class="dropdown-menu dropdown-menu-sm">
                        <li class="dropdown-title">Select Month</li>
                        <li><a href="#" class="dropdown-item">January</a></li>
                        <li><a href="#" class="dropdown-item">February</a></li>
                        <li><a href="#" class="dropdown-item">March</a></li>
                        <li><a href="#" class="dropdown-item">April</a></li>
                        <li><a href="#" class="dropdown-item">May</a></li>
                        <li><a href="#" class="dropdown-item">June</a></li>
                        <li><a href="#" class="dropdown-item">July</a></li>
                        <li><a href="#" class="dropdown-item active">August</a></li>
                        <li><a href="#" class="dropdown-item">September</a></li>
                        <li><a href="#" class="dropdown-item">October</a></li>
                        <li><a href="#" class="dropdown-item">November</a></li>
                        <li><a href="#" class="dropdown-item">December</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-stats-items">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">24</div>
                      <div class="card-stats-item-label"><a class="nav-link" href="../Layout">Ventas</a></div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">12</div>
                      <div class="card-stats-item-label"><a class="nav-link" href="{{ asset ('usuario/Layout')}}">Compras</a></div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">23</div>
                      <div class="card-stats-item-label"><a class="nav-link" href="../Layout">Personal</a></div>
                    </div>
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Facturas</h4>
                  </div>
                  <div class="card-body">
                    59
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <canvas id="balance-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Utilidad del Período</h4>
                  </div>
                  <div class="card-body">
                    $187,13
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <canvas id="sales-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Ventas</h4>
                  </div>
                  <div class="card-body">
                    4,732
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <canvas id="sales-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Compras</h4>
                  </div>
                  <div class="card-body">
                    3,732
                  </div>
                </div>
              </div>
            </div>
        
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Ventas vs Compras</h4>
                </div>
                <div class="card-body">
                  <canvas id="myChart" height="158"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card gradient-bottom">
                <div class="card-header">
                  <h4>Top 5 Productos</h4>
                  <div class="card-header-action dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Mes</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                      <li class="dropdown-title">Seleccione el Período</li>
                      <li><a href="#" class="dropdown-item">Hoy</a></li>
                      <li><a href="#" class="dropdown-item">Semana</a></li>
                      <li><a href="#" class="dropdown-item active">Mes</a></li>
                      <li><a href="#" class="dropdown-item">Año</a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body" id="top-5-scroll">
                  <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="assets/img/products/product-3-50.png" alt="product">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small">86 Ventas</div></div>
                        <div class="media-title">oPhone S9 Limited</div>
                        <div class="mt-1">
                          <div class="budget-price">
                            <div class="budget-price-square bg-primary" data-width="64%"></div>
                            <div class="budget-price-label">$68,714</div>
                          </div>
                          <div class="budget-price">
                            <div class="budget-price-square bg-danger" data-width="43%"></div>
                            <div class="budget-price-label">$38,700</div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="assets/img/products/product-4-50.png" alt="product">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small">67 Ventas</div></div>
                        <div class="media-title">iBook Pro 2018</div>
                        <div class="mt-1">
                          <div class="budget-price">
                            <div class="budget-price-square bg-primary" data-width="84%"></div>
                            <div class="budget-price-label">$107,133</div>
                          </div>
                          <div class="budget-price">
                            <div class="budget-price-square bg-danger" data-width="60%"></div>
                            <div class="budget-price-label">$91,455</div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="assets/img/products/product-1-50.png" alt="product">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small">63 Ventas</div></div>
                        <div class="media-title">Headphone Blitz</div>
                        <div class="mt-1">
                          <div class="budget-price">
                            <div class="budget-price-square bg-primary" data-width="34%"></div>
                            <div class="budget-price-label">$3,717</div>
                          </div>
                          <div class="budget-price">
                            <div class="budget-price-square bg-danger" data-width="28%"></div>
                            <div class="budget-price-label">$2,835</div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="assets/img/products/product-3-50.png" alt="product">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small">28 Ventas</div></div>
                        <div class="media-title">oPhone X Lite</div>
                        <div class="mt-1">
                          <div class="budget-price">
                            <div class="budget-price-square bg-primary" data-width="45%"></div>
                            <div class="budget-price-label">$13,972</div>
                          </div>
                          <div class="budget-price">
                            <div class="budget-price-square bg-danger" data-width="30%"></div>
                            <div class="budget-price-label">$9,660</div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="assets/img/products/product-5-50.png" alt="product">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small">19 Ventas</div></div>
                        <div class="media-title">Old Camera</div>
                        <div class="mt-1">
                          <div class="budget-price">
                            <div class="budget-price-square bg-primary" data-width="35%"></div>
                            <div class="budget-price-label">$7,391</div>
                          </div>
                          <div class="budget-price">
                            <div class="budget-price-square bg-danger" data-width="28%"></div>
                            <div class="budget-price-label">$5,472</div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="card-footer pt-3 d-flex justify-content-center">
                  <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-primary" data-width="20"></div>
                    <div class="budget-price-label">Precio de Venta</div>
                  </div>
                  <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-danger" data-width="20"></div>
                    <div class="budget-price-label">Precio Presupuestado</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Los mejores Productos</h4>
                </div>
                <div class="card-body">
                  <div class="owl-carousel owl-theme" id="products-carousel">
                    <div>
                      <div class="product-item pb-3">
                        <div class="product-image">
                          <img alt="image" src="assets/img/products/product-4-50.png" class="img-fluid">
                        </div>
                        <div class="product-details">
                          <div class="product-name">iBook Pro 2018</div>
                          <div class="product-review">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                          </div>
                          <div class="text-muted text-small">67 Vendidos</div>
                          <div class="product-cta">
                            <a href="#" class="btn btn-primary">Detalle</a>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div>
                      <div class="product-item">
                        <div class="product-image">
                          <img alt="image" src="assets/img/products/product-3-50.png" class="img-fluid">
                        </div>
                        <div class="product-details">
                          <div class="product-name">oPhone S9 Limited</div>
                          <div class="product-review">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                          </div>
                          <div class="text-muted text-small">86 Vendidos</div>
                          <div class="product-cta">
                            <a href="#" class="btn btn-primary">Detalle</a>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div>
                      <div class="product-item">
                        <div class="product-image">
                          <img alt="image" src="assets/img/products/product-1-50.png" class="img-fluid">
                        </div>
                        <div class="product-details">
                          <div class="product-name">Headphone Blitz</div>
                          <div class="product-review">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                          </div>
                          <div class="text-muted text-small">63 Vendidos</div>
                          <div class="product-cta">
                            <a href="#" class="btn btn-primary">Detalle</a>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Últimas Facturaciones</h4>
                  <div class="card-header-action">
                    <a href="#" class="btn btn-danger">Ver más <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>Factura No.</th>
                        <th>Cliente</th>
                        <th>Estatus</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                      </tr>
                      <tr>
                        <td><a href="#">INV-87239</a></td>
                        <td class="font-weight-600">Kusnadi</td>
                        <td><div class="badge badge-warning">Unpaid</div></td>
                        <td>July 19, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-48574</a></td>
                        <td class="font-weight-600">Hasan Basri</td>
                        <td><div class="badge badge-success">Paid</div></td>
                        <td>July 21, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-76824</a></td>
                        <td class="font-weight-600">Muhamad Nuruzzaki</td>
                        <td><div class="badge badge-warning">Unpaid</div></td>
                        <td>July 22, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-84990</a></td>
                        <td class="font-weight-600">Agung Ardiansyah</td>
                        <td><div class="badge badge-warning">Unpaid</div></td>
                        <td>July 22, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-87320</a></td>
                        <td class="font-weight-600">Ardian Rahardiansyah</td>
                        <td><div class="badge badge-success">Paid</div></td>
                        <td>July 28, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
       
          </div>
        </section>
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