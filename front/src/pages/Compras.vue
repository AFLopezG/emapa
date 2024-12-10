<template>
    <q-page padding>
        <div class="row">
            <div class="col-6"><q-input  outlined v-model="date" label="fecha" /></div>
            <div class="col-6"> <q-btn color="white" icon="search" @click="buscar"/>
            </div>
        </div>
    </q-page>

</template>
<script>

export default {
    name:'compraPage',
    data() {
        return {
           listado:[],
           compra:[]
        }
    },
}
</script>
