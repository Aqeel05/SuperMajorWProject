<x-app-layout>
    <header>
        <!-- Header section -->
        <div class="bg-green-100 p-4">
            <h1 class="font-semibold text-5xl text-center text-green-500 py-2">Chatbot</h1>
            <div class="max-w-5xl mx-auto">
                <h2 class="font-medium text-2xl text-green-600 py-1">A fast-acting advisor for your problems</h2>
                <p class="text-gray-900 py-1">
                    Chatbot frameworks have yet to be implemented.<br>
                    Our project also offers a chatbot that can be used for either seeking quick feedback regarding foot pressure distribution or the like,
                    just a quick chat, or off-topic chats.<br>
                    This is a link to ChatGPT just in case:
                    <a class="underline" href="https://chatgpt.com/">Redirect chatbot</a><br>
                    <span class="text-red-600">
                        The chatbot can make mistakes which can result in highly undesirable consequences on you.<br>
                        For professional advice, please seek a doctor.<br>
                        For safe use of this chatbot, it is only imperative that you carefully peruse OpenAI's
                        <a class="underline" href="https://openai.com/policies/privacy-policy/">Privacy Policy</a>
                        at all costs.<br>
                        You have been warned.
                    </span>
                </p>
            </div>
        </div>
    </header>
    <main>
        <div class="max-w-4xl mx-auto p-4">
            <div class="text-center">
                The chatbot page has been moved to
                <a href="{{ route('chatbot.show') }}">
                    this page
                </a>
            </div>
        </div>
    </main>
</x-app-layout>
