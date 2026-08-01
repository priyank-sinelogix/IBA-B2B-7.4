<div class="card col-lg-10 p-0">
    <div class="card-header"><h3 class="card-title">{{ $sampleRequest->exists ? 'Edit Sample Request' : 'Request a New Sample Development' }}</h3></div>
    <form method="POST" action="{{ $sampleRequest->exists ? url('/sample-requests/'.$sampleRequest->id) : url('/sample-requests') }}" enctype="multipart/form-data">
        @csrf
        @if($sampleRequest->exists) @method('PUT') @endif
        <div class="card-body">
            @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

            <div class="form-group">
                <label>Style Name</label>
                <input type="text" name="style_name" class="form-control" value="{{ old('style_name', $sampleRequest->style_name) }}" required>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label>Fabric Preference</label>
                    <input type="text" name="fabric_preference" class="form-control" value="{{ old('fabric_preference', $sampleRequest->fabric_preference) }}" placeholder="e.g. Moss Crepe Spandex">
                </div>
                <div class="form-group col-4">
                    <label>Colour Preference</label>
                    <input type="text" name="colour_preference" class="form-control" value="{{ old('colour_preference', $sampleRequest->colour_preference) }}">
                </div>
                <div class="form-group col-4">
                    <label>Print Preference</label>
                    <input type="text" name="print_preference" class="form-control" value="{{ old('print_preference', $sampleRequest->print_preference) }}">
                </div>
            </div>
            <div class="form-group">
                <label>Description / Notes</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Describe the style, fit, references, inspiration...">{{ old('description', $sampleRequest->description) }}</textarea>
            </div>

            @if($sampleRequest->exists && $sampleRequest->images->count())
            <div class="form-group">
                <label>Current Reference Images</label>
                <div class="d-flex flex-wrap">
                    @foreach($sampleRequest->images as $img)
                    <div class="text-center mr-3 mb-2">
                        <img src="{{ $img->url() }}" width="70" height="70" style="object-fit:cover;border-radius:6px;" class="border mb-1">
                        <div class="form-check">
                            <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" class="form-check-input" id="delImg{{ $img->id }}">
                            <label class="form-check-label small text-danger" for="delImg{{ $img->id }}">Remove</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="form-group">
                <label>{{ $sampleRequest->exists ? 'Add More Reference Images (optional)' : 'Reference Images (optional — you can select multiple)' }}</label>
                <input type="file" name="reference_images[]" id="refImagesInput" class="form-control-file" accept="image/*" multiple>
                <div id="refImagePreview" class="d-flex flex-wrap mt-2"></div>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="mb-0"><strong>Size Chart (optional)</strong> — let IBA know the measurements you need</label>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSizeChartRow()"><i class="fas fa-plus mr-1"></i> Add Row</button>
            </div>
            <table class="table table-bordered mb-0" id="sizeChartTable">
                <thead>
                    <tr>
                        <th style="min-width:180px;">Specifications</th>
                        <th>XS</th><th>S</th><th>M</th><th>L</th><th>XL</th><th>2XL</th><th>3XL</th><th>4XL</th><th>5XL</th><th></th>
                    </tr>
                </thead>
                <tbody id="sizeChartBody">
                    @forelse($sampleRequest->sizeChartRows ?? [] as $row)
                    <tr>
                        <td><input type="text" name="specification[]" class="form-control form-control-sm" value="{{ $row->specification }}"></td>
                        <td><input type="number" step="0.01" name="xs[]" class="form-control form-control-sm" value="{{ $row->xs }}"></td>
                        <td><input type="number" step="0.01" name="s[]" class="form-control form-control-sm" value="{{ $row->s }}"></td>
                        <td><input type="number" step="0.01" name="m[]" class="form-control form-control-sm" value="{{ $row->m }}"></td>
                        <td><input type="number" step="0.01" name="l[]" class="form-control form-control-sm" value="{{ $row->l }}"></td>
                        <td><input type="number" step="0.01" name="xl[]" class="form-control form-control-sm" value="{{ $row->xl }}"></td>
                        <td><input type="number" step="0.01" name="xxl[]" class="form-control form-control-sm" value="{{ $row->xxl }}"></td>
                        <td><input type="number" step="0.01" name="xxxl[]" class="form-control form-control-sm" value="{{ $row->xxxl }}"></td>
                        <td><input type="number" step="0.01" name="xxxxl[]" class="form-control form-control-sm" value="{{ $row->xxxxl }}"></td>
                        <td><input type="number" step="0.01" name="xxxxxl[]" class="form-control form-control-sm" value="{{ $row->xxxxxl }}"></td>
                        <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">&times;</button></td>
                    </tr>
                    @empty
                    <tr>
                        <td><input type="text" name="specification[]" class="form-control form-control-sm" placeholder="e.g. Chest Width"></td>
                        <td><input type="number" step="0.01" name="xs[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="s[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="m[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="l[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="xl[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="xxl[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="xxxl[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="xxxxl[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="xxxxxl[]" class="form-control form-control-sm"></td>
                        <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()">&times;</button></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-iba">{{ $sampleRequest->exists ? 'Save Changes' : 'Submit Request' }}</button>
            <a href="{{ url('/sample-requests') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    function addSizeChartRow() {
        var tbody = document.getElementById('sizeChartBody');
        var row = document.createElement('tr');
        var cols = ['specification', 'xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl', 'xxxxxl'];
        cols.forEach(function (name, i) {
            var td = document.createElement('td');
            var input = document.createElement('input');
            input.className = 'form-control form-control-sm';
            input.name = name + '[]';
            input.type = i === 0 ? 'text' : 'number';
            if (i > 0) input.step = '0.01';
            td.appendChild(input);
            row.appendChild(td);
        });
        var actionTd = document.createElement('td');
        actionTd.innerHTML = '<button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest(\'tr\').remove()">&times;</button>';
        row.appendChild(actionTd);
        tbody.appendChild(row);
    }

    // Simple thumbnail preview of newly selected images before upload
    document.getElementById('refImagesInput').addEventListener('change', function (e) {
        var preview = document.getElementById('refImagePreview');
        preview.innerHTML = '';
        Array.from(e.target.files).forEach(function (file) {
            var reader = new FileReader();
            reader.onload = function (ev) {
                var img = document.createElement('img');
                img.src = ev.target.result;
                img.width = 64; img.height = 64;
                img.style.objectFit = 'cover';
                img.style.borderRadius = '6px';
                img.className = 'mr-2 mb-2 border';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
