<x-app-layout>
    <header>
    <div class="max-w-5xl mx-auto p-4">
        <div>
            <h3 class="font-medium text-lg text-gray-900">
                Chatbot (moved to all other pages)
            </h3>
            <p class="text-gray-600">This is supposed to be where the chatbot was supposed to be.</p>
        </div>
    </div>
    </header>
    <main>
        <div class="max-w-5xl mx-auto p-4">
            <div class="p-4 rounded-md bg-white">
                <div class="p-4 rounded-md bg-gray-900 overflow-y-auto" style="height: 40rem;">
                    <div class="flex justify-start">
                        <div class="p-2 pr-8 mb-4 border border-white rounded-md bg-gray-600">
                            <p class="text-white font-mono">
                                <span class="font-mono font-bold">Chatbot:</span><br>
                                This area has no code.<br>
                                null<br>
                                null<br>
                                null<br>
                                null
                            </p>
                        </div>
                    </div>    
                    <div class="flex justify-start">
                        <div class="p-2 pr-8 mb-4 border border-white rounded-md bg-black">
                            <p class="text-white font-mono">
                            <span class="font-mono font-bold">You:</span><br>
                                Let me continue!<br>
                                Let me see how long this text can be! As long as the ends of the earth?<br>
                                I wanna expand this div!<br>
                                this is a phrase<br>
                                this is another phrase<br>
                                zzzZZZ<br>
                                no
                            </p>
                        </div>    
                    </div>
                </div>
                <div class="flex flex-row mt-4 justify-center items-start space-x-4">
                    <div class="grow">
                        <textarea rows="5" class="w-full text-gray-600 resize-none rounded-md" placeholder="Typing in here won't help"></textarea>
                    </div>
                    <div class="flex-none">
                        <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 transition ease-in-out duration-150">
                            Enter
                        </button>
                    </div>
                </div>
            </div>
        </div>    
    </main>
</x-app-layout>