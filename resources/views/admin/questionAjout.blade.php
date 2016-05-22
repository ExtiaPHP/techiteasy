@extends('layouts.admin')

@section('title', trans('content.title_page_question_add'))

@section('page', $page)

@section('content')

<ol class="breadcrumb">
    <li><a href="{!! route('admin.question.index') !!}"><i class="fa fa-arrow-circle-left"></i> {!! trans('content.back') !!}</a></li>
</ol>

{!! Form::open(array('url' => '#', 'method' => 'post')) !!}
<div class="form-group">
    <label for="category">{!! trans('content.question_add_label_category') !!}</label>
    {!! Form::select('categories', ['1' => 'Front-end', '2' => 'Back-end', '3' => 'CSS3'], null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="description">{!! trans('content.question_add_label_description') !!}</label>
    {!! Form::text('description', '', array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_description'))) !!}
</div>
<div class="form-group">
    <label for="question">{!! trans('content.question_add_label_question') !!}</label>
    {!! Form::textArea('question', '', array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_question'), 'rows' => '3')) !!}
</div>
<div class="form-group">
    <label for="difficulty">{!! trans('content.question_add_label_level') !!}</label>
    {!! Form::select('difficulties', ['1' => 'Débutant', '2' => 'Intermédiaire', '3' => 'Difficile'], '', ['class' => 'form-control']) !!}
</select>
</div>

<div class="form-group">
     <label for="answer">{!! trans('content.question_add_label_response_1') !!}</label>

       {!! Form::checkbox('reponse_valide_1', 1) !!}
       {!! Form::text('answer1', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_1'))) !!}
</div>
<div class="form-group">
     <label for="answer">{!! trans('content.question_add_label_response_2') !!}</label>

        {!! Form::checkbox('reponse_valide_2', 1) !!}
        {!! Form::text('answer2', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_2'))) !!}
</div>
<div class="form-group">
      <label for="answer">{!! trans('content.question_add_label_response_3') !!}</label>

        {!! Form::checkbox('reponse_valide_3', 1) !!}
        {!! Form::text('answer3', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_3'))) !!}
</div>
<div class="form-group">
       <label for="answer">{!! trans('content.question_add_label_response_4') !!}</label>

        {!! Form::checkbox('reponse_valide_4', 1) !!}
        {!! Form::text('answer4', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_4'))) !!}
</div>
<div class="form-group">
      <label for="answer">{!! trans('content.question_add_label_response_5') !!}</label>

        {!! Form::checkbox('reponse_valide_5', 1) !!}
        {!! Form::text('answer5', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_5'))) !!}
</div>
<div class="form-group">
       <label for="answer">{!! trans('content.question_add_label_response_6') !!}</label>

         {!! Form::checkbox('reponse_valide_6', 1) !!}
         {!! Form::text('answer6', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_6'))) !!}
</div>

       
<div class="footer pull-right">
    <a href="{!! route('admin.question.index') !!}" class="btn btn-default ">{!! trans('content.question_add_cancel_button') !!}</a>
    <button type="button" class="btn btn-extia">{!! trans('content.question_add_save_button') !!}</button>
</div>




{!! Form::close() !!}
<div>
</div>

@endsection
