<input type="text" name="search" class="form-control mr-2" style="max-width:220px;" placeholder="{{ $searchPlaceholder ?? 'Search...' }}" value="{{ request('search') }}">
<select name="per_page" class="form-control mr-2" style="max-width:110px;" onchange="this.form.submit()">
    @foreach([15,25,50,100,200] as $n)
        <option value="{{ $n }}" {{ (int) request('per_page', 100) === $n ? 'selected' : '' }}>{{ $n }}/page</option>
    @endforeach
</select>
<button class="btn btn-outline-secondary mr-2"><i class="fas fa-search"></i></button>
