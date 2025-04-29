@extends('layouts.app')

@section('content')
    <article class="mb-10">
        <header class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
            <div class="flex items-center text-gray-500 mb-6">
                <span>{{ $article->published_at->format('d/m/Y') }}</span>
                @if($article->category)
                    <span class="mx-2">•</span>
                    <a href="{{ route('articles.category', $article->category) }}" class="text-blue-600 hover:text-blue-800">
                        {{ ucfirst(str_replace('-', ' ', $article->category)) }}
                    </a>
                @endif
            </div>

            @if($article->image)
                <div class="rounded-lg overflow-hidden mb-8">
                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full h-auto">
                </div>
            @endif
        </header>

        <div class="prose lg:prose-xl max-w-none">
            {!! $article->content !!}
        </div>
    </article>

    @if($relatedArticles->count() > 0)
        <div class="mt-12 mb-8">
            <h2 class="text-2xl font-bold mb-6">Articles associés</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $relatedArticle)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        @if($relatedArticle->image)
                            <div class="h-40 overflow-hidden">
                                <img src="{{ asset($relatedArticle->image) }}" alt="{{ $relatedArticle->title }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold mb-2">{{ $relatedArticle->title }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $relatedArticle->excerpt }}</p>
                            <a href="{{ route('articles.show', $relatedArticle->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lire l'article →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8 mt-12">
        <div class="lg:w-2/3">
            <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                <h3 class="text-xl font-semibold mb-3">Vous avez une question ?</h3>
                <p class="text-gray-600 mb-4">Notre équipe est disponible pour vous aider et répondre à toutes vos questions.</p>
                <a href="{{ route('contact') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Nous contacter</a>
            </div>
        </div>

        <div class="lg:w-1/3">
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                <h3 class="text-xl font-semibold mb-3">Nos calculateurs</h3>
                <p class="text-gray-600 mb-4">Découvrez nos outils gratuits pour vos calculs financiers.</p>
                <a href="{{ route('calculateurs.index') }}" class="inline-block px-6 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition-colors">Voir tous les calculateurs</a>
            </div>
        </div>
    </div>
@endsection
