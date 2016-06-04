@extends('layouts.admin')

@section('title', trans('content.title_page_result_index'))

@section('content')
    <h1 class="page-header"><i class="fa fa-music-circle"></i> {!! trans('content.title_result_index') !!}</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>{!! trans('content.resultat_index_table_lastname_candidate') !!}</th>
            <th>{!! trans('content.resultat_index_table_firstname_candidate') !!}</th>
            <th>{!! trans('content.resultat_index_table_mail_candidate') !!}</th>
            <th>{!! trans('content.resultat_index_table_questionnaire') !!}</th>
            <th>{!! trans('content.resultat_index_table_lastname_rh') !!}</th>
            <th>{!! trans('content.resultat_index_table_firstname_rh') !!}</th>
        </tr>
        </thead>
        <tbody>

        @foreach($results as $result)
            <tr>
                <td>{{ $result->lastname }}</td>
                <td>{{ $result->firstname }}</td>
                <td>{{ $result->email }}</td>
                <td>{{ $result->questionnaire_title }}</td>
                <td>{{ $result->rh_lastname }}</td>
                <td>{{ $result->rh_firstname }}</td>
                <td>
                    <a class="rh-badge" href="{!! route('admin.result.detail', $result->id) !!}"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>


@endsection
