<div>
    <a href="{{ route('taskCreate') }}">Tambah data</a>
    <hr>
    @if(session()->has('message'))
        <li>{{ session()->get('message') }}</li>
    @endif
    <table border="1">
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
        @forelse($tasks as $key => $task)
        <tr>
            <td>{{ $key+1 }}</td>
            <td><a href="{{ route('taskShow',$task->id) }}">{{ $task->name }}</a></td>
            <td>{{ $task->getProject->name }}</td>
            <td>{{ $task->getStaf->full_name }}</td>
            <td>{{ $task->total_member }}</td>
            <td>{{ $task->start_date }}</td>
            <td>{{ $task->end_date }}</td>
            <td>{{ $task->description }}</td>
            <td>
                <a href="{{ route('taskAddMember',$task->id) }}">Add member</a>
                <a href="{{ route('commentCreate',$task->id) }}">Comment</a>
                <a href="{{ route('taskEdit',$task->id) }}">Edit</a>
                <a href="{{ route('taskDelete',$task->id) }}">Delete</a>
            </td>            
        </tr>
        @empty
            <tr>
                <td colspan='8' align="center"><b>belum ada data</b></td>
            </tr>
        @endforelse
    </table>

</div>