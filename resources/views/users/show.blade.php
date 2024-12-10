@extends('layout.layout')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                @include('shared.success-msg')
                @include('shared.error-msg')
                <div class="mt-3">
                    @include('shared.user-card')
                </div>
                <div class="mt-3">
                    @forelse ($ideas as $idea)
                        <div class="mt-3">
                            @include('ideas.idea-card')
                        </div>
                    @empty
                        <p class="text-center mt-3">No results found.</p>
                    @endforelse
                    <div class="mt-3">
                        {{ $ideas->withQueryString()->links() }}
                    </div>
                </div>
            </div>
            <div class="col-3">
                @include('shared.search-bar')
                @include('shared.follow-box')
            </div>
        </div>
    </div>
@endsection
