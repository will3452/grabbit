<div>
    <div class="d-flex" style="justify-content: space-between;">
        <h6>
            Comments
            @if (count($comments))
                <div class="badge bg-primary">{{count($comments)}}</div>
            @endif
        </h6>
        <div>
            <button class="btn btn-sm" wire:click="toggleComment">
                view comments
            </button>
        </div>
    </div>
    @if ($viewComments)
    <div>
        @foreach ($comments as $comment)
            <div class="card card-body my-2">
                <div class="d-flex" style="justify-content: space-between;">
                    <div>
                        {{$comment->user->name}}
                    </div>
                    <div style="font-size: 12px;">
                        {{$comment->created_at->diffForHumans()}}
                    </div>
                </div>
                <div style="padding-left: 10px;font-family:serif;" class="text-xs">
                    > {{$comment->value}}
                </div>
            </div>
        @endforeach
    </div>
    @endif
    <form wire:submit.prevent="addComment" class="mt-4">
        <textarea wire:model="comment" name="value" placeholder="Aa" max="100" max-length="100" class="form-control"></textarea>
        <div style="text-align:right !important;" class="text-right mt-2">
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
    </form>
</div>
