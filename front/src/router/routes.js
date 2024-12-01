const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') },
      { path: '/maquinaria', component: () => import('pages/Maquinaria.vue') },
      { path: '/equipo', component: () => import('pages/Equipo.vue') },
      { path: '/actividad', component: () => import('pages/Actividad.vue') },
      { path: '/cronograma', component: () => import('pages/Cronograma.vue') },
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
