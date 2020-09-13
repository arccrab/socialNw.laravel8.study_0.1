@include('layout.head')

<div class="jumbotron p-4 p-md-5 text-white bg-dark container">
    <div class="col-md-6 px-0">
        <h1 class="display-4">{{ $user['username'] }}</h1>
    </div>
</div>


<div class="container">
    <h4 class="mb-3">Add post</h4>
    <form action='{{ route('create-post') }}' method='post'>
        @csrf
        <input type="hidden" name="user_id" value="{{ $user['id'] }}">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="body">First name</label>
                <textarea class="form-control" id="body" name="body" placeholder="Enter here..."></textarea>
            </div>
        </div>
        <button class="btn btn-success btn-lg" type="submit">Post</button>
        <hr class="mb-4">
    </form>
</div>

<div class="container">
@foreach($posts as $post)

                <div class="row">
                    <div class="col-md-12">
                        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-1 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <div class="mb-1 text-muted">{{ $post['time'] }}</div>
                                <p class="card-text mb-auto">{{ $post['body'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

@endforeach
</div>

@include('layout.footer')