<template>

    <div class="divConteneur">

        <div class="divPrincipale">

            <div class="divContenuMenu">
                
                <div class="enTeteMenu">

                    <img src="../assets/icons/voiture.png" style="height: 100%; width: 52%;">

                </div>

                <p class="titreMenu">Menu</p>

                <div class="divMenu">

                    <div class="divBouttonMenu">

                        <RouterLink to="statistique" class="menu">Statistiques</RouterLink>
                        <img src="../assets/icons/graphique.png" class="iconMenu">

                    </div>
    
                    <div class="divBouttonMenu">

                        <RouterLink to="ajouter" class="menu">Nouveau</RouterLink>
                        <img src="../assets/icons/nouveau.png" class="iconMenu">

                    </div>
                    
                    <div class="divBouttonMenu">


                        <RouterLink to="liste" class="menu">Liste</RouterLink>
                        <img src="../assets/icons/liste.png" class="iconMenu">

                    </div>

                </div>

                <div class="piedMenu">

                    <p class="titreProfile">Profil</p>

                        <div class="profile">
                            <img src="../assets/icons/profil.png" alt="Profil" class="photoAdmin">
                            <div class="infoAdmin">
                                <span class="nomAdmin" id="admin">{{ admin }}</span><br>
                                <span class="roleAdmin">Administrateur</span>
                            </div>
                        </div>

                </div>

                <div class="divSeDeconnecter">

                    <RouterLink to="/" id="seDeconnecter">Se déconnecter</RouterLink>
                    <img src="../assets/icons/SeDeconnecter.svg" class="iconMenu">

                </div>

            </div>


            <div class="divTeteContenu">

                    <div class="divEnTete">

                         <div class="divEnTeteGauche">

                            <h3>Gestionnaire des locations de voiture</h3>

                         </div>

                         <div class="divEnTeteDroite">

                            <div class="divBtnEnTete">

                                <img src="../assets/icons/utilisateur.png" class="iconMonCompte">
                                <input type="button" value="Mon compte" class="btnMonCompte">

                            </div>

                            <div class="divBtnEnTete">

                                <img src="../assets/icons/historique.png" class="iconHistorique">
                                <input type="button" value="Historiques" class="btnHistorique">

                            </div>

                         </div>

                    </div>

                    <div class="divContenu">

                        <RouterView></RouterView>       

                    </div>

            </div>

        </div>

    </div>

</template>

<script>


export default {
    name : "PagePrincipale",
    data() {
        return {
            admin : ""
        }
    },
    mounted() {
        this.admin = sessionStorage.getItem("admin");
    }
}

</script>

<style>

html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

</style>

<style scoped>

.divConteneur {
    font-family: 'Inter Variable', sans-serif;
    background-color: #f1f5f9;
    color: #0f172a;
    width: 100%;
    height: 100dvh;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
}

.divPrincipale {
    display: flex;
    flex: 1;
}

.divTeteContenu {
    width: 280px;
    background-color: #ffffff;
    border-right: 1px solid #e2e8f0;
    display: flex;
    flex: 1;
}

.divEnTete {
    height: 70px;
    border-bottom: 1px solid #e2e8f0;
}

.divContenuMenu {
    width: 200px;
    background-color: #ffffff;
    border-right: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
}

.divMenu {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.titreMenu, .titreProfile {
    font-size: large;
    font-weight: 500;
    color: #64748b;
    margin-left: 30px;
}

.menu {
    text-decoration: none;
    color: #64748b;
    font-weight: 500;
    border-radius: 8px;
    padding: 25px 0 25px 65px;
    margin: 0 10px 0 5px;
    position: absolute;
    width: 9%;
}

.menu:hover {
    background-color: #f1f5f9;
    color: #0f172a;
}

.menu.router-link-exact-active {
    background-color: #e0e7ff;
    color: #4f46e5;
}

.enTeteMenu {
    text-align: center;
    height: 72px;
    border-bottom: 1px solid #e2e8f0;
    width: 100%;
}

.divBouttonMenu {
    height: 80px;
}

.iconMenu {
    height: 30px;
    width: 30px;
    position: relative;
    margin-left: 12%;
    margin-top: 10%;
}

.divTeteContenu {
    display: flex;
    flex-direction: column;
    min-width: 0; 
}

.divEnTete {
    height: 72px;
    background-color: rgba(255, 255, 255, 0.8);
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    position: sticky;
    top: 0;
}

.divEnTeteGauche, .divEnTeteDroite {
    display: flex;
    align-items: center;
    color: #64748b;
    font-size: large;
}

.divContenu {
    display: flex;
    flex-direction: column;
    flex: 1;
    background-color: #f1f5f9;
}

.piedMenu {
    margin-top: 30%;
    height: 30%;
    border-top: 1px solid #e2e8f0;
}

.titreProfile {
    margin-bottom: 15%;
}

.profile {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.photoAdmin {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-left: 10px;
}

.nomAdmin { 
    font-weight: 600; 
    text-align: center;
}

.infoAdmin { 
    display: flex; 
    flex-direction: column; 
    text-align: center;
    margin-left: 5px;
}

.roleAdmin { 
    color: #64748b; 
}

#seDeconnecter {
    text-decoration: none;
    color: #64748b;
    font-weight: 500;
    border-radius: 8px;
    padding: 20px 0 20px 55px;
    margin: 5px 10px 10px 5px;
    position: absolute;
    width: 10%;
}

#seDeconnecter:hover {
    background-color: #f1f5f9;
    color: #4f46e5;
}

.divSeDeconnecter {
    margin-bottom: 30%;
}


.btnMonCompte {
    width: 150px;
    margin-left: 10px;
    height: 50px;
    background-color: #7494ec;
    border-radius: 8px;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    box-shadow: 0 4px 14px 0 rgba(116, 148, 236, 0.3);
    font-family: "Inter Variable", sans-serif;
    padding-left: 40px;
}

.btnHistorique {
    width: 150px;
    margin-left: 10px;
    height: 50px;
    background-color: #7494ec;
    border-radius: 8px;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    box-shadow: 0 4px 14px 0 rgba(116, 148, 236, 0.3);
    font-family: "Inter Variable", sans-serif;
    padding-left: 30px;
}

.btnHistorique:hover, .btnMonCompte:hover  {
    background-color: #5b7fe8;
    box-shadow: 0 6px 20px rgba(116, 148, 236, 0.5);
}

.iconMonCompte {
    height: 30px;
    width: 30px;
    position: absolute;
    margin-top: 10px;
    margin-left: 20px;
}

.iconHistorique {
    height: 27px;
    width: 27px;
    position: absolute;
    margin-top: 11px;
    margin-left: 20px;
}

.divBtnEnTete {
    display: flex;
    flex-direction: column;
}

</style>