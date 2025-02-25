@extends('layout-admin')

@section('titre', 'Dashboard')

@section('contenu')

<div class="flex flex-grow gap-16 bg-reverse">
    <livewire:admin-sidebar />
    
    <div class="flex flex-col flex-grow gap-4 mt-16 mr-16">

        {{-- Entête --}}
        <div class="flex flex-col">
            <p class="text-2xl font-medium">{{ __('Dashboard') }}</p>
            <p class="text-lg font-medium opacity-50">{{ __('ManageStats') }}</p>
        </div>

        {{-- Stats + Pie Chart --}}
        <p class="text-lg font-medium">{{ __('NumberStats') }}</p>
        <div class="flex gap-4 h-80">
            
            <div class="flex flex-col gap-4">
                {{-- Nombre de visiteurs actuels --}}
                <div class="flex flex-col justify-center h-24 px-4 rounded-lg bg-primary/20">
                    <p class="text-lg font-medium opacity-50">{{ __('CurrentVisitors') }}</p>
                    <p class="text-2xl font-medium">1</p>
                </div>

                {{-- Nombre de visiteurs totaux --}}
                <div class="flex flex-col justify-center h-24 px-4 rounded-lg bg-primary/20">
                    <p class="text-lg font-medium opacity-50">{{ __('AllVisitors') }}</p>
                    <p class="text-2xl font-medium">117</p>
                </div>

                {{-- Nombre d'inscrits --}}
                <div class="flex flex-col justify-center h-24 px-4 rounded-lg bg-primary/20">
                    <p class="text-lg font-medium opacity-50">{{ __('AllAccounts') }}</p>
                    <p class="text-2xl font-medium">30</p>
                </div>
            </div>

            <div class="flex flex-col gap-4">
                {{-- Nombre de commandes --}}
                <div class="flex flex-col justify-center h-24 px-4 rounded-lg bg-primary/20">
                    <p class="text-lg font-medium opacity-50">{{ __('AllOrdersMade') }}</p>
                    <p class="text-2xl font-medium">21</p>
                </div>

                {{-- Chiffre d'affaire --}}
                <div class="flex flex-col justify-center h-24 px-4 rounded-lg bg-primary/20">
                    <p class="text-lg font-medium opacity-50">{{ __('MoneyMade') }}</p>
                    <p class="text-2xl font-medium">{{ $chiffreAffaire }}€</p>
                </div>

                {{-- Satisfaction client --}}
                <div class="flex flex-col justify-center h-24 px-4 rounded-lg bg-primary/20">
                    <p class="text-lg font-medium opacity-50">{{ __('UserSatisfaction') }}</p>
                    <div class="flex items-center gap-2">
                        <p class="text-2xl font-medium">{{ number_format($moyenneSatisfaction, 1) }}</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </div>
            
            {{-- Graphique Marques les plus présentes --}}
            <canvas id="brandsPieChart"></canvas>

        </div>

        {{-- Graphiques --}}
        <div class="flex w-full gap-4 h-96">

            {{-- Graphique Evolution des Commandes --}}
            <div class="flex flex-col w-full gap-4">
                <p class="text-lg font-medium">{{ __('NumberOrders') }}</p>
                <canvas id="ordersEvolutionChart"></canvas>
            </div>

            {{-- Graphique Nombre de ventes/enchères --}}
            <div class="flex flex-col w-full gap-4">
                <p class="text-lg font-medium">{{ __('NumberOffers') }}</p>
                <canvas id="offersEvolutionChart"></canvas>
            </div>
        </div>
        
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctxOrders = document.getElementById('ordersEvolutionChart').getContext('2d');
    var ordersEvolutionChart = new Chart(ctxOrders, {
        type: 'line',
        data: {
            labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
            datasets: [{
                label: 'Nombre de commandes',
                data: ["2", "5", "7", "21", "14", "17", "11", "23", "28", "16", "12", "15"],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 3,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxOffers = document.getElementById('offersEvolutionChart').getContext('2d');
    var offersEvolutionChart = new Chart(ctxOffers, {
        type: 'bar',
        data: {
            labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
            datasets: [
                {
                    label: 'Nombre de ventes',
                    data: ["9", "11", "5", "7", "14", "17", "12", "6", "4", "15", "10", "11"],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Nombre d\'enchères',
                    data: ["3", "7", "8", "4", "8", "2", "15", "9", "7", "8", "9", "6"],
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxBrands = document.getElementById('brandsPieChart').getContext('2d');
    var brandsPieChart = new Chart(ctxBrands, {
        type: 'pie',
        data: {
            labels: ["Peugeot", "Renault", "BMW", "Mercedes-benz", "Audi"],
            datasets: [{
                label: 'Marques les plus présentes',
                data: [5, 5, 15, 6, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>

@endsection