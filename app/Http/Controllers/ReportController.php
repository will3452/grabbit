<?php

namespace App\Http\Controllers;

use App\Models\ReportType;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(Request $request){

        $datas['report_type'] = $request->report_type;
        $datas['report_id'] = $request->report_id;

        // $reportType = ReportType::all();

        return view('report.index', compact('datas'));
    }
}
