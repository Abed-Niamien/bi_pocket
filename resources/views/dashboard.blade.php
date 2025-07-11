<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon tableau de bord') }}
        </h2>
    </x-slot>


@section('content')

@php
    $userRole = $user->id_role_user;
    $userName = $user->name;
@endphp

<div class="flex flex-col md:flex-row min-h-screen bg-gray-100">

    {{-- Sidebar --}}
    <aside class="w-full md:w-64 bg-white shadow-md p-6">
        <h2 class="text-xl font-semibold mb-6 text-indigo-700">Menu</h2>

        @if($userRole == 1  and $userName != 'admin0123')
            <ul>
                <li class="mb-3">
                    <a href="{{ route('entreprises.create') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">
                        + Créer une entreprise
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('admin.ventes.index') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">
                        Section Ventes
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('admin.clients.index') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">
                        Section Clients
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('admin.stocks.index') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">
                        Section Stock
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('admin.entreprises.index') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">
                        Section Entreprises
                    </a>
                </li>
            </ul>

        @elseif($userRole == 2)
            <ul>
                <li class="mb-3"><a href="{{ route('products.create') }}" class="text-gray-700 hover:text-indigo-600">+ Ajouter un produit</a></li>
                <li class="mb-3"><a href="{{ route('stocks.create') }}" class="text-gray-700 hover:text-indigo-600">+ Ajouter un stock</a></li>
                <li class="mb-3"><a href="{{ route('ventes.create') }}" class="text-gray-700 hover:text-indigo-600">+ Ajouter une vente</a></li>
                <li class="mb-3"><a href="{{ route('clients.create') }}" class="text-gray-700 hover:text-indigo-600">+ Ajouter un client</a></li>

                <li class="mt-4 mb-3 border-t pt-4 text-indigo-700 font-semibold">Listes détaillées</li>
                <li class="mb-3"><a href="{{ route('products.index1') }}" class="text-gray-700 hover:text-indigo-600">Liste des produits</a></li>
                <li class="mb-3"><a href="{{ route('clients.index') }}" class="text-gray-700 hover:text-indigo-600">Liste des clients</a></li>
                <li class="mb-3"><a href="{{ route('stocks.index') }}" class="text-gray-700 hover:text-indigo-600">Liste des stocks</a></li>
                <li class="mb-3"><a href="{{ route('ventes.index') }}" class="text-gray-700 hover:text-indigo-600">Liste des ventes</a></li>
            </ul>
        @elseif($userRole == 1 and $userName == 'admin0123')
            <h2 class="text-xl font-semibold mb-6 text-indigo-700">Admin Menu</h2>
                <ul>
                    <li class="mb-3"><a href="{{ route('products.index') }}" class="text-gray-700 hover:text-indigo-600">Liste des produits</a></li>
                    <li class="mb-3"><a href="{{ route('products.create') }}" class="text-gray-700 hover:text-indigo-600">+ Ajouter un produit</a></li>

                    <li class="mb-3"><a href="{{ route('categorie_produit.index') }}" class="text-gray-700 hover:text-indigo-600">Liste des catégories</a></li>
                    <li class="mb-3"><a href="{{ route('categorie_produit.create') }}" class="text-gray-700 hover:text-indigo-600">+ Ajouter une catégorie</a></li>

                    <li class="mb-3"><a href="{{ route('pays.index') }}" class="text-gray-700 hover:text-indigo-600">Liste des pays</a></li>
                    <li class="mb-3"><a href="{{ route('pays.create') }}" class="text-gray-700 hover:text-indigo-600">+ Ajouter un pays</a></li>

                    <li class="mb-3"><a href="{{ route('admin0123.utilisateurs.index') }}" class="text-gray-700 hover:text-indigo-600">Liste des utilisateurs</a></li>
                
                    <li class="mb-3"><a href="{{ route('villes.index') }}" class="text-gray-700 hover:text-indigo-600">Liste des villes</a></li>
                    <li class="mb-3"><a href="{{ route('villes.create') }}" class="text-gray-700 hover:text-indigo-600">+ Ajouter une ville</a></li>
               
                    <li class="mb-3"><a href="{{ route('communes.index') }}" class="text-gray-700 hover:text-indigo-600">Liste des communes</a></li>
                    <li class="mb-3"><a href="{{ route('communes.create') }}" class="text-gray-700 hover:text-indigo-600">+ Ajouter un commune</a></li>
                
                
                </ul>
        @endif
    </aside>

    {{-- Contenu principal --}}
    <main class="flex-1 px-4 md:px-8 py-8">


        {{-- Message de succès --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Partie ADMIN --}}
        @if($userRole == 1  and $userName != 'admin0123')
            @foreach($entreprises as $entreprise)
                <div class="bg-white shadow rounded-lg mb-8 p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
                        <h2 class="text-2xl font-semibold text-indigo-700">
                            <a href="{{ route('entreprises.show', $entreprise->id) }}" class="hover:underline">
                                {{ $entreprise->nom_entreprise }}
                            </a>
                        </h2>
                        <a href="{{ route('employes.create', $entreprise) }}"
                           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                            + Ajouter un employé
                        </a>
                    </div>

                    {{-- Liste des employés --}}
                    @if($entreprise->users->count() > 0)
                        <h3 class="text-lg font-medium mb-3 text-gray-700">Employés</h3>
                        <ul class="divide-y divide-gray-200 border border-gray-200 rounded">
                            @foreach($entreprise->users as $userEmp)
                                <li class="px-4 py-3 flex justify-between items-center hover:bg-gray-50 transition">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $userEmp->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $userEmp->email }}</p>
                                    </div>
                                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Employé</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 italic">Aucun employé pour cette entreprise.</p>
                    @endif

                    {{-- GRAPHIQUES --}}
                    @php $stats = $statistiquesParEntreprise[$entreprise->id]; @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                        {{-- Graphique : Ventes par période --}}
                        <div class="bg-gray-50 p-4 rounded shadow">
                            <h3 class="text-base font-semibold text-gray-700 mb-2">Ventes par période</h3>
                            <canvas id="chart-periode-{{ $entreprise->id }}"></canvas>
                        </div>

                        {{-- Graphique : Ventes par catégorie --}}
                        <div class="bg-gray-50 p-4 rounded shadow">
                            <h3 class="text-base font-semibold text-gray-700 mb-2">Ventes par catégorie</h3>
                            <canvas id="chart-categorie-{{ $entreprise->id }}"></canvas>
                        </div>

                        {{-- Graphique : Produits les plus achetés --}}
                        <div class="bg-gray-50 p-4 rounded shadow">
                            <h3 class="text-base font-semibold text-gray-700 mb-2">Top 5 produits achetés</h3>
                            <canvas id="chart-produits-{{ $entreprise->id }}"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Nouvelle section : Carte des ventes --}}
                <div class="mt-10 bg-white p-6 rounded shadow">
                    <h3 class="text-xl font-semibold text-indigo-700 mb-4">Carte des ventes - {{ $entreprise->nom_entreprise }}</h3>
                    <div id="map-{{ $entreprise->id }}" style="height: 400px; width: 100%;"></div>
                </div>
            @endforeach

            @if($entreprises->isEmpty())
                <p class="text-center text-gray-600 italic mt-12">Vous n'avez pas encore créé d'entreprise.</p>
            @endif
      <!-- Leaflet CSS -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

            <!-- Leaflet JS -->
            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function () {
        @foreach($entreprises as $entreprise)
            new Chart(document.getElementById('chart-periode-{{ $entreprise->id }}'), {
    type: 'line',
    data: {
        labels: {!! json_encode($statistiquesParEntreprise[$entreprise->id]['ventesParPeriode']->pluck('periode')) !!},
        datasets: [{
            label: 'Montant total',
            data: {!! json_encode($statistiquesParEntreprise[$entreprise->id]['ventesParPeriode']->pluck('total')) !!},
            borderColor: '#4f46e5',
            fill: false,
            tension: 0.3
        }]
    },
    options: { responsive: true }
});


            new Chart(document.getElementById('chart-categorie-{{ $entreprise->id }}'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($statistiquesParEntreprise[$entreprise->id]['ventesParCategorie']->pluck('categorie')) !!},
                    datasets: [{
                        label: 'Total des ventes',
                        data: {!! json_encode($statistiquesParEntreprise[$entreprise->id]['ventesParCategorie']->pluck('total')) !!},
                        backgroundColor: '#6366f1'
                    }]
                },
                options: { responsive: true }
            });

            new Chart(document.getElementById('chart-produits-{{ $entreprise->id }}'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode($statistiquesParEntreprise[$entreprise->id]['produitsPlusVendus']->pluck('produit')) !!},
                    datasets: [{
                        data: {!! json_encode($statistiquesParEntreprise[$entreprise->id]['produitsPlusVendus']->pluck('quantite_totale')) !!},
                        backgroundColor: ['#f97316', '#10b981', '#6366f1', '#ec4899', '#facc15']
                    }]
                },
                options: { responsive: true }
            });
        @endforeach
    });

    @foreach($entreprises as $entreprise)
    // Initialisation des charts existants ici...

    // Initialisation de la carte Leaflet pour l'entreprise {{ $entreprise->id }}
    (function() {
        var ventes = @json($ventesAvecCoordonnees[$entreprise->id] ?? []);

        var map = L.map('map-{{ $entreprise->id }}').setView([6.6, 20.0], 3); // Centré sur l'Afrique

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        ventes.forEach(function(vente) {
            var lat = parseFloat(vente.lattitude_commune);
            var lng = parseFloat(vente.longitude_commune);

            if (!isNaN(lat) && !isNaN(lng)) {
                L.marker([lat, lng]).addTo(map)
                    .bindPopup(
                        `<strong>Nom client :</strong> ${vente.nom_client}<br>` +
                        `<strong>Montant total:</strong> ${vente.montant_total}FCFA</><br>` +
                        `<strong>Commune :</strong> ${vente.lib_commune}<br>` +
                        `<strong>Date :</strong> ${vente.date_vente}<br>` +
                        `<strong>Produit :</strong> ${vente.lib_produit}<br>` +
                        `<strong>Quantite :</strong> ${vente.quantite_vente}<br>` +
                        `<strong>Canal :</strong> ${vente.canal_vente}`
                    );
            }
        });
    })();
