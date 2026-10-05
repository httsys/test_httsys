@php
    $selected = collect($selected ?? []);
    $isLocked = isset($role) && $role->is_locked;
@endphp

<style>
    .perm-group-card { border: 1px solid #e3e6f0; border-radius: 10px; margin-bottom: 18px; background: #fff; }
    .perm-group-head {
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 18px; border-bottom: 1px solid #eef1f6; cursor: pointer;
    }
    .perm-group-head h6 { margin: 0; font-weight: 700; font-size: 14.5px; }
    .perm-count { background: #eef1f6; color: #6c7488; font-size: 11.5px; font-weight: 700; border-radius: 20px; padding: 2px 9px; margin-left: 8px; }
    .perm-body { padding: 14px 18px; }
    .perm-item { display: flex; align-items: flex-start; gap: 10px; padding: 7px 0; }
    .perm-item label { margin: 0; font-weight: 600; font-size: 13.5px; color: #2b3244; cursor: pointer; }
    .perm-key { display: block; font-family: monospace; font-size: 11.5px; color: #9aa3b5; font-weight: 400; }
    .perm-danger { background: #fdeaea; color: #d33; font-size: 10px; font-weight: 700; border-radius: 4px; padding: 1px 6px; margin-left: 6px; vertical-align: middle; }
    .perm-selectall { font-size: 12.5px; font-weight: 600; color: #4e73df; }
    .perm-locked-note { background: #fef3d7; border: 1px solid #f0dba3; color: #8a6a00; border-radius: 8px; padding: 12px 16px; margin-bottom: 18px; font-size: 13.5px; }
</style>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="form-group">
                    <label class="font-weight-bold">Role name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $role->name ?? '') }}"
                           placeholder="e.g. Shop Manager"
                           {{ $isLocked ? 'readonly' : '' }} required>
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Description</label>
                    <textarea name="description" rows="3" class="form-control"
                              placeholder="What is this role for?">{{ old('description', $role->description ?? '') }}</textarea>
                </div>

                <div class="text-muted small"><span id="permSelectedCount">0</span> selected</div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        @if ($isLocked)
            <div class="perm-locked-note">
                <strong>This is the built-in administrator role.</strong>
                It always has full access to everything, including any feature added later,
                so its permissions can't be edited. You can still change its description.
            </div>
        @endif

        @foreach ($grouped as $groupName => $items)
            <div class="perm-group-card">
                <div class="perm-group-head" data-toggle="collapse" data-target="#permGroup{{ $loop->index }}">
                    <h6>
                        {{ $groupName }}
                        <span class="perm-count">
                            <span class="group-count" data-group="{{ $loop->index }}">0</span>/{{ count($items) }}
                        </span>
                    </h6>
                    @unless ($isLocked)
                        <a href="#" class="perm-selectall" data-group="{{ $loop->index }}">Select all</a>
                    @endunless
                </div>
                <div class="perm-body collapse show" id="permGroup{{ $loop->index }}">
                    <div class="row">
                        @foreach ($items as $item)
                            <div class="col-md-6">
                                <div class="perm-item">
                                    <input type="checkbox"
                                           class="perm-check"
                                           data-group="{{ $loop->parent->index }}"
                                           name="permissions[]"
                                           id="perm_{{ Str::slug($item['key'], '_') }}"
                                           value="{{ $item['key'] }}"
                                           {{ $isLocked || $selected->contains($item['key']) ? 'checked' : '' }}
                                           {{ $isLocked ? 'disabled' : '' }}>
                                    <label for="perm_{{ Str::slug($item['key'], '_') }}">
                                        {{ $item['label'] }}
                                        @if ($item['dangerous'])<span class="perm-danger">DANGEROUS</span>@endif
                                        <span class="perm-key">{{ $item['key'] }}</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var checks = Array.prototype.slice.call(document.querySelectorAll('.perm-check'));

    function refreshCounts() {
        document.getElementById('permSelectedCount').textContent =
            checks.filter(function (c) { return c.checked; }).length;

        document.querySelectorAll('.group-count').forEach(function (el) {
            var g = el.dataset.group;
            el.textContent = checks.filter(function (c) {
                return c.dataset.group === g && c.checked;
            }).length;
        });
    }

    checks.forEach(function (c) { c.addEventListener('change', refreshCounts); });

    document.querySelectorAll('.perm-selectall').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var g = this.dataset.group;
            var groupChecks = checks.filter(function (c) { return c.dataset.group === g; });
            var allOn = groupChecks.every(function (c) { return c.checked; });
            groupChecks.forEach(function (c) { c.checked = !allOn; });
            refreshCounts();
        });
    });

    refreshCounts();
});
</script>
