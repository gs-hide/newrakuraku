<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create New Reservation') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('reservation.store') }}" method="POST">
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for=" staff_id " :value="__(' Staff_Id ')" />
              <x-text-input id=" staff_id " class="block mt-1 w-full" type="text" name="staff_id" :value="old(' staff_id ')" required autofocus />
              <x-input-error :messages="$errors->get(' staff_id ')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for=" visit_time " :value="__(' Visit_Time ')" />
              <x-text-input id=" visit_time " class="block mt-1 w-full" type="text" name="description" :value="old(' visit_time ')" required autofocus />
              <x-input-error :messages="$errors->get(' visit_time ')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-3">
                {{ __('Create') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>


