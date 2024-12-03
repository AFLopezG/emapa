<template>
    <q-page padding>
    <q-table title="Listado de Equipos" :rows="listado" :columns="columns" row-key="name" >
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
                 <q-btn flat color="yellow" icon="edit" dense @click="modificar(props.row)" v-if="props.row.estado!='FUERA DE SERVICIO'"/>                
            </q-td>
          </template>
    </q-table>
    <q-dialog v-model="dialogReg">
    <q-card>
    <q-card-section>
    <div class="text-h6" v-if="equipo.id==undefined">Registrar Equipo</div>
    <div class="text-h6" v-else>Modificar Equipo</div>
    </q-card-section>
    <q-form @submit="onSubmit"  class="q-gutter-md" >
    <q-card-section>
    <div class="row">
        <div class="col-12 q-pa-xs"><q-input outlined dense v-model="equipo.codigo" label="Codigo" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']" /></div>
        <div class="col-12 q-pa-xs"><q-input outlined dense v-model="equipo.nombre" label="Nombre Equip" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']" /></div>
        <div class="col-12 q-pa-xs"><q-input outlined dense v-model="equipo.ubicacion" label="Ubicacion" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']" /></div>
        <div class="col-12 q-pa-xs"><q-input outlined dense v-model="equipo.adquisicion" label="Fec Adquisicion" type="date" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']" /></div>
        <div class="col-12 q-pa-xs" v-if="equipo.id!=undefined"><q-select outlined dense v-model="equipo.estado" label="Estado" :options="['OPERATIVO','EN MANTENIMIENTO','FUERA DE SERVICIO']" /></div>
        <div class="col-12 q-pa-xs"><q-input outlined dense v-model="equipo.operador" label="Operador Resp" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']" /></div>
    </div>
    

    
    </q-card-section>
    <q-card-actions align="right">
    <q-btn label="REGISTRAR" type="submit" color="green" v-if="equipo.id==undefined" flat/>
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
        equipo:{},
        listado:[],
        columns:[
            {label:'OP',name:'op',field:'op'},
            {label:'CODIGO',name:'codigo',field:'codigo'},
            {label:'NOMBRE',name:'nombre',field:'nombre'},
            {label:'UBICACION',name:'ubicacion',field:'ubicacion'},
            {label:'Fec Adq',name:'adquisicion',field:'adquisicion'},
            {label:'Resp',name:'operador',field:'operador'},
        ]
    }
  },
  created() {
        this.getEquip()
    },
    methods: {
        modificar(r){
            this.equipo=r
            this.dialogReg=true
        },

        getEquip(){
            this.$api.get('equipo').then(res =>{
                this.listado=res.data
            })
        },
        onSubmit(){
            /*if(this.user.id==undefined)
                return false
            this.equipo.user_id=this.user.id*/

            if(this.equipo.id==undefined){
                this.$api.post('equipo',this.equipo).then(res =>{
                    this.dialogReg=false
                    this.getMaq()
                })
            }
            else{
                this.$api.put('equipo/'+this.equipo.id,this.equipo).then(res =>{
                    this.dialogReg=false
                    this.getMaq()
                })
            }
        }
    },
}
</script>