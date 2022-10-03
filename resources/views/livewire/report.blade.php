<div class="card">
    <div class="card-header">Report Form</div>
    <form wire:submit.prevent="addReport" class="card-body" id="create_meetup">
        <div class="form-group">
            <p><b>Report: </b> {{$reportDisplayInfo}}</p>
        </div>
        <div class="form-group">
            <p><b>Report Type: </b> {{ucwords($report)}}</p>
        </div>
        <div class="form-group mt-2">
            <select wire:model="report_list" name="report_list" class="form-control @error('report_list') is-invalid @enderror" id="report_list">
                <option value="">Report List</option>
                @foreach ($reportType as $item)
                    <option value="{{$item->name}}">{{$item->name}}</option>
                @endforeach
            </select>
            <div class="text-danger mt-1">
                @error('report_list')
                    {{$message}}
                @enderror
                
            </div>
        </div>
        <div class="form-group mt-2">
            <textarea wire:model="report_remarks" name="report_remarks" id="report_remarks" placeholder="Remarks" class="form-control  @error('report_remarks') is-invalid @enderror" id="remarks" rows="3"></textarea>
            <div class="text-danger mt-1">
                @error('report_remarks')
                    {{$message}}
                @enderror
                
            </div>
        </div>

        <div class="mt-2 form-group mt-3" style="text-align:right !important;">
            <button type="submit" class="message_btn">
                <div wire:loading.remove wire:target="addReport">
                    Submit Report
                </div>
                <div wire:loading wire:target="addReport">
                    Processing...
                </div>
            </button>
        </div>
    </form>
</div>
