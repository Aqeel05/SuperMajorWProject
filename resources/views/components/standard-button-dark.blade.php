<button {{ $attributes->merge(['type' => 'button', 'class' =>
'inline-flex items-center text-white my-1 px-2 py-1 bg-gray-900 rounded-md
hover:shadow hover:bg-gray-700
focus:ring-2 focus:ring-green-500 focus:ring-offset-2
transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
