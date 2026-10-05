<template>

    <div class="contenuFormulaireAjout">

    <form class="teste">

      <div class="divEnTete">

        <div>

            Numéro du location : <input type="text" id="numero" readonly v-model="formulaire.numero">

        </div>

        <div>

            Loyer : <input type="text" v-model="formulaire.loyer" readonly><br>

        </div>

      </div>

      <div class="divFormulaireAjout">

        <div class="divInput" id="divNom">

            <label>Nom du locataire :</label><br>
            <input type="text" v-model="formulaire.nom" v-on:input="validerNom" @input="v$.formulaire.nom.$touch()"
            v-on:blur="v$.formulaire.nom.$touch()" @keydown.enter="suivant1" id="nom" maxlength="20"
            :class="{ 'invalide': v$.formulaire.nom.$error,'valide': !v$.formulaire.nom.$error }"><br>

        </div>

        <div v-if="v$.formulaire.nom.$error">

          <p v-if="v$.formulaire.nom.required.$invalid" class="messageErreur">Veuillez saisir le nom du locataire</p>

        </div>

        <div class="divInput">

            <label>Designation du voiture :</label><br>
            <input type="text" name="designation" v-model="formulaire.designation" v-on:blur="v$.formulaire.designation.$touch()" 
            @keydown.enter="suivant2" v-on:input="v$.formulaire.designation.$touch()" maxlength="15"
            :class="{ 'invalide': v$.formulaire.designation.$error,'valide': !v$.formulaire.designation.$error }" id="selection">
            </input><br>

        </div>

        <div v-if="v$.formulaire.designation.$error">

          <p v-if="v$.formulaire.designation.required.$invalid" class="messageErreur">Le designation du voiture est obligatoire</p>

        </div>

        <div class="divInput">

            <label>Nombre de jours (max = 60) :</label><br>
            <input type="number" min="1" v-model="formulaire.nbrJours" v-on:keyup="afficherLoyer()" id="nbrJours"
            v-on:input="formulaire.nbrJours = Math.min(formulaire.nbrJours, 60), v$.formulaire.nbrJours.$touch()" @keydown.enter="suivant3"
            :class="{ 'invalide': v$.formulaire.nbrJours.$error,'valide': !v$.formulaire.nbrJours.$error }"><br>

        </div>

        <div v-if="v$.formulaire.nbrJours.$error">
          <p v-if="v$.formulaire.nbrJours.pasZero.$invalid" class="messageErreur">Le nombre de jours doit être supérieur à 0</p>
        </div>


        <div class="divInput">

            <label>Taux journalier (en Ar) :</label><br>
            <input type="number" min="1" v-model="formulaire.taux" v-on:keyup="afficherLoyer()" @keydown.enter="suivant4"
            v-on:input="formulaire.taux = Math.min(formulaire.taux, 99999999), v$.formulaire.taux.$touch()" id="taux"
            :class="{ 'invalide': v$.formulaire.taux.$error,'valide': !v$.formulaire.taux.$error }"><br>

        </div>

        <div v-if="v$.formulaire.taux.$error">
          <p v-if="v$.formulaire.taux.pasZero.$invalid" class="messageErreur">Le taux journalier doit être supérieur à 0</p>
        </div>
        
        <div class="divBoutton">

            <input type="reset" value="Annuler" id="btnAnnuler">
            <input type="button" value="Enregistrer" :disabled="v$.$invalid" id="btnAjouter" v-on:click="ajouter">

        </div>

      </div>


    </form>

  </div>


</template>

