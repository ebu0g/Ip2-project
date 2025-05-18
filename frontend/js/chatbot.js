document.addEventListener('DOMContentLoaded', () => {
    const chatHistory = document.getElementById('chat-history');
    const chatForm = document.getElementById('chat-form');
    const userMessageInput = document.getElementById('user-message');
    const fileInput = document.getElementById('file-input');
    const clearHistoryButton = document.getElementById('clear-history');

    // Handle form submission
    chatForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const userMessage = userMessageInput.value.trim();
        const file = fileInput.files[0];

        if (!userMessage && !file) {
            alert('Please enter a message or upload an image.');
            return;
        }

        // Add user message to chat history
        if (userMessage) {
            const userMessageDiv = document.createElement('div');
            userMessageDiv.className = 'user-message bg-green-100 text-green-800 p-3 rounded-lg self-end max-w-xs';
            userMessageDiv.textContent = userMessage;
            chatHistory.appendChild(userMessageDiv);
        }

        // Add uploaded image to chat history
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const imgDiv = document.createElement('div');
                imgDiv.className = 'user-message self-end max-w-xs';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Uploaded Image';
                img.className = 'rounded-lg shadow-md';
                imgDiv.appendChild(img);
                chatHistory.appendChild(imgDiv);
                chatHistory.scrollTop = chatHistory.scrollHeight;
            };
            reader.readAsDataURL(file);
        }

        // Scroll to the bottom of the chat history
        chatHistory.scrollTop = chatHistory.scrollHeight;

        // Prepare form data for submission
        const formData = new FormData();
        formData.append('user_message', userMessage);
        if (file) {
            formData.append('file', file);
        }

        fetch('/backend/api/google-gemini.php', {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'assistant-message bg-red-100 text-red-800 p-3 rounded-lg self-start max-w-xs';
                    errorDiv.textContent = data.error;
                    chatHistory.appendChild(errorDiv);
                } else if (data.type === 'text') {
                    const assistantMessageDiv = document.createElement('div');
                    assistantMessageDiv.className = 'assistant-message bg-gray-100 text-gray-800 p-3 rounded-lg self-start max-w-xs';
                    assistantMessageDiv.textContent = data.content;
                    chatHistory.appendChild(assistantMessageDiv);
                } else if (data.type === 'image') {
                    data.content.forEach((url) => {
                        const imgDiv = document.createElement('div');
                        imgDiv.className = 'assistant-message self-start max-w-xs';
                        const img = document.createElement('img');
                        img.src = url;
                        img.alt = 'Generated Image';
                        img.className = 'rounded-lg shadow-md';
                        imgDiv.appendChild(img);
                        chatHistory.appendChild(imgDiv);
                    });
                }
                chatHistory.scrollTop = chatHistory.scrollHeight;
            })
            .catch((error) => {
                console.error('Error:', error);
            });

        // Clear input fields
        userMessageInput.value = '';
        fileInput.value = '';
    });

    // Handle clear history
    clearHistoryButton.addEventListener('click', () => {
        fetch('/backend/api/google-gemini.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'clear_history' }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    chatHistory.innerHTML = ''; // Clear chat history in the UI
                } else {
                    alert('Failed to clear chat history.');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });
});