@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Members</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Members</h3>
                <a class="btn-info btn-sm mx-2" href="{{ route('member.create') }}"><i class="fas fa-plus"></i></a>
                <div class="card-tools">
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
                            <th>Name</th>
                            <th>USER ID</th>
                            <th>Email</th>
                            <th>Membership Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @foreach ($item->categories as $cat)
                                        {{ $cat->name }}
                                        @unless ($loop->last)
                                            ,
                                        @endunless
                                    @endforeach
                                </td>
                                <td class="py-0 align-middle">
                                    <div class="d-flex">
                                        <a href="{{ route('member.show',$item->id) }}" class="btn-sm btn-info mr-1"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('member.edit',$item->id) }}" class="btn-sm btn-warning mr-1"><i class="fas fa-edit"></i></a>
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
