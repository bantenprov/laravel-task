<div>

<a href="{{ route('taskIndex') }}">List</a>
<hr>
@if(session()->has('message'))
    <li>{{ session()->get('message') }}</li>
@endif
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
            <td valign='top'>Member</td>
            <td valign='top'>:</td>
            <td>
                <br>
                <ul>
                    @forelse($members as $member)
                        <li>
                        [{{ $member->getMember->getUser->name }}] 
                        <a href="{{ route('taskRemoveMember',[$member->id,$member->member_id]) }}">Remove</a>
                        </li>
                    @empty    
                    <li>-</li>
                    @endforelse
                </ul>
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
        
    </table>
    
     
</div>