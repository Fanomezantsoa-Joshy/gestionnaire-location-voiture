import { createRouter, createWebHistory } from 'vue-router'
import CreerCompte from '@/components/CreerCompte.vue'
import Connexion from '@/components/Connexion.vue'
import MdpOublier from '@/components/MdpOublier.vue'
import PagePrincipale from '@/components/PagePrincipale.vue'
import Liste from '@/components/Liste.vue'
import Ajouter from '@/components/Ajouter.vue'
import ModifierLocation from '@/components/ModifierLocation.vue'
import Statistique from '@/components/Statistique.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: Connexion
    },
    {
      path: '/mdpOublier',
      component: MdpOublier
    },
    {
      path: '/creerCompte',
      component: CreerCompte
    },
    {
      path: '/pagePrincipale',
      component: PagePrincipale,
      redirect: '/pagePrincipale/statistique',
      children: [
        {
          path: 'liste',
          component: Liste
        },
        {
          path: 'statistique',
          component: Statistique
        },
        {
          path: 'ajouter',
          component: Ajouter
        },
        {
          path: 'modifier',
          component: ModifierLocation
        }
      ]
    }
  ],
})

export default router
