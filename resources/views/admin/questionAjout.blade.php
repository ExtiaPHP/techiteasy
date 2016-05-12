@extends('layouts.admin')

@section('title', $question->id ? trans('content.title_page_question_edit') : trans('content.title_page_question_add'))

@section('page', $page)

@section('content')

<ol class="breadcrumb">
    <li><a href="{!! route('admin.questionnaire.index') !!}"><i class="fa fa-arrow-circle-left"></i> {!! trans('content.back') !!}</a></li>
</ol>

{!! Form::open(array('url' => $question->id ? URL::route('admin.question.update', $question->id) : URL::route('admin.question.store'), 'method' => $question->id ? 'put' : 'post')) !!}
<div class="form-group">
    <label for="category">{!! trans('content.question_add_label_category') !!}</label>
    {!! Form::select('categories', $categories, $question->category_id, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="description">{!! trans('content.question_add_label_description') !!}</label>
    {!! Form::text('description', $question->label, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_description'))) !!}
</div>
<div class="form-group">
    <label for="question">{!! trans('content.question_add_label_question') !!}</label>
    {!! Form::textArea('question', $question->description, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_question'), 'rows' => '3')) !!}
</div>
<div class="form-group">
    <label for="difficulty">{!! trans('content.question_add_label_level') !!}</label>
    {!! Form::select('difficulties', $difficulties, $question->level, ['class' => 'form-control']) !!}
</select>
</div>

<div class="form-group">
     <label for="answer">{!! trans('content.question_add_label_response_1') !!}</label>
      @if (isset($aReponses[0]))
       {!! Form::hidden('reponse_1_id', $aReponses[0]->id) !!}
       {!! Form::checkbox('reponse_valide_1', 1, $aReponses[0]->verify) !!}
       {!! Form::text('answer1', $aReponses[0]->label, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_1'))) !!}
    @else
       {!! Form::checkbox('reponse_valide_1', 1) !!}
       {!! Form::text('answer1', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_1'))) !!}
    @endif
</div>
<div class="form-group">
     <label for="answer">{!! trans('content.question_add_label_response_2') !!}</label>
        @if (isset($aReponses[1]))
        {!! Form::hidden('reponse_2_id', $aReponses[1]->id) !!}
        {!! Form::checkbox('reponse_valide_2', 1,$aReponses[1]->verify) !!}
        {!! Form::text('answer2', $aReponses[1]->label, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_2'))) !!}
        @else
        {!! Form::checkbox('reponse_valide_2', 1) !!}
        {!! Form::text('answer2', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_2'))) !!}
        @endif
</div>
<div class="form-group">
      <label for="answer">{!! trans('content.question_add_label_response_3') !!}</label>
        @if (isset($aReponses[2]))
         {!! Form::hidden('reponse_3_id', $aReponses[2]->id) !!}
        {!! Form::checkbox('reponse_valide_3', 1, $aReponses[2]->verify) !!}
        {!! Form::text('answer3', $aReponses[2]->label, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_3'))) !!}
        @else
        {!! Form::checkbox('reponse_valide_3', 1) !!}
        {!! Form::text('answer3', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_3'))) !!}
        @endif
</div>
<div class="form-group">
       <label for="answer">{!! trans('content.question_add_label_response_4') !!}</label>
        @if (isset($aReponses[3]))
         {!! Form::hidden('reponse_4_id', $aReponses[3]->id) !!}
        {!! Form::checkbox('reponse_valide_4', 1, $aReponses[3]->verify) !!}
        {!! Form::text('answer4', $aReponses[3]->label, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_4'))) !!}
        @else
        {!! Form::checkbox('reponse_valide_4', 1) !!}
        {!! Form::text('answer4', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_4'))) !!}
        @endif
</div>
<div class="form-group">
      <label for="answer">{!! trans('content.question_add_label_response_5') !!}</label>
        @if (isset($aReponses[4]))
        {!! Form::hidden('reponse_5_id', $aReponses[4]->id) !!}
        {!! Form::checkbox('reponse_valide_5', 1, $aReponses[4]->verify) !!}
        {!! Form::text('answer5', $aReponses[4]->label, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_5'))) !!}
        @else
        {!! Form::checkbox('reponse_valide_5', 1) !!}
        {!! Form::text('answer5', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_5'))) !!}
        @endif 
</div>
<div class="form-group">
       <label for="answer">{!! trans('content.question_add_label_response_6') !!}</label>
      @if (isset($aReponses[5]))
          {!! Form::hidden('reponse_6_id', $aReponses[5]->id) !!}
          {!! Form::checkbox('reponse_valide_6', 1, $aReponses[5]->verify) !!}
          {!! Form::text('answer6', $aReponses[5]->label, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_6'))) !!}
      @else
         {!! Form::checkbox('reponse_valide_6', 1) !!}
         {!! Form::text('answer6', null, array('class' => 'form-control', 'placeholder' => trans('content.question_add_placeholder_response_6'))) !!}
      @endif
</div>

       
<div class="footer pull-right">
    <a href="{!! route('admin.question.index') !!}" class="btn btn-default ">{!! trans('content.question_add_cancel_button') !!}</a>
    <button type="submit" class="btn btn-extia">{!! trans('content.question_add_save_button') !!}</button>
</div>




{!! Form::close() !!}
<div>
</div>

@endsection
