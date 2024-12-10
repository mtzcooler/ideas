@auth
    <h4>Share yours ideas</h4>
    <div class="row">
        <form action="{{ route('ideas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" id="idea.content" rows="3"></textarea>
                @error('content')
                    <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                @enderror
                {{-- <textarea name="user" class="form-control" id="idea.user" rows="3"></textarea> --}}
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark">Share</button>
            </div>
        </form>
    </div>
@endauth
@guest
    <div>
        <h4>Login to share your ideas</h4>
    </div>
@endguest
<hr>
