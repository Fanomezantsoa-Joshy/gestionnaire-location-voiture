<template>

    <div class="divStatistique">

        <div class="divConteneur">

            <div class="divEnTete">
                <h1>Bilan du loyer</h1>
            </div>

            <div class="divContenu">
                <div class="divBilan">
                    <div class="divIcon" style="background: #e0e7ff; color: #4f46e5;">
                    </div>
                    <div class="divDetailBilan">
                        <h3 id="loyer total">Total</h3>
                        <p class="valeurBilan" id="total">{{ total }} Ar</p>
                    </div>
                </div>

                <div class="divBilan">
                    <div class="divIcon" style="background: #fee2e2; color: #dc2626;">
                    </div>
                    <div class="divDetailBilan">
                        <h3>Minimal</h3>
                        <p class="valeurBilan" id="min">{{ min }} Ar</p>
                    </div>
                </div>

                <div class="divBilan">
                    <div class="divIcon" style="background: #dcfce7; color: #16a34a;">
                    </div>
                    <div class="divDetailBilan">
                        <h3>Maximal</h3>
                        <p class="valeurBilan" id="max">{{ max }} Ar</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="divGraphique">

        <h2>Graphique</h2>

        <div class="contenuGraphique">

            <Bar id="graphique" :options="options" :data="valeur"></Bar>

        </div>

    </div>

</template>

<script>

    import axios from "axios";
    import { Bar } from 'vue-chartjs';
    import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, LineController } from 'chart.js';
    ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

    export default {
        name: "PageStatistique",
        components: {
            Bar
        },
        data() {
            return {
                min : 0,
                max : 0,
                total : 0,
                valeur: {
                    labels: ["Total", "Minimal", "Maximal"],
                    datasets: [
                        {
                            label: "Loyer en Ariary",
                            backgroundColor: ["#e0e7ff", "#fee2e2", "#dcfce7"],
                            borderColor: ["#b4c6fc", "#fca5a5", "#86efac"],
                            borderWidth: 2,
                            borderRadius: 8,
                            hoverBackgroundColor: ["#c7d2fe", "#fecaca", "#bbf7d0"],
                            hoverBorderColor: ["#818cf8", "#f87171", "#4ade80"],
                            data: [sessionStorage.getItem("total"), sessionStorage.getItem("min"), sessionStorage.getItem("max")]
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                boxWidth: 0,
                                color: "#1e293b",
                                font: {
                                    size: 18,
                                    family: "'Inter', 'Helvetica Neue', Arial, sans-serif"
                                }
                            },
                            position: "top"
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: ["#818cf8", "#f87171", "#4ade80"],
                                font: {
                                    size: 18,
                                    family: "'Inter', 'Helvetica Neue', Arial, sans-serif"
                                }
                            }
                        },
                        y: {
                            ticks: {
                                color: "#1e293b",
                                font: {
                                    size: 16,
                                    family: "'Inter', 'Helvetica Neue', Arial, sans-serif"
                                }
                            }
                        }
                    }
                }
            }
        },
        methods: {
        
            async recuperer() {
                try {
        
                    const reponse = await axios.get("http://localhost/gestionnaire-location-voiture/backend/statistique.php");

                    this.total = reponse.data.valeur.total;
                    this.max = reponse.data.valeur.max;
                    this.min = reponse.data.valeur.min;

                    sessionStorage.setItem("total", reponse.data.valeur.total);
                    sessionStorage.setItem("min", reponse.data.valeur.min);
                    sessionStorage.setItem("max", reponse.data.valeur.max);
        
                } catch (erreur) {
                    alert("Connexion impossible!" + erreur.message);
                    return;
                }
            }
        },
        mounted() {
            this.recuperer();
        }
}


</script>

<style scoped>
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

    .divConteneur {
        flex: 1;
        padding: 2rem;
        overflow-y: auto;
        font-family: "Inter Variable", sans-serif;
    }

    .divEnTete {
        margin-bottom: 2rem;
    }

    .divEnTete h1 {
        color: #334155;
        font-size: x-large;
    }

    .divContenu {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .divBilan {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        min-height: 80px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    }

    .divBilan:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    }

    .divIcon {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .divDetailBilan h3 {
        margin-top: -1%;
        font-size: 16px;
        color: #64748b;
        font-weight: 500;
    }

    .valeurBilan {
        font-size: 1.5rem;
        font-weight: 700;
        color: #334155;
        margin: 0.25rem 0;
    }


    .contenuGraphique {
        padding-left: 20%;
        padding-right: 20%;
        height: 64%;
    }

    h2 {
        font-family: "Poppins", sans-serif;
        color: #64748b;
        font-size: x-large;
        margin-left: 5%;
    }
</style>