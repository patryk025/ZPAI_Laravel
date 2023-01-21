<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $ticket->title }} (numer zgłoszenia: {{$ticket->id}})
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <style>
          .bubbleWrapper {
            padding: 10px 10px;
            display: flex;
            justify-content: flex-end;
            flex-direction: column;
            align-self: flex-end;
            color: #fff;
          }

          .inlineContainer {
            display: inline-flex;
          }

          .inlineContainer.own {
            flex-direction: row-reverse;
          }

          .ownBubble {
            min-width: 60px;
            max-width: 700px;
            padding: 14px 18px;
            margin: 6px 8px;
            background-color: #5b5377;
            border-radius: 16px 16px 0 16px;
            border: 1px solid #443f56;
          }

          .otherBubble {
            min-width: 60px;
            max-width: 700px;
            padding: 14px 18px;
            margin: 6px 8px;
            background-color: #6C8EA4;
            border-radius: 16px 16px 16px 0;
            border: 1px solid #54788e;
          }

          .own {
            align-self: flex-end;
          }

          .other {
            align-self: flex-start;
          }

          span.own, span.other {
            font-size: 14px;
            color: grey;
          }

          .ticketChat {
            width: 100%;
          }
        </style>
        <div class="ticketChat">
          <div class="ticketChatMessages">
            @foreach ($ticket->ticket_messages()->get() as $message)
              @if($message->message_from == 0)
                <div class="bubbleWrapper">
                  <div class="inlineContainer">
                    <div class="otherBubble other">{{ $message->message }}</div>
                  </div>
                </div>
              @else
                <div class="bubbleWrapper">
                  <div class="inlineContainer own">
                    <div class="ownBubble own">{{ $message->message }}</div>
                  </div>
                </div>
              @endif
            @endforeach
          </div>
          <div class="ticketChatInput">
            <input type="text" id="ticketChatInput">
            <button id="ticketChatSend" onclick="alert('Not implemented')">Wyślij</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>