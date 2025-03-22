<x-layout>
  <x-slot:heading>
    Job
  </x-slot>

  <h2 class=" text-lg font-bold">
    {{ $job->title }}
  </h2>
  <p>
    This job pays {{ $job->salary }} per month
  </p>

  <div class="mt-6 flex gap-x-2">
    <x-button href="/jobs/{{ $job->id }}/edit">
      Edit Job
    </x-button>
    <form method="POST" action="/jobs/{{ $job->id }}">
      @csrf
      @method('DELETE')
      <button type="submit"
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-500 leading-5 rounded-md hover:bg-red-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-red-500 dark:active:bg-gray-700 dark:active:text-gray-300">Delete</button>
    </form>
  </div>

</x-layout>
