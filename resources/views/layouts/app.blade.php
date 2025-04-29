<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Meta SEO tags --}}
    {!! SEO::generate() !!}

    {{-- Injection du schema JSON-LD --}}
    @foreach($schema ?? [] as $type => $schemaObj)
        {!! $schemaObj->toScript() !!}
    @endforeach

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire styles --}}
    @livewireStyles
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-blue-600">En-Ligne.ma</a>
                <ul class="flex space-x-6">
                    <li><a href="/" class="text-gray-700 hover:text-blue-600">Accueil</a></li>
                    <li><a href="/calculateurs" class="text-gray-700 hover:text-blue-600">Calculateurs</a></li>
                    <li><a href="/a-propos" class="text-gray-700 hover:text-blue-600">À propos</a></li>
                    <li><a href="/contact" class="text-gray-700 hover:text-blue-600">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">En-Ligne.ma</h3>
                    <p class="text-gray-300">Vos simulateurs et calculateurs marocains en ligne. Rapides, gratuits et simples d'utilisation.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Liens utiles</h3>
                    <ul class="space-y-2">
                        <li><a href="/calculateurs/salaire-net" class="text-gray-300 hover:text-white">Calculateur de salaire net</a></li>
                        <li><a href="/calculateurs/credit-immobilier" class="text-gray-300 hover:text-white">Simulateur de crédit immobilier</a></li>
                        <li><a href="/mentions-legales" class="text-gray-300 hover:text-white">Mentions légales</a></li>
                        <li><a href="/politique-confidentialite" class="text-gray-300 hover:text-white">Politique de confidentialité</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <p class="text-gray-300">Des questions ou suggestions ? N'hésitez pas à nous contacter.</p>
                    <a href="/contact" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Nous contacter</a>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} En-Ligne.ma - Tous droits réservés</p>
            </div>
        </div>
    </footer>

    {{-- Livewire scripts --}}
    @livewireScripts
</body>
</html>
