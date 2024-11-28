<template>
    <q-page padding>
    <q-table title="Listado Actividad Equipo" :rows="listado" :columns="columns" row-key="name" >
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
    <div class="text-h6" v-if="actividad.id==undefined">Registrar Equipo</div>
    <div class="text-h6" v-else>Modificar Equipo</div>
    </q-card-section>
    <q-form @submit="onSubmit"  class="q-gutter-md" >
    <q-card-section>
    <div class="row">
        <div class="col-12 q-pa-xs"><q-input outlined dense v-model="actividad.nombre" label="Nombre Act" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']" /></div>
        <div class="col-12 q-pa-xs"><q-select outlined dense v-model="actividad.tipo" :options="['ELECTRICO','MECANICO']" label="Tipo" :rules="[ val => val && val.length > 0 || 'Dato requerido']"/></div>
        <div class="col-12 q-pa-xs"><q-input outlined dense v-model="actividad.asociado" label="Asociado" lazy-rules :rules="[ val => val && val.length > 0 || 'Dato requerido']" /></div>
        <div class="col-12 q-pa-xs"><q-select outlined dense v-model="fr" :options="frec" label="Frecuencia" /></div>
        <div class="col-12 q-pa-xs"><q-select outlined dense v-model="equipo" :options="equipos" label="EQUIPO" option-label="nombre"/></div>
        <div class="col-12 q-pa-xs"><q-select outlined dense v-model="maq" :options="maquinarias" label="MAQUINARIA" option-label="nombre"/></div>
    </div>
    
   </q-card-section>
    <q-card-actions align="right">
    <q-btn label="REGISTRAR" type="submit" color="green" v-if="actividad.id==undefined" flat/>
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
        maquinarias:[],
        equipos:[],
        equipo:{nombre:''},
        maq:{nombre:''},
        filter:'',
        listado:[],
        actividad:{},
        frec:[
            {label:'SEMANAL',dias:7},
            {label:'MENSUAL',dias:30},
            {label:'TRIMESTRAL',dias:90},
            {label:'SEMESTRAL',dias:180},
            {label:'ANUAL',dias:365},
        ],
        fr:{label:'SEMANAL',dias:7},
        columns:[
            {label:'OP',name:'op',field:'op'},
            {label:'NOMBRE',name:'nombre',field:'nombre'},
            {label:'ASOCIADO',name:'asociado',field:'asociado'},
            {label:'TIPO',name:'tipo',field:'tipo'},
            {label:'frecuencia',name:'frecuencia',field:'frecuencia'},
            {label:'Equipo.',name:'user',field:row=>row.equipo.nombre},
            {label:'Maq.',name:'user',field:row=>row.maquinaria.nombre},
        ]
    }
  },
  created() {
        this.getAct()
        this.getEq()
        this.getMaq()
    },
    methods: {
        modificar(r){

            this.actividad=r
            this.fr={label:this.actividad.frecuencia,dias:this.actividad.dias}
            this.equipo=r.equipo
            this.maq=r.maquinaria
            this.dialogReg=true
        },
        getAct(){
            this.$api.get('actividad').then(res =>{
                console.log(res.data)
                this.listado=res.data
            })
        },
        getEq(){
            this.$api.get('listEq').then(res =>{
                console.log(res.data)
                this.equipos=res.data
            })
        },
        getMaq(){
            this.$api.get('maquinaria').then(res =>{
                this.maquinarias=res.data
            })
        },
        onSubmit(){
            if(this.equipo.id==undefined)
                return false
            if(this.maq.id==undefined)
                return false

            this.actividad.equipo_id=this.equipo.id
            this.actividad.maquinaria_id=this.maq.id
            this.actividad.frecuencia=this.fr.label
            this.actividad.dias=this.fr.dias

            if(this.actividad.id==undefined){
                this.$api.post('actividad',this.actividad).then(res =>{
                    this.dialogReg=false
                    this.getAct()
                })
            }
            else{
                this.$api.put('actividad/'+this.actividad.id,this.actividad).then(res =>{
                    this.dialogReg=false
                    this.getAct()
                })
            }
        }
    },
}
</script>