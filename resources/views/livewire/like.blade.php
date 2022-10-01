<div>
    {{$likes}} <button style="border:none;background: #fff;" wire:click="toggle"> <img style="width: 20px" src="{{$this->isLiked() ? 'https://img.icons8.com/color/48/000000/filled-like.png': '/icons8-love-48.png'}}"/> </button>
</div>
