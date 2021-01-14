@extends("plantilla.admin")

@section("titulo","editar Categoría")

@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categorías</a></li>
<li class="breadcrumb-item active"> @yield("titulo")</li>
@endsection

@section("contenido")
<div id="apicategory">
  <form action=" {{ route('admin.category.update', $cat->id) }} " method="post">
  @csrf
  @method('PUT')

  <span style="display:none;" id="editar"> {{$editar}} </span>
  <span style="display:none;" id="nombretemp"> {{$cat->nombre}} </span>
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Administración de Categorías</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">


            <div class="container">
                
                    
              <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input v-model="nombre" 

                      @blur="getCategory" 
                      @focus = "div_aparecer= false"
                  
                  class="form-control" type="text" name="nombre" id="nombre">
                  <label for="slug">Slug</label>
                  <input readonly v-model="generarSLug"  class="form-control" type="text" name="slug" id="slug">
                  <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                  @{{ div_mensajeslug }}
                  </div>
                  <br v-if="div_aparecer">
                  <label for="descripcion">Descripción</label>
                  <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="5">{{$cat->descripcion}}
                  </textarea>
                  
              </div>
                            
                
            </div>


        </div>
        <!-- /.card-body -->
        <div class="card-footer">
             <a href="{{ route('cancelar','admin.category.index') }}" class="btn btn-danger">Cancelar</a>
            <input 
            :disabled = "deshabilitar_boton==1"
            type="submit" value="Guardar" class="btn btn-primary float-right">
                    
                   
        </div>
        <!-- /.card-footer-->
    </div>
      <!-- /.card -->
  </form>
</div>
@endsection