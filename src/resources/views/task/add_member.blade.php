@extends('layouts/default') 
{{-- Page title --}} 
@section('title') 
{{ $title }} 
@stop {{-- local styles --}} 
@section('header_styles') 
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/css/select2.min.css')}}">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
@stop 
{{-- Page Header--}} 
@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('taskManagementTaskIndex') }}">
                <i class="fa ti-arrow-circle-left"></i> Back
            </a>
        </li>
    </ol>
</section>
@stop {{-- Page content --}} 

@section('content') 

<div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="padding:0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('message'))
    <div class="alert alert-success">
        <ul style="padding:0;">
            <li>{{ session()->get('message') }}</li>
        </ul>
    </div>
@endif
</div>   

<div class="row">    
    <div class="col-lg-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="ti-pencil"></i> Add member to {{ $task->name }}
                </h3>
                <span class="pull-right">
                    <i class="fa fa-fw ti-angle-up clickable"></i>
                </span>
            </div>
            <div class="panel-body">
                {{--  <form action="#" class="form-horizontal">  --}}
                {!! Form::open(['route' => ['taskManagementTaskAddMemberStore',$task->id],'method' => 'post','class' => 'form-horizontal']) !!}  
                    <div class="form-body">
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                Task Name
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw ti-clipboard"></i>
                                    </span>
                                    <input type="text" readonly value="{{ $task->name }}" class="form-control" id="inputUsername2" placeholder="Task Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                Project Name
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw ti-ruler-pencil"></i>
                                    </span>
                                    <input type="text" readonly value="{{ $task->getProject->name }}" class="form-control" id="inputUsername2" placeholder="Task Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                Staf
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw ti-id-badge"></i>
                                    </span>
                                    <input type="text" readonly value="{{ $task->getStaf->full_name }}" class="form-control" id="inputUsername2" placeholder="Task Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                Start date
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw ti-calendar"></i>
                                    </span>
                                    <input type="text" readonly value="{{ $task->start_date }}" class="form-control" id="inputUsername2" placeholder="Task Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                End date
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw ti-calendar"></i>
                                    </span>
                                    <input type="text" readonly value="{{ $task->end_date }}" class="form-control" id="inputUsername2" placeholder="Task Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea readonly id="inputContent1" rows="3"  class="form-control resize_vertical">{{$task->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                Member
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                                <i class="fa fa-fw ti-user"></i>
                                            </span>
                                    <select id="member" name="member_id" class="form-control">
                                        <option value="" selected disabled>-Select Member-</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->getUser->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-sm-offset-3 col-sm-9">
                                {!! Form::submit('submit',['class' => 'btn btn-primary']) !!}
                                &nbsp;
                                <button type="reset" class="btn btn-default bttn_reset">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@stop {{-- local scripts --}} 


@section('footer_scripts') 

<script type="text/javascript" src="{{asset('vendors/select2/js/select2.js')}}"></script>

<script>

$("#member").select2({
    theme: "bootstrap"
});

</script>

@stop
