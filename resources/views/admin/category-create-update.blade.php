@extends('layouts.admin')

@section('title', $category->id ? trans('conent.title_page_category_edit') : trans('content.title_page_category_add'))

@section('page', $page)

@section('content')
<h1 class="page-header"><i class="fa fa-bookmark"></i> {!! trans('content.title_category_add') !!}</h1>
<ol class="breadcrumb">
	<li><a href="{!! route('admin.category.index') !!}"><i class="fa fa-arrow-circle-left"></i> {!! trans('content.back') !!}</a></li>
</ol>
<div class="row">
	<div class="col-md-12">
	@if($category->id)
		<h2>{!! trans('content.category_edit_header', ['name' => $category->name]) !!}</h2>
	@else
		<h2>{!! trans('content.category_add_header') !!}</h2>
	@endif
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! Form::open(array('url' => $category->id ? URL::route('admin.category.update', $category->id) : URL::route('admin.category.store'), 'method' => $category->id ? 'put' : 'post')) !!}
			<div class="form-group">
				<label>{!! trans('content.category_add_label_name') !!}</label>
				{!! Form::text('name', $category->name, array('class' => 'form-control', 'placeholder' => trans('content.category_add_placeholder_name'), 'required' => 'required')) !!}
			</div>
			<button type="submit" class="btn btn-lg btn-extia btn-block">{!! $category->id ? trans('content.category_edit_button').' <i class="fa fa-check"></i>' : trans('content.category_add_button').' <i class="fa fa-plus"></i>' !!}</i></button>
		{!! Form::close() !!}
	</div>
</div>
@endsection