@extends('layouts.admin')

@section('title', $level->id ? trans('conent.title_page_level_edit') : trans('content.title_page_level_add'))

@section('page', $page)

@section('content')
    <h1 class="page-header"><i class="fa fa-music"></i> {!! trans('content.title_level_add') !!}</h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin.level.index') !!}"><i class="fa fa-arrow-circle-left"></i> {!! trans('content.back') !!}</a></li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @if($level->id)
                <h2>{!! trans('content.level_edit_header', ['name' => $level->label]) !!}</h2>
            @else
                <h2>{!! trans('content.level_add_header') !!}</h2>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(array('url' => $level->id ? URL::route('admin.level.update', $level->id) : URL::route('admin.level.store'), 'method' => $level->id ? 'put' : 'post')) !!}
            <div class="form-group">
                <label>{!! trans('content.level_add_label_name') !!}</label>
                {!! Form::text('label', $level->label, array('class' => 'form-control', 'placeholder' => trans('content.level_add_placeholder_name'))) !!}
            </div>
            <div class="form-group">
                <label>{!! trans('content.level_add_label_point') !!}</label>
                {!! Form::text('point', $level->point, array('class' => 'form-control', 'placeholder' => trans('content.level_add_placeholder_point'))) !!}
            </div>
            <button type="submit" class="btn btn-lg btn-extia btn-block">{!! $level->id ? trans('content.level_edit_button').' <i class="fa fa-check"></i>' : trans('content.level_add_button').' <i class="fa fa-plus"></i>' !!}</i></button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection