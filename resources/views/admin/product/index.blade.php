@extends("plantilla.admin")

@section("titulo","Administración De Producto")

@section("breadcrumb")
<li class="breadcrumb-item active"> @yield("titulo")</li>
@endsection

@section("contenido")
<!-- /.row -->
<div class="row" id="confirmarEliminar">
    <span style="display:none" id="urlBase">{{route('admin.product.index')}}</span>
    @include('custom.modal_eliminar')

    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Sección de Productos</h3>

        <div class="card-tools">
            <form action="">
                <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="nombre" class="form-control float-right" placeholder="Buscar" value="{{ request()->get('nombre') }}">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
                </div>
            </form>
        </div>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <a class="m-2 float-right btn btn-primary" href="{{ route('admin.product.create') }}"> <i class="fas fa-plus"></i> Añadir Producto </a>
            <table class="table table-head-fixed">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Activo</th>
                    <th>Slider Principal</th>
                    <th colspan="3"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>

                        @if($producto->images->count()>=1)

                            <td><img style="height:100px; width:100px;" class="rounded-circle" src="{{ $producto->images->random()->url }}" alt=""></td>

                        @else

                            <td><img style="height:100px; width:100px;" class="rounded-circle" src="/imagenes/avatar5.png" alt=""></td>
                        
                        @endif
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->estado }}</td>
                        <td>{{ $producto->activo }}</td>
                        <td>{{ $producto->sliderprincipal }}</td>
                        <td><a class="btn btn-default" 
                            href="{{ route('admin.product.show', $producto->slug) }}">  <i class="far fa-eye"></i> </a>
                        </td>
                        <td><a class="btn btn-info" 
                            href="{{ route('admin.product.edit', $producto->slug) }}"> <i class="far fa-edit"></i> </a>
                        </td>
                        <td><a class="btn btn-danger " 
                            href="{{ route('admin.product.index') }}" 
                            v-on:click.prevent="desea_eliminar({{ $producto->id }})">  <i class="far fa-trash-alt"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
            {{ $productos->appends($_GET)->links() }}  <!-- este el paginador -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
</div>
<!-- /.row -->

@endsection