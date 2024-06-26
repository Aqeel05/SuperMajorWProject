<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center font-sans text-white my-1 px-2 py-1 bg-green-600 rounded-md hover:shadow hover:bg-green-500 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
