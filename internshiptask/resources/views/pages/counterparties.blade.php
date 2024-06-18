@extends('layouts.default')

@section('content')

@if (session('success'))
    <div class="alert alert-success m-0 p-3 alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close p-3.5" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger m-0 p-1">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h3 class="py-2">Контрагенти</h3>

    @if($counterparties->isEmpty())
        <div class="alert alert-info">
            Няма налични контрагенти.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="col-3">Име</th>
                    <th scope="col" class="col-2">Булстат</th>
                    <th scope="col" class="col-2">Адрес</th>
                    <th scope="col" class="col-2">Email</th>
                    <th scope="col" class="col-1"></th>
                    <th scope="col" class="col-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($counterparties as $counterparty)
                <tr>
                    <td>{{ $counterparty->counterpartyname }}</td>
                    <td>{{ $counterparty->bulstat }}</td>
                    <td>{{ $counterparty->address }}</td>
                    <td>{{ $counterparty->email }}</td>
                    <td class="iconCell">
                        <a href="#" class="icon-link" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $counterparty->id }}" data-name="{{ $counterparty->counterpartyname }}" data-bulstat="{{ $counterparty->bulstat }}" data-address="{{ $counterparty->address }}" data-email="{{ $counterparty->email }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square icon" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>
                    </td>
                    <td class="iconCell">
                        <a href="{{ route('counterparties.destroy', $counterparty->id) }}" id="delete" class="icon-link" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $counterparty->id }}').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trash3 icon" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                        </a>
                        <form id="delete-form-{{ $counterparty->id }}" action="{{ route('counterparties.destroy', $counterparty->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Редактиране на контрагент</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="counterpartyname" class="form-label">Name</label>
                        <input type="text" class="form-control" id="counterpartyname" name="counterpartyname">
                    </div>
                    <div class="mb-3">
                        <label for="bulstat" class="form-label">Bulstat</label>
                        <input type="number" class="form-control" id="bulstat" name="bulstat">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editCounterpartyModal = document.getElementById('editModal');
        if (editCounterpartyModal) {
            editCounterpartyModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var counterpartyId = button.getAttribute('data-id');
                var counterpartyName = button.getAttribute('data-name');
                var bulstat = button.getAttribute('data-bulstat');
                var address = button.getAttribute('data-address');
                var email = button.getAttribute('data-email');

                var modalTitle = editCounterpartyModal.querySelector('.modal-title');
                var modalBodyInputCounterpartyName = editCounterpartyModal.querySelector('#counterpartyname');
                var modalBodyBulstat = editCounterpartyModal.querySelector('#bulstat');
                var modalBodyInputAdress = editCounterpartyModal.querySelector('#address');
                var modalBodyInputEmail = editCounterpartyModal.querySelector('#email');
                var editCounterpartyForm = editCounterpartyModal.querySelector('#editForm');

                modalBodyInputCounterpartyName.value = counterpartyName;
                modalBodyBulstat.value = bulstat;
                modalBodyInputAdress.value = address;
                modalBodyInputEmail.value = email;

                editCounterpartyForm.action = '{{ route("counterparties.update", ":id") }}'.replace(':id', counterpartyId);
            });
        }
    });
</script>
@stop
