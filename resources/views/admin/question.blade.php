@extends('layouts.admin')

@section('title', trans('content.title_page_question_index'))

@section('content')
<h1 class="page-header"><i class="fa fa-question-circle"></i> {!! trans('content.title_question_index') !!}</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>{!! trans('content.question_index_table_hashtag') !!}</th>
            <th>{!! trans('content.question_index_table_category') !!}</th>
            <th>{!! trans('content.question_index_table_question') !!}</th>
            <th>{!! trans('content.question_index_table_description') !!}</th>
            <th>{!! trans('content.question_index_table_level') !!}</th>
            <th>{!! trans('content.question_index_table_action') !!}</th>
        </tr>	
    </thead>
    <tbody>




    </tbody>
</table>
<div>
    <a href="{!! route('admin.question.create') !!}" class="btn btn-extia pull-right">{!! trans('content.question_index_add_button') !!}</a>
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
