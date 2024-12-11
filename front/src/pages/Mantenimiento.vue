<template>
    <q-page padding>
        <div class="row">
            <div class="col-6 q-pa-xs"><q-input dense outlined v-model="fecha" label="Fecha" type="date"/></div>
            <div class="col-6 q-pa-xs"> <q-btn color="info"  icon="search" @click="getplan"/>   </div>
        </div>
        <q-table title="Mantenimiento Programado" :rows="listado" :columns="columns" row-key="name" >
            <template v-slot:body-cell-op="props">
                <q-td keys="op" :props="props">
                     <q-btn flat color="acent" icon="checklist" dense @click="dato=props.row; dialogReg=true" />                
                </q-td>
              </template>
        </q-table>
        <q-dialog v-model="dialogReg">
            <q-card style="width: 700px; max-width: 80vw;">
                <q-card-section>
                    <div class="text-h6">REVSION {{dato.actividad.nombre}}</div>
                </q-card-section>
                <q-card-section>
                    <div class="row">
                        <div class="col-6 q-pa-xs"><q-select dense outlined v-model="registro.condicion" :options="['OPERATIVO','PENDIENTE DE REPARACION','REQUIERE REVISION']" label="Condicion" /></div>
                        <div class="col-6 q-pa-xs"><q-input dense outlined v-model="registro.duracion" label="duracion" type="number"/></div>
                        <div class="col-12 q-pa-xs"><q-input dense outlined v-model="registro.detalle" label="detalle" /></div>
                    </div>
                    <div class="row">
                        <div class="col-12 q-pa-xs"><q-select  dense outlined v-model="material" :options="inventario" label="Material"  @filter="filterFn" use-input input-debounce="0"/></div>
                        <div class="col-6 q-pa-xs"><q-input dense outlined v-model="cantidad" label="Cantidad" type="number"/></div>
                        <div class="col-6 q-pa-xs"><q-btn color="green" icon="check" label="agregar" @click="agregar"/></div>
                        <div class="col-12 q-pa-xs">
                            <q-table  :rows="detalles" :columns="colList" row-key="name" dense >
                                <template v-slot:body-cell-op="props">
                                    <q-td keys="op" :props="props">
                                         <q-btn flat color="red" icon="delete" dense @click="eliminar(props)" />                
                                    </q-td>
                                  </template>
                            </q-table>
                            
                        
                        </div>
                    </div>
                </q-card-section>
                <q-card-actions align="right">
                    <q-btn flat label="OK" color="primary" v-close-popup />
                </q-card-actions>
            </q-card>
        </q-dialog>
        
    </q-page>
</template>
<script>
import moment from "moment"
export default {
    name:'MantPage',
    data() {
        return {
            dialogReg:false,
            material:{label:''},
            registro:{},
            inventario:[],
            filterinv:[],
            dato:{},
            listado:[],
            detalles:[],
            fecha:moment().format("YYYY-MM-DD"),
            columns:[
                {name:'op',label:'op',field:'op'},
                {name:'actividad',label:'actividad',field:row=>row.actividad.nombre},
                {name:'equipo',label:'equipo',field:row=>row.actividad.equipo.nombre},
                {name:'tipo',label:'tipo',field:'tipo'},
                {name:'descripcion',label:'descripcion',field:'descripcion'},
            ],
            colList:[
            {name:'op',label:'op',field:'op'},
            {name:'cantidad',label:'cantidad',field:'cantidad'},
            {name:'nombre',label:'nombre',field:'nombre'},
            ]
        }
    },
    created(){
        this.getplan()
        this.getInv()
    },
    methods:{
        agregar(){
            this.material.cantidad=this.cantidad
            this.detalles.push(this.material)
        },
        eliminar(p){
            console.log(p)
            this.detalles.splice(p.rowIndex,1)
        },
        filterFn (val, update) {
        if (val === '') {
          update(() => {
            this.inventario = this.filterinv

            // here you have access to "ref" which
            // is the Vue reference of the QSelect
          })
          return
        }

        update(() => {
          const needle = val.toLowerCase()
          this.inventario = this.filterinv.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
        })
      },
        getInv(){
            this.$api.get('inventario').then(res =>{
                console.log(res.data)
                res.data.forEach(r => {
                    r.label=r.nombre
                });
                this.inventario=res.data
                this.filterinv=this.inventario
            })
        },
        getplan(){
            this.$api.get('listPlan/'+this.fecha).then(res=>{
                console.log(res.data)
                this.listado=res.data
            })

        }
    }
}
</script>