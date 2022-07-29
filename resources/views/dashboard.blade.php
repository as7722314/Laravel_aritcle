<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="/article/create"
                    class="float-right text-center p-3 mr-3 mt-3 rounded-lg border-solid border-2 border-green-200 button-show transition duration-500 bg-transparent hover:bg-green-300">
                    Create Article
                </a>
                <div class="lg:m-20 m-10">
                    <div class="flex flex-col mt-24 sm:mt-20">
                        @foreach ($articles as $article)
                            <div class="md:full border-solid border-2 border-grey-600 mb-3 p-5 rounded-lg">
                                <p class="text-3xl mb-2">{{ $article->name }}</p>
                                <p class="text-base ml-8 mb-2">{{ $article->content }}</p>
                                <h2 class="float-right">最新時間 : {{ $article->updated_at }}</h2><br>
                                <div class="my-1 h-28 md:h-12 sm:h-16 w-full">
                                    @if (auth_user()->id == $article->user_id)
                                        <a href="/article/delete/{{ $article->id }}"
                                            class="float-right w-20 text-center mx-1 py-2 rounded-lg border-solid border-2 border-red-200 button-show transition duration-500 bg-transparent hover:bg-red-300">
                                            Delete
                                        </a>
                                        <a href="/article/show_update/{{ $article->id }}"
                                            class="float-right w-20 text-center mx-1 py-2 rounded-lg border-solid border-2 border-blue-200 button-show transition duration-500 bg-transparent hover:bg-sky-300">
                                            Update
                                        </a>
                                    @endif
                                    @if (count($article->comments) > 0)
                                        <button
                                            class="float-right text-center mx-1 px-2 py-2 border-solid border-2 border-black-200 rounded-lg button-show"
                                            onclick="showComments('{{ $article->id . '_comment' }}')">
                                            Comments
                                        </button>
                                    @endif
                                    <a href="/comment/{{ $article->id }}/article"
                                        class="float-right text-center mx-1 px-2 py-2 rounded-lg border-solid border-2 border-blue-200 button-show transition duration-500 bg-transparent hover:bg-sky-300">
                                        Comments Area
                                    </a>
                                </div>

                                <div id="{{ $article->id . '_comment' }}" class="hidden p-6">
                                    @foreach ($article->comments as $comment)
                                        <div id="{{ 'comment_' . $comment->id }}" class="flex items-center">
                                            <span
                                                class="custome-ani1 w-full mb-2 py-2 px-2 block border-dotted border-2 border-blue-100">
                                                <p>{{ $comment->text }}</p>
                                                <p class="float-right text-sm">{{ $comment->updated_at }}</p>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>


</style>
<script>
    function showComments(id) {
        if (document.getElementById(id).classList.contains('hidden')) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('block');
        } else {
            document.getElementById(id).classList.remove('block');
            document.getElementById(id).classList.add('hidden');
        }

    }
</script>
