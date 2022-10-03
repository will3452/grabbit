<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Report as ReportModel;
use Livewire\Component;
use App\Models\ReportType;
use App\Models\User;

class Report extends Component
{
    public $reportType;

    public $report;

    public $report_Id;

    public $reportDisplayInfo;

    public $report_remarks;

    public $report_list;

    public $status;

    public function mount(){

        $this->reportType = ReportType::all();

        if($this->report == 'post'){

            $this->report_Id = Post::whereId($this->report_Id)->first();

            $this->reportDisplayInfo = $this->report_Id->title;
        }
        elseif($this->report == 'user'){

            $this->report_Id = User::whereId($this->report_Id)->first();

            $this->reportDisplayInfo = $this->report_Id->name;
        }
        // add here if report comment
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,
            [
                'report_remarks' => 'required',
                'report_list' => 'required',
            ]
        );
    }
    public function addReport(){

        $data = $this->validate(
            [
                'report_remarks' => 'required',
                'report_list' => 'required',
            ]
        );

        ReportModel::create([
            'user_id' => auth()->user()->id,
            'reported_id' => $this->report_Id->id,
            'reported_type' => '\\App\\Models\\Report',
            'report' => $data['report_list'],
            'remarks' => $data['report_remarks']
        ]);
        $this->report_remarks = "";

        $this->report_list = "";

        return redirect()->route('post.index')->with('success', 'Report Submitted!');


    }

    public function render()
    {
        return view('livewire.report');
    }
}
