@extends('template.layout')
@section('content-header')
<h1>
    Companies
</h1>
<ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Companies</li>
</ol>
@stop
@section('title')
<title>Interleave | Companies</title>
@stop

<?php $ngApp='companiesApp';?>
@section('content')
	<div ng-view></div>
@stop
@section('footer-scripts')
	@parent
	{{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.js')}}
	{{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-route.min.js')}}
	{{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-sanitize.min.js')}}
	{{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-resource.min.js')}}
	{{HTML::script('assets/js/angular/companies/controllers.js')}}
	{{HTML::script('assets/js/angular/directives/angular-table.js')}}
	{{HTML::script('assets/js/angular/directives/ng-csv.min.js')}}
	{{HTML::script('assets/js/angular/companies/services.js')}}
	{{HTML::script('assets/js/angular/companies/app.js')}}
@stop
@section('header-styles')
	@parent
	{{HTML::style('assets/css/angular-table.css')}}
@stop

