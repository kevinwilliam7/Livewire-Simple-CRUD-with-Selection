<div>
    <div class="m-5">
        <div class="container">
            <div class="card-body">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"><span><i class="fas fa-plus-square"></i></span></button>
                <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal Create</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input wire:model="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Input your name">
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input wire:model="password" class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Input your Password">
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Email</label>
                                    <input wire:model="email" class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Input your email">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Address</label>
                                    <input wire:model="address" class="form-control @error('address') is-invalid @enderror" type="text" placeholder="Input your address">
                                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button wire:click="store()" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button wire:click="selectedExcelConfirm()" @if(count($selected)<=0) disabled @endif class="btn btn-success"><span><i class="fas fa-file-excel"></i></span></button>
                <button wire:click="selectedDestroyConfirm()" @if(count($selected)<=0) disabled @endif class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
            </div>
        </div>
        <div class="container">
            <div class="card-body table-reponsive">
                <div class="row">
                    <div class="col-sm-7 col-md-7 col-lg-7 col-7">
                        <label class="col-form-label-sm">Show</label>
                        <select wire:model="entries">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>Entries</label>
                    </div>
                    <div class="form-group col-sm-5 col-md-5 col-lg-5 col-5">
                        <input wire:model="search" class="form-control" type="search" placeholder="Search something here....">
                    </div>
                </div>
            </div>
            <div class="card-body table-reponsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $key => $user)
                            <tr class="align-middle">
                                <td><input checked="true" wire:model="selected" class="form-check-input" type="checkbox" value="{{$user->id}}"></td>
                                <td>{{$users->firstItem() + $key}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td><button wire:click="destroyConfirm({{$user->id}})" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button></td>
                            </tr>
                        @empty
                            <tr class="align-middle">
                                <td colspan="6">No Record Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>Showing {{$users->firstItem()}} to {{$users->lastItem()}} of {{$users->total()}} entries</div>
                <div>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
