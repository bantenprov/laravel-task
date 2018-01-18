@extends('layouts/default') 
{{-- Page title --}} 
@section('title') 
{{ $title }} 
@stop 
{{-- local styles --}} 
@section('header_styles') 
<link href="{{asset('css/alertmessage.css')}}" rel="stylesheet">

<style>

*:before, *:after {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.clearfix {
  clear:both;
}

.text-center {text-align:center;}

pre {
    display: block;
    padding: 9.5px;
    margin: 0 0 10px;
    font-size: 13px;
    line-height: 1.42857143;
    color: #333;
    word-break: break-all;
    word-wrap: break-word;
    background-color: #F5F5F5;
    border: 1px solid #CCC;
    border-radius: 4px;
}


.success-box {
  margin:50px 0;
  padding:10px 10px;
  border:1px solid #eee;
  background:#f9f9f9;
}

.success-box img {
  margin-right:10px;
  display:inline-block;
  vertical-align:top;
}

.success-box > div {
  vertical-align:top;
  display:inline-block;
  color:#888;
}



/* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
  
}

/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
  font-size:1.5em; /* Change the size of the stars */
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
  color:#FFCC36;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
}
.start_c{
    color:#FF912C;
}

</style>

@stop {{-- Page Header--}} 


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
    <div class="col-sm-12 col-md-8">    
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="ti-notepad"></i> {{ $title }} Detail
                </h3>
            </div>
            <div class="panel-body">
                <p><b>Task Name</b> : {{ $task->name }}</p>
                <p><b>Project</b> : {{ $task->getProject->name }}</p>
                <p><b>Staf</b> : {{ $task->getStaf->full_name }}</p>
                <p><b>Start date</b> : {{ $task->start_date }}</p>
                <p><b>End date</b> : {{ $task->end_date }}</p>
                <p><b>Duration :</b> {{ $duration->days }} day</p>
                <p><b>Description :</b></p>
                <p>{{ $task->description }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="ti-user"></i> Members
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
                                <th>Member</th>
                                <th>Action</th>                            
                            </tr>
                        </thead>
                        <tbody>                        
                            @forelse($members as $key => $member)
                            <tr>
                                <td width="50px">{{ $key+1 }}</td>
                                <td>
                                    {{ $member->getMember->getUser->name }}                            
                                </td>
                                <td width="50px">                            
                                    <a class="btn btn-danger btn-xs" href="{{ route('taskManagementTaskRemoveMember',[$member->id,$member->member_id]) }}" data-toggle="modal" data-placement="top"><span class="fa fa-fw fa-times"></span></a>
                                </td> 
                            </tr>                           
                            @empty    
                            <tr>
                                <td colspan='3' align="center"><b>belum ada data</b></td>
                            </tr>
                            @endforelse                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
     <h3>Comments : <span>{{ $countComment }} comment</span> </h3>
     
 </div>

 <br>
</div>

<div class="row">
    @forelse($task->getComment as $comment)
    <div class="col-sm-12 col-md-12">    
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title clearfix" id="{{ $comment->id }}">
                    <span class="pull-left">
                        <i class="ti-comment-alt"></i> &nbsp; {{ $comment->title }}
                    </span>
                    
                    <span class="text-nowrap">
                        <span class="pull-right">
                            <a class="btn btn-xs btn-primary pull-right" onclick="copyToClipboard($(this))" link="{{ route('taskManagementTaskShow',$task->id) }}#{{ $comment->id }}"><i class="ti-link"></i> Copy link</a> 
                        </span>   
                        <span class="comment-id pull-right" ></span>
                    </span>
                </h3>
            </div>
            <div class="panel-body">
                <i class="ti-user"></i> <b>{{ $comment->getUser->name }}</b> - {{ $comment->created_at }}
                
                @if($comment->user_id == $user_id || $comment->comment_rating->where('user_id',$user_id)->count() > 0)
                <section class='rating-widget pull-right'>
                  
                    <!-- Rating Stars Box -->
                    <div class='rating-stars' style="pointer-events:none">
                        <ul id='stars' cmid="{{ $comment->id }}">
                            @for($i = 0;$i < $comment->comment_rating->where('user_id',$user_id)->first()['rating'];$i++)
                            <li class='star selected' title='Poor' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            @endfor                   
                        </ul>
                    </div>
                </section> 
                @else
                <section class='rating-widget pull-right'>
                  
                    <!-- Rating Stars Box -->
                    <div class='rating-stars' >
                        <ul id='stars' cmid="{{ $comment->id }}">
                            <li class='star' title='Poor' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Fair' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Good' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Excellent' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='WOW!!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                        </ul>
                    </div>
                </section> 
                @endif
                <p>{{ $comment->comment_rating->sum('rating') }} <i class='start_c fa fa-star fa-fw'></i></p>
                <div class="alert-message alert-message-default">
                    <p>{{ $comment->comment }}</p> 
                </div>   
                
            </div>
        </div>
    </div>
    @empty
    <div class="col-sm-12 col-md-12">    
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="ti-comment-alt"></i> Comments
                </h3>
            </div>
            <div class="panel-body">
                No comment            
            </div>
        </div>
    </div>
    @endforelse
    <div class="col-lg-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="ti-pencil"></i> Form send comment
                </h3>
                <span class="pull-right">
                    <i class="fa fa-fw ti-angle-up clickable"></i>
                </span>
            </div>
            <div class="panel-body">
                {{--  <form action="#" class="form-horizontal">  --}}
                    {!! Form::open(['route' => ['taskManagementTaskCommentStore',$task->id],'method' => 'post','class' => 'form-horizontal','files'=>'true']) !!}  
                    <div class="form-body">                        
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                Task Name
                            </label>
                            <label for="inputUsername1" class=" control-label">
                                <b>{{ $task->name }}</b>
                            </label>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                Title Name
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw ti-pencil"></i>
                                    </span>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="inputUsername2" placeholder="Title">
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="" class="col-sm-3 control-label">Comment</label>
                            <div class="col-sm-9">
                                <textarea name="comment" id="inputContent1" rows="3"  class="form-control resize_vertical">{{ old('comment') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                URL
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw ti-link"></i>
                                    </span>
                                    <input type="text" name="url" value="{{ old('url') }}" class="form-control" id="inputUsername2" placeholder="ex : http://example.com">
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-10">
                            <label for="inputUsername1" class="col-sm-3 control-label">
                                File
                            </label>
                            <div class="col-sm-9">
                                {{-- <label class="control-label">
                                    Select File
                                </label>
                                <input name="file" type="file"> --}}
                                <label class="custom-file">
                                  <input type="file" id="file2" name="file" class="custom-file-input">
                                  <span class="custom-file-control"></span>
                              </label>

                              <p id="filename" class="help-block"></p>
                              {{--  {!! Form::file('file') !!}  --}}
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



<script>    

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).attr('link')).select();
        document.execCommand('copy');
        $temp.remove();
    }

    $(document).ready(function(){
      
        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
            
            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });
            
        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
            });
        });
        
        
        /* 2. Action to perform on click */
        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');
            //console.log($(this).parent());
            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }
            
            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }
            
            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
                val = ratingValue;  
                cmdi = $(this).parent().attr('cmid') ;
                $(this).parent().css('pointer-events','none');
            }
            else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                val = ratingValue;  
                cmdi = $(this).parent().attr('cmid') ;
                $(this).parent().css('pointer-events','none');
            }
            //console.log(cmdi);
            var url = '{{ route('ajaxTest',[':id',':cmid']) }}';
            var replace_url = url.replace(':id',val);
            var storeUrl = replace_url.replace(':cmid',cmdi);
            console.log(storeUrl);
            $.ajax({
                type: "get",
                url: storeUrl,
                data: "text",
                dataType: "json",
                success: function (response) {
                    console.log(response.msgs);
                    window.location.reload();
                }
            });
        });
        
        
    });

    $("#file2").change(function(){
        var filename = $("#file2").val();
        $("#filename").html(filename);


    });


    function responseMessage(msg) {
        $('.success-box').fadeIn(200);  
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }

</script>

@stop

