<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Albums') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                @if(session('success'))
                <div class='bg-green-400 text-white rounded-lg p-2 m-2'>
                    {{session('success')}}
                </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-right"><a href="{{ route('albums.create') }}" type="button" class="py-2 px-4 text-sm font-medium text-white bg-blue-500 rounded-l-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white rounded">{{ __('Albums') }}</a></div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-3 py-3">#</th>
                                    <th scope="col" class="px-3 py-3">Cover image</th>
                                    <th scope="col" class="px-3 py-3">Name</th>
                                    <th scope="col" class="px-3 py-3">Created at</th>
                                    <th scope="col" class="px-3 py-3">Updated at</th>
                                    <th scope="col" class="px-3 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($albums as $index => $album)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 h-96">
                                    <td class="px-3 py-4">{{$album->id}}</td>
                                    <th scope="row"
                                        class="px-3 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <img src="{{$album->getFirstMediaUrl('cover_image','thumb')}}"></th>
                                    <td class="px-3 py-4">
                                        {{ $album->name }}
                                    </td>
                                    <td class="px-3 py-4"> {{$album->created_at}}</td>
                                    <td class="px-3 py-4"> {{$album->updated_at}}</td>
                                    <td class="px-3 py-4">
                                        <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Actions <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                                        <!-- Dropdown menu -->
                                        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                                            <li>
                                                <a href="{{ route('albums.show', $album->id) }}" type="button" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                    Add Photos
                                                  </a>                                            </li>
                                            <li>
                                                <a href="{{ route('albums.edit', $album->id) }}" type="button" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                    Edit
                                                  </a>                                            </li>
                                            <li>
                                                <a href='#' class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" type="button" data-modal-toggle="defaultModal{{ $index }}">
                                                    Delete
                                                </a>                                            
                                            </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    No albums found
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" class="px-3 py-3">#</th>
                                    <th scope="col" class="px-3 py-3">Cover image</th>
                                    <th scope="col" class="px-3 py-3">Name</th>
                                    <th scope="col" class="px-3 py-3">Created at</th>
                                    <th scope="col" class="px-3 py-3">Updated at</th>
                                    <th scope="col" class="px-3 py-3">Actions</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@foreach($albums as $index => $album)
  <!-- Main modal -->
    <div id="defaultModal{{ $index }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('are you sure you want to delete this album?') }}
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal{{ $index }}">
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                  </button>
              </div>
              <!-- Modal body -->
              <form action="{{ route('albums.destroy', $album->id) }}" method="POST">
                @method('DELETE')
                @csrf
              <div class="p-6 space-y-6">
                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                      {{ __('if you click accept the album with it\'s photo will delete.') }}
                  </p>
                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    {{ __('if you click move the album will delete but it photos will move to anther album.') }}

                </p>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                  <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">I accept</button>
                  <a href="{{ route('move_photos', $album->id) }}" type="button" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-blue-800">Move Photos</a>
              </div>
              </form>
          </div>
      </div>
  </div>
  @endforeach
  @push('scripts')
  <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>
  @endpush
</x-app-layout>