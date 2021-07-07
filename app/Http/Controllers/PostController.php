<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Enroll;
use App\Models\statement;
use App\Models\StepForm;
use App\Models\StepFormdts;
use App\Models\StepFormmd;
use DateTime;
use Illuminate\Http\Request;
//use App\Http\Controllers\DB;
use DB;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index(Request $request)
    {
//        $ads = DB::select('select `stepforms`.*,
//        (select `imageName` from `stepforms_media`
//        where `stepform_id` = stepforms.id and `target` = "pjimg" limit 1)
//        as `pjimg` from `stepforms`
//        where `status` = 5
//        order by `status`');

        $ads = DB::table('vw_showprojectsum')
            ->where( 'status' ,'=','5')
            ->get();
        $now = date_format(new DateTime(), "Y-m-d");
//
//        $stepforms = DB::select('select `stepforms`.*,
//        (select `imageName` from `stepforms_media`
//        where `stepform_id` = stepforms.id and `target` = "pjimg" limit 1)
//        as `pjimg` from `stepforms`
//        where (`status` = 2 OR `status` = 4 OR `status` = 3 OR `status` = 5)
//        and "'.$now.'" < `endat`
//        order by `status` asc limit 12 offset 0');

        $vwshows= DB::table('vw_showprojectsum')
            ->where( 'status' ,'<>','1')
            ->orderBy('status')
            ->get();

        // find enroll
        $enroll = new Enroll();
        $encount = $enroll->where('user_id', '=', Auth::id())->get()->count();

        $enrolled = false;
        if ($encount > 0) {
            $enrolled = true;
        }

        $request->session()->put("enrolled", $enrolled);

        return view('home', [
//            'stepforms'=>$stepforms,
            'ads'=>$ads,
            'vwshows' => $vwshows,
            'cate' => StepFormController::CATE
        ]);
    }

    public function show($id){
        $stepforms = DB::select('select sf.*, rp.id AS report_id from stepforms AS sf
        LEFT JOIN report AS rp ON sf.id = rp.project_id where sf.id=?',[$id, $id]);

        $gallery = DB::table('stepforms_media')
        ->where('stepform_id', $id)
        ->where('target', 'pjimg')
        ->get();

        $plan = DB::select('select * from `stepforms_details` where `stepform_id` = ?', [$id]);

        $statement = new statement();
        $stt = $statement
        ->join('sf_withdraw', 'statement.id', '=', 'sf_withdraw.withdraw_id')
        ->where('statement.stepforms_id', '=', $id)
        ->where('type', '=', '0')
        ->get();

        $cmnt = [];
        for ($i = 0;$i < count($stt);$i++) {
            $comment = new comment();
            $cmnt[$stt[$i]->id] = $comment
            ->join('users', 'users.id', '=', 'comment.user_id')
            ->where('statement_id', '=', $stt[$i]->id)->get();
        }

        $vwshows = DB::table('vw_showprojectsum')->where('id', $id)->get();

//        $qrcode = new Generator;
//        $dat2 = $qrcode->size(200)->generate(DB::table('vw_showprojectsum')
//            ->where('id', $id)
//            ->get());


        return view('show',[
            'stepforms'=>$stepforms,
            'plan' => $plan,
            'gallery' => $gallery,
            'statement' => $stt,
            'vwshows' => $vwshows,
            'comment' => $cmnt,
//            'dat2' => $dat2
            ]);
    }
}
