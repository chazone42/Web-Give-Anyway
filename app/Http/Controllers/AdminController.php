<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Enroll;
use App\Models\statement;
use App\Models\StepForm;
use App\Models\StepFormdts;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    const OP_REPORT = [
        1 => "เนื้อโครงการนี้ไม่เหมาะสม",
        2 => "เนื้อหาโครงการนี้ไม่ใช่ของจริง",
        3 => "เนื้อโครงการนี้ไม่สมเหตุสมผล",
        4 => "หลักฐานที่แนบมาไม่ใช่ของจริง"
    ];
    const OP_STATUS = [
        1 => "รออนุมัติ",
        2 => "อนุมัติ",
        3 => "ระงับการใช้งาน"
    ];
    const ReportAction = [
        1 => "รอตรวจสอบ",
        2 => "ตรวจสอบแล้ว ให้ดำเนินการต่อ",
        3 => "อยู่ในระหว่างดำเนินการตรวจสอบ",
        4 => "ตรวจสอบแล้ว ไม่ให้ดำเนินการต่อ",
    ];
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vw_shows = DB::table('vw_showprojectsum')
            ->where( 'status' ,'<>','1')
            ->orderBy('status')
            ->get();
//
        return view('admin', [
            'vw_shows'=>$vw_shows]);
    }

    public function status(Request $request, $id){
        $data = User::find($id);

        if($data->status ==0){
            $data->status=1;
        }else{
            $data->status=0;
        }
        $data->save();

        return Redirect::to('admin')->with('message', $data->name. 'OK');

    }

    public function showReport(Request $request)
    {
        $report = DB::select('SELECT *, (SELECT imageName FROM stepforms_media
        WHERE stepform_id = sf.id AND target = "eviimg") AS eviimg, rp.id as report_id FROM stepforms AS sf
        JOIN report AS rp ON rp.project_id = sf.id');

        return view('report')
        ->with('reports', $report)
        ->with('op_report', self::OP_REPORT)
        ->with('action', self::ReportAction);
    }
    public function confirm_report(Request $request)
    {
        if ($request->input('status') == 2) {
            $report = DB::table('report')->where('project_id', '=', $request->input('project_id'))->get();
            DB::table('stepforms')->where('id', $report[0]->project_id)->update(['status' => $request->input('status')]);
            DB::delete('delete from report where project_id=?', [$request->input('project_id')]);
        } else if ($request->input('status') == 3) {
            $report = DB::table('report')->where('project_id', '=', $request->input('project_id'))->get();
            DB::table('stepforms')->where('id', $report[0]->project_id)->update(['status' => $request->input('status')]);
        }  else if ($request->input('status') == 4) {
            $report = DB::table('report')->where('project_id', '=', $request->input('project_id'))->get();
            DB::table('stepforms')->where('id', $report[0]->project_id)->update(['status' => $request->input('status')]);
            DB::delete('delete from report where project_id=?', [$request->input('project_id')]);
        }  else {
            $report = DB::table('report')->where('project_id', '=', $request->input('project_id'))->get();
            DB::table('stepforms')->where('id', $report[0]->project_id)->update(['status' => $request->input('status')]);
            DB::delete('delete from report where project_id=?', [$request->input('project_id')]);
        }

        return redirect('admin/report');
    }
    public function confirm()
    {
        $projects = DB::select('SELECT *, (SELECT imageName FROM stepforms_media
        WHERE stepform_id = sf.id AND target = "acimg") AS acimg FROM stepforms AS sf
        WHERE sf.status = 1');

//        if($projects){
//            $red = view('adminConfirm')->with('projects', $projects)->with('op_status', self::OP_STATUS)->with('toast_success','แก้ไขเรียบร้อย');
//        }
//        return $red;
        return view('adminConfirm')->with('projects', $projects)->with('op_status', self::OP_STATUS);
    }
    public function projectAutherize(Request $request)
    {
        $update = DB::table('stepforms')->where('id', $request->get('id'))
        ->update(['status' => $request->input('status')]);

        return redirect('admin/confirm_stepform');
    }
    public function comment_report(Request $request)
    {
        $statement = new statement();
        $stt = $statement
        ->join('stepforms', 'stepforms.id', '=', 'statement.stepforms_id')
        ->join('sf_withdraw', 'statement.id', '=', 'sf_withdraw.withdraw_id')
        ->where('type', '=', '0')
        ->get();

        $cmnt = [];
        for ($i = 0;$i < count($stt);$i++) {
            $comment = new comment();
            $cmnt[$stt[$i]->id] = $comment
            ->join('users', 'users.id', '=', 'comment.user_id')
            ->where('statement_id', '=', $stt[$i]->id)->get();
        }

        return view('adminComment', ['statement'=>$stt, 'comment'=>$cmnt, 'op_report'=>SELF::OP_STATUS]);
    }
    function updatestatus(Request $request)
    {
        $post = $request->all();

        DB::table('stepforms')
        ->where('id', '=', $post['stepforms_id'])
        ->update(['status'=>$post['status']]);

        return response(['update'=>true]);
    }
    public function showEdit($id){

//        return StepForm::find($id);
        $post = StepForm::find($id);
        return view('edit',['post'=>$post]);

    }
    public function update(Request $request){

        $post = StepForm::find($request->id);
        $post->projectname=$request->projectname;
        $post->detail = $request->detail;
        $post->object = $request->object;
        $post->startat = $request->startat;
        $post->endat = $request->endat;
        $post->tel = $request->tel;
        $post->email = $request->email;
        $post->cate = $request->cate;
        $post->namebank = $request->namebank;
        $post->numberbank = $request->numberbank;
        $post->bank = $request->bank;
        $post->branch = $request->branch;
        $post->save();

        if($post){
            $red = redirect('admin')->with('toast_success','แก้ไขเรียบร้อย');
        }
        return $red;

    }
//    public function statuspost(Request $request, $id){
//        $data = Enroll::find($id);
//
//        if($data->status ==0){
//            $data->status=1;
//        }else{
//            $data->status=0;
//        }
//        $data->save();
//
//        return Redirect::to('admin')->with('message', $data->firstname. 'OK');
//    }
}
