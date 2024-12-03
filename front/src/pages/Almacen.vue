<template>
    <q-page padding>
    <q-table title="Listado de Inventario" :rows="listado" :columns="columns" row-key="name" >
        <template v-slot:top-right>
             <q-btn color="green" dense label="Registrar" @click="dialogReg=true"/>
            
            <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>

          <template v-slot:body-cell-op="props">
            <q-td keys="op" :props="props">
                 <q-btn flat color="yellow" icon="edit" dense @click="modificar(props.row)" />
                
            </q-td>
          </template>
    </q-table>

    <q-dialog v-model="dialogReg">
    <q-card>
    <q-card-section>
    <div class="text-h6" v-if="inventario.id==undefined">Registrar Inventario</div>
    <div class="text-h6" v-else>Modificar Inventario</div>
    </q-card-section>
    <q-form @submit="onSubmit"  class="q-gutter-md" >
    <q-card-section>
        <div class="row">
            <div class="col-12"><q-input dense outlined v-model="inventario.nombre" label="Nombre " lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']"/></div>
            <div class="col-12"><q-input dense outlined v-model="inventario.serie" label="serie " lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']"/></div>
            <div class="col-12"><q-input dense outlined v-model="inventario.descripcion" label="descripcion " lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']"/></div>
            <div class="col-12"><q-input dense outlined v-model="inventario.tipo" label="tipo/grupo " /></div>
            <div class="col-12"><q-input dense outlined v-model="inventario.ubicacion" label="ubicacion " /></div>
            <div class="col-12"><q-input dense outlined v-model="inventario.minimo" type="number" label="minimo " /></div>
        </div>

    
    </q-card-section>
    <q-card-actions align="right">
    <q-btn label="REGISTRAR" type="submit" color="green" v-if="inventario.id==undefined" flat/>
    <q-btn label="MODIFICAR" type="submit" color="yellow" v-else flat/>
    <q-btn flat label="CANCELAR" color="red" v-close-popup />
    </q-card-actions>
</q-form>

    </q-card>
    </q-dialog>
    
    </q-page>
</template>
<script>
 export default{
    name:'almacenPage',
  data() {
    return {
        dialogReg:false,
        filter:'',
        inventario:{minimo:1},
        listado:[],
        columns:[
            {label:'OP',name:'op',field:'op'},
            {label:'NOMBRE',name:'nombre',field:'nombre'},
            {label:'SERIE',name:'serie',field:'serie'},
            {label:'DESCRIP',name:'descripcion',field:'descripcion'},
            {label:'TIPO',name:'tipo',field:'tipo'},
            {label:'STOCK',name:'cantidad',field:'cantidad'},
            {label:'MINIMO',name:'minimo',field:'minimo'},
            {label:'UBICACION',name:'ubicacion',field:'ubicacion'},
        ]
    }
  },
  created() {
        this.getInv()
    },
    methods: {
        modificar(r){
            this.inventario=r
            this.dialogReg=true
        },
        getInv(){
            this.$api.get('inventario').then(res =>{
                this.listado=res.data
            })
        },
        onSubmit(){
            if(this.inventario.id==undefined){
                this.$api.post('inventario',this.inventario).then(res =>{
                    this.dialogReg=false
                    this.getInv()
                })
            }
            else{
                this.$api.put('inventario/'+this.inventario.id,this.inventario).then(res =>{
                    this.dialogReg=false
                    this.getInv()
                })
            }
            this.inventario={minimo:1}
        }
    },
}
</script>