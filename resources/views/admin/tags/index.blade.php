@extends('admin.layouts.base')

@section('contents')

    <h1>Tags</h1>

    @if (session('delete_success'))
        @php $tag = session('delete_success') @endphp
        <div class="alert alert-danger">
            The tag "{{ $tag->name }}" has been deleted
        </div>
    @endif

    {{-- @if (session('restore_success'))
        @php $tag = session('restore_success') @endphp
        <div class="alert alert-success">
            La tag "{{ $tag->title }}" è stata ripristinata
        </div>
    @endif --}}

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <th scope="row">{{ $tag->id }}</th>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.tags.show', ['tag' => $tag]) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('admin.tags.edit', ['tag' => $tag]) }}">Edit</a>
                        <button
                            type="button"
                            class="btn btn-danger js-delete"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="{{ $tag->id }}"
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
                        data-template="{{ route('admin.tags.destroy', ['tag' => '*****']) }}"
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

@endsection