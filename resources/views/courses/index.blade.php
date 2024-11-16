@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Courses</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Courses</h3>
                <div class="card-tools">
                    <a class="btn-info btn-sm mx-2" href="{{ route('admin.courses.create') }}"><i class="fas fa-plus"></i> Create</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->category->name ?? '-' }}</td>
                                <td>{{ $item->price }}</td>
                                <td class="py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.courses.show', $item->id) }}" class="btn btn-info mx-1"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.courses.edit', $item->id) }}" class="btn btn-warning mx-1"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.courses.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete?')"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
