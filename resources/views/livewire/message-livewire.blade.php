<div class="card w-100 mb-5">
    <div class="card-header p-3 chat-header">
       <div class="d-flex align-items-md-baseline">
        @if ($profile_reader->avatar)
           <div>
                <img class="rounded-circle img-thumbnail object-fit-cover profile-avatar-message-size"src="{{ asset('storage/'.$profile_reader->avatar) }}" alt="">
           </div>
        @else
            <div class="no-profile-message img-thumbnail object-fit-cover">
               <b>P</b>
            </div>
        @endif
            <div>
                <b>{{ucwords($user->name)}}</b>
            </div>
       </div>
    </div>

    <div wire:poll.50000ms="getAllMessages" class="card-body chatbox start-scrollbuttom" id="messageBody">
        @if ($AllMessages)
            @foreach ($AllMessages as $message)
                <div class="chat  @if ($message->created_by == $created_by) sender @else reciever @endif">
                    <span class="msg">
                        {{$message->messages}}
                    </span><br>
                    <small>{{$message->created_at->diffForHumans()}}</small>
                </div>
            
                    <div class="files @if ($message->created_by == $created_by) sender-file @else reciever-file @endif">
                        @foreach ($message->getFiles() as $item)
                            <div>
                                @if (pathinfo($message->getPublicImage($item->image), PATHINFO_EXTENSION) == 'pdf')
                                   <a target="_blank" href="{{$message->getPublicImage($item->image)}}}}"><img src="/pdf2.png" alt=""></a>
                                @elseif(pathinfo($message->getPublicImage($item->image), PATHINFO_EXTENSION) == 'docx')
                                    <a target="_blank" href="{{$message->getPublicImage($item->image)}}}}"> <img src="/docx.png" alt=""></a>
                                @else
                                  <a target="_blank" href="{{$message->getPublicImage($item->image)}}"><img src="{{$message->getPublicImage($item->image)}}" alt=""></a>
                                @endif
                                
                            </div>
                       @endforeach
                    </div>
            @endforeach
        @else
            <div class="start-convo">
                <p>Start Converstaion</p>
            </div>
        @endif
    </div>
    <div class="card-footer p-3">
        <form wire:submit.prevent="sendmessage" enctype="multipart/form-data">
           <div class="d-flex justify-content-baseline mb-2">
                <div class="form-group w-100">
                    {{-- <textarea wire:model="message_text" class="form-control" name="message_text" placeholder="message_text" cols="3" rows="3"></textarea> --}}
                    <input wire:model.defer="message_sent" type="text" class="form-control @error('message_sent') is-invalid @enderror message_text" name="message_sent" placeholder="Aa" >
                </div>
                <div class="form-group">
                    <button type="submit" wire:loading.attr="disabled" wire:loading.class="disabledbtn" wire:target="files" class="message_btn">
                        <div wire:loading.remove wire:target="sendmessage">
                            Send
                        </div>
                        <div wire:loading wire:target="sendmessage">
                            Sending...
                        </div>
                    </button>
                </div>
           </div>
           <div class="mb-3">
                <input type="file" wire:model="files" accept="image/png, image/PNG, image/jpeg, image/JPEG, image/jpg, image/JPG" multiple class="form-control p-2">
                {{-- @error('files') <span class="error">{{ $message }}</span> @enderror --}}
            </div>
            <div wire:loading wire:target="files">
                Please Wait Before Sending...
            </div>
        </form>
    </div>
</div>


    <script>
        var messageBody = document.querySelector('#messageBody');
        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight ;

        window.addEventListener('scrollDown', () => {
            var messageBody = document.querySelector('#messageBody');
            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight ;
        });
    </script>
