@extends('admin.layouts.base')

@section('contents')

    <h1>Posts</h1>

    @if (session('delete_success'))
        @php $post = session('delete_success') @endphp
        <div class="alert alert-danger">
            Il post "{{ $post->title }}" è stato eliminato per sempre
            {{-- <form
                action="{{ route("admin.posts.restore", ['post' => $post]) }}"
                    method="post"
                    class="d-inline-block"
                >
                @csrf
                <button class="btn btn-warning">Ripristina</button>
            </form> --}}
        </div>
    @endif

    {{-- @if (session('restore_success'))
        @php $post = session('restore_success') @endphp
        <div class="alert alert-success">
            La post "{{ $post->title }}" è stata ripristinata
        </div>
    @endif --}}

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Tags</th>
                <th scope="col">Image url</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td><a href="{{ route('admin.categories.show', ['category' => $post->category]) }}">{{ $post->category->name }}</a></td>
                    <td>
                        @foreach ($post->tags as $tag)
                            <a href="{{ route('admin.tags.show', ['tag' => $tag]) }}">{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </td>
                    <td>{{ $post->url_image }}</td>
                    <td>
                        <a href="{{ route('admin.posts.prova', ['post' => $post]) }}">al link di prova</a>
                        <a class="btn btn-primary" href="{{ route('admin.posts.show', ['post' => $post]) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post]) }}">Edit</a>
                        <button
                            type="button"
                            class="btn btn-danger js-delete"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="{{ $post->slug }}"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form
                        action=""
                        data-template="{{ route('admin.posts.destroy', ['post' => '*****']) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{ $posts->links() }}

@endsection