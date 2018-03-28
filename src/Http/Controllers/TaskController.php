<?php namespace Bantenprov\Task\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\Task\Facades\Task;
use Bantenprov\Task\Models\Task as TaskModel;
use Bantenprov\Project\Models\Project;
use Bantenprov\Staf\Models\Staf;
use Bantenprov\Member\Models\Member;

use Validator;
/**
 * The TaskController class.
 *
 * @package Bantenprov\Task
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class TaskController extends Controller
{
    protected $taskModel;
    protected $projectModel;
    protected $stafModel;
    protected $memberModel;
    protected $commentModel;
    

    public function __construct()
    {
        $this->taskModel = new TaskModel;
        $this->projectModel = new Project;
        $this->stafModel = new Staf;
        $this->memberModel = new Member;
    }

    public function index()
    {
        $tasks = $this->taskModel->whereNull('member_id')->paginate();                        

        foreach($tasks as $task)
        {
            $total = $this->taskModel->whereNotNull('member_id')->where('parrent_id',$task->id)->count();
            
            array_set($task,'total_member',$total);
        }        
                        
        return $tasks;
    }

    public function create()
    {       

        $projects = $this->projectModel->all();
        $stafs = $this->stafModel->all();
                
        return $projects;
        
    }

    public function store($req)
    {
        //dd($req->all);
        $validator = Validator::make($req, [
            'project_id' => 'required',          
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('taskCreate')
            ->withErrors($validator)
            ->withInput();
        }
        

        $store = $req;
        
        array_set($store,'staf_id',$this->projectModel->find($req['project_id'])->staf_id);      
        
        $this->taskModel->create($store);

        return redirect()->back()->with('message','Success add data');
    }

    public function addMember($task_id)
    {
        $members = $this->memberModel->all();
        $task =  $this->taskModel->find($task_id);        

        $response = (object) ['task' => $task,'members' => $members];
        return $response;
    }

    public function storeAddMember($task_id,$req)
    {
        
        // $a = $req;
        // dd($req->member_id);
        $validator = Validator::make($req, [
            'member_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $task =  $this->taskModel->find($task_id);
                

        if($this->taskModel->where('member_id',$req['member_id'])->where('project_id',$task->project_id)->count() > 0){
            return redirect()->back()->withErrors('This Member Allready Project');
        }

        
        
        $this->taskModel->create([
            'name' => $task->name,
            'project_id' => $task->project_id,
            'staf_id' => $task->staf_id,
            'member_id' => $req['member_id'],
            'start_date' => $task->start_date,
            'end_date' => $task->end_date,
            'description' => $task->description,
            'parrent_id' => $task->id
        ]);

        return redirect()->back()->with('message','Success add member to '.$task->name);
    }

    public function show($id)
    {        
        $task =  $this->taskModel->find($id);
        $members = $this->taskModel->whereNotNull('member_id')->where('parrent_id',$task->id)->get();

        $response = (object) ['task' => $task,'members' => $members];
        return $response;
        
    }

    public function removeMember($task_id,$member_id)
    {
        $task =  $this->taskModel->where('id',$task_id)->where('member_id',$member_id)->delete();

        return redirect()->back()->with('message','Success remove member');
    }

    public function edit($id)
    {
        return "
            <a href=".route('taskIndex').">Back</a>
        ";
    }

    public function update(Request $req, $id)
    {

    }

    public function destroy($id)
    {
        $this->taskModel->find($id)->delete();
        return redirect()->back();
    }

    public function countTask()
    {
        $result = $this->taskModel->whereNull('member_id')->count();

        return $result;
    }

    public function demo()
    {
        return Task::welcome();
    }
}
