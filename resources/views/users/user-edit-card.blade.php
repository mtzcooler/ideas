<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                        alt="{{ $user->getUsername() }} Avatar">
                    <div>
                        <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                        @error('name')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                @auth
                    @if (Auth::id() == $user->id)
                        <div>
                            <a href="{{ route('users.show', $user->id) }}">View</a>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="mt-4">
                <label for="">Profile Picture</label>
                <input name="avatar" type="file" class="form-control">
                @error('avatar')
                    <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                @enderror
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>
                <textarea name="bio" class="form-control" id="user.bio" rows="3">{{ $user->bio }}</textarea>
                @error('bio')
                    <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                @enderror
                <div class="">
                    <button type="submit" class="btn btn-dark btn-sm mt-1">Save</button>
                </div>
                <div class="d-flex justify-content-start">
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                        </span> {{ $user->followers()->count() }} Followers </a>
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                        </span> {{ $user->ideas()->count() }} </a>
                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                        </span> {{ $user->comments()->count() }} </a>
                </div>
            </div>
        </form>
    </div>
</div>
<hr>
