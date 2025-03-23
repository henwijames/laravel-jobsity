<x-layout>
  <x-slot:heading>
    Job Listings
  </x-slot>
  @if (session()->has('store'))
    <p style="color: green;">{{ session('store') }}</p>
    {{ session()->forget('store') }}
  @endif
  @if (session()->has('update'))
    <p style="color: green;">{{ session('update') }}</p>
    {{ session()->forget('update') }}
  @endif

  <div class="space-y-4">
    @foreach ($jobs as $job)
      <a href="/jobs/{{ $job->id }}"
        class="block px-4 py-6 border border-gray-200 rounded-lg hover:bg-slate-200 transition-colors ease-in-out">
        <div class="font-bold text-sm text-blue-500">
          {{ $job->employer ? $job->employer->name : 'No employer listed' }}
        </div>
        <div>
          <strong>{{ $job->title }}: </strong>Pays {{ $job->salary }} per month
        </div>
      </a>
    @endforeach

  </div>
  @if ($jobs->isEmpty())
    <div class="text-center text-[32px] uppercase font-bold">No jobs found</div>
  @else
    <div class="mt-2">
      {{ $jobs->links() }}
    </div>
  @endif
</x-layout>
