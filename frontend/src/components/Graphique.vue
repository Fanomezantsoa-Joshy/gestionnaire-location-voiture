<template>

    <div class="divContenuStat">

            <div class="divStatistique">

        <Statistique></Statistique>

    </div>

    <div class="divGraphique">
        
        <Graphe></Graphe>       

    </div>

    </div>

</template>

<script>

import Statistique from './Statistique.vue';
import Graphe from './Graphe.vue';

export default {
    name : 'Graphique',
    components : {
        Graphe,
        Statistique
    }
}

</script>

<style scoped>

.divContenuStat {
    height: 100%;
}

.divStatistique {
    height: 40%;
}

.divGraphique {
        background-color: #fff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        margin-top: 2%;
        margin-left: 3%;
        margin-right: 3%;
        margin-bottom: 2%;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        height: 48%;
}

.divGraphique:hover {
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

</style>