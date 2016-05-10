@extends('layouts.master')

@section('title', trans('content.index_page_title'))

@section('content')


<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{!! trans('content.index_questionnaire') !!}</h3>
            </div>
            <div class="panel-body">
               <table class="table table-striped">
				    <thead>
				        <tr>
				            <th>{!! trans('content.index_table_hashtag') !!}</th>
				            <th>{!! trans('content.index_table_title') !!}</th>
				            <th>{!! trans('content.index_table_action') !!}</th>
				        </tr>	
				    </thead>
				    <tbody>
			        @foreach($questionnaires as $questionnaire)
				        <tr>
				            <td>{{ $questionnaire->id }}</td>
				            <td>{{ $questionnaire->title }}</td>
				            <td>
				            	  <a class="question-badge edition-badge" href="{!! route('questionnaire.launch',$questionnaire->id) !!}" value="{{ $questionnaire->id }}" >{!! trans('content.index_label_link_action') !!}</a>
				            </td>
				        </tr>
			        @endforeach
	    			</tbody>
    			</table>
    			{!! str_replace('/?', '?', $questionnaires->render()) !!}
            </div>
        </div>
    </div>
</div>


@endsection