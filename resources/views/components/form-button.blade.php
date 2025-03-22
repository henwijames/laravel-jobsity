<button
  {{ $attributes->merge(['class' => 'rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-gray-700 transition-all ease-in-out duration-300 border-2 focus:border-gray-300']) }}>
  {{ $slot }}
</button>
