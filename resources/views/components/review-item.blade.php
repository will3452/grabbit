@props(['review'])
<li class="list-group-item">
    <div class="d-flex justify-content-between">
        <div>
            <img src="{{ asset('storage/'.$review->reviewer->profile->avatar) }}" alt="" class="border rounded-circle" style="width: 30px; height: 30px">
            <span>{{$review->reviewer->name}}</span>
        </div>
        <div class="text-secondary" style="font-size: 10px">
            {{$review->created_at->diffForHumans()}}
        </div>
    </div>
    <div style="font-size:12px">
        {{$review->remarks}}
    </div>
    <x-review-stars :value="$review->star"></x-review-stars>
</li>
