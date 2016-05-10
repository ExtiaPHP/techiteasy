@extends('layouts.admin')

@section('title', trans('content.title_page_questionnaire_index'))

@section('content')

<h1 class="page-header"><i class="fa fa-question-circle"></i> {!! trans('content.title_questionnaire_index') !!}</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>{!! trans('content.questionnaire_index_column_hashtag') !!}</th>
            <th>{!! trans('content.questionnaire_index_column_title') !!}</th>
            <th>{!! trans('content.questionnaire_index_column_action') !!}</th>
        </tr>	
    </thead>
    <tbody>
        @foreach($questionnaires as $questionnaire)
        <tr>
            <td>{{ $questionnaire->id }}</td>
            <td id="category-name-{{ $questionnaire->id }}">{{ $questionnaire->title }}</td>
            <td>
                <button class="btn btn-default btn-xs btn-delete-category" data-toggle="modal" data-target="#questionnaireDeleteModal" title="{!! trans('content.questionnaire_index_button_delete') !!}" data-id="{{ $questionnaire->id }}" data-urldelete="{!! route('admin.questionnaire.destroy', $questionnaire->id) !!}"><i class="fa fa-times"></i></button>
                <a href="{!! route('admin.questionnaire.edit', $questionnaire->id) !!}" class="btn btn-default btn-xs" title="{!! trans('content.questionnaire_index_button_edit') !!}"><i class="fa fa-pencil-square-o"></i></a>
            </td>
        </tr>
        @endforeach
        <?php echo $questionnaires->render(); ?>

    </tbody>
</table>
<div>
    <a href="{!! route('admin.questionnaire.create') !!}" class="btn btn-extia pull-right">{!! trans('content.questionnaire_index_add') !!}</a>
</div>


<div id="questionnaireDeleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(array('url' => URL::route('admin.questionnaire.destroy', 0), 'method' => 'DELETE', 'id' => 'category-delete-form')) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! trans('content.questionnaire_index_title_delete') !!} "<span id="category-name-delete"></span>"</h4>
            </div>
            <div class="modal-body">
                <p>{!! trans('content.questionnaire_index_modal_text') !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('content.questionnaire_index_modal_cancel') !!}</button>
                <button type="submit" class="btn btn-extia">{!! trans('content.questionnaire_index_modal_delete') !!}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
