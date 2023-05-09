<div class="row mb-3">
    <div class="col-md-12">
        <a class="btn btn-primary" href="{{ route($route.'.create') }}"> Novo registro</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 80px">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col" style="width: 240px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rows->count() > 0)
                            @foreach ($rows as $row)
                                <tr>
                                    <th scope="row">{{ $row->id }}</th>
                                    <td>{{ $row->name }}</td>
                                    <td class="d-flex justify-content-between ">

                                        @if($route=='users')
                                            <a href="{{route($route.'.show', $row->id)}}" class="btn btn-dark ">Papéis</a>
                                        @endif

                                        <a href="{{route($route.'.edit', $row->id)}}" class="btn btn-primary ">Editar</a>

                                        <form method="POST" action="{{route($route.'.destroy', $row->id)}}" onsubmit="return confirm('Deseja realmente excluir?')">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="table-warning">
                                <td colspan="3">Nenhum registro encontrado!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
