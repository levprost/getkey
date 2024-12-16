@extends ('layouts.app')

@section('title')
Réseau Social Laravel - Mon compte
@endsection

@section('content')
<div class="container">

    <h1>Mon compte</h1>

    <h3 class="pb-3">Modifier mes informations </h3>

    <div class="row">

        <form class="col-4 mx-auto" action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first-name">Nouveau prénom</label>
                <input required type="text" class="form-control" placeholder="modifier" name="first_name"
                    value="{{ $user->first_name }}" id="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Nouveau prénom</label>
                <input required type="text" class="form-control" placeholder="modifier" name="last_name"
                    value="{{ $user->last_name }}" id="last_name">
            </div>
            <div class="form-group">
                <label for="pseudo">Nouveau pseudo</label>
                <input required type="text" class="form-control" placeholder="modifier" name="pseudo"
                    value="{{ $user->pseudo }}" id="pseudo">
            </div>
            <div class="form-group">
                <label for="adresse">Nouvelle adresse</label>
                <input required type="text" class="form-control" placeholder="modifier" name="adresse"
                    value="{{ $user->adresse }}" id="adresse">
            </div>

            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
        <form action="{{ route('users.destroy', $user) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer le compte</button>
        </form>
    </div>
</div>
@endsection