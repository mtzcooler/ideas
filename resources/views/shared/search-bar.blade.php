<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">Search</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard') }}" method="GET">
            <input name="search" value="{{ request('search') }}" placeholder="..." class="form-control w-100"
                type="search" id="search" clearable="true">
            <button class="btn btn-dark mt-2">Search</button>
        </form>
    </div>
</div>
