@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-3">Articles et Guides</h1>
        <p class="text-gray-600">Découvrez nos articles et guides sur les finances personnelles, l'immobilier et bien plus.</p>
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
                <p class="text-gray-600">Aucun article disponible pour le moment.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>

    <div class="bg-gray-100 p-8 rounded-lg mt-10 mb-12">
        <h2 class="text-2xl font-bold mb-4">Vous avez une question ?</h2>
        <p class="mb-6">Vous ne trouvez pas l'information que vous cherchez ? N'hésitez pas à nous contacter directement.</p>
        <a href="{{ route('contact') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 transition-colors">Nous contacter</a>
    </div>
@endsection
