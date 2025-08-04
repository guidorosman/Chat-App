<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Chats') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your chats') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex h-[550px] text-sm-border rounded-xl shadow overflow-hidden bg-white">
        <!-- Left: User List -->
        <div class="w-1/4 border-r bg-gray-50">
            <div class="p-4 font-bold text-gray-700 border-b">Users</div>
            <div class="divide-y">
                @foreach ($users as $user)
                    <div wire:click="selectUser({{ $user->id }})" class="p-3 cursor-pointer hover:bg-blue-100 transition {{ $selectedUser->id === $user->id ? 'bg-blue-100 font-semibold' : '' }}">
                        <div class="text-gray-800">{{ $user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                    </div>
                @endforeach
                
            </div>
        </div>

        <!-- Right: Chat Section -->
        <div class="w-3/4 flex flex-col">
            <!-- Header -->
            <div class="p-4 border-b bg-gray-50">
                <div class="text-lg font-semibold texxt-gray-800">{{ $selectedUser->name }}</div>
                <div class="text-xs text-gray-500">{{ $selectedUser->email }}</div>
            </div>
            
            <!-- Messages -->
            <div class="flex-1 p-4 overflow-y-auto space-y-2 bg-gray-50">
                @foreach ($messages as $message)
                    <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs px-4 py-2 rounded-2xl shadow {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                            {{ $message->message}}
                        </div>
                    </div>
                @endforeach    
            </div>
            
            <div id="typing-indicator" class="px-4 ph-1 text-xs text-gray-400 italic"></div>

            <!-- Input -->
             <form wire:submit="submit" class="p-4 border-t bg-white flex items-center gap-2">
                <input
                    wire:model.live="newMessage" 
                    type="text"
                    class="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-1"
                    placeholder="Type your message..." />
                    <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-full">
                        Send
                    </button>
             </form>            
        </div>
    </div>

</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('userTyping', (event) => {
            console.log(event);
            window.Echo.private(`chat.${event.selectedUserId}`).whisper("typing", {
                userId: event.userId,
                userName: event.userName
            })
        });

        window.Echo.private(`chat.{{ $loginId }}`).listenForWhisper('typing', (event) => {
            var t = document.getElementById("typing-indicator");
            t.innerText = `${event.userName} is typing...`;

            setTimeout(() => {
                t.innerText = '';
            }, 2000);
        })
    });
</script>
