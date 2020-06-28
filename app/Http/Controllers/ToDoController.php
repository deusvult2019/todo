<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class ToDoController extends Controller
{

  public function index(Request $request)
  {
     $tasks = $request->user()->task()->orderBy('hotovo','asc')->get();
      return view('home', [
          'tasks' => $tasks,
    ]);
  }
public function vyhladat(Request $request)
{
  $this->validate($request, [
    'search' => 'required|max:255',
]);
 $search = $request->get('search');
 $tasks = $request->user()->task()->where('uloha','like', '%'.$search.'%')->paginate(3);
 
 return view('home', [
  'tasks' => $tasks,
]);
}


  public function vytvor(Request $request)
  {
    $this->validate($request, [
      'uloha' => 'required|max:255',
  ]);

    $request->user()->task()->create([
      'uloha' => $request->uloha,
  ]);

    return redirect()->back();

  }


  public function __construct()
  {
      $this->middleware('auth');
  }

   public function hotovo(Task $task)
   {
    

    $task->update(['hotovo' => true]);
    return redirect()->back();
   }

    
}
