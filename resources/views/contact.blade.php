<?php
$title = "Contac Us";
$subtitle = "We'd like to hear from you";
?>
@extends('layout')

@section('title',"Contact Us")

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])
@stop