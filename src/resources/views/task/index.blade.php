
@extends('layouts/default') 
{{-- Page title --}} 
@section('title') 
{{ $title }} 
@stop {{-- local styles --}} 
@section('header_styles') 
@stop 
{{-- Page Header--}} 
@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li class="active">
            Task
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
        <a href="{{ route('taskManagementTaskCreate') }}" class="btn btn-sm btn-primary">
            <i class="fa fa-fw fa-plus"></i>
            Add new task
        </a>
    </div>
</div>
<br><br>
<div class="row">    
    <div class="col-lg-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="ti-list"></i> Task List
                </h3>
                <span class="pull-right">
                    <i class="fa fa-fw ti-angle-up clickable"></i>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Project</th>
                                <th>Staf</th>            
                                <th>Total Member</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tasks as $key => $task)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><a href="{{ route('taskManagementTaskShow',$task->id) }}">{{ $task->name }}</a></td>
                                <td>{{ $task->getProject->name }}</td>
                                <td>{{ $task->getStaf->full_name }}</td>
                                <td>{{ $task->total_member }}</td>
                                <td>{{ $task->start_date }}</td>
                                <td>{{ $task->end_date }}</td>
                                <td>{{ $task->description }}</td>
                                <td width="120px">
                                    <a class="btn btn-success btn-xs" href="{{ route('taskManagementTaskAddMember',$task->id) }}" data-toggle="modal" data-placement="top"><span class="fa fa-fw ti-user"></span></a>
                                    <a class="btn btn-primary btn-xs" href="{{ route('taskManagementTaskCommentCreate',$task->id) }}" data-toggle="modal" data-placement="top"><span class="fa fa-fw ti-comment-alt"></span></a>
                                    <a class="btn btn-danger btn-xs" href="{{ route('taskManagementTaskDestroy',$task->id) }}" data-toggle="modal" data-placement="top"><span class="fa fa-fw fa-times"></span></a>  
                                </td>            
                            </tr>
                            @empty
                                <tr>
                                    <td colspan='8' align="center"><b>belum ada data</b></td>
                                </tr>
                            @endforelse                           
                        </tbody>
                    </table>
                </div>
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>

@stop {{-- local scripts --}} 


@section('footer_scripts') @stop
