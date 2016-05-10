<ul class="nav nav-sidebar">
	<li{!! isset($page) && $page == 'dashboard' ? ' class="active"' : '' !!}>
        <a href="{!! route('dashboard') !!}"><i class="fa fa-tachometer"></i> {!! trans('content.sidebard_dashboard') !!}</a>
    </li>
    <li{!! isset($page) && $page == 'questionnaire' ? ' class="active"' : '' !!}>
        <a href="{!! route('admin.questionnaire.index') !!}"><i class="fa fa-file-text"></i></i> {!! trans('content.sidebard_questionnaire') !!}</a>
    </li>
    <li{!! isset($page) && $page == 'question' ? ' class="active"' : '' !!}>
        <a href="{!! route('admin.question.index') !!}"><i class="fa fa-question-circle"></i> {!! trans('content.sidebard_question') !!}</a>
    </li>
    <li{!! isset($page) && $page == 'category' ? ' class="active"' : '' !!}>
        <a href="{!! route('admin.category.index') !!}"><i class="fa fa-bookmark"></i> {!! trans('content.sidebard_category') !!}</a>
    </li>
</ul>
