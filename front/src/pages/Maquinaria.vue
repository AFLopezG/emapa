<template>
    <q-page padding>
    <q-table title="Listado de Maquinaria" :rows="listado" :columns="columns" row-key="name" >
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
    <div class="text-h6" v-if="maq.id==undefined">Registrar </div>
    <div class="text-h6" v-else>Modificar </div>
    </q-card-section>
    <q-form @submit="onSubmit"  class="q-gutter-md" >
    <q-card-section>
    <q-input filled v-model="maq.nombre" label="Nombre" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']" />

    
    </q-card-section>
    <q-card-actions align="right">
    <q-btn label="REGISTRAR" type="submit" color="green" v-if="maq.id==undefined" flat/>
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
    name:'maquinariaPage',
  data() {
    return {
        dialogReg:false,
        filter:'',
        maq:{},
        listado:[],
        columns:[
            {label:'OP',name:'op',field:'op'},
            {label:'NOMBRE',name:'nombre',field:'nombre'},
        ]
    }
  },
  created() {
        this.getMaq()
    },
    methods: {
        modificar(r){
            this.maq=r
            this.dialogReg=true
        },
        getMaq(){
            this.$api.get('maquinaria').then(res =>{
                this.listado=res.data
            })
        },
        onSubmit(){
            if(this.maq.id==undefined){
                this.$api.post('maquinaria',this.maq).then(res =>{
                    this.dialogReg=false
                    this.getMaq()
                })
            }
            else{
                this.$api.put('maquinaria/'+this.maq.id,this.maq).then(res =>{
                    this.dialogReg=false
                    this.getMaq()
                })
            }
        }
    },
}
</script>