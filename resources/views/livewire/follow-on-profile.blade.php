<div class="text-center mt-2">
   @if (! $isFollowed)
    <button class="btn btn-primary" wire:click="toggleFollow">
        FOLLOW
    </button>
    @else
    <button class="btn btn-secondary" wire:click="toggleFollow">
        UNFOLLOW
    </button>
   @endif

</div>
