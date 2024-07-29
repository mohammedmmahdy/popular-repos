<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Filters:</h2>
    <div class="row my-2">
        <div class="col-4">
            <div class="form-group">
                <label for="language">Language</label>
                <input type="text" class="form-control" id="language" wire:model.live="language">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="per_page">Per page</label>
                <select class="form-select" id="per_page" wire:model.live="per_page">
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="created_at">Created at</label>
                <input type="date" class="form-control" id="created_at" wire:model.live="created_at">
            </div>
        </div>
    </div>
    <div class="send-mail">
        <button type="button" class="btn btn-primary my-2" wire:click="sendMail" wire:loading.remove> Notify me
            📭</button>
        <button type="button" class="btn btn-primary my-2" wire:loading wire:target="sendMail" disabled>
            Notify me 📭
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
    </div>

    <hr>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Owner</th>
                <th scope="col">Language</th>
                <th scope="col">Forks</th>
                <th scope="col">Created at</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($repositories as $repository)
                <tr>
                    <td>{{ $repository['name'] }} </td>
                    <td>{{ $repository['owner']['login'] }}</td>
                    <td>{{ $repository['language'] }}</td>
                    <td>{{ $repository['forks'] }}</td>
                    <td>{{ $repository['created_at'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No repositories found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
