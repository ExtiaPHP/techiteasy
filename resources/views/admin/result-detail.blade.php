@extends('layouts.admin')

@section('title', trans('content.title_page_result_index'))

@section('content')
    <h1 class="page-header"><i class="fa fa-music-circle"></i> {!! trans('content.title_result_index') !!}</h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin.result.index') !!}"><i class="fa fa-arrow-circle-left"></i> {!! trans('content.back') !!}</a></li>
    </ol>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>{!! trans('content.resultat_index_table_question') !!}</th>
            @for($i=1;$i<=$maxCpt;$i++)
                <th>{!! trans('content.resultat_index_table_answer') !!}</th>
            @endfor
        </tr>
        </thead>
        <tbody>

        @foreach($re as $result)
            <tr>
                <td>{{ $result['question'] }}</td>
                @for($i=1;$i<=$maxCpt;$i++)
                    <td>{{ isset($result['answer'.$i]) ? $result['answer'.$i] : '' }}</td>
                @endfor

            </tr>
        @endforeach


        </tbody>
    </table>



@endsection
