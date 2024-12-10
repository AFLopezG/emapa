<template>
    <q-page padding>
        <div class="col-12">
            <div class="text-h5">PROGRAMACION DE FUNCIONES</div>
              <q-btn label="Registrar" icon="add_circle" color="primary" @click="dialogReg=true; "/>
              <FullCalendar class="full-height" :options="calendarOptions" />
      
            </div>
        <q-dialog v-model="dialogReg" full-width="">
            <q-card>
                <q-card-section>
                    <div class="text-h6">PROGRAMAR</div>
                </q-card-section>
                <q-form @submit="onSubmit"  class="q-gutter-md" >
     
                
                <q-card-section>
                   <div class="row">
                    <div class="col-6 q-pa-xs"><q-select dense square outlined v-model="equipo" :options="equipos" label="Equipos" option-label="nombre" @update:model-value="cargar"/></div>
                    <div class="col-6 q-pa-xs"><q-select dense square outlined v-model="actividad" :options="actividades" label="Actividad" option-label="nombre" v-if="actividades.length>0"/></div>
                    <div class="col-6 q-pa-xs"><q-input dense square outlined v-model="trabajo.creacion" type="date" label="Fecha Inicio" v-if="actividades.length>0" required/></div>
                    <div class="col-6 q-pa-xs"><q-select dense square outlined v-model="trabajo.tipo" :options="tipo" label="Tipo" v-if="actividades.length>0" required/></div>
                    <div class="col-12 q-pa-xs"><q-input dense square outlined v-model="trabajo.descripcion" label="Descripcion" v-if="actividades.length>0"/></div>
                   </div>
                </q-card-section> 
                    <q-card-actions align="right">
                    <q-btn flat label="CANCELAR" color="red" v-close-popup />
                    <q-btn flat label="REGISTRAR" color="green" type="submit" v-if="actividades.length>0 " />
                </q-card-actions>
                    </q-form>
            </q-card>
        </q-dialog>
          
        <q-dialog v-model="dialogMod" full-width="">
            <q-card>
                <q-card-section>
                    <div class="text-h6">MODIFICAR PROGRAMAR</div>
                </q-card-section>
                <q-form @submit="onMod"  class="q-gutter-md" >
     
                
                <q-card-section>
                   <div class="row">
                    <div class="col-6 q-pa-xs"><b>EQUIPO: </b> {{trabajo2.actividad.equipo.nombre}}</div>
                    <div class="col-6 q-pa-xs"><b>ACTIVIDAD: </b> {{trabajo2.actividad.nombre}}</div>
                    <div class="col-6 q-pa-xs"><q-input dense square outlined v-model="trabajo2.creacion" type="date" label="Fecha Inicio"  required/></div>
                    <div class="col-6 q-pa-xs"><q-select dense square outlined v-model="trabajo2.tipo" :options="tipo" label="Tipo" v required/></div>
                    <div class="col-12 q-pa-xs"><q-input dense square outlined v-model="trabajo2.descripcion" label="Descripcion" /></div>
                   </div>
                </q-card-section> 
                    <q-card-actions align="right">
                    <q-btn flat label="CANCELAR" color="red" v-close-popup />
                    <q-btn flat label="MODIFICAR" color="green" type="submit" />
                </q-card-actions>
                    </q-form>
            </q-card>
        </q-dialog>
    </q-page>
</template>

<script>
import {date} from 'quasar'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import esLocale from "@fullcalendar/core/locales/es";
import moment from "moment"
import Equipo from "./Equipo.vue";

 export default{
    name:'cronogramaPage',
    components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
        tipo:['PREVENTIVO','CORRECTIVO','PREDICTIVO'],
        dialogReg:false,
        dialogMod:false,
        equipos:[],
        equipo:{nombre:''},
        actividades:[],
        actividad:{},
        trabajo2:{},
        trabajos:[],
        trabajo:{'creacion':moment().format("YYYY-MM-DD")},
        calendarOptions: {
        // slotMinTime: "09:00:00",

        selectable:true,
        plugins: [ dayGridPlugin, timeGridPlugin,interactionPlugin], headerToolbar: {
          left: 'prev,next',
          center: 'title',
          right: 'dayGridMonth,dayGridWeek,dayGridDay',
        },
        initialView: 'dayGridWeek',
        locale: esLocale,
        allDaySlot:false,
        editable: true,
        selectMirror: true,
        dayMaxEvents: true,
        firstDay:1,
        // weekends: true,
        // select: this.handleDateSelect,
        // dateClick: this.handleDateClick,
        eventClick: this.eventTitleClick,
        dateClick:this.dateClick,
        // select:this.handleSelect,
        events: [
          // { title: 'event 1', date: '2022-02-01' },
          // { title: 'event 2', date: '2022-02-02' }
        ],
        height: "auto",
        weekends: true // initial value
      },
    }
    },
    created(){
        this.getAct()
        this.getTrabajo()
    },
    methods:{
        onSubmit(){
            //console.log(this.equipo.id==undefined || this.actividad.id==undefined)
            if(this.equipo.id==undefined || this.actividad.id==undefined)
                return false

            this.trabajo.actividad_id=this.actividad.id

            this.$api.post('trabajo',this.trabajo).then(res=>{
                this.getTrabajo()
                this.trabajo={'creacion':moment().format("YYYY-MM-DD")}
                this.dialogReg=false
            })

        },
        onMod(){
            this.$api.put('trabajo/'+this.trabajo2.id,this.trabajo2).then(res=>{
                this.dialogMod=false
                this.getTrabajo()
            })
        },
        cargar(){
            if((this.equipo.actividades).length>0){
                this.actividades=this.equipo.actividades
                this.actividad=this.actividades[0]
            }
        },
        eventTitleClick: function(args) {
             console.log(args.event.id)
            this.trabajos.forEach(r=>{
                if(r.id==args.event.id)
                this.trabajo2=r
            })
            this.dialogMod=true
            },
        getAct(){
            this.$api.get('listReg').then(res=>{
                console.log(res.data)
                this.equipos=res.data
                this.equipo=this.equipos[0]
                if((this.equipo.actividades).length > 0){
                    this.actividades=this.equipo.actividades
                    this.actividad=this.actividades[0]
                }
                
        })
        },
        getTrabajo(){
            this.events=[]
            this.trabajos=[]
                this.$api.get('listCrono').then(res=>{
                console.log(res.data)
                res.data.forEach(r=>{
                    this.trabajos.push(r)
                    this.events.push({ title: r.actividad.nombre+' ', start: r.creacion,id:r.id })
                })
                console.log(this.events)
                this.calendarOptions.events=this.events
                })
        }
    }
}

</script>