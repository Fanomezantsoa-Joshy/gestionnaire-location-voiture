<template>

    <div class="divRecherche">

        Recherche : <input type="text" placeholder="Rechercher dans la liste" v-model="recherche">
        <img src="../assets/icons/chercher.png" class="iconRecherche">

    </div>

    <div class="divTableau">

        <Vue3EasyDataTable :headers="enTete" :items="liste" :search-field="champRecherche" :search-value="recherche"
            alternating theme-color="#42b883" empty-message="Aucune donnée trouvée" :rows-items="[6, 7]"
            rows-per-page="5" rows-per-page-message="Lignes par page :" rows-of-page-separator-message="sur">

            <template #item-actions="valeur">

                <div>
                    <button v-on:click="modifier(valeur.numero, valeur.nom, 
                valeur.designation, valeur.nbrJours, valeur.taux,valeur.loyer, valeur.numero)" id="modifier">

                        <img src="../assets/icons/modifier.png" class="iconListe">

                    </button>

                    <button v-on:click="supprimer(valeur.numero)" id="supprimer">

                        <img src="../assets/icons/supprimer.png" class="iconListe">

                    </button>

                </div>

            </template>

        </Vue3EasyDataTable>

    </div>

<div class="divMessage" v-if="afficher">

    <div class="divFermer">

        <button v-on:click="fermer" id="btnFermer">

            <img src="../assets/icons/fermer.png" class="iconFermer">

        </button>

    </div>

    <div class="divContenu">

        <img :src="message.iconMessage" class="icon">
        <span id="message">{{ message.message }}</span>

    </div>

</div>

</template>

<script>

import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import { variable } from '@/variable';
import axios from 'axios';

export default {
    name : "listeLocation",
    components : {
        Vue3EasyDataTable
    },
    data() {
        return {
            recherche : "",
            champRecherche : ["numero", "nom", "designation", "loyer"],
            afficher : false,
            message : variable,
            enTete : [
                { text : "Numéro", value : "numero", sortable: true, width : 120},
                { text : "Nom du locataire", value : "nom", sortable: true, width : 180},
                { text : "Désignation", value : "designation", sortable: true, width : 150},
                { text : "Nombre de Jours", value : "nbrJours", sortable: true },
                { text : "Taux journalier", value : "taux", sortable: true, width : 150},
                { text : "Loyer", value : "loyer", sortable: true },
                { text : "Actions", value : "actions"}
            ],
            liste : []
        }
    },

    beforeRouteEnter(to, from, next) {

        next(vm => {

            const etat = window.history.state;

            if(!from.name) {
                if(!etat.vientDeAjout || !etat.vientDeModifier) {
                    vm.afficherListe();
                    vm.afficher = false;
                }
            }

            if((etat && etat.vientDeAjout) || (etat && etat.vientDeModifier)) {
                    etat.vientDeAjout = false;
                    etat.vientDeModifier = false;
                    vm.afficherListe();
                    setTimeout(() => {
                        vm.afficher = true;    
                    }, 1000);     
            }
        })

    },
    methods : {
        async afficherListe() {
            try {
                    const response = await axios.get("http://localhost/gestionnaire-location-voiture/backend/afficherListe.php");
                    this.liste = response.data;
            } catch (erreur) {
                this.message.modifierMessage("Impossible d'afficher la liste");
                this.afficher = true;
            }
        },
        async supprimer(numero) {
            try {
                const reponse = await axios.get("http://localhost/gestionnaire-location-voiture/backend/supprimer.php", {
                    params: {
                        numero : numero
                    }
                });

                this.afficherListe();

                this.message.modifierMessage("Location supprimée avec succès !"); 
    
                this.afficher = true;     

                } catch (erreur) {
                    this.message.modifierMessage("Impossible d'effecuter la suppression !");
                    this.afficher = true;
                    return;
                }
        },
        modifier(numero, nom, designation, nbrJours, taux,loyer, ancienNumero) {
            this.message.numero = numero;
            this.message.nom = nom;
            this.message.designation = designation;
            this.message.nbrJours = nbrJours;
            this.message.taux = taux;
            this.message.loyer = loyer;
            this.message.ancienNumero = ancienNumero;
            this.$router.push("modifier");
        },
        fermer() {
            this.afficher = false;
        },
    }
}

</script>

<style scoped>

.iconRecherche {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    height: 25px;
    width: 25px;
    margin-left: -3%;
}

.divRecherche {
    margin: 20px 0 20px 50px;
    font-family: "Inter Variable", sans-serif;
    font-size: 16px;
    font-weight: 500;
    position: relative;
}

.divRecherche input {
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 10px 20px 10px 10px;
    background-color: #f8fafc;
    font-family: "Inter Variable", sans-serif;
    font-size: 15px;
    outline: none;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.divRecherche input:hover {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.divTableau {
    font-family: "Inter Variable", sans-serif;
    --easy-table-border: none;
    --easy-table-row-border: 1px solid #e2e8f0;
    --easy-table-header-font-size: 16px;
    --easy-table-header-background-color: #f8fafc;
    --easy-table-header-font-color: #334155;
    --easy-table-header-item-padding: 10px 0 10px 10px;
    --easy-table-body-item-padding: 10px 0 10px 20px;
    --easy-table-body-row-font-size: 15px;
    --easy-table-footer-font-size: 14px;
    --easy-table-footer-padding: 20px 40px 20px 0px;
    overflow-x: hidden;
    border-radius: 16px;
    --easy-table-columns-border: none;
    margin-left: 3%;
    margin-right: 3%;
    margin-bottom: 2%;
    border: 2px solid #d1d5db;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    background-color: white;
    display: flex;
    flex-direction: column;
    flex: 1;
}


.divMessage {
    background-color: #dcfce7;
    border-radius: 12px;
    border: 2px solid #86efac;
    margin: 10px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    margin-top: auto;
    height: 80px;
    width: 500px;
    margin-left: 30%;
    margin-bottom: 2%;
}

.divMessage:hover {
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
    border-color: #4ade80;
}

.divFermer {
    margin-left: 92%;
    height: 40px;
}

.divContenu {
    display: flex;
    flex-direction: row;
    justify-content: center;
}

.icon {
    height: 40px;
    width: 40px;
    margin-right: 20px;
    margin-top: -4%;
}

.iconFermer {
    height: 25px;
    width: 25px;
}

#message {
    font-family: "Inter Variable", sans-serif;
    color: #4ade80;
    font-weight: 600;
    font-size: large;
    margin-top: -2%;
}

#btnFermer  {
    height: 35px;
    width: 35px;
    background-color: transparent;
    border: none;
}

.iconListe {
    height: 30px;
    width: 30px;
}

#modifier  {
    height: 45px;
    width: 45px;
    background-color: transparent;
    border: none;
    margin-left: -10%;
}

#supprimer {
    height: 45px;
    width: 45px;
    background-color: transparent;
    border: none;
    margin-left: 15%;
}

#modifier:hover, #supprimer:hover {
    transform: translateY(-1px);
    background-color: #d1d5db;
    border: 2px solid white;
    border-radius: 10px;
} 

#modifier:active, #supprimer:active {
    transform: translateY(1px) scale(0.97);
} 

</style>