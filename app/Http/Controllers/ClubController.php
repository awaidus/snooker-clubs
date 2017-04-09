<?php

namespace App\Http\Controllers;

use App\Club;
use App\User;
use Illuminate\Http\Request;
use Sentinel;
use Session;

class ClubController extends Controller
{
    public function index()
    {
        if (Sentinel::inRole('manager')) {

//            $clubs = Club::forManager()->with(['games' => function ($query) {
//                $query->active();
//            }
//                , 'transactions'])->get();

            $club = Club::where('manager_id', Sentinel::getUser()->id)->first();

            session('club_id', $club->id);

            return redirect()->route('showGames', ['club_id' => $club->id]);


        } elseif (Sentinel::inRole('super') || Sentinel::inRole('admin')) {

            $clubs = Club::with(['games', 'transactions'])->get();

        } else {

            return redirect()->route('login')->with(['error' => 'You must be Admin or Manager to access.']);
        }

        return view('club.index', compact('clubs'));
    }

    public function show($id = null)
    {
        $club = (!is_null($id) && $id != -1) ? Club::find($id) : new Club();
        $users = User::all()->pluck('first_name', 'id');

        return view('club.show', compact('club', 'users'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'club_name' => 'required|unique:clubs,club_name,' . $request->id,
            'no_of_tables' => 'required',
        ]);


        $data = $request->all();


        Club::updateOrCreate(['id' => $data['id']], $data);


        return redirect()->route('home')->with(['success' => 'Club saved successfully !']);
    }


}
