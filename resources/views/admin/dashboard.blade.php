@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Dashboard Administrador</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Admin</h4>
            </div>
            <div class="card-body">
              1
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-newspaper"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>To Do</h4>
            </div>
            <div class="card-body">
              3
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Reportes</h4>
            </div>
            <div class="card-body">
              11
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-circle"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Usuarios en Línea</h4>
            </div>
            <div class="card-body">
              4
            </div>
          </div>
        </div>
      </div>                  
    </div>
   


    <div class="row">
      <div class="col-lg-7 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Administración de Usuarios</h4>
            <div class="card-header-action">
           <!--   <a href="#" class="btn btn-primary">View All</a>  -->
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped mb-0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Ruc</th>
                    <th>Empresa</th>
                    <th>Usuario</th>
                    <th>Email Usuario</th>
                    <th>Perfil</th>
                    <th>Estatus</th>
                    <th>Creado el:</th>
                    <th>Actualizado el:</th>
                    <th>Editar</th>
                  </tr>
                </thead>  
                <tbody>   
                  @foreach($users as $user)
              
                    <tr>
                        <th>{{$user->id}}</th>
                        <th>{{$user->ruc}}</th>
                        <th>{{$user->empresa}}</th>
                        <th>{{$user->name}}</th>
                        <th>{{$user->email}}</th>
                        <th>{{$user->rol}}</th>
                        <th>{{$user->estatus}}</th>
                        <th>{{$user->created_at}}</th>
                        <th>{{$user->updated_at}}</th>
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
  </section>
@endsection