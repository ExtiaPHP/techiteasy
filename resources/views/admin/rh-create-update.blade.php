@extends('layouts.admin')

@section('title', $rh->id ? trans('conent.title_page_rh_edit') : trans('content.title_page_rh_add'))

@section('page', $page)

@section('content')
    <h1 class="page-header"><i class="fa fa-tree"></i> {!! trans('content.title_rh_add') !!}</h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin.rh.index') !!}"><i class="fa fa-arrow-circle-left"></i> {!! trans('content.back') !!}</a></li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @if($rh->id)
                <h2>{!! trans('content.rh_edit_header', ['name' => $rh->lastname.' '.$rh->firstname]) !!}</h2>
            @else
                <h2>{!! trans('content.rh_add_header') !!}</h2>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(array('url' => $rh->id ? URL::route('admin.rh.update', $rh->id) : URL::route('admin.rh.store'), 'method' => $rh->id ? 'put' : 'post')) !!}
            <div class="form-group">
                <label>{!! trans('content.rh_add_label_lastname') !!}</label>
                {!! Form::text('lastname', $rh->lastname, array('class' => 'form-control', 'placeholder' => trans('content.rh_add_placeholder_lastname'))) !!}
            </div>
            <div class="form-group">
                <label>{!! trans('content.rh_add_label_firstname') !!}</label>
                {!! Form::text('firstname', $rh->firstname, array('class' => 'form-control', 'placeholder' => trans('content.rh_add_placeholder_firstname'))) !!}
            </div>
            <div class="form-group">
                <label>{!! trans('content.rh_add_label_mail') !!}</label>
                {!! Form::text('email', $rh->email, array('class' => 'form-control', 'placeholder' => trans('content.rh_add_placeholder_mail'))) !!}
            </div>
            <button type="submit" class="btn btn-lg btn-extia btn-block">{!! $rh->id ? trans('content.rh_edit_button').' <i class="fa fa-check"></i>' : trans('content.rh_add_button').' <i class="fa fa-plus"></i>' !!}</i></button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection