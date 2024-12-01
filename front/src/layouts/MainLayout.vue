<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen=!leftDrawerOpen"
        />

        <q-toolbar-title>
          <q-badge class="text-white ">Sistema Mantenimiento</q-badge>
        </q-toolbar-title>
        <div>

        </div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      :width="250"
    >
    <q-list bordered class="rounded-borders">
      <q-item-label header class="text-center text-bold">
        Opciones
      </q-item-label>

      <q-item clickable dense to="/" exact active-class="bg-primary text-white">
        <q-item-section avatar><q-icon name="home" /></q-item-section>
        <q-item-section><q-item-label>Principal</q-item-label><q-item-label caption class="text-grey">Pagina principal</q-item-label></q-item-section>
    </q-item>
      <q-expansion-item dense exact expand-separator icon="people" label="Usuarios" to="/usuarios" expand-icon="null" />
      <q-expansion-item dense exact expand-separator icon="precision_manufacturing" label="Sistema Maquinaria" to="/maquinaria" expand-icon="null" />
      <q-expansion-item dense exact expand-separator icon="factory" label="Equipos" to="/equipo" expand-icon="null" />
      <q-expansion-item dense exact expand-separator icon="checklist" label="Actividad" to="/actividad" expand-icon="null" />
      <q-expansion-item dense exact expand-separator icon="today" label="Planificacion" to="/actividad" expand-icon="null" />
      
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script >
import { defineComponent, ref } from 'vue'
import EssentialLink from 'components/EssentialLink.vue'

export default defineComponent({
  name: 'MainLayout',
  data () {
    return {
      leftDrawerOpen: ref(false),
    }
  },
  created () {
  },
  methods: {
    toggleLeftDrawer () {
      this.leftDrawerOpen = !this.leftDrawerOpen
    }
  },
})
</script>
