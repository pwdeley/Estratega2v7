@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Editar Perfil</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard')}}">Dashboard</a></div>
        <div class="breadcrumb-item">Editar Perfil</div>
      </div>
    </div>
    <div class="section-body">
      
      <div class="row mt-sm-4">

        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">
            <form method="post" class="needs-validation" novalidate="" action="{{ route('admin.perfil.update')}}">
                @csrf
                <div class="card-header">
                <h4>Datos del Usuario</h4>
              </div>
              <div class="card-body">
                  <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                      <label>Nombres y Apellidos</label>
                      <input type="text" class="form-control" name="name" value="{{ Auth::user()->name}}" required="">
                      <div class="invalid-feedback">
                        Complete el campo con sus Nombres y Apellidos.
                      </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>Correo Electrónico</label>
                      <input type="email" class="form-control" name="email" value="{{ Auth::user()->email}}" required="">
                      <div class="invalid-feedback">
                        Complete el campo con su Correo Electrónico
                      </div>
                    </div>
                  </div>

              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Guardar Cambios</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection