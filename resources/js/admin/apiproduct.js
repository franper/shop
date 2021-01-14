const apiproduct = new Vue({
    el: '#apiproduct',
    data: {
        nombre: '',
        slug: '',
        div_mensajeslug:'Slug Existe',
        div_clase_slug: '',
        div_aparecer: false,
        deshabilitar_boton:1,

        //variable de precio
        precioanterior : 0,
        precioactual : 0,
        descuento : 0,
        porcentajededescuento : 0,
        descuentomensaje : ''
    }, 
    computed: {
        generarSLug : function(){
            var char= {
                "á":"a","é":"e","í":"i","ó":"o","ú":"u",
                "Á":"A","É":"E","Í":"I","Ó":"O","Ú":"U",
                "ñ":"n","Ñ":"N"," ":"-","_":"-"
            }
            var expr = /[áéíóúÁÉÍÓÚÑñ_ ]/g;

            this.slug =  this.nombre.trim().replace(expr, function(e){
                return char[e]
            }).toLowerCase()

           return this.slug;
           //return this.nombre.trim().replace(/ /g,'-').toLowerCase()
        },
        generarDescuento : function(){

            
            if(this.porcentajededescuento > 0 && this.porcentajededescuento < 100 ){
                
                this.descuento = (this.precioanterior * this.porcentajededescuento)/100;
                
                this.precioactual = this.precioanterior - this.descuento;
                
                this.descuentomensaje = 'Hay un descuento de $'+ this.descuento;
                
                return this.descuentomensaje;
                
            }else{

                this.precioactual = this.precioanterior;

                if(this.porcentajededescuento >= 100){
    
                    this.porcentajededescuento = 100;
    
                    this.descuento = (this.precioanterior * this.porcentajededescuento)/100;
    
                    this.precioactual = this.precioanterior - this.descuento;
                    
                    this.descuentomensaje = 'Hay un descuento del 100% ES GRATIS';
    
                }
                if(this.porcentajededescuento < 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'el valor no puede ser menor a 0'
                    });
                    
                    this.porcentajededescuento = 0;
                    this.descuentomensaje = 'No hay un descuento';
                }
                

                return this.descuentomensaje;
            }
            
        }
    },
    methods: {
        getProduct() {     // ********** CONSULTA AJAX **********
            if(this.slug){
                let url = '/api/product/'+this.slug;
                axios.get(url).then(response => {
                this.div_mensajeslug = response.data;
                    if (this.div_mensajeslug==="Slug Disponible") {
                        this.div_clase_slug = 'badge badge-success';
                        this.deshabilitar_boton=0;
                    } else {
                        this.div_clase_slug = 'badge badge-danger';
                        this.deshabilitar_boton=1;
                    }
                    this.div_aparecer = true;

                })
            } else {
                this.div_clase_slug = 'badge badge-danger';
                this.div_mensajeslug = "el campo nombre no puede estar vacío";
                this.deshabilitar_boton=1;
                this.div_aparecer = true;
            }
            
        }
    },
    mounted(){
        if(document.getElementById('editar')){
            this.nombre = document.getElementById('nombretemp').innerHTML;
            this.deshabilitar_boton=1;
        }
    }

});