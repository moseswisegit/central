<?php

namespace App\Http\Controllers\SuperAdmin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        if (! Gate::allows('user_access')) {
            return abort(401);
        }

        $users = User::all();
        $roles = DB::table("roles")->select('id','title')->get();


        $enteteContent = "Utilisateurs";

        return view('superAdmin.users.index', compact('users','roles','enteteContent'));
    }


    public function getUsers(){
        $users = User::all();
 
        return view('superAdmin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('superAdmin.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        $user = User::create($request->all());
        DB::table('uts')->insertGetId([
            'user_id' => $user->id,
            'nom' => $request->name,
            'email' => $request->email, // Assurez-vous de hasher le mot de passe
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('success', 'Insertion effectuée avec succès');


        return redirect()->route('superAdmin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit($id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'roles'));
    }
*/
        public function edit($id)
        {
            if (! Gate::allows('user_edit')) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $roles = \App\Role::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
            $user = User::findOrFail($id);

            // Vous pouvez également inclure d'autres données que vous souhaitez renvoyer à votre requête AJAX
            $data = [
                'user' => $user,
                'roles' => $roles,
            ];

            return response()->json($data);
        }


    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(UpdateUsersRequest $request, $id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->update($request->all());

        session()->flash('success', 'Mise à jour effectuée avec succès');



        return redirect()->route('superAdmin.users.index');
    }


    // public function update(UpdateUsersRequest $request, $id)
    // {
    //     if (!Gate::allows('user_edit')) {
    //         return response()->json(['message' => 'Unauthorized'], 401);
    //     }

    //     $user = User::findOrFail($id);

    //     // Récupérez les données du formulaire
    //     $userData = $request->except('password');

    //     // Vérifiez si le champ du mot de passe est rempli
    //     if (!empty($request->input('password'))) {
    //         // Mettez à jour le mot de passe uniquement s'il est fourni
    //         $userData['password'] = bcrypt($request->input('password'));
    //     }

    //     // Mettez à jour l'utilisateur avec les nouvelles données
    //     $user->update($userData);

    //     // Vous pouvez inclure d'autres données dans la réponse si nécessaire
    //     $data = [
    //         'message' => 'Utilisateur mis à jour avec succès',
    //         'user' => $user,
    //     ];

    //     // Renvoyer une réponse JSON
    //     return response()->json($data);
    // }


    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_view')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$folders = \App\Folder::where('created_by_id', $id)->get();$files = \App\File::where('created_by_id', $id)->get();

        $user = User::findOrFail($id);

        return view('superAdmin.users.show', compact('user', 'folders', 'files'));
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superAdmin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
