const confirmarEliminar = new Vue({
    el: '#confirmarEliminar',
    data: {
        urlEliminar: '',
    }, 
    methods: {
        desea_eliminar(id){
            this.urlEliminar = document.getElementById("urlBase").innerHTML+'/'+id;
           // alert(this.urlEliminar);
           $('#modal_eliminar').modal('show');
        }
    }

});