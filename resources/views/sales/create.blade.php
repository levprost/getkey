@extends('layouts.app')

@section('content')

        <div class="container py-5">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <div class="tab-content">
                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <h3> Ajouter une Solde</h3>
                            <!-- Message d'information -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <!-- Formulaire -->
                            <form method="POST" action="{{ route('sales.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Nom du solde</label>
                                    <input type="text" name="name_sales" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary  rounded-pill shadow-sm mt-4">
                                    Ajouter une solde </button>
                            </form>
                            <!-- Fin du formulaire -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection