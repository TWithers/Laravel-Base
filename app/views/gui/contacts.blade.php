@extends('template.layout')
@section('content-header')
<h1>
    Contacts
</h1>
<ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Contacts</li>
</ol>
@stop
@section('title')
<title>Interleave | Contacts</title>
@stop

<?php $ngApp='contactsApp';?>
@section('content')
	<div ng-view></div>
@stop
@section('footer-scripts')
	@parent
	{{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.js')}}
	{{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-route.min.js')}}
	{{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-sanitize.min.js')}}
	{{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-resource.min.js')}}
	{{HTML::script('assets/js/angular/contacts/controllers.js')}}
	{{HTML::script('assets/js/angular/directives/angular-table.js')}}
	{{HTML::script('assets/js/angular/directives/ng-csv.min.js')}}
	{{HTML::script('assets/js/angular/contacts/services.js')}}
	{{HTML::script('assets/js/angular/directives/typeahead.js')}}
	{{HTML::script('assets/js/angular/contacts/app.js')}}
@stop
@section('header-styles')
	@parent
	{{HTML::style('assets/css/angular-table.css')}}
@stop

