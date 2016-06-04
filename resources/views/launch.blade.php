@extends('layouts.master')

@section('title', trans('content.launch_page_title'))

@section('content')


 {!! Form::open(array('url' => '/valider', 'method' => 'post')) !!}
<div class="row">
    <div class="col-md-12">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{!! trans('content.launch_title') !!}</h3>
            </div>
            <div class="panel-body">
            	@if (count($question) == 0)
					  No records
				@else
					<div class="first_column">
						{!! Form::hidden('questionnaire_id', $questionnaire_id) !!}
						{!! Form::hidden('question_id', $question['question_id'], ['id' => 'question_id']) !!}
						{!! Form::hidden('_token', csrf_token(), ['id' => 'csrf']) !!}

						<div id="question" class="sizefont_title">
							<div><strong>{{ $question['question_label']  }}</strong></div>
						</div>

						<div id="answers" class="sizefont">
							<?php if($answers !== null) { ?>
								<ul id="answer_list">
									@foreach($answers as $id => $label)
										<li>{!! Form::checkbox('ans', $label, null, ['data-id' => $id])  !!} {{$label}}</li>
									@endforeach
								</ul>
							<?php }else{ ?>
								<div>{!! Form::textarea('ans_empty', '', ['size' => '80x8', 'id' => 'ans_empty'])  !!}</div>
							<?php } ?>
						</div>
					</div>
					<div class="second_column">
						<div class="footer pull-right">
							<button type="button" id="button" class="btn btn-lg btn-extia btn-block">{!! Html::image('assets/img/right-black-arrow.png', 'suivante', ['width' => '150px', 'height' => '150px']) !!}</button>
						</div>
					</div>
				@endif
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('script')
	<script type="text/javascript">
		$(function() {
			$('#button').click(function() {

				var check = new Object();
				$.each($('#answer_list').find('li input:checkbox:checked'), function(i, item) {
					check[i] = $(this).data('id');
				});

				if($('#ans_empty').length) {
					var empty = $('#ans_empty').val();
				}else{
					var empty = "null";
				}

				$.ajax({
					url : "{{route('questionnaire.next_question')}}",
					type : 'POST',
					data : "_token="+$('#csrf').val()+"&question="+$('#question_id').val()+"&answer="+JSON.stringify(check)+"&answer_empty="+empty,
					success : function(response){

						$('#lineTotal').css('width', response.total+"%");

						if(response.end == 1) {
							document.location="/questionnaire/valider/{{$questionnaire_id}}";
						}

						$('#question').html("<div><strong>"+response.question.question_label+"</strong></div>");
						$('#question_id').val(response.question.question_id);

						$('#answers').html('');
						if(response.answers == null) {
							var s = '<div><textarea id="ans_empty" name="ans_empty" cols="80" rows="8"></textarea></div>';
						}else {
							var s = '<ul id="answer_list">';
							$.each(response.answers, function (key, value) {
								s += "<li><input data-id='" + key + "' name='ans' type='checkbox' value='" + value + "'> " + value + "</li>";
							});
							s += "</ul>";
						}

						$('#answers').html(s);

						if(response.end == 1) {
							document.location="/questions/end";
						}
					}
				});
			});
		})
	</script>
@endsection