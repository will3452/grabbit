<div class="card">
    <div class="card-header">Meetup Request Form</div>
    <form wire:submit.prevent="stored" class="card-body" id="create_meetup">
        <div class="form-group">
            <p><b>Post:</b> {{$postid->title}}</p>
        </div>
        <div class="form-group">
            <p><b>Description:</b> {{$postid->descriptions}}</p>
        </div>
        <div class="form-group">
            <p><b>Created:</b> <small>{{$postid->created_at->diffForHumans()}}</small></p>
        </div>
        <div class="form-group">
            <label for="meetup_date">Select Date To Load Available Time</label>
            <input wire:model="meetup_date" name="meetup_date" type="text" id="meetup_date" class="form-control" onchange="this.dispatchEvent(new InputEvent('input'))" placeholder="Y-m-d">
            <div wire:loading wire:target="meetup_date">
                Checking...
            </div>
            <div class="text-danger mt-1">
                @error('meetup_date')
                    {{$message}}
                @enderror
            </div>
            @php
            $dataarray =  json_encode($datelists)
            @endphp
        </div>
         @if ($meetup_date)
            <div class="form-group">
                <label for="time">Available Time</label>
                {{-- <select wire:model="time" class="form-control" name="time" id="time"> //stop here
                        {{$getData->start_time - $getData->end_time}}
                </select> --}}
                <div class="text-danger mt-1">
                    @error('time')
                        {{$message}}
                    @enderror
                </div>
            </div>
        @endif
        <div class="form-group mt-2">
            <label for="remarks">Create Your Remarks</label>
            <textarea  name="remarks" id="remarks" placeholder="Remarks" class="form-control" id="remarks" rows="3"></textarea>
            <div class="text-danger mt-1">
                @error('remarks')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="mt-2 form-group" style="text-align:right !important;">
            <button wire:target="stored" disabled type="submit" class="btn btn-primary metupssbtn">
                <div wire:loading.remove wire:target="stored">
                    Create Meetup
                </div>
                <div wire:loading wire:target="stored">
                    Processing...
                </div>
            </button>
        </div>
    </form>
    <script type="text/javascript">
        let enabledays = <?php echo $dataarray; ?>;
        function enableTheseDays(date){
                let sdate = $.datepicker.formatDate( 'yy-mm-dd', date)
                if($.inArray(sdate, enabledays) != -1){
                    return [true];
                }else{
                    return [false];
                }
        }
        $( function() {
            $("#meetup_date").datepicker({
                dateFormat: "yy-mm-dd",
                beforeShowDay:enableTheseDays
            })
        })
        $("#meetup_date").keypress(function (e) {
            return false;
        });
        $("#date").keydown(function (e) {
            return false;
        });
    </script>
</div>