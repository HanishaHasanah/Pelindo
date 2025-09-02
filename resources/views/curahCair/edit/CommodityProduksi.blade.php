@extends('layout.bootstrap')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Data Komoditas Produksi</h5>
            </div>
            <div class="card-body">
                
                {{-- Pesan error --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('commodity.update', $data->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="commodity_id" class="form-label">Nama Komoditas</label>
                        <select name="commodity_id" id="commodity_id" class="form-select" required>
                            @foreach($commodities as $commodity)
                                <option value="{{ $commodity->id }}" {{ $data->commodity_id == $commodity->id ? 'selected' : '' }}>
                                    {{ $commodity->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select" required>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $data->bulan == $i ? 'selected' : '' }}>
                                    Bulan {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" 
                               value="{{ $data->tahun }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="produksi" class="form-label">Produksi (Ton)</label>
                        <input type="number" step="0.001" name="produksi" id="produksi" 
                               class="form-control" value="{{ $data->produksi }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Data_CC', ['type' => 'commodity']) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
