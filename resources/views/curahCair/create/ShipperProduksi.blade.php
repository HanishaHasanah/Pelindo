@extends('layout.bootstrap')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Data Shipper Produksi</h5>
                </div>
                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('shipper.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="shipper_id" class="form-label">Nama Shipper</label>
                            <select name="shipper_id" id="shipper_id" 
                                    class="form-control @error('shipper_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Shipper --</option>
                                @foreach($shippers as $shipper)
                                    <option value="{{ $shipper->id }}" {{ old('shipper_id') == $shipper->id ? 'selected' : '' }}>
                                        {{ $shipper->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shipper_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select name="bulan" id="bulan" 
                                    class="form-control @error('bulan') is-invalid @enderror" required>
                                <option value="">-- Pilih Bulan --</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('bulan') == $i ? 'selected' : '' }}>
                                        Bulan {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('bulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="number" name="tahun" id="tahun" 
                                   class="form-control @error('tahun') is-invalid @enderror"
                                   value="{{ old('tahun', date('Y')) }}" required>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="produksi" class="form-label">Produksi (Ton)</label>
                            <input type="number" step="0.001" name="produksi" id="produksi" 
                                   class="form-control @error('produksi') is-invalid @enderror"
                                   value="{{ old('produksi') }}" required>
                            @error('produksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('Data_CC', ['type' => 'shipper']) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
