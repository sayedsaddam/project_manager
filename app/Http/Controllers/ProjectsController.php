<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\User;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            // dump(Auth::user()->id);
            $projects =  Project::where('user_id', Auth::user()->id)->get();
            return view('projects.index', compact('projects'));
        }
        return view('auth.login');
    }

    /**
     * Creating a names route to add users to projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function adduser(Request $request){
        $project = Project::find($request->input('project_id'));
        if(Auth::user()->id == $project->user_id){
            $user = User::where('email', $request->input('email'))->first(); // Single record.
            // Check if user is already added to a project.
            $projectUser = ProjectUser::where('user_id', $user->id)->where('project_id', $project->id)->first();
            if($projectUser){
                return redirect()->route('projects.show', ['project' => $project->id])->with('success', $request->input('email'). ' is already a member of the project.');
            }
            if($user && $project){
                $project->users()->attach($user->id);
                return redirect()->route('projects.show', ['project' => $project->id])->with('success', $request->input('email').' was added to project successfully.');
            }
        }
        return redirect()->route('projects.show', ['project' => $project->id])->with('errors', 'Error adding user to project.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        $companies = null;
        if(!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        return view('projects.create', ['company_id' => $company_id, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check if the user is logged in.
        if(Auth::check()){
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),
                'user_id' => Auth::user()->id
            ]);
            if($project){
                return redirect()->route('projects.show', ['Project' => $project->id])->with('success', 'Project has created successfully.');
            }
        }
        return back()->withInput()->with('error', 'Error creating a new Project.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::find($project->id);
        $comments = $project->comments;
        return view('projects.show', compact(['project', 'comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $project = Project::find($project->id);
        return view('projects.edit', compact('Project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // Save data.
        $projectUpdate = Project::where('id', $project->id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        if($projectUpdate){
            return redirect()->route('projects.show', ['Project' => $project->id])->with('success', 'Project has been updated successfully.');
        }
        // Redirect.
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $findProject = Project::find($project->id);
        if($findProject->delete()){
            return redirect()->route('projects.index')->with('success', 'Project has deleted successfully.');
        }
        return back()->withInput()->with('error', 'Project could not be deleted.');
    }
}
