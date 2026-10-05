<template>

    <h2>Graphique</h2>

    <div class="contenuGraphique">

        <Bar id="graphique" :options="options" :data="valeur"></Bar>

    </div>

</template>

<script>

import { Bar } from 'vue-chartjs';

import { Chart as ChartJS, Title, Tooltip, Legend, BarElement,CategoryScale, LinearScale, LineController } from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    name : "Graphique",
    components: {
        Bar
    },
    data() {
        return {
            valeur : {
                labels : ["Total", "Minimal", "Maximal"],
                datasets : [
                    {
                        label : "Loyer en Ariary",
                        backgroundColor : ["#e0e7ff","#fee2e2", "#dcfce7"],
                        borderColor : ["#b4c6fc", "#fca5a5", "#86efac"],
                        borderWidth : 2,
                        borderRadius : 8,
                        hoverBackgroundColor : ["#c7d2fe", "#fecaca", "#bbf7d0"],
                        hoverBorderColor : ["#818cf8", "#f87171", "#4ade80"],
                        data : [sessionStorage.getItem("total"), sessionStorage.getItem("min"), sessionStorage.getItem("max")]
                    }
                ]
            },
            options : {
                responsive : true,
                maintainAspectRatio : false,
                plugins : {
                    legend : {
                        labels : {
                            boxWidth: 0,
                            color : "#1e293b",
                            font : {
                                size : 18,
                                family : "'Inter', 'Helvetica Neue', Arial, sans-serif"
                            }
                        },
                        position : "top"
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display : false
                        },
                        ticks: {
                            color: ["#818cf8", "#f87171", "#4ade80"],
                            font: {
                                size : 18,
                                family : "'Inter', 'Helvetica Neue', Arial, sans-serif"
                            }
                        }
                    },
                    y: {
                        ticks: {
                            color: "#1e293b",
                            font: {
                                size : 16,
                                family : "'Inter', 'Helvetica Neue', Arial, sans-serif"
                            }
                        }
                    }
                }
            }
        }
    }
}

</script>

<style scoped>

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