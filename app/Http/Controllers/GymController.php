<?php

namespace App\Http\Controllers;

use App\Http\Requests\GymStoreRequest;
use App\Models\Gym;
use App\Models\Calendar;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 登録済みのジムを表示
        $user = Auth::user();
        return Gym::where('owner_id', $user->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GymStoreRequest $request)
    {
        $user = Auth::user(); //ログイン中のユーザー

        $gym = new Gym;
        $gym->id                  = $request->id;
        $gym->owner_id            = $user->id;
        $gym->name                = $request->gym_name;
        $gym->zipcode             = $request->gym_zipcode;
        $gym->address             = $request->gym_address;
        $gym->building            = $request->gym_building;
        $gym->tel                 = $request->gym_tel;
        $gym->facility            = $request->gym_facility;

        if ($request->introduction_pic) {
            // MEMO: 紹介画像のS3へのアップロード & アップロードされた画像のpath取得
            $introduction_image = $request->file('introduction_pic');
            $introduction_image_path = Storage::disk('s3')->putFile('/gym/'. $gym->owner_id .'/introduction_pic', $introduction_image, 'public');
            $gym->introduction_pic = $introduction_image_path;
        } else {
            $introduction_image = null;
        }


        if (isset($request->introduction_text)) {
            $gym->introduction_text = $request->introduction_text;
        }
        if (isset($request->mon_open)) {
            $gym->mon_opening_started = $request->mon_open;
        }
        if (isset($request->mon_close)) {
            $gym->mon_opening_ended = $request->mon_close;
        }
        if (isset($request->tue_open)) {
            $gym->tue_opening_started = $request->tue_open;
        }
        if (isset($request->tue_close)) {
            $gym->tue_opening_ended = $request->tue_close;
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
            $gym->thu_opening_ended = $request->thu_close;
        }
        if (isset($request->fri_open)) {
            $gym->fri_opening_started = $request->fri_open;
        }
        if (isset($request->fri_close)) {
            $gym->fri_opening_ended = $request->fri_close;
        }
        if (isset($request->sat_open)) {
            $gym->sat_opening_started = $request->sat_open;
        }
        if (isset($request->sat_close)) {
            $gym->sat_opening_ended = $request->sat_close;
        }
        if (isset($request->sun_open)) {
            $gym->sun_opening_started = $request->sun_open;
        }
        if (isset($request->sun_close)) {
            $gym->sun_opening_ended = $request->sun_close;
        }
        $gym->save();

        // MEMO: ジムを登録したらユーザーステータスをオーナー(No.10)に変更
        $user = User::findOrFail($user->id);
        $user->status = config('consts.user.OWNER');
        $user->save();
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($gym_id)
    {
        return Gym::FindOrFail($gym_id, ['name','introduction_pic']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GymStoreRequest $request, $gym_id)
    {
        $gym = Gym::FindOrFail($gym_id);
        $gym->name              = $request->gym_name;
        $gym->zipcode           = $request->gym_zipcode;
        $gym->address           = $request->gym_address;
        $gym->building          = $request->gym_building;
        $gym->tel               = $request->gym_tel;
        $gym->facility          = $request->gym_facility;
        if ($request->introduction_pic) {
            if (isset($gym->introduction_pic)) {
                \Storage::disk('s3')->delete($gym->introduction_pic);
            }
            // MEMO: 紹介画像のS3へのアップロード & アップロードされた画像のpath取得
            $introduction_image = $request->file('introduction_pic');
            $introduction_image_path = Storage::disk('s3')->putFile('/gym/'. $gym->owner_id .'/introduction_pic', $introduction_image, 'public');
            $gym->introduction_pic = $introduction_image_path;
        }

        
        if (isset($request->introduction_text)) {
            $gym->introduction_text = $request->introduction_text;
        }
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gym = Gym::FindOrFail($id);
        
        // delete_flagを1（閉店済）に変更
        $gym->delete_flag     = 1;
        $gym->save();

        // 削除機能
        Gym::where('id', $id)->delete();
    }


    /**
     *  郵便番号情報取得
     */
    public function getZipInfo(Request $request)
    {
        $url = "https://api.zipaddress.net/?zipcode={$request->zipcode}";
        return file_get_contents($url);
    }
}
