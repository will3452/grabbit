
<div class="card">
    <div class="card-header">Create new post</div>
    <form wire:submit.prevent="stored" class="card-body"  enctype="multipart/form-data">
        <div class="form-group mt-3">
            <input wire:model="title" type="text" class="form-control  @error('title') is-invalid @enderror"id="title" name="title" placeholder="Title">
            <div class="text-danger mt-1">
                @error('title')
                    {{$message}}
                @enderror
                
            </div>
        </div>

        <div class="form-group mt-3">
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
                <div wire:loading.remove wire:target="stored">
                    Post
                </div>
                <div wire:loading wire:target="stored">
                    Processing...
                </div>
            </button>
        </div>
   </form>
</div>