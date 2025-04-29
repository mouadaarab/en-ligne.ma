@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-3">Articles sur {{ $categoryName }}</h1>
        <p class="text-gray-600">Découvrez tous nos articles et guides sur le thème {{ $categoryName }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
        @forelse($articles as $article)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($article->image)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">{{ $article->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $article->excerpt }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">{{ $article->published_at->format('d/m/Y') }}</span>
                        <a href="{{ route('articles.show', $article->slug) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                            Lire l'article
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center p-10">
                <p class="text-gray-600">Aucun article disponible dans cette catégorie pour le moment.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-12">
        <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
            <h3 class="text-xl font-semibold mb-3">Tous nos articles</h3>
            <p class="text-gray-600 mb-4">Découvrez l'ensemble de nos articles et guides sur différents sujets.</p>
            <a href="{{ route('articles.index') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Voir tous les articles</a>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
            <h3 class="text-xl font-semibold mb-3">Nos calculateurs</h3>
            <p class="text-gray-600 mb-4">Découvrez nos outils gratuits pour vos calculs financiers.</p>
            <a href="{{ route('calculateurs.index') }}" class="inline-block px-6 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition-colors">Voir les calculateurs</a>
        </div>
    </div>
@endsection
