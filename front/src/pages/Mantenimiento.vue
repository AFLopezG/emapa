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
            <q-card>
                <q-card-section>
                    <div class="text-h6">REVSION {{dato.actividad.nombre}}</div>
                </q-card-section>
                <q-card-section>
                    <div class="row">
                        <div class="col-6"><q-select square outlined v-model="registro.condicion" :options="['OPERATIVO','PENDIENTE DE REPARACION','REQUIERE REVISION']" label="Condicion" /></div>
                        <div class="col-6 q-pa-xs"><q-input  outlined v-model="registro.duracion" label="duracion" type="number"/></div>
                        <div class="col-6 q-pa-xs"><q-input  outlined v-model="registro.detalle" label="detalle" /></div>
                    </div>
                    <div class="row">
                        <div class="col-12"><q-select square outlined v-model="material" :options="inventario" label="Material" option-label="nombre"/></div>
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
            material:{nombre:''},
            registro:{},
            inventario:[],
            dato:{},
            listado:[],
            fecha:moment().format("YYYY-MM-DD"),
            columns:[
                {name:'op',label:'op',field:'op'},
                {name:'actividad',label:'actividad',field:row=>row.actividad.nombre},
                {name:'equipo',label:'equipo',field:row=>row.actividad.equipo.nombre},
                {name:'tipo',label:'tipo',field:'tipo'},
                {name:'descripcion',label:'descripcion',field:'descripcion'},
            ]
        }
    },
    created(){
        this.getplan()
        this.getInv()
    },
    methods:{
        getInv(){
            this.$api.get('inventario').then(res =>{
                console.log(res.data)
                this.inventario=res.data
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