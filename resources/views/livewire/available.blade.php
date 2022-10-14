<div class="card">
    <div class="card-header">Create new post</div>
    <form wire:submit.prevent="stored" class="card-body">
        @csrf
        <div class="form-group mt-3">
            <input wire:model="date" type="text" id="date" class="form-control  @error('date') is-invalid @enderror" onchange="this.dispatchEvent(new InputEvent('input'))" id="date" name="date" placeholder="yy-mm-dd">
            <div class="text-danger mt-1">
                @error('date')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-group mt-3">
            <label for="starttime">Start Time</label>
            <input wire:model="starttime" type="time" class="form-control  @error('starttime') is-invalid @enderror"id="starttime" name="starttime" placeholder="starttime">
            <div class="text-danger mt-1">
                @error('starttime')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-group mt-3">
            <label for="endtime">End Time</label>
            <input wire:model="endtime" type="time" class="form-control  @error('endtime') is-invalid @enderror" id="endtime" name="endtime" placeholder="endtime">
            <div class="text-danger mt-1">
                @error('endtime')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-group mt-4">
            <button  wire:target="stored" type="submit" id="submitdata" class="btn btn-outline-primary w-100 p-2">
                <div wire:loading.remove wire:target="stored">
                    Submit
                </div>
                <div wire:loading wire:target="stored">
                    Processing...
                </div>
            </button>
        </div>
   </form>
    <script src="{{ asset('js/availability.js') }}"></script>
    </div>