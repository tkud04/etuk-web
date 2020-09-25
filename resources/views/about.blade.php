<?php
$title = "About Us";
$subtitle = "Who we are & What we strive for";
?>
@extends('layout')

@section('title',"About Us")

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])
@stop