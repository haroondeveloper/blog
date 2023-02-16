@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($role) ? 'Edit' : 'Create' }} Role</div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}">
                            @csrf
                            @if (isset($role))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ isset($role) ? $role->name : old('name') }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="name" name="slug" value="{{ isset($role) ? $role->name : old('name') }}" required>
                                @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="permissions">Permissions</label>
                                <select multiple class="form-control" id="permissions" name="permissions[]">
                                    @if(!$permissions->isEmpty())
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}" {{ isset($role) && $role->permissions->contains($permission->id) ? 'selected' : '' }}>{{ $permission->name }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                            <button type="submit" class="btn btn-primary">{{ isset($role) ? 'Update' : 'Create' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
