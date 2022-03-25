@if (session()->has('notification'))
     {{-- Push messages --}}
    <div class="alert alert-success">
        <strong>{{ session('notification') }}</strong>
    </div>
@endif
