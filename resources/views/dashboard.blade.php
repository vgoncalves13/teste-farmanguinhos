<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        {{-- Check if has flash message --}}
        @if (session('success'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
                <div class="bg-green-100 border border-green-400 text-white-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sucesso!</strong>
                    <span class="block sm:inline">Cadastro efetuado!</span><br>
                    <strong>Nome: </strong>{{session('user')->name}}<br>
                    <strong>CEP: </strong>{{session('user')->cep}}<br>
                    <strong>Endereço: </strong>{{session('user')->address}}<br>
                    <strong>Número: </strong>{{session('user')->number}}<br>
                    <strong>Complemento: </strong>{{session('user')->complement}}<br>
                    <strong>Cidade: </strong>{{session('user')->city}}<br>
                    <strong>Estado: </strong>{{session('user')->state}}<br>
                </div>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-red-200">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><a href="{{ route('register') }}">Criar novo usuário</a></button>
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">CEP</th>
                                <th class="px-4 py-2">Endereço</th>
                                <th class="px-4 py-2">Número</th>
                                <th class="px-4 py-2">Complemento</th>
                                <th class="px-4 py-2">Cidade</th>
                                <th class="px-4 py-2">Estado</th>
                                <th class="px-4 py-2">Criado em</th>
                                <th class="px-4 py-2">Atualizado em</th>
                                <th class="px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $user->id }}</td>
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">{{ $user->cep }}</td>
                                        <td class="border px-4 py-2">{{ $user->address }}</td>
                                        <td class="border px-4 py-2">{{ $user->number }}</td>
                                        <td class="border px-4 py-2">{{ $user->complement }}</td>
                                        <td class="border px-4 py-2">{{ $user->city }}</td>
                                        <td class="border px-4 py-2">{{ $user->state }}</td>
                                        <td class="border px-4 py-2">{{ $user->created_at }}</td>
                                        <td class="border px-4 py-2">{{ $user->updated_at }}</td>
                                        {{-- Create small button to delete with confirmation --}}
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                {{-- Button with sweetalert2 confirmation --}}
                                                <button type="submit" class="show_confirm bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Tem certeza que deseja deletar?`,
              text: "Esta ação não poderá ser revertida.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>
