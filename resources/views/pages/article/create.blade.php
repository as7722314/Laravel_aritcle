<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            新增文章
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <div class="container mx-auto p-5 w-full sm:w-full md:w-1/2 bg-white sm:rounded-lg shadow-xl">
                    <form action="/article/store" method="POST">
                        @csrf
                        <div class="title mb-2 w-full">
                            <label for="name" class="text-2xl">標題</label>
                            <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror w-full"
                                required />
                            @error('name')
                                <div class="animate-show text-red-600 font-bold pl-3 py-1 mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="content w-full">
                            <label for="content" class="text-2xl">內容</label>
                            <textarea id="content" name="content" rows="4" cols="50" class="@error('content') is-invalid @enderror w-full"
                                required></textarea>
                            @error('content')
                                <div class="animate-show text-red-600 font-bold pl-3 py-1">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="actions">
                            <button type="submit"
                                class="float-right m-3 px-4 py-2 border-solid border-2 border-green-200 hover:bg-green-400 rounded-lg">Add</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
