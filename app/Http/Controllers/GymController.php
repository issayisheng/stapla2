<?php

namespace App\Http\Controllers;

use App\Http\Requests\GymStoreRequest;
use App\Models\Gym;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GymController extends Controller
{
    public function index()
    {
        $current_user = Auth::user();
        return view(gym.index);
    }

    public function create()
    {
        $current_user = Auth::user();
        return view('gym.create');
    }

    public function store(GymStoreRequest $request)
    {
        $current_user = Auth::user();

        $gym = new Gym;
        $gym->owner_id            = $current_user->id;
        $gym->name                = $request->gym_name;
        $gym->zip_code            = $request->gym_zipcode;
        $gym->prefecture          = $request->gym_name;
        $gym->city                = $request->gym_name;
        $gym->street              = $request->gym_name;
        $gym->building            = $request->gym_name;
        $gym->tel                 = $request->gym_name;
        if (isset($request->mon_opening)) {
            $gym->mon_opening_started = $request->mon_opening;
        }
        if (isset($request->mon_close)) {
            $gym->mon_opening_ended   = $request->mon_close;
        }
        if (isset($request->tue_opening)) {
            $gym->tue_opening_started = $request->tue_opening;
        }
        if (isset($request->tue_close)) {
            $gym->tue_opening_ended   = $request->tue_close;
        }
        if (isset($request->wed_opening)) {
            $gym->wed_opening_started = $request->wed_opening;
        }
        if (isset($request->wed_close)) {
            $gym->wed_opening_ended   = $request->wed_close;
        }
        if (isset($request->thu_opening)) {
            $gym->thu_opening_started = $request->thu_opening;
        }
        if (isset($request->mon_opening)) {
            $gym->thu_opening_ended   = $request->mon_opening;
        }
        if (isset($request->fri_opening)) {
            $gym->fri_opening_started = $request->fri_opening;
        }
        if (isset($request->fri_close)) {
            $gym->fri_opening_ended   = $request->fri_close;
        }
        if (isset($request->sat_opening)) {
            $gym->sat_opening_started = $request->sat_opening;
        }
        if (isset($request->sat_close)) {
            $gym->sat_opening_ended   = $request->sat_close;
        }
        if (isset($request->sun_opening)) {
            $gym->sun_opening_started = $request->sun_opening;
        }
        if (isset($request->sun_close)) {
            $gym->sun_opening_ended   = $request->sun_close;
        }
        $gym->save();

        // MEMO: ジムを登録したらユーザーのステータスをオーナー(3, 後で定数化)に変更
        $user = User::findOrFail($current_user->id);
        $user-> status = 2;
        $user->save();

        return \redirect()->route('gym.show', ['gym_id' => $gym->id])
                                ->with('done', '「'.$gym->name.'」を新規登録しました。');
    }

    public function show($gym_id)
    {
        // return $gym_id.'show';
        $gym = Gym::FindOrFail($gym_id);
        return view('gym.show', \compact('gym'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
