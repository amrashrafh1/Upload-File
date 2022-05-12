<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Album') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class='text-red-500 text-sm font-bold p-2'>{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
                        <form method='post' action='{{route('albums.update', $album->id)}}' enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="mt-4 gap-x-2">
                                    <label for="name">Name</label>
                                    <input type="text" name='name' class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="name"
                                        value="{{old('name', $album->name)}}" placeholder="Enter Album name">
                                </div>
                                <div class="mt-4 gap-x-2">
                                    <label for="cover-image">Cover Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name='cover_image' class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                id="cover-image">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class='mt-6 gap-x-2'>
                                    <img src="{{ $album->getFirstMediaUrl('cover_image','thumb')}}"/>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer mt-5">
                                <button type="submit" class="py-2 px-4 text-sm font-medium text-white bg-blue-500 rounded-l-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
