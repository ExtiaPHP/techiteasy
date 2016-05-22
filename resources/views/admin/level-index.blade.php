@extends('layouts.admin')

@section('title', trans('content.title_page_level_index'))

@section('content')
    <h1 class="page-header"><i class="fa fa-music-circle"></i> {!! trans('content.title_level_index') !!}</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>{!! trans('content.level_index_table_hashtag') !!}</th>
            <th>{!! trans('content.level_index_table_level') !!}</th>
            <th>{!! trans('content.level_index_table_point') !!}</th>
        </tr>
        </thead>
        <tbody>

        @foreach($levels as $level)
            <tr>
                <td>{{ $level->id }}</td>
                <td>{{ $level->label }}</td>
                <td>{{ $level->point }}</td>
                <td>
                    <a class="level-badge suppression-badge" href="#" data-url="{!! route('admin.level.destroy', $level->id) !!}" data-toggle="modal" data-target="#modalSup"><i class="fa fa-times"></i></a>
                    <a class="level-badge edition-badge" href="{!! route('admin.level.edit', $level->id) !!}" value="{{ $level->id }}" ><i class="fa fa-pencil-square-o"></i></a>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
    <div>
        <a href="{!! route('admin.level.create') !!}" class="btn btn-extia pull-right">{!! trans('content.level_index_add_button') !!}</a>
    </div>

    <div class="modal fade" id="modalSup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-times"></i>
                        {!! trans('content.question_index_title_delete') !!}
                    </h4>
                </div>
                <form id="delete-form" action="" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input id="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <p id="delete-text"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal">{!! trans('content.question_index_delete_cancel_button') !!}</button>
                        <button id="delete-btn" type="submit" class="btn btn-extia">{!! trans('content.question_index_delete_confirm_button') !!}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
