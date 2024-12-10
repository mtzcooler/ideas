<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{ $idea->user->getImageURL() }}" alt="{{ $idea->user->getUsername() }} Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}">{{ $idea->user->name }}</a></h5>
                </div>
            </div>
            <div>
                <form method="POST" action="{{ route('ideas.destroy', $idea) }}">
                    @csrf
                    <a href="{{ route('ideas.show', $idea->id) }}">View</a>
                    @if (Auth::id() === $idea->user_id)
                        <a href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
                        <button class="btn btn-danger btn-sm" type="submit">X</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('ideas.update', $idea->id) }}" method="POST">
                @csrf @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="idea.content" rows="3">{{ $idea->content }}</textarea>
                    @error('content')
                        <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                    @enderror
                    {{-- <textarea name="user" class="form-control" id="idea.user" rows="3"></textarea> --}}
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2">Update</button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('ideas.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at }} </span>
            </div>
        </div>
        @include('ideas.comments-box')
    </div>
</div>
