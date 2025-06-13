 <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- 🔹 Statistiques générales --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Ventes par période --}}
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-semibold mb-2">Ventes par Période</h3>
                    <div class="relative h-64">
                        <canvas id="chartPeriode" class="w-full h-64"></canvas>
                    </div>
            </div>

            {{-- Ventes par catégorie --}}
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-semibold mb-2">Ventes par Catégorie</h3>
                    <div class="relative h-64">
                        <canvas id="chartCategorie" class="w-full h-64"></canvas>
                    </div>
            </div>
        </div>

        {{-- Produits les plus vendus --}}
        <div class="bg-white shadow rounded-lg p-4 mt-6">
            <h3 class="text-lg font-semibold mb-2">Top 5 des Produits les Plus Vendus</h3>
                <div class="relative h-64">
                    <canvas id="chartProduits" class="w-full h-64"></canvas>
                </div>
        </div>
    </div>