<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Comments Manage --}}
            {{ __('CommentsManage') }}
        </h2>
    </x-slot>
    <div id="update_form" class="hidden custome-ani1 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="lg:mx-20 my-1 mx-10">
            <div class="flex flex-col">
                <form action="/comment/update" method="POST">
                    @csrf
                    @method('put')
                    <div class="w-full mb-3 rounded-lg">
                        <input type="hidden" id="article_id" name="article_id" />
                        <input type="hidden" id="comment_id" name="comment_id" />
                        <input class="w-full rounded-lg transition ease-in-out hover:scale-105" type="text" id="text"
                            name="text" required />
                        <button type="button"
                            class="button-show float-right mx-1 my-1 px-4 py-2 border-solid border-2 border-red-600 rounded-lg"
                            onclick="closeUpdate()">Close Update</button>
                        <button type="submit"
                            class="button-show float-right mx-1 my-1 px-4 py-2 border-solid border-2 border-fuchsia-600 rounded-lg">
                            Update Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="lg:mx-20 mx-10">
                    <div class="flex flex-col mt-12 sm:mt-8">
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}
                        <div class="border-solid border-2 border-grey-600 mb-3 p-5 rounded-lg">
                            <p class="text-3xl mb-2">{{ $article->name }}</p>
                            <p class="text-base ml-8 mr-8 mb-2 break-normal">{{ $article->content }}</p>
                            <h2 class="float-right">最新時間 : {{ $article->updated_at }}</h2>
                            <div class="p-6 custome-ani1">
                                <form class="mb-3" action="/comment/store" method="POST">
                                    @csrf
                                    <div class="w-full mb-3 rounded-lg">
                                        <input type="hidden" name="article_id" value="{{ $article->id }}" />
                                        <input class="w-full rounded-lg transition ease-in-out hover:scale-105"
                                            type="text" id="text" name="text" placeholder="輸入您想留言的內容" required />
                                        <button type="submit"
                                            class="button-show float-right my-1 px-4 py-2 border-solid border-2 border-fuchsia-600 rounded-lg">
                                            Add Comment</button>
                                    </div>
                                </form>
                            </div>
                            @if (count($comments) > 0)
                                <div class="p-6 custome-ani1">
                                    @foreach ($comments as $comment)
                                        <form action="/comment/{{ $comment->id }}/{{ $article->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <div id="{{ 'comment_' . $comment->id }}" class="flex items-center">
                                                <span
                                                    class="w-full mb-2 py-2 px-2 border-dotted border-2 border-blue-100">
                                                    <p class="break-words">{{ $comment->text }}</p>
                                                    @if ($comment->user_id == auth_user()->id || $article->user_id == auth_user()->id)
                                                        <button type="submit"
                                                            class="float-right text-xl text-red-500 px-2">❌</button>
                                                    @endif
                                                    @if ($comment->user_id == auth_user()->id)
                                                        <button type="button" class="float-right px-2"
                                                            onclick="updateComment({{ $comment }})">✏️</button>
                                                    @endif
                                                    <p class="float-right text-sm">
                                                        {{ $comment->updated_at }}</p>
                                                </span>
                                            </div>
                                        </form>
                                    @endforeach
                                    {{ $comments->links() }}
                                </div>
                            @else
                                <div class="w-full text-center my-2">暫無留言</div>

                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
<script>
    function updateComment(comment) {
        document.getElementById('article_id').value = comment.article_id;
        document.getElementById('comment_id').value = comment.id;
        document.getElementById('text').value = comment.text;
        document.getElementById("update_form").classList.remove('hidden');
        document.getElementById("update_form").classList.add('block');
    }

    function closeUpdate() {
        if (document.getElementById("update_form").classList.contains('hidden')) {
            document.getElementById("update_form").classList.remove('hidden');
            document.getElementById("update_form").classList.add('block');
        } else {
            document.getElementById("update_form").classList.remove('block');
            document.getElementById("update_form").classList.add('hidden');
        }
    }

    async function deleteComment(delete_id) {
        try {
            let res = await fetch(`http://www.side_project.com/comment/${delete_id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
            })
            let data = await res.json();
            if (data.status == true) {
                document.getElementById("comment_" + delete_id).remove();
                alert('刪除成功');
            } else {
                alert('刪除失敗');
            }
        } catch (error) {
            console.log(error);
        }
    }
</script>