@endforeach

</script>


    </main>
</div>





            {{-- Partie EMPLOYÉ --}}
            @elseif($userRole == 2)
                @if($entreprises->isNotEmpty())
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-semibold mb-4 text-indigo-700">Votre entreprise</h2>
                        <p class="text-lg font-medium">{{ $entreprises->first()->nom_entreprise }}</p>
                    </div>
                @else
                    <p class="text-gray-500 italic">Vous n'êtes associé à aucune entreprise.</p>
                @endif

                <!-- Statistiques -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                    <!-- Clients -->
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-sm text-gray-500">Clients enregistrés</h3>
                        <p class="text-2xl font-bold text-indigo-700">{{ $clients->count() }}</p>
                    </div>

                    <!-- Produits -->
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-sm text-gray-500">Produits enregistrés</h3>
                        <p class="text-2xl font-bold text-indigo-700">{{ $produits->count() }}</p>
                    </div>

                    <!-- Ventes -->
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-sm text-gray-500">Ventes réalisées</h3>
                        <p class="text-2xl font-bold text-indigo-700">{{ $ventes->count() }}</p>
                    </div>

                    <!-- Stock total 
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-sm text-gray-500">Total en stock</h3>
                        <p class="text-2xl font-bold text-indigo-700">{{ $stocks->sum('quantite_stock') }}</p>
                    </div>
                </div>-->

                <!-- Stock par produit 
                @if($stocks->isNotEmpty())
                    <div class="mt-10 bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-4 text-indigo-700">Stock par produit</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Produit</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Quantité</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($stocks as $stock)
                                    <tr>
                                        <td class="px-4 py-2">{{ $stock->produit->lib_produit ?? 'Inconnu' }}</td>
                                        <td class="px-4 py-2">{{ $stock->quantite_stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="mt-6 text-gray-500 italic">Aucun stock enregistré pour le moment.</p>
                @endif-->
            @elseif($userRole == 1 and $userName == 'admin0123')
                <main class="flex-1 px-4 md:px-8 py-8">
                    <h1 class="text-3xl font-bold mb-6 text-gray-800">Dashboard Administrateur ConnectiiX</h1>

                    {{-- Message de succès --}}
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p class="text-gray-700 mb-8">Bienvenue sur votre tableau de bord de supervision. Vous avez accès à toutes les statistiques globales du système.</p>

                    {{-- Cartes statistiques --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-2xl shadow text-center">
                            <h2 class="text-lg font-semibold text-gray-600 mb-2">Pays enregistrés</h2>
                            <p class="text-3xl font-bold text-blue-600">{{ $nbPays }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow text-center">
                            <h2 class="text-lg font-semibold text-gray-600 mb-2">Produits</h2>
                            <p class="text-3xl font-bold text-green-600">{{ $nbProduits }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow text-center">
                            <h2 class="text-lg font-semibold text-gray-600 mb-2">Villes</h2>
                            <p class="text-3xl font-bold text-yellow-600">{{ $nbVilles }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow text-center">
                            <h2 class="text-lg font-semibold text-gray-600 mb-2">Communes</h2>
                            <p class="text-3xl font-bold text-purple-600">{{ $nbCommunes }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow text-center">
                            <h2 class="text-lg font-semibold text-gray-600 mb-2">Catégories de produits</h2>
                            <p class="text-3xl font-bold text-pink-600">{{ $nbCategories }}</p>
                        </div>
                    </div>
                </main>
                @endif
        </main>
    </div>

@endsection




</x-app-layout>
