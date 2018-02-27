@extends('admin.layout')

@section('title', 'Article')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">記事一覧</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6 text-left">
                                <a href="{{ url('admin/article/create') }}" class="btn btn-info btn-circle"><i class="fa fa-pencil-square-o"></i></a>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="{{ url('admin/article/create') }}" class="btn btn-primary btn-circle">20</a>
                                <a href="{{ url('admin/article/create') }}" class="btn btn-default btn-circle">50</a>
                                <a href="{{ url('admin/article/create') }}" class="btn btn-default btn-circle">100</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles['data'] as $article)
                                <tr>
                                    <td>{{ $article->seq }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ mb_strimwidth($article->content, 0, 70, '...') }}</td>
                                    <td>
                                        <a href="{{ url(sprintf('admin/article/%d/edit', $article->seq)) }}" class="btn btn-warning btn-circle"><i class="fa fa-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-eraser"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-6 text-left">
                                @if (is_null($articles['pagination']['first']))
                                    <a class="btn btn-default btn-circle disabled"><i class="fa fa-angle-double-left"></i></a>
                                @else
                                    <a href="{{ url()->current() . '?' . http_build_query(['start' => $articles['pagination']['first']]) }}" class="btn btn-default btn-circle"><i class="fa fa-angle-double-left"></i></a>
                                @endif
                                @if (is_null($articles['pagination']['previous']))
                                    <a class="btn btn-default btn-circle disabled"><i class="fa fa-angle-left"></i></a>
                                @else
                                    <a href="{{ url()->current() . '?' . http_build_query(['start' => $articles['pagination']['previous']]) }}" class="btn btn-default btn-circle"><i class="fa fa-angle-left"></i></a>
                                @endif
                                </div>
                                <div class="col-lg-6 text-right">
                                @if (is_null($articles['pagination']['next']))
                                    <a class="btn btn-default btn-circle disabled"><i class="fa fa-angle-right"></i></a>
                                @else
                                    <a href="{{ url()->current() . '?' . http_build_query(['start' => $articles['pagination']['next']]) }}" class="btn btn-default btn-circle"><i class="fa fa-angle-right"></i></a>
                                @endif
                                @if (is_null($articles['pagination']['last']))
                                    <a class="btn btn-default btn-circle disabled"><i class="fa fa-angle-double-right"></i></a>
                                @else
                                    <a href="{{ url()->current() . '?' . http_build_query(['start' => $articles['pagination']['last']]) }}" class="btn btn-default btn-circle"><i class="fa fa-angle-double-right"></i></a>
                                @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
@endsection
