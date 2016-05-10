@extends('layouts.admin')

@section('title', $questionnaire->id ? trans('content.title_page_questionnaire_edit') : trans('content.title_page_questionnaire_add'))

@section('page', $page)

@section('content')
<h1 class="page-header"><i class="fa fa-bookmark"></i> {!! trans('content.title_questionnaire_add') !!}</h1>

<ol class="breadcrumb">
	<li><a href="{!! route('admin.questionnaire.index') !!}"><i class="fa fa-arrow-circle-left"></i> {!! trans('content.back') !!}</a></li>
</ol>
<div class="row">
	<div class="col-md-12">
	@if($questionnaire->id)
		<h2>{!! trans('content.questionnaire_edit_header', ['name' => $questionnaire->title]) !!}</h2>
	@else
		<h2>{!! trans('content.questionnaire_add_header') !!}</h2>
	@endif
	</div>
</div>



<div class="row">
	<div>
		{!! Form::open(array('url' => $questionnaire->id ? URL::route('admin.questionnaire.update', $questionnaire->id) : URL::route('admin.questionnaire.store'),
			'method' => $questionnaire->id ? 'put' : 'post',
			'id' => 'formquestionnaire')) !!}
			<div class="form-group">
				{!! Form::text('title', $questionnaire->title, array('class' => 'form-control', 'placeholder' => 'Nom', '	')) !!}
			</div>
			<div>
				{!! Form::select('categories', ['' => ''] + $categories, '', array('class' => 'form-control', 'id' => 'categories')) !!}
			</div>

			<input type="hidden" value="" name="listcheck" id="listcheck">
			<div id="renderlist">

			</div>


			<button type="button" id="validate" class="margin_top_10 btn btn-lg btn-extia btn-block">{!! $questionnaire->id ? trans('content.questionnaire_edit_button').' <i class="fa fa-check"></i>' : trans('content.questionnaire_add_button').' <i class="fa fa-plus"></i>' !!}</i></button>
		{!! Form::close() !!}
	</div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(function() {
			tabCheck = new Object();

			<?php if (isset($questions)) { ?>
				tabBisCheck = "{{ $questions }}";
				$.each(tabBisCheck.split(','), function (a,b) {
					tabCheck[b] = b;
				});
			<?php } ?>

			$('#categories').change(function() {
				if($(this).val() != '') {
					$.ajax({
						url : '/admin/questionnaire/listquestion/'+$(this).val(),
						type : 'GET',
						success : function(data){ // code_html contient le HTML renvoyé
							string = "";
							string += "<div style='width:5%'><strong>{!! trans('content.questionnaire_add_table_hashtag') !!}</strong></div>";
							string += "<div style='width:5%'><strong>{!! trans('content.questionnaire_add_table_number') !!}</strong></div>";
							string += "<div style='width:40%'><strong>{!! trans('content.questionnaire_add_table_question') !!}</strong></div>";
							string += "<div style='width:40%'><strong>{!! trans('content.questionnaire_add_table_description') !!}</strong></div>";
							string += "<div style='width:5%'><strong>{!! trans('content.questionnaire_add_table_level') !!}</strong></div>";
							string += "<div class='clear'></div>";

							$.each(data.response, function(i, item) {
								if(i%2 == 0)
									classodd='odd';
								else
									classodd='';

								if(tabCheck.hasOwnProperty(item.id))
									check = "checked='checked'";
								else
									check = '';

								string += "<div class='"+classodd+"' style='width:5%'><input class='checkbox' "+check+" type='checkbox' value='"+item.id+"'></div>";
								string += "<div class='"+classodd+"' style='width:5%'>"+item.id+"</div>";
								string += "<div class='"+classodd+"' style='width:40%'>"+item.label+"</div>";
								string += "<div class='"+classodd+"' style='width:40%'>"+item.description+"</div>";
								string += "<div class='"+classodd+"' style='width:5%'>"+item.level+"</div>";
								string += "<div class='clear'></div>";
							});

							$('#renderlist').html(string);

							bind();
						}

					});
				}
			})

			$('#validate').click(function() {
				$('#listcheck').val(JSON.stringify(tabCheck));

				$('#formquestionnaire').submit();
			});
		})

		function bind() {
			$(".checkbox").unbind('click');
			$(".checkbox").click(function() {
				if($(this).is(':checked'))
					tabCheck[$(this).val()] = $(this).val();
				else
					delete tabCheck[$(this).val()];
			})
		}
	</script>
@stop