<script>

    import axios from 'axios';
    import useVuelidate from '@vuelidate/core';
    import { required, maxLength, sameAs } from '@vuelidate/validators';
    import { variable } from '@/variable';

    export default {
        name: "formAjout",
        setup() {
            return {
                v$: useVuelidate()
            }
        },
        mounted() {
            this.dernierNumero();
            document.getElementById("nom").focus();
        },
        data() {
            return {
                message : variable,
                derNumero : 0,
                formulaire: {
                    numero: "LOC-" + this.derNumero,
                    loyer: 1 + " Ar",
                    nom: "",
                    nbrJours: 1,
                    designation: "",
                    taux: 1
                }
            }
        },
        methods: {

            async dernierNumero() {
                try {

                    const reponse = await axios.get("http://localhost/gestionnaire-location-voiture/backend/recupNum.php");

                    if (reponse.status == 202) {
                        console.log("La table location est vide");
                        this.formulaire.numero = "LOC-001";
                        return;
                    }

                    var num = reponse.data.num_loc;

                    this.derNumero = String(parseInt(num.substring(4, 7)) + 1).padStart(3, "0");

                    this.formulaire.numero = "LOC-" + this.derNumero;

                } catch (erreur) {
                    alert("Impossible de se connecter aux bases de données !");
                }
            },

            async ajouter() {
                
                document.getElementById("btnAjouter").disabled = true;

                try {

                    const reponse = await axios.post("http://localhost/gestionnaire-location-voiture/backend/ajouter.php", this.formulaire);

                } catch (erreur) {

                    this.message.modifierMessage("Impossible d'effectuer l'insértion !");
                }

                this.message.modifierMessage("Location ajoutée avec succès !");

                this.$router.push({
                    path : "liste",
                    state : { vientDeAjout : true }
                });

            },

            afficherLoyer() {
                if (this.formulaire.nbrJours == "" || this.formulaire.taux == "") {
                    this.formulaire.loyer = ""
                }
                else {
                    this.formulaire.loyer = this.formulaire.nbrJours * parseInt(this.formulaire.taux) + " Ar"
                }
            },
            validerNom() {
                this.formulaire.nom = this.formulaire.nom.replace(/[^a-zA-ZÀ-ÿ\s]/g, '')
            },
            suivant1() {
                document.getElementById("selection").focus();
            },
            suivant2() {
                document.getElementById("nbrJours").focus();
            },
            suivant3() {
                document.getElementById("taux").focus();
            },
            suivant4() {
                document.getElementById("taux").blur();
            }                                    
        },

        validations() {
            return {
                formulaire: {
                    nom: { required },
                    designation: { required },
                    nbrJours: { pasZero: (value) => value != 0 },
                    taux: { pasZero: (value) => value != 0 }
                }
            }
        }
    }

</script>

<style scoped>

.contenuFormulaireAjout {
    font-family: "Inter Variable", sans-serif;
    height: 100%;
    align-content: center;
}

.divEnTete {
    margin-top: 1%;
    margin-bottom: 2%;
    margin-left: 10%;
    margin-right: 10%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
}

.divEnTete input {
    border: 2px solid #d1d5db;
    font-size: large;
    width: 40%;
    background-color: #eee;
    border-radius: 8px;
    padding: 10px 20px 10px 20px;
    outline: none;
    color: #333;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    text-align: center;
    margin-left: 10px;
}

#divNom {
    margin-top: 2%;
}

.divFormulaireAjout {
    background-color: #fff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    margin-left: 5%;
    margin-right: 5%;
    padding-left: 10%;
}

.divInput {
    position: relative;
    margin: 30px;
}

.divInput input {
    margin-top: 5px;
}

.divInput input::placeholder {
    color: #888;
    font-weight: 400;
}

.divInput input:hover {
    transform: translateY(-2px);
}

.divInput input:focus.valide {
    border-color: #3b82f6;
}

#btnAjouter {
    width: 150px;
    margin-left: 30px;
    height: 50px;
    background-color: #7494ec;
    border-radius: 10px;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 18px;
    color: #fff;
    font-weight: 500;
    box-shadow: 0 4px 14px 0 rgba(116, 148, 236, 0.4);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

#btnAjouter:not(:disabled):hover {
    background-color: #5b7fe8;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(116, 148, 236, 0.5);
}

#btnAjouter:disabled {
    cursor: default;
    opacity: 0.6;
}

#btnAjouter:not(:disabled):active  {
    background-color: #436be3;
    transform: translateY(1px) scale(0.97);
    box-shadow: 0 2px 10px rgba(116, 148, 236, 0.4);
    opacity: 0.6;
}

#btnAnnuler {
    width: 100px;
    height: 50px;
    font-size: large;
    color: #ffa500;
    text-decoration: none;
    border: none;
    background-color: transparent;
}

#btnAnnuler:hover {
    color: #d38b05;
    text-decoration: underline;
}

.valide {
    border: 2px solid #d1d5db;
    font-size: large;
    width: 60%;
    padding: 10px 50px 10px 20px;
    background-color: #eee;
    border-radius: 10px;
    outline: none;
    color: #333;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.invalide {
    border: 2px solid #dc3545;
    width: 60%;
    font-size: large;
    padding: 10px 50px 10px 20px;
    background-color: #eee;
    border-radius: 10px;
    outline: none;
    color: #333;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.messageErreur {
    position: absolute;
    color: #dc3545;
    font-size: 15px;
    margin-left: 4%;
    margin-top: -2%;
}

.divBoutton {
    margin-left: 60%;
    padding-bottom: 2%;
}


</style>