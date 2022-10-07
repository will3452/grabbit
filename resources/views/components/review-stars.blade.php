@props(['value' => 0])
<div>
    @for ($i = 0; $i < $value; $i++)
    <img src="/star.png" alt="" style="width: 20px">
    @endfor
</div>
