
<div class="row">
    <div class="col-12 col-md-8 mb-4">
        <div class="card">
            <div class="card-header">Update Post</div>
            <form wire:submit.prevent="updatepost" class="card-body" enctype="multipart/form-data">
                <div class="form-group mt-3">
                    <input wire:model="title" type="text" class="form-control  @error('title') is-invalid @enderror"id="title" name="title" placeholder="Title">
                    <div class="text-danger mt-1">
                        @error('title')
                            {{$message}}
                        @enderror
                        
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="images" class="mt-2 mb-1"><b>Add More Image</b></label>
                    <input wire:model="images" type="file" class="form-control  @error('images') is-invalid @enderror" id="images" name="images" accept="image/png, image/PNG, image/jpeg, image/JPEG, image/jpg, image/JPG" multiple>
                    <div class="text-danger mt-1">
                        @error('images')
                            {{$message}}
                        @enderror
                    </div>
                    <div wire:loading wire:target="images">
                        Please Wait Before Posting...
                    </div>
                </div>

                <div class="form-group mt-3">
                    <textarea wire:model="descriptions" name="descriptions" placeholder="descriptions" class="form-control @error('descriptions') is-invalid @enderror" id="descriptions" rows="3"></textarea>
                    <div class="text-danger mt-1">
                        @error('descriptions')
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" wire:loading.attr="disabled" wire:loading.class="images" class="btn btn-outline-primary w-100 p-2">
                        <div wire:loading.remove wire:target="updatepost">
                            Update
                        </div>
                        <div wire:loading wire:target="updatepost">
                            Updating...
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header">
                Item Status
            </div>
            <form wire:submit.prevent="updatestatus"  class="card-body">
                <div class="form-group mt-3">
                    <p>Status: <b><small>
                        @if ($statuspost)
                            Sold Out
                        @else
                            ----------
                        @endif
                    </small></b></p>
                </div>
                <div class="form-group mt-3">
                    <select wire:model="statuspost" class="form-control  @error('statuspost') is-invalid @enderror"" >
                        <option>Mark List:</option>
                        <option value="sold">Sold Out</option>
                        <option value="not-sold">Not Sold</option>
                      </select>
                      <div class="text-danger mt-1">
                        @error('statuspost')
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button  class="btn btn-outline-primary w-100 p-2">
                        <div wire:loading.remove wire:target="updatestatus">
                            Update
                        </div>
                        <div wire:loading wire:target="updatestatus">
                            Updating...
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="edit-image-list mt-3">
        @foreach($imagepost as $item)
             <div>
                <div>
                    <div class="form-group mt-3">
                        <img src="{{$postdata->getExploadImage($item->image)}}" alt="">
                    </div>
                    <div class="form-group mt-0">
                        <button  wire:click.prevent="deleteimage({{$item->id}})" class="btn btn-danger text-white w-100 p-2">
                            <div wire:target="deleteimage({{$item->id}})">
                                Delete
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  
        <!-- Small modal -->
    <script>
          window.addEventListener('popmessage', event => {
            $(".alert-show").show();
            $(".alert-messages").text('Delete Success')
        })
        window.addEventListener('errormessage', event => {
            $(".alert-show").show();
            $(".alert-messages").text('Please Upload Photo First');
        })
        window.addEventListener('updatesuccess', event => {
            $(".alert-show").show();
            $(".alert-messages").text('Update Successfully');
        })
    </script>
</div>