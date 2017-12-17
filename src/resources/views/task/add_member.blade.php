<div>

<a href="{{ route('taskIndex') }}">List</a>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('message'))
    <li>{{ session()->get('message') }}</li>
@endif
{!! Form::open(['route' => ['taskStoreAddMember',$task->id],'method' => 'post']) !!}

    <table>
        <tr>
            <td>Project</td>
            <td>:</td>
            <td>
                {!! Form::label('project',$task->getProject->name) !!}                
            </td>
        </tr>
        <tr>
            <td>Staf</td>
            <td>:</td>
            <td>
                {!! Form::label('project',$task->getStaf->full_name) !!}                
            </td>
        </tr>
        <tr>
            <td>Member</td>
            <td>:</td>
            <td>
                <select name="member_id">
                    <option value="" selected disabled>-Select Member-</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->getUser->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>Name</td>
            <td>:</td>
            <td>                
                {!! Form::label('name',$task->name) !!}
            </td>
        </tr>
        <tr>
            <td>Start date</td>
            <td>:</td>
            <td>                
                {!! Form::label('start_date',$task->start_date) !!}
            </td>
        </tr>
        <tr>
            <td>End date</td>
            <td>:</td>
            <td>                
                {!! Form::label('end_date',$task->end_date) !!}
            </td>
        </tr>
        <tr>
            <td valign="top">Description</td>
            <td>:</td>
            <td>            
                {!! Form::label('description',$task->description) !!}
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>            
                {!! Form::submit('submit') !!}                
            </td>
        </tr>
    </table>
    
     
{!! Form::close() !!}

</div>