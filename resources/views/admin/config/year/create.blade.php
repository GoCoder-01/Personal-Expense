<div class="container py-3">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form id="addYearForm" action="{{ route('financial-year.store') }}" method="POST">
                @csrf
                <!-- Row 1 -->
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">From Date</label>
                        <input type="date" name="from_date" class="form-control shadow-sm" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">To Date</label>
                        <input type="date" name="to_date" class="form-control shadow-sm" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Is Running Year</label>
                        <select name="is_running_year" class="form-select shadow-sm">
                            <option value="">-- Select --</option>
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                </div>

                <!-- Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Save Financial Year
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
