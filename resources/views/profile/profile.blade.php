@extends('layouts.app')
@section('conteudo')
    <div class="bg-white p-4 rounded-md w-full">
    <h5 class="mx-auto m-5 text-4xl font-medium text-slate-700 flex justify-center">Index</h5>
    <div class= "bg-white p-4 rounded-md w-full flex justify-between">
        <a class=" text-gray-500 py-2.5 px-4 relative mx-5 my-4 w-1/12 rounded hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white" href="{{route('showIndex')}}">
        <i class="fa fa-angle-left mr-2"></i>Back
        </a>
    
    </div>  

    <table class="w-full table-auto">
        <thead>
            <tr class="text-sm leading-normal">
            <th class="p-4 uppercase text-sm text-grey-dark border-b border-grey-light text-left">ID Usuario</th>
            <th class="p-4 uppercase text-sm text-grey-dark border-b border-grey-light text-left">Nome</th>
            <th class="p-4 uppercase text-sm text-grey-dark border-b border-grey-light text-left">Email</th>
            <th class="p-4 uppercase text-sm text-grey-dark border-b border-grey-light text-left">Editar</th>
            <th class="p-4 uppercase text-sm text-grey-dark border-b border-grey-light text-left">Ativar/Inativar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="hover:bg-grey-lighter">
            <td class="p-4 border-b border-grey-light text-left">{{$user->id}}</td>
            <td class="p-4 border-b border-grey-light text-left">{{$user->name}}</td>
            <td class="p-4 border-b border-grey-light text-left">{{$user->email}}</td>
            <td class="p-4 border-b border-grey-light text-left"><a href="{{route('edit', $user->id)}}" class="btn btn-primary">Edit</a></td>
            <td class="p-4 border-b border-grey-light text-left">
                <button class="toggle-ativacao @if($user->status === 1) btn-danger @elseif($user->status === 0) btn-success @else btn-primary @endif" data-id="{{ $user->id}}">
                {{ $user->status ? 'Disable' : 'Activate' }}
                </button>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function () 
    {
        $('.toggle-ativacao').click(function () {
        var button = $(this);
        var userId = button.data('id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/status/' + userId,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) 
            {
            if (response.status === 1) 
            {
                button.text('Disable').removeClass('btn-success').addClass('btn-danger');
            } else {
                button.text('Activate').removeClass('btn-danger').addClass('btn-success');
            }
            },
            error: function () {
                console.log(error);
            }
        });
        });
    });
</script>

@endsection