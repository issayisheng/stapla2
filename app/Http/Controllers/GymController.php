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
        $gyms = Gym::where('owner_id', $current_user->id)->get();
        return view('gym.index', \compact('gyms'));
    }

    public function create()
    {
        $current_user = Auth::user();
        return view('gym.create');
    }

    public function store(GymStoreRequest $request)
    {
        $current_user = Auth::user();

        // dd($current_user);

        $gym = new Gym;
        $gym->owner_id            = $current_user->id;
        $gym->name                = $request->gym_name;
        $gym->zip_code            = $request->gym_zipcode;
        $gym->prefecture          = $request->gym_prefecture;
        $gym->city                = $request->gym_city;
        $gym->street              = $request->gym_street;
        $gym->building            = $request->gym_building;
        $gym->tel                 = $request->gym_tel;

        if ($file = $request->gym_image) {
            $fileName = time() . $file->getClientOriginalName(); // アップロードしたファイル名をつけて保存
            $target_path = public_path('public/gym');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }
        $gym->gym_image = $fileName;


        if (isset($request->mon_open)) {
            $gym->mon_opening_started = $request->mon_open;
        }
        if (isset($request->mon_close)) {
            $gym->mon_opening_ended   = $request->mon_close;
        }
        if (isset($request->tue_open)) {
            $gym->tue_opening_started = $request->tue_open;
        }
        if (isset($request->tue_close)) {
            $gym->tue_opening_ended   = $request->tue_close;
        }
        if (isset($request->wed_open)) {
            $gym->wed_opening_started = $request->wed_open;
        }
        if (isset($request->wed_close)) {
            $gym->wed_opening_ended   = $request->wed_close;
        }
        if (isset($request->thu_open)) {
            $gym->thu_opening_started = $request->thu_open;
        }
        if (isset($request->thu_open)) {
            $gym->thu_opening_ended   = $request->thu_close;
        }
        if (isset($request->fri_open)) {
            $gym->fri_opening_started = $request->fri_open;
        }
        if (isset($request->fri_close)) {
            $gym->fri_opening_ended   = $request->fri_close;
        }
        if (isset($request->sat_open)) {
            $gym->sat_opening_started = $request->sat_open;
        }
        if (isset($request->sat_close)) {
            $gym->sat_opening_ended   = $request->sat_close;
        }
        if (isset($request->sun_open)) {
            $gym->sun_opening_started = $request->sun_open;
        }
        if (isset($request->sun_close)) {
            $gym->sun_opening_ended   = $request->sun_close;
        }
        $gym->save();

        // MEMO: ジムを登録したらユーザーのステータスをオーナー(3, 後で定数化)に変更
        $user = User::findOrFail($current_user->id);
        $user-> status = 10;
        $user->save();

        return \redirect()->route('gym.show', ['gym_id' => $gym->id])
                                ->with('done', '「'.$gym->name.'」を新規登録しました。');
    }

    public function show($gym_id)
    {
        $gym = Gym::FindOrFail($gym_id);
        return view('gym.show', \compact('gym'));
    }

    public function edit($gym_id)
    {
        $gym = Gym::FindOrFail($gym_id);
        return \view('gym.edit', \compact('gym'));
    }

    public function update(GymStoreRequest $request, $gym_id)
    {
        $current_user = Auth::user();
        $gym = Gym::FindOrFail($gym_id);
        $gym->name                = $request->gym_name;
        $gym->zip_code            = $request->gym_zipcode;
        $gym->prefecture          = $request->gym_prefecture;
        $gym->city                = $request->gym_city;
        $gym->street              = $request->gym_street;
        $gym->building            = $request->gym_building;
        $gym->tel                 = $request->gym_tel;
        if ($file = $request->gym_image) {
            $fileName = time() . $file->getClientOriginalName(); // アップロードしたファイル名をつけて保存
            $target_path = public_path('public/gym');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }
        $gym->gym_image = $fileName;

        if (isset($request->mon_open)) {
            $gym->mon_opening_started = $request->mon_open;
        }
        if (isset($request->mon_close)) {
            $gym->mon_opening_ended   = $request->mon_close;
        }
        if (isset($request->tue_open)) {
            $gym->tue_opening_started = $request->tue_open;
        }
        if (isset($request->tue_close)) {
            $gym->tue_opening_ended   = $request->tue_close;
        }
        if (isset($request->wed_open)) {
            $gym->wed_opening_started = $request->wed_open;
        }
        if (isset($request->wed_close)) {
            $gym->wed_opening_ended   = $request->wed_close;
        }
        if (isset($request->thu_open)) {
            $gym->thu_opening_started = $request->thu_open;
        }
        if (isset($request->thu_open)) {
            $gym->thu_opening_ended   = $request->thu_close;
        }
        if (isset($request->fri_open)) {
            $gym->fri_opening_started = $request->fri_open;
        }
        if (isset($request->fri_close)) {
            $gym->fri_opening_ended   = $request->fri_close;
        }
        if (isset($request->sat_open)) {
            $gym->sat_opening_started = $request->sat_open;
        }
        if (isset($request->sat_close)) {
            $gym->sat_opening_ended   = $request->sat_close;
        }
        if (isset($request->sun_open)) {
            $gym->sun_opening_started = $request->sun_open;
        }
        if (isset($request->sun_close)) {
            $gym->sun_opening_ended   = $request->sun_close;
        }
        $gym->save();

        return \redirect()->route('gym.show', ['gym_id' => $gym->id])
                                ->with('done', '「'.$gym->name.'」を編集しました。');
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
