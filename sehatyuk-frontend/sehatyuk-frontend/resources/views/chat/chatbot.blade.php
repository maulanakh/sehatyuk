@extends('layouts.layout')

@section('title', 'Chatbot SehatYuk')

@section('content')
    <div class="card shadow-sm" style="height: 82vh; display: flex; flex-direction: column;">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-robot me-2"></i>Chatbot SehatYuk</h5>
        </div>

        {{-- Area obrolan --}}
        <div id="chatbox" class="card-body overflow-auto" style="flex-grow: 1; background-color: #f8f9fa;">
            <div id="messages" class="d-flex flex-column gap-2"></div>
        </div>

        {{-- Input pesan --}}
        <div class="card-footer bg-white">
            <form id="chat-form" class="d-flex">
                <input type="text" id="user-input" class="form-control me-2" placeholder="Ketik pertanyaanmu..."
                    required>
                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Tambahkan marked.js -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <script>
        const form = document.getElementById('chat-form');
        const input = document.getElementById('user-input');
        const messages = document.getElementById('messages');
        // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const question = input.value.trim();
            if (!question) return;

            // Tampilkan pesan user
            addMessage(question, 'user');
            input.value = '';
            input.focus();

            // Tampilkan indikator mengetik
            const loadingMsg = addMessage('', 'bot', true);
            let dotCount = 0;
            const loadingInterval = setInterval(() => {
                dotCount = (dotCount + 1) % 4;
                loadingMsg.innerHTML = `<em>Mengetik${'.'.repeat(dotCount)}</em>`;
            }, 500);

            try {
                const response = await fetch('{{ route('chatbot.ask') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        question: question
                    }),
                    credentials: 'same-origin' // <<< ini penting

                });

                const data = await response.json();
                clearInterval(loadingInterval);
                loadingMsg.remove();
                addMessage(data.answer || "Maaf, tidak bisa menjawab saat ini.", 'bot');
            } catch (error) {
                loadingMsg.remove();
                addMessage("Gagal menghubungi server.", 'bot');
                console.error(error);
            }
        });

        function addMessage(text, sender, isLoading = false) {
            const div = document.createElement('div');
            div.classList.add('p-2', 'rounded', 'border');

            if (sender === 'user') {
                div.classList.add('bg-primary', 'text-white', 'align-self-end');
                div.innerText = text;
            } else {
                div.classList.add('bg-light', 'text-dark', 'align-self-start');
                div.innerHTML = isLoading ? '<em>Mengetik...</em>' : marked.parse(text);
            }

            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
            return div;
        }
    </script>
@endsection